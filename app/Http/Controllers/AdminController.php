<?php

namespace App\Http\Controllers;


use App\Models\ContactUSMessage;
use Illuminate\Support\Facades\Log;
use App\Models\Deposit;
use App\Models\Idverification;
use App\Models\Investment;
use App\Models\Message;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\Withdrawal;
 use App\Models\ServerFeed;
use App\Models\WithdrawalCard;
use App\Notifications\AdminMessageNotification;
use App\Notifications\IDVerificationSubmitted;

use App\Notifications\TransactionNotification;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AdminController extends Controller
{
   public function userIndex(Request $request)
{
    $query = User::with(['investments', 'profile', 'withdrawalCard'])
        ->withSum('investments', 'amount_invested')
        ->where('role_as', 0);

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    if ($request->filled('status')) {
        $query->where('active', $request->status === 'Active' ? 1 : 0);
    }

    $users = $query->paginate(10)->withQueryString();

    return view('admin.users.index', compact('users'));
}
    public function hiddenuser(Request $request)
    {
        $query = User::with(['profile', 'withdrawalCard'])
            ->withSum('investments', 'amount_invested')
            ->where('role_as', 0);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        if ($request->filled('status')) {
            $query->where('active', $request->status === 'Active' ? 1 : 0);
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users.indexmain', compact('users'));
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function pendingDeposits()
    {
        $deposits = Deposit::with('user', 'plan', 'wallet')
            ->where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.pending', compact('deposits'));
    }

    public function approvedDeposits()
    {
        $deposits = Deposit::with(['user', 'plan', 'wallet'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.approved', compact('deposits'));
    }


    public function rejectDeposit(Request $request, $id)
    {
        $request->validate([
            'rejection_note' => 'required|string|min:5',
        ]);

        $deposit = Deposit::findOrFail($id);

        if ($deposit->status === 1) {
            return back()->with('error', 'Cannot reject approved deposit.');
        }

        $deposit->update([
            'status' => 2, // rejected
            'rejection_note' => $request->rejection_note,
        ]);

        // Optional notification
        $deposit->user->notify(new TransactionNotification(
            'Deposit Rejected',
            'Your deposit was rejected. Please check the reason in your dashboard.'
        ));

        return back()->with('success', 'Deposit rejected with reason.');
    }

   public function approveDeposit($id)
{
    DB::transaction(function () use ($id) {

        $deposit = Deposit::findOrFail($id);

        if ($deposit->status === 1) {
            throw new \Exception('Already approved');
        }

        $plan = Plan::findOrFail($deposit->plan_id);

        $roi = $plan->interest_rate;
        $totalProfit = ($deposit->amount_deposited * $roi / 100) * $plan->duration;

        Investment::create([
            'user_id' => $deposit->user_id,
            'plan_id' => $deposit->plan_id,
            'amount_invested' => $deposit->amount_deposited,
            'roi' => $roi,
            'total_profit' => $totalProfit,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
            'withdrawn' => 0,
        ]);

        $deposit->update(['status' => 1]);
    });

    return back()->with('success', 'Deposit approved and investment started');
}

    public function showApprovedWithdrawals()
    {
        $approvedWithdrawals = Withdrawal::where('status', 'approved')
            ->with(['user'])
            ->latest()
            ->get();

        $withdrawalCards = WithdrawalCard::all();

        return view('admin.deposits.withdrawal_approved', compact('approvedWithdrawals', 'withdrawalCards'));
    }

    public function unapproveBalanceWithdrawal(Request $request, $id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->user->available_balance += $withdrawal->amount;
        $withdrawal->user->save();

        $withdrawal->status = 'failed';
        $withdrawal->admin_note = $request->admin_note;
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal has been unapproved and marked as failed.');
    }

    // ✅ FIXED: Generate Membership Code



    // Add this to AdminController.php

    public function generateMembershipCode(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($request->user_id);

        // Check if user already has a code
        if ($user->membership_code) {
            return response()->json([
                'success' => false,
                'message' => 'User already has code: ' . $user->membership_code
            ], 400);
        }

        // Generate unique code
        do {
            $membershipCode = 'VIP' . date('Y') . strtoupper(Str::random(6));
        } while (DB::table('membership_codes')->where('code', $membershipCode)->exists());

        // Insert into membership_codes table
        DB::table('membership_codes')->insert([
            'code' => $membershipCode,
            'is_used' => false,
            'used_by' => null,
            'used_at' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Assign to user (but don't activate yet)
        $user->update([
            'membership_code' => $membershipCode,
            'has_membership' => false
        ]);

        return response()->json([
            'success' => true,
            'membership_code' => $membershipCode,
            'user_name' => $user->name
        ]);
    }

    // live

    public function toggleMembershipLock(User $user)
    {
        $user->membership_locked = !$user->membership_locked;
        $user->save();

        $status = $user->membership_locked ? 'locked' : 'unlocked';

        return back()->with('success', "Membership code has been {$status}.");
    }



    public function withdrawaldestroy($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'approved') {
            return back()->with('error', 'Only approved withdrawals can be deleted.');
        }

        $withdrawal->delete();

        return back()->with('success', 'Approved withdrawal deleted successfully.');
    }

    public function updateBalance(Request $request, $id)
    {
        $request->validate([
            'available_balance' => 'required|numeric|min:0',
            'investments.*' => 'nullable|numeric|min:0',
        ]);

        $user = User::findOrFail($id);
        $user->available_balance = $request->input('available_balance');
        $user->save();

        return redirect()->route('user.index')->with('success', 'User balance updated successfully.');
    }

    public function admin_dashboard()
    {
        $totalUsers = User::count();
        $totalDeposits = User::sum('available_balance');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $amount_invested = Investment::sum('amount_invested');
        $user = auth()->user();
        return view('admin.index', compact(
            'totalUsers',
            'totalDeposits',
            'totalWithdrawals',
            'amount_invested',
            'user'
        ));
    }

    public function adminViewWithdrawals()
    {
        $withdrawals = Withdrawal::with(['user.profile', 'user.withdrawalCard'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.deposits.withdrawal_pending', compact('withdrawals'));
    }

    public function approveBalanceWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 'approved') {
            return back()->with('error', 'This withdrawal has already been approved.');
        }

        $withdrawal->status = 'approved';
        $withdrawal->admin_note = null;
        $withdrawal->save();

        $user = $withdrawal->user;

        $user->notify(new TransactionNotification(
            'Withdrawal Approved',
            'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been approved.'
        ));

        return back()->with('success', 'Withdrawal approved successfully.');
    }

    public function rejectBalanceWithdrawal(Request $request, $id)
    {
        $request->validate([
            'admin_note' => 'required|string|max:500',
        ]);

        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        $user = $withdrawal->user;
        $user->available_balance += $withdrawal->amount;
        $user->save();

        $withdrawal->status = 'rejected';
        $withdrawal->admin_note = $request->admin_note;
        $withdrawal->save();

        $user->notify(new TransactionNotification(
            'Withdrawal Rejected',
            'Your withdrawal request of $' . number_format($withdrawal->amount, 2) . ' has been rejected. Reason: ' . $request->admin_note
        ));

        return back()->with('success', 'Withdrawal rejected, amount refunded to user, and notification sent.');
    }

    public function index()
    {
        $messages = ContactUSMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contactUs.index', compact('messages'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully.');
    }

    public function profile()
    {
        $user = User::with('profile')->find(auth()->id());
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);

            $profile = $user->profile ?? new \App\Models\UserProfile();
            $profile->user_id = $user->id;
            $profile->profile_pic = $filename;
            $profile->save();
        }

        $user->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
        ]);

        if ($user->profile) {
            $user->profile->update([
                'address' => $request->input('address'),
                'bitcoin_address' => $request->input('bitcoin_address'),
                'etherium_address' => $request->input('etherium_address'),
            ]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function kycindex()
    {
        $kycs = UserKyc::with('user')->latest()->get();
        return view('admin.admin_approve_id_verification', compact('kycs'));
    }

    public function approve($id)
    {
        $kyc = UserKyc::with('user')->findOrFail($id);

        if ($kyc->status === 'approved') {
            return redirect()->back()->with('error', 'This KYC is already approved.');
        }

        if ($kyc->status === 'rejected') {
            return redirect()->back()->with('error', 'This KYC has already been rejected and cannot be approved.');
        }

        $kyc->status = 'approved';
        $kyc->admin_note = 'Approved by admin';
        $kyc->save();

        $user = $kyc->user;
        $user->notify(new TransactionNotification(
            'KYC Approved',
            'Your KYC documents have been reviewed and approved. You have unlocked additional features for your trading.'
        ));

        return redirect()->back()->with('success', 'KYC approved.');
    }

    public function reject($id)
    {
        $kyc = UserKyc::with('user')->findOrFail($id);

        if ($kyc->status === 'rejected') {
            return redirect()->back()->with('error', 'This KYC is already rejected.');
        }

        if ($kyc->status === 'approved') {
            return redirect()->back()->with('error', 'This KYC has already been approved and cannot be rejected.');
        }

        $kyc->status = 'rejected';
        $kyc->admin_note = 'Rejected by admin';
        $kyc->save();

        $user = $kyc->user;
        $user->notify(new TransactionNotification(
            'KYC Rejected',
            'Your KYC documents were reviewed and rejected. Please upload a clearer image of your ID for verification.'
        ));

        return redirect()->back()->with('success', 'KYC rejected.');
    }



    // * Get language code based on country
    //      */
    private function getLanguageCode($country)
    {
        $countryLanguageMap = [
            'Afghanistan' => 'ps',
            'Albania' => 'sq',
            'Algeria' => 'ar',
            'Argentina' => 'es',
            'Australia' => 'en',
            'Austria' => 'de',
            'Bangladesh' => 'bn',
            'Belarus' => 'be',
            'Belgium' => 'nl',
            'Brazil' => 'pt',
            'Bulgaria' => 'bg',
            'Cambodia' => 'km',
            'Canada' => 'en',
            'Chile' => 'es',
            'China' => 'zh-CN',
            'Colombia' => 'es',
            'Croatia' => 'hr',
            'Czech Republic' => 'cs',
            'Denmark' => 'da',
            'Egypt' => 'ar',
            'Estonia' => 'et',
            'Finland' => 'fi',
            'France' => 'fr',
            'Germany' => 'de',
            'Ghana' => 'en',
            'Greece' => 'el',
            'Hong Kong' => 'zh-TW',
            'Hungary' => 'hu',
            'Iceland' => 'is',
            'India' => 'hi',
            'Indonesia' => 'id',
            'Iran' => 'fa',
            'Iraq' => 'ar',
            'Ireland' => 'en',
            'Israel' => 'he',
            'Italy' => 'it',
            'Japan' => 'ja',
            'Jordan' => 'ar',
            'Kazakhstan' => 'kk',
            'Kenya' => 'sw',
            'Kuwait' => 'ar',
            'Latvia' => 'lv',
            'Lebanon' => 'ar',
            'Lithuania' => 'lt',
            'Luxembourg' => 'lb',
            'Malaysia' => 'ms',
            'Maldives' => 'dv',
            'Mexico' => 'es',
            'Morocco' => 'ar',
            'Nepal' => 'ne',
            'Netherlands' => 'nl',
            'New Zealand' => 'en',
            'Nigeria' => 'en',
            'Norway' => 'no',
            'Pakistan' => 'ur',
            'Palestine' => 'ar',
            'Peru' => 'es',
            'Philippines' => 'tl',
            'Poland' => 'pl',
            'Portugal' => 'pt',
            'Qatar' => 'ar',
            'Romania' => 'ro',
            'Russia' => 'ru',
            'Saudi Arabia' => 'ar',
            'Serbia' => 'sr',
            'Singapore' => 'en',
            'Slovakia' => 'sk',
            'Slovenia' => 'sl',
            'South Africa' => 'af',
            'South Korea' => 'ko',
            'Spain' => 'es',
            'Sri Lanka' => 'si',
            'Sweden' => 'sv',
            'Switzerland' => 'de',
            'Syria' => 'ar',
            'Taiwan' => 'zh-TW',
            'Tanzania' => 'sw',
            'Thailand' => 'th',
            'Tunisia' => 'ar',
            'Turkey' => 'tr',
            'Ukraine' => 'uk',
            'United Arab Emirates' => 'ar',
            'United Kingdom' => 'en',
            'United States' => 'en',
            'Uruguay' => 'es',
            'Uzbekistan' => 'uz',
            'Venezuela' => 'es',
            'Vietnam' => 'vi',
            'Yemen' => 'ar',
            'Zambia' => 'en',
            'Zimbabwe' => 'en',
        ];

        return $countryLanguageMap[$country] ?? 'en';
    }

    /**
     * Translate message to target language using Google Cloud Translate
     */

    private function translateMessage($text, $targetLanguage)
    {
        try {
            if ($targetLanguage === 'en' || empty($targetLanguage)) {
                return $text;
            }

            $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl={$targetLanguage}&dt=t&q=" . urlencode($text);

            $response = file_get_contents($url);

            if (!$response) {
                return $text;
            }

            $result = json_decode($response, true);

            if (!isset($result[0])) {
                return $text;
            }

            $translatedText = '';

            foreach ($result[0] as $sentence) {
                $translatedText .= $sentence[0];
            }

            return $translatedText;
        } catch (\Exception $e) {
            Log::error('Translation failed: ' . $e->getMessage());
            return $text;
        }
    }
    /**
     * Send message with auto-translation
     */
    /**
     * Send message with auto-translation
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'users' => 'required|array'
        ]);

        if (in_array('all', $request->users)) {
            $users = User::all();
        } else {
            $users = User::whereIn('id', $request->users)->get();
        }

        $originalTitle = $request->title;
        $originalMessage = $request->message;

        $translationSuccess = true;
        $failedTranslations = [];

        foreach ($users as $user) {
            $languageCode = $this->getLanguageCode($user->country ?? '');

            try {
                $translatedTitle = $this->translateMessage($originalTitle, $languageCode);
                $translatedMessage = $this->translateMessage($originalMessage, $languageCode);

                $user->notify(new AdminMessageNotification(
                    $translatedTitle,
                    $translatedMessage,
                    $originalTitle,
                    $originalMessage,
                    $languageCode,
                    $user->country
                ));
            } catch (\Exception $e) {
                // If translation fails, send the original message
                Log::warning('Translation failed for user ' . $user->id . ': ' . $e->getMessage());
                $failedTranslations[] = $user->name;

                $user->notify(new AdminMessageNotification(
                    $originalTitle,
                    $originalMessage,
                    $originalTitle,
                    $originalMessage,
                    'en',
                    $user->country
                ));
            }
        }

        $message = 'Messages sent successfully!';
        if (!empty($failedTranslations)) {
            $message = 'Messages sent, but translation failed for: ' . implode(', ', $failedTranslations);
        }

        Log::info('Messages sent', [
            'total_users' => $users->count(),
            'failed_translations' => $failedTranslations
        ]);

        return back()->with('success', $message);
    }




    //copying trades
   



public function serverindex()
{
    $feeds = ServerFeed::latest()->get();
    return view('admin.serverfeeds.index', compact('feeds'));
}

public function store(Request $request)
{
    $request->validate([
        'server_name' => 'required|string|max:255',
        'admin_name' => 'required|string|max:255',
        'active_members' => 'required|integer',
        'copying_trades' => 'required|integer',
        'profit_margin' => 'required|numeric',

        // Server profile
        'server_profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'server_description' => 'nullable|string',

        // Admin profile
        'admin_profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'admin_bio' => 'nullable|string',
    ]);

    $data = [
        'server_name' => $request->server_name,
        'admin_name' => $request->admin_name,
        'active_members' => $request->active_members,
        'copying_trades' => $request->copying_trades,
        'profit_margin' => $request->profit_margin,
        'server_description' => $request->server_description,
        'admin_bio' => $request->admin_bio,
    ];

    // Handle Server Image
    if ($request->hasFile('server_profile_image')) {
        $image = $request->file('server_profile_image');
        $path = $image->store('servers', 'public');
        $data['server_profile_image'] = basename($path);
    }

    // Handle Admin Image
    if ($request->hasFile('admin_profile_image')) {
        $image = $request->file('admin_profile_image');
        $path = $image->store('admins', 'public');
        $data['admin_profile_image'] = basename($path);
    }

    ServerFeed::create($data);

    return back()->with('success', 'Server added successfully');
}

public function update(Request $request, $id)
{
    $feed = ServerFeed::findOrFail($id);

    $request->validate([
        'server_name' => 'required|string|max:255',
        'admin_name' => 'required|string|max:255',
        'active_members' => 'required|integer',
        'copying_trades' => 'required|integer',
        'profit_margin' => 'required|numeric',

        'server_profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'server_description' => 'nullable|string',

        'admin_profile_image' => 'nullable|image|mimes:jpg,jpeg,png',
        'admin_bio' => 'nullable|string',
    ]);

    $data = [
        'server_name' => $request->server_name,
        'admin_name' => $request->admin_name,
        'active_members' => $request->active_members,
        'copying_trades' => $request->copying_trades,
        'profit_margin' => $request->profit_margin,
        'server_description' => $request->server_description,
        'admin_bio' => $request->admin_bio,
    ];

    if ($request->hasFile('server_profile_image')) {
        $path = $request->file('server_profile_image')
                        ->store('servers', 'public');
        $data['server_profile_image'] = basename($path);
    }

    if ($request->hasFile('admin_profile_image')) {
        $path = $request->file('admin_profile_image')
                        ->store('admins', 'public');
        $data['admin_profile_image'] = basename($path);
    }

    $feed->update($data);

    return back()->with('success', 'Server updated successfully');
}


public function deleteServerFeed($id)
{
    ServerFeed::findOrFail($id)->delete();
    return back()->with('success', 'Server info deleted');
}
public function serveredit($id)
{
    $feed = ServerFeed::findOrFail($id);
    return view('admin.serverfeeds.edit', compact('feed'));
}
}
