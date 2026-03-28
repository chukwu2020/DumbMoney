@extends('layout.admin')

@section('content')

<div class="dashboard-main-body">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0" style="color:#0C3A30;">Users List</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li><a href="{{ route('hidden.user') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon> List</a></li>
        </ul>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <div class="card rounded-xl overflow-hidden border-0 bg-white shadow-sm">
            <div class="card-body p-6">
                <h6 class="text-lg font-semibold mb-4 text-gray-800">Search Users</h6>
                <form action="{{ route('hidden.user') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by name..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-[#9EDD05] focus:border-transparent">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ request('email') }}" placeholder="Search by email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-[#9EDD05] focus:border-transparent">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" name="country" value="{{ request('country') }}" placeholder="Search by country..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-[#9EDD05] focus:border-transparent">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Copy Preference</label>
                        <select name="copy_preference" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-800 focus:ring-2 focus:ring-[#9EDD05]">
                            <option value="">All</option>
                            <option value="platform_admin" {{ request('copy_preference') == 'platform_admin' ? 'selected' : '' }}>Platform Admin</option>
                            <option value="specific_admin"  {{ request('copy_preference') == 'specific_admin'  ? 'selected' : '' }}>Specific Admin</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" style="background-color:#0C3A30; color:white;" class="px-6 py-2 rounded-lg flex items-center gap-2 transition hover:opacity-90">
                            <iconify-icon icon="material-symbols:search"></iconify-icon> Search
                        </button>
                        @if(request('name') || request('email') || request('country') || request('copy_preference'))
                        <a href="{{ route('hidden.user') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:close"></iconify-icon> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="card rounded-xl overflow-hidden border-0 bg-white shadow-sm">
        <div class="card-body p-6">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0">
                    <thead>
                        <tr style="background:#0C3A30 !important;">
                            @foreach(['Profile','Name','Contact','Country','Join Source','Copy Preference','Selected Admin','Join Date','Experience','Trading Freq','Transaction Vol','Investment Goals','Asset Classes','Account Type','Copy Admin','Investment Amount','Financial Alt','Annual Income','Deposit Source','Ongoing Source','Balance','Total Invested','Active Trades','Membership Code','Control','Status','Action'] as $h)
                            <th style="background:#0C3A30 !important; color:#fff !important; white-space:nowrap;" class="py-3">{{ $h }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        @php
                            $totalInvested = $user->investments->sum('amount_invested');
                            $activeTrades  = $user->investments->where('status', 'active')->count();
                            $profilePic    = $user->profile->profile_pic ?? null;
                            $initials      = collect(explode(' ', $user->name))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('') ?: 'U';
                            $tradingInfo   = $user->tradingInfo;
                        @endphp
                        <tr class="hover:bg-gray-50">

                            {{-- Profile --}}
                            <td class="text-center">
                                @if($profilePic)
                                    <img src="{{ asset('storage/profile_pics/' . $profilePic) }}"
                                         alt="{{ $user->name }}"
                                         class="w-10 h-10 rounded-full object-cover mx-auto"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#8bc905] to-[#6ea003] text-white items-center justify-center font-semibold mx-auto" style="display:none;">{{ $initials }}</div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#8bc905] to-[#6ea003] text-white flex items-center justify-center font-semibold mx-auto">{{ $initials }}</div>
                                @endif
                            </td>

                            <td><div class="font-semibold text-gray-800">{{ $user->name }}</div><div class="text-xs text-gray-500">@{{ $user->username }}</div></td>
                            <td><div class="text-sm text-gray-700">{{ $user->phone ?? 'N/A' }}</div><div class="text-xs text-gray-500 truncate max-w-[150px]">{{ $user->email }}</div></td>
                            <td class="text-sm text-gray-700">{{ $user->country ?? 'N/A' }}</td>

                            {{-- Join Source --}}
                            <td>
                                @if($user->join_source)
                                    <div class="flex items-center gap-1">
                                        @if($user->join_source == 'discord')    <iconify-icon icon="ri:discord-line"   style="color:#5865F2;"></iconify-icon>
                                        @elseif($user->join_source == 'telegram') <iconify-icon icon="ri:telegram-line" style="color:#26A5E4;"></iconify-icon>
                                        @elseif($user->join_source == 'youtube')  <iconify-icon icon="ri:youtube-line"  style="color:#FF0000;"></iconify-icon>
                                        @elseif($user->join_source == 'instagram')<iconify-icon icon="ri:instagram-line" style="color:#E4405F;"></iconify-icon>
                                        @elseif($user->join_source == 'facebook') <iconify-icon icon="ri:facebook-line" style="color:#1877F2;"></iconify-icon>
                                        @else <iconify-icon icon="ri:global-line"></iconify-icon>
                                        @endif
                                        <span class="capitalize text-sm text-gray-700">{{ str_replace('_',' ',$user->join_source) }}</span>
                                    </div>
                                @else <span class="text-gray-400 text-sm">Not specified</span>
                                @endif
                            </td>

                            {{-- Copy Preference --}}
                            <td>
                                @if($user->copy_preference)
                                    <div class="flex items-center gap-1">
                                        @if($user->copy_preference == 'platform_admin') <iconify-icon icon="ri:admin-line" style="color:#8bc905;"></iconify-icon><span class="text-sm text-gray-700">Platform Admin</span>
                                        @elseif($user->copy_preference == 'specific_admin') <iconify-icon icon="ri:discord-line" style="color:#5865F2;"></iconify-icon><span class="text-sm text-gray-700">Specific Admin</span>
                                        @endif
                                    </div>
                                @else <span class="text-gray-400 text-sm">Not specified</span>
                                @endif
                            </td>

                            <td>
                                @if($user->copy_preference == 'specific_admin' && $user->copy_admin_name)
                                    <div class="font-medium text-sm text-gray-800">{{ $user->copy_admin_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->copy_server_name ?? 'N/A' }}</div>
                                @else <span class="text-gray-400 text-sm">—</span>
                                @endif
                            </td>

                            <td class="text-sm text-gray-700">{{ $user->created_at->format('d M Y') }}</td>

                            <td class="text-sm text-gray-700">
                                @if($tradingInfo)
                                    <span class="font-medium">{{ $tradingInfo->stock_experience == 'yes' ? 'Experienced' : ($tradingInfo->stock_experience == 'no' ? 'Little Exp.' : 'Novice') }}</span>
                                @else <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>

                            <td class="text-sm text-gray-700">{{ $tradingInfo ? $tradingInfo->trading_frequency.' times' : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ $tradingInfo ? str_replace('_',' ',str_replace('k',',000',$tradingInfo->transaction_volume)) : '—' }}</td>

                            <td class="text-sm">
                                @if($tradingInfo)
                                    @php $goals = is_array($tradingInfo->investment_goals) ? $tradingInfo->investment_goals : (json_decode($tradingInfo->investment_goals, true) ?? []); @endphp
                                    <div class="flex flex-wrap gap-1">@foreach($goals as $g)<span class="px-1.5 py-0.5 bg-blue-50 text-blue-700 rounded text-xs whitespace-nowrap">{{ ucfirst(str_replace('_',' ',$g)) }}</span>@endforeach</div>
                                @else <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>

                            <td class="text-sm">
                                @if($tradingInfo)
                                    @php $assets = is_array($tradingInfo->asset_classes) ? $tradingInfo->asset_classes : (json_decode($tradingInfo->asset_classes, true) ?? []); @endphp
                                    <div class="flex flex-wrap gap-1">@foreach($assets as $a)<span class="px-1.5 py-0.5 bg-green-50 text-green-700 rounded text-xs whitespace-nowrap">{{ ucfirst($a) }}</span>@endforeach</div>
                                @else <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>

                            <td class="text-sm text-gray-700">{{ $tradingInfo ? ucfirst($tradingInfo->account_type) : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ ($tradingInfo && $tradingInfo->copy_admin_name) ? $tradingInfo->copy_admin_name : '—' }}</td>
                            <td class="text-sm font-semibold text-green-600">{{ $tradingInfo ? '$'.number_format($tradingInfo->investment_amount,2) : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ ($tradingInfo && $tradingInfo->financial_alternative) ? $tradingInfo->financial_alternative : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ $tradingInfo ? $tradingInfo->annual_income : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ $tradingInfo ? ucfirst(str_replace('_',' ',$tradingInfo->deposit_source)) : '—' }}</td>
                            <td class="text-sm text-gray-700">{{ $tradingInfo ? ucfirst(str_replace('_',' ',$tradingInfo->ongoing_deposit_source)) : '—' }}</td>
                            <td class="font-semibold text-green-600">${{ number_format($user->available_balance ?? 0, 2) }}</td>
                            <td class="font-semibold text-blue-600">${{ number_format($user->amount_invested, 2) }}</td>

                            <td class="text-center">
                                @if($activeTrades > 0)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700"><iconify-icon icon="ph:chart-line-up-fill"></iconify-icon>{{ $activeTrades }}</span>
                                @else <span class="text-gray-400 text-sm">0</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($user->membership_code)
                                    <div class="inline-block text-left">
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-3 py-2 rounded-xl border border-green-200">
                                            <div class="text-xs font-semibold text-green-700 mb-1">✅ Code</div>
                                            <div class="font-mono text-sm font-bold text-gray-800 mb-2" id="membershipCode-{{ $user->id }}">{{ $user->membership_code }}</div>
                                            <div class="flex items-center justify-between gap-2">
                                                <span class="text-xs {{ $user->has_membership ? 'text-green-600' : 'text-yellow-600' }}">{{ $user->has_membership ? 'Active' : 'Pending' }}</span>
                                                <button id="copyBtn-{{ $user->id }}" onclick="copyMembershipCode({{ $user->id }})" class="px-2 py-1 bg-[#8AC304] text-black rounded-lg text-xs font-semibold hover:bg-[#7AB503] transition">📋 Copy</button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <button onclick="generateMembershipCode({{ $user->id }})" class="px-3 py-2 bg-gradient-to-r from-[#8AC304] to-[#6ea003] text-black rounded-lg text-sm font-semibold hover:shadow-md transition">
                                        <iconify-icon icon="mdi:ticket-confirmation" class="mr-1"></iconify-icon> Generate
                                    </button>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($user->membership_code)
                                    <form method="POST" action="{{ route('admin.membership.lock', $user->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="w-8 h-8 rounded-full {{ $user->membership_locked ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600' }} hover:bg-yellow-200 flex items-center justify-center mx-auto transition" title="{{ $user->membership_locked ? 'Unlock' : 'Lock' }} Membership">
                                            <iconify-icon icon="{{ $user->membership_locked ? 'mdi:lock-open' : 'mdi:lock' }}"></iconify-icon>
                                        </button>
                                    </form>
                                @else <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($user->active)
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">Active</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">Inactive</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 flex items-center justify-center transition"><iconify-icon icon="heroicons:eye"></iconify-icon></a>
                                    <a href="{{ route('user.edit', $user->id) }}" class="w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-200 flex items-center justify-center transition"><iconify-icon icon="lucide:edit"></iconify-icon></a>
                                    <form method="POST" action="{{ route('user.destroy', $user->id) }}" onsubmit="return confirm('Delete this user?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transition"><iconify-icon icon="fluent:delete-24-regular"></iconify-icon></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="27" class="text-center py-8 text-gray-500">No users found matching your search criteria.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $users->links('vendor.pagination.tailwind') }}</div>
        </div>
    </div>
</div>

<script>
function copyMembershipCode(userId) {
    const code = document.getElementById(`membershipCode-${userId}`).textContent.trim();
    const btn  = document.getElementById(`copyBtn-${userId}`);
    const orig = btn.innerHTML;
    navigator.clipboard.writeText(code).then(() => {
        btn.innerHTML = "✓ Copied!"; btn.style.background="#22c55e"; btn.style.color="white";
        setTimeout(() => { btn.innerHTML=orig; btn.style.background="#8AC304"; btn.style.color="black"; }, 2000);
    });
}
function generateMembershipCode(userId) {
    const btn = event.currentTarget;
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<iconify-icon icon="svg-spinners:3-dots-fade"></iconify-icon> Generating...';
    fetch("{{ route('admin.generate.membership.code') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
        body: JSON.stringify({ user_id: userId })
    }).then(r => r.json()).then(data => {
        if (data.success) { location.reload(); }
        else { btn.disabled=false; btn.innerHTML=orig; alert(data.message || 'Failed'); }
    }).catch(() => { btn.disabled=false; btn.innerHTML=orig; alert("Something went wrong."); });
}
</script>
@endsection