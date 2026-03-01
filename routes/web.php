<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

use App\Models\Plan;

use App\Http\Controllers\{
    AdminController,
    DepositController,
    HomeController,
    InvestmentController,
    PlanController,
    ProfileController,
    UserController,
    WalletController,
    UserCardController,
    Auth\LoginController,
    Auth\ResetPasswordController,
    Auth\ForgotPasswordController,
    MessageController,
    UserAuthController,
    UserKycController,
    WithdrawalController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    $plans = Cache::remember('homepage_plans', 60, function () {
        return Plan::latest()->get();
    });

    return view('welcome', compact('plans'));
});

// Auth scaffolding
Auth::routes();

// Custom Auth pages under 'auth' prefix
Route::prefix('auth')->group(function () {
    Route::get('/signup', [UserController::class, 'signup'])->name('signup');
    // Route::post('/create', [UserController::class, 'create_user'])->name('user.create');
    Route::get('/planlists', [UserController::class, 'plans_header'])->name('plans.header');
    Route::get('/about-us', [UserController::class, 'About_Us'])->name('about.us');
    Route::get('/OurServices', [UserController::class, 'services'])->name('our.services');
    Route::get('/ContactUs', [UserController::class, 'contactus'])->name('contact.us');

    // contact us form submission
    Route::post('/contact/send', [UserController::class, 'send'])->name('user.contact.send');
});

// --- Language ---
Route::post('/set-language', function (Request $request) {
    session(['locale' => $request->lang]);
    return response()->json(['status' => 'ok']);
});


// --- Overlay Control ---
Route::middleware('auth')->group(function () {
    // Hide overlay when user clicks close
    Route::post('/hide-overlay', [UserController::class, 'hideOverlay'])
        ->name('user.hide-overlay');
});



// --- Authentication Routes (login) ---
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// --- Password Reset & OTP Routes ---
Route::get('password/reset', function () {
    return redirect()->route('password.otp.request');
})->name('password.request');

// OTP password reset routes
Route::get('password/forgot', [ForgotPasswordController::class, 'showOtpRequestForm'])->name('password.otp.request');

// Redirect default password reset URL to OTP request


Route::post('password/otp-send', [ForgotPasswordController::class, 'sendOtp'])->name('password.otp.send');
Route::get('password/otp-verify', [ForgotPasswordController::class, 'showOtpVerifyForm'])->name('password.otp.verify.form');
Route::post('password/otp-verify', [ForgotPasswordController::class, 'verifyOtpAndReset'])->name('password.otp.verify');
Route::get('/password/verify-otp', fn() => view('auth.passwords.otp_verify'))->name('password.otp.form');

// --- Other public routes related to OTP verification ---
Route::get('/verify-otp/{token}', [UserController::class, 'showVerifyOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [UserController::class, 'submitOtp'])->name('otp.submit');
Route::post('/resend-otp', [UserController::class, 'resendOtp'])->name('otp.resend');

// --- Notifications ---
Route::get('/user/notifications', fn() => view('dashboard.user.notifications'))
    ->middleware(['auth', 'verified'])
    ->name('user.notifications');

// --- User creation ---
Route::post('/create-user', [UserController::class, 'createUser'])->name('user.create');

// --- Take profit ---
Route::post('/user/take-profit', [UserController::class, 'takeProfit'])->middleware('auth');

// --- Middleware-protected routes ---
Route::middleware(['auth'])->group(function () {

    // Home and Signout
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/signout', [HomeController::class, 'signout'])->name('signout');

    // Profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'userProfile'])->name('profile.show');
        Route::put('/', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    });

    // Investment & Withdrawal shared routes
    Route::post('/user/investments/{id}/withdraw', [InvestmentController::class, 'withdraw'])->name('investments.withdraw');
    Route::post('/investments/{id}/take-profit', [InvestmentController::class, 'takeProfit'])->name('investments.takeProfit');

    // Dismiss banner
    Route::post('/dismiss-banner', function () {
        session(['dismissed_zero_investment_banner' => true]);
        return response()->json(['success' => true]);
    })->name('user.dismiss-banner');

    // Withdraw from balance
    Route::post('/dashboard/withdraw', [WithdrawalController::class, 'withdrawFromBalance'])->name('user.balance.withdraw');

    // Investments list
    Route::get('/investments', [InvestmentController::class, 'index'])->name('user.investments');
    Route::get('/withdrawn-investments', [InvestmentController::class, 'withdrawnInvestments'])->name('user.withdrawn.investments');

    // --- User routes under /user prefix ---
    Route::prefix('user')->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserController::class, 'user_dashboard'])->name('user_dashboard');

        // Deposit routes
        Route::controller(DepositController::class)->group(function () {
            Route::get('/deposit', 'userDeposit')->name('user.deposit');
            Route::post('/make-deposit', 'userMakeDeposit')->name('user.make-deposit');
            Route::get('/confirm-deposit', 'confirmDeposit')->name('deposit.confirm');
            Route::post('/submit-deposit', 'submitDeposit')->name('deposit.submit');
            Route::get('/deposit-history', 'depositHistory')->name('user.deposit-history');
        });

        // Reinvestment
        Route::post('/initiate-reinvestment', [UserController::class, 'initiateReinvestment'])->name('initiate.reinvestment');

        // Plans
        Route::get('/planlist', [PlanController::class, 'plan_dashboard'])->name('plan.dashboard');

        // Withdrawals
        Route::get('/withdraw/form', [WithdrawalController::class, 'showWithdrawForm'])->name('user.withdraw.form');
        Route::post('/withdraw/request', [WithdrawalController::class, 'submitWithdrawRequest'])->name('balance.withdraw.request');
        Route::get('/withdrawals/list', [WithdrawalController::class, 'withdrawalList'])->name('user.withdrawals.list');

        Route::prefix('withdrawals')->controller(WithdrawalController::class)->group(function () {
            Route::get('/', 'index')->name('withdrawals.index');
            Route::post('/generate-card', 'generateCard')->name('withdrawals.generateCard');
            Route::get('/view-card', 'viewCard')->name('withdrawals.view-card');
        });
    });


       Route::get('/rules&guildlines', [UserController::class, 'rules_regulations'])->name('rules.regulations');

    // --- Admin Routes ---
    Route::prefix('admin')->middleware('isAdmin')->group(function () {

        // Admin dashboard & withdrawals reject
        Route::get('/dashboard', [AdminController::class, 'admin_dashboard'])->name('admin_dashboard');
        Route::post('/withdrawals/{id}/reject', [AdminController::class, 'rejectBalanceWithdrawal'])->name('admin.withdraw.reject');

        // Admin messages
        Route::get('/messages', [AdminController::class, 'index'])->name('admin.messages.index');
        Route::delete('/messages/{message}', [AdminController::class, 'destroy'])->name('admin.messages.destroy');

        // Admin profile routes with auth middleware
        Route::middleware(['auth'])->group(function () {
            Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
            Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        });
       
Route::post('/admin/withdrawals/{id}/unapprove', [AdminController::class,'unapproveBalanceWithdrawal'])->name('withdraw.unapprove');



    });

 


    
    // Plans management
    Route::prefix('plans')->group(function () {
        Route::get('/', [PlanController::class, 'planList'])->name('plan.list');
        Route::get('/create', [PlanController::class, 'addPlan'])->name('create_plan');
        Route::post('/store', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/edit/{id}', [PlanController::class, 'editPlan'])->name('plan.edit');
        Route::post('/update/{id}', [PlanController::class, 'updatePlan'])->name('plan.update');
        Route::get('/delete/{id}', [PlanController::class, 'deletePlan'])->name('plan.delete');
    });

    // Wallets management
    Route::prefix('wallets')->group(function () {
        Route::get('/', [WalletController::class, 'index'])->name('wallet.index');
        Route::get('/create', [WalletController::class, 'addWallet'])->name('create_wallet');
        Route::post('/store', [WalletController::class, 'storeWallet'])->name('wallet.create');
        Route::delete('/{id}', [WalletController::class, 'destroy'])->name('wallet.delete');
    });

    // Users management
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminController::class, 'userIndex'])->name('user.index');
          Route::get('/hidden', [AdminController::class, 'hiddenuser'])->name('hidden.user');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');
        Route::put('/{id}/update-balance', [AdminController::class, 'updateBalance'])->name('admin.users.updateBalance');
        Route::delete('/{id}', [AdminController::class, 'userDestroy'])->name('user.destroy');
    });

    // Deposits management
    Route::prefix('deposits')->controller(AdminController::class)->group(function () {
        Route::get('/pending', 'pendingDeposits')->name('admin.deposits.pending');
        Route::get('/approved', 'approvedDeposits')->name('admin.deposits.approved');
        Route::post('/approve/{id}', 'approveDeposit')->name('admin.approve.deposit');

       
          Route::delete('/reject/{id}',  'rejectDeposit')->name('admin.reject.deposit');

    });



    // Withdrawals management
    Route::prefix('withdrawals')->group(function () {
        Route::get('/pending', [AdminController::class, 'adminViewWithdrawals'])->name('withdrawals.pending');
        Route::get('/approved', [AdminController::class, 'showApprovedWithdrawals'])->name('admin.withdrawals.approved');
        Route::post('/{id}/approve', [AdminController::class, 'approveBalanceWithdrawal'])->name('admin.approve.withdrawal');
        Route::delete('/{id}', [AdminController::class, 'withdrawaldestroy'])->name('withdraw.delete');
    });

    // --- User Document Verification ---
    Route::middleware(['verified'])->group(function () {
        Route::get('/user/kyc', [UserKycController::class, 'create'])->name('user.kyc.upload');
        Route::post('/user/kyc', [UserKycController::class, 'store'])->name('user.kyc.submit');
    });

    // Dismiss KYC alert
    Route::post('/id-verification/alert-dismiss', [UserController::class, 'dismissAlert'])
        ->name('user.kyc.dismiss-alert');

    // Admin KYC management
    Route::prefix('admin')->middleware(['isAdmin'])->group(function () {
        Route::get('kyc', [AdminController::class, 'kycindex'])->name('admin.kyc.index');
        Route::patch('kyc/{id}/approve', [AdminController::class, 'approve'])->name('admin.kyc.approve');
        Route::patch('kyc/{id}/reject', [AdminController::class, 'reject'])->name('admin.kyc.reject');
    });
    
Route::patch('/admin/membership/lock/{user}', [AdminController::class, 'toggleMembershipLock'])->name('admin.membership.lock');


    // lives


    Route::middleware(['isAdmin'])->group(function () {

    Route::post('/admin/generate-membership-code', [AdminController::class, 'generateMembershipCode'])
        ->name('admin.generate.membership.code');

    // Show message form
    Route::get('/admin/user/{id}/message', function ($id) {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.send-message', compact('user'));
    })->name('admin.user.message.form');

    // Send message
    Route::post('/admin/send-message', [AdminController::class, 'sendMessage'])
        ->name('admin.send.message');

    
});
    Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/server-feeds', [AdminController::class, 'serverindex'])->name('admin.feeds');
    Route::post('/server-feeds', [AdminController::class, 'store'])->name('admin.feeds.store');
    Route::put('/server-feeds/{id}', [AdminController::class, 'update'])->name('admin.feeds.update');
   Route::delete('/server-feeds/{id}', [AdminController::class, 'deleteServerFeed'])
    ->name('admin.feeds.delete');
    Route::get('/server-feeds/{id}/edit', [AdminController::class, 'serveredit'])
    ->name('admin.feeds.edit');
});

// User Routes (inside auth middleware)


Route::middleware(['auth'])->group(function () {
    Route::get('/user/live', [UserController::class, 'user_live'])->name('user_live');
    
    Route::post('/user/activate-membership', [UserController::class, 'activateMembership'])
        ->name('user.activate.membership');
    
    Route::post('/live-trading/start', [UserController::class, 'liveTradingStart'])
        ->name('live.trading.start');
    
    Route::post('/live-trading/update', [UserController::class, 'liveTradingUpdate'])
        ->name('live.trading.update');
    
    Route::post('/live-trading/claim', [UserController::class, 'liveTradingClaim'])
        ->name('live.trading.claim');
    
    Route::post('/live-trading/message', [UserController::class, 'liveTradingSendMessage'])
        ->name('live.trading.message');
    
    Route::get('/live-trading/messages', [UserController::class, 'liveTradingGetMessages'])
        ->name('live.trading.messages');

       Route::get('/check-membership-status', [UserController::class, 'checkMembership'])->name('check.membership');

    //    user terms , privacy settings 
        Route::get('/terms and privacy policy  ', [UserController::class, 'terms_privacy'])->name('terms.privacy');

            Route::get('/terms $ privacy settings', [planController::class, 'terms_privacyhome'])->name('terms.privacys');

Route::get('/membership-locked', [UserController::class, 'lockedPage'])
    ->middleware('auth')
    ->name('membership.locked');
});



});
