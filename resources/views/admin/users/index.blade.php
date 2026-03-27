@extends('layout.admin')

@section('content')

<div class="dashboard-main-body">

    <!-- Header -->
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">Users List</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li>
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li>
                <a href="{{ route('hidden.user') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon>
                    List
                </a>
            </li>
        </ul>
    </div>

    <!-- ===== SEARCH SECTION ===== -->
    <div class="mb-6">
        <div class="card rounded-xl overflow-hidden border-0 bg-white shadow-sm">
            <div class="card-body p-6">
                <h6 class="text-lg font-semibold mb-4">Search Users</h6>
                
                <form action="{{ route('hidden.user') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                    <!-- Search by Name -->
                    <div class="flex-1 min-w-[200px]">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ request('name') }}"
                               placeholder="Search by name..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                    </div>
                    
                    <!-- Search by Email -->
                    <div class="flex-1 min-w-[200px]">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ request('email') }}"
                               placeholder="Search by email..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                    </div>
                    
                    <!-- Search by Country -->
                    <div class="flex-1 min-w-[200px]">
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                        <input type="text" 
                               name="country" 
                               id="country" 
                               value="{{ request('country') }}"
                               placeholder="Search by country..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                    </div>
                    
                    <!-- Search by Copy Preference -->
                    <div class="flex-1 min-w-[200px]">
                        <label for="copy_preference" class="block text-sm font-medium text-gray-700 mb-1">Copy Preference</label>
                        <select name="copy_preference" id="copy_preference" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                            <option value="">All</option>
                            <option value="platform_admin" {{ request('copy_preference') == 'platform_admin' ? 'selected' : '' }}>Platform Admin</option>
                            <option value="specific_admin" {{ request('copy_preference') == 'specific_admin' ? 'selected' : '' }}>Specific Admin</option>
                        </select>
                    </div>
                    
                    <!-- Search Button -->
                    <div class="flex gap-2">
                        <button type="submit" style="background-color: #0C3A30; color: white;" 
                                class="px-6 py-2 rounded-lg hover:bg-[#154e40] transition-colors duration-200 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:search"></iconify-icon>
                            Search
                        </button>
                        
                        <!-- Clear Button -->
                        @if(request('name') || request('email') || request('country') || request('copy_preference'))
                        <a href="{{ route('hidden.user') }}" 
                           class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:close"></iconify-icon>
                            Clear
                        </a>
                        @endif
                    </div>
                </form>

                <!-- Search Stats -->
                @if(request('name') || request('email') || request('country') || request('copy_preference'))
                <div class="mt-3 text-sm text-gray-600">
                    Showing results for: 
                    @if(request('name')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:person" class="text-[#0C3A30]"></iconify-icon> Name: "{{ request('name') }}"</span> @endif
                    @if(request('email')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:mail" class="text-[#0C3A30]"></iconify-icon> Email: "{{ request('email') }}"</span> @endif
                    @if(request('country')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:location-on" class="text-[#0C3A30]"></iconify-icon> Country: "{{ request('country') }}"</span> @endif
                    @if(request('copy_preference')) 
                        <span class="inline-flex items-center gap-1">
                            <iconify-icon icon="material-symbols:content-copy" class="text-[#0C3A30]"></iconify-icon> 
                            Copy: {{ request('copy_preference') == 'platform_admin' ? 'Platform Admin' : 'Specific Admin' }}
                        </span> 
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- ===== END SEARCH SECTION ===== -->

    <!-- Table -->
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card rounded-xl overflow-hidden border-0 bg-white shadow-sm">

                <div class="card-body p-6">

                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">

                            <thead>
                                <tr style="background:#0C3A30 !important;">
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Profile</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Name</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Contact</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Country</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Join Source</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Copy Preference</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Selected Admin</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Join Date</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Experience</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Trading Freq</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Transaction Vol</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Investment Goals</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Asset Classes</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Account Type</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Copy Admin</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Investment Amount</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Financial Alt</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Annual Income</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Deposit Source</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Ongoing Source</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Balance</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Total Invested</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Active Trades</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Membership Code</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Control</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Status</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                @php
                                    $totalInvested = $user->investments->sum('amount_invested');
                                    $activeTrades = $user->investments->where('status', 'active')->count();
                                    $hasProfilePic = $user->profile && $user->profile->profile_pic && file_exists(public_path('uploads/' . $user->profile->profile_pic));
                                    $initials = collect(explode(' ', $user->name))->map(fn($w) => strtoupper(substr($w, 0, 1)))->take(2)->join('') ?: 'U';
                                    $tradingInfo = $user->tradingInfo;
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <!-- Profile -->
                                    <td class="text-center">
                                        @if($hasProfilePic)
                                            <img src="{{ asset('uploads/' . $user->profile->profile_pic) }}" class="w-10 h-10 rounded-full object-cover" />
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#8bc905] to-[#6ea003] text-white flex items-center justify-center font-semibold mx-auto">
                                                {{ $initials }}
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Name & Username -->
                                    <td>
                                        <div class="font-semibold text-gray-800">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">@ {{ $user->username }}</div>
                                    </td>

                                    <!-- Phone & Email -->
                                    <td>
                                        <div class="text-sm">{{ $user->phone ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[150px]">{{ $user->email }}</div>
                                    </td>

                                    <!-- Country -->
                                    <td class="text-sm">{{ $user->country ?? 'N/A' }}</td>

                                    <!-- Join Source -->
                                    <td>
                                        @if($user->join_source)
                                            <div class="flex items-center gap-1">
                                                @if($user->join_source == 'discord')
                                                    <iconify-icon icon="ri:discord-line" style="color: #5865F2;"></iconify-icon>
                                                @elseif($user->join_source == 'telegram')
                                                    <iconify-icon icon="ri:telegram-line" style="color: #26A5E4;"></iconify-icon>
                                                @elseif($user->join_source == 'youtube')
                                                    <iconify-icon icon="ri:youtube-line" style="color: #FF0000;"></iconify-icon>
                                                @elseif($user->join_source == 'instagram')
                                                    <iconify-icon icon="ri:instagram-line" style="color: #E4405F;"></iconify-icon>
                                                @elseif($user->join_source == 'facebook')
                                                    <iconify-icon icon="ri:facebook-line" style="color: #1877F2;"></iconify-icon>
                                                @else
                                                    <iconify-icon icon="ri:global-line"></iconify-icon>
                                                @endif
                                                <span class="capitalize text-sm">{{ str_replace('_', ' ', $user->join_source) }}</span>
                                            </div>
                                            @if($user->join_source_other)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <span class="font-medium">Other:</span> {{ $user->join_source_other }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-sm">Not specified</span>
                                        @endif
                                    </td>

                                    <!-- Copy Preference -->
                                    <td>
                                        @if($user->copy_preference)
                                            <div class="flex items-center gap-1">
                                                @if($user->copy_preference == 'platform_admin')
                                                    <iconify-icon icon="ri:admin-line" style="color: #8bc905;"></iconify-icon>
                                                    <span class="text-sm">Platform Admin</span>
                                                @elseif($user->copy_preference == 'specific_admin')
                                                    <iconify-icon icon="ri:discord-line" style="color: #5865F2;"></iconify-icon>
                                                    <span class="text-sm">Specific Admin</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-sm">Not specified</span>
                                        @endif
                                    </td>

                                    <!-- Selected Admin -->
                                    <td>
                                        @if($user->copy_preference == 'specific_admin' && $user->copy_admin_name)
                                            <div class="font-medium text-sm">{{ $user->copy_admin_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->copy_server_name ?? 'Server not specified' }}</div>
                                            @if($user->copy_admin_id)
                                                <div class="text-xs text-gray-400">ID: {{ $user->copy_admin_id }}</div>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-sm">—</span>
                                        @endif
                                    </td>

                                    <!-- Join Date -->
                                    <td class="text-sm">{{ $user->created_at->format('d M Y') }}</td>

                                    <!-- Stock Experience -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            <span class="capitalize font-medium">
                                                @if($tradingInfo->stock_experience == 'yes')
                                                    Experienced
                                                @elseif($tradingInfo->stock_experience == 'no')
                                                    Little Experience
                                                @else
                                                    Complete Novice
                                                @endif
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Trading Frequency -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            {{ $tradingInfo->trading_frequency }} times
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Transaction Volume -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            {{ str_replace('_', ' ', str_replace('k', ',000', $tradingInfo->transaction_volume)) }}
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Investment Goals -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            @php
                                                $goals = is_array($tradingInfo->investment_goals) ? $tradingInfo->investment_goals : json_decode($tradingInfo->investment_goals, true);
                                            @endphp
                                            @if($goals)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($goals as $goal)
                                                        <span class="px-1.5 py-0.5 bg-blue-50 text-blue-700 rounded text-xs whitespace-nowrap">
                                                            {{ ucfirst(str_replace('_', ' ', $goal)) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs">—</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Asset Classes -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            @php
                                                $assets = is_array($tradingInfo->asset_classes) ? $tradingInfo->asset_classes : json_decode($tradingInfo->asset_classes, true);
                                            @endphp
                                            @if($assets)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($assets as $asset)
                                                        <span class="px-1.5 py-0.5 bg-green-50 text-green-700 rounded text-xs whitespace-nowrap">
                                                            {{ ucfirst($asset) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-xs">—</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Account Type -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            <span class="capitalize">{{ $tradingInfo->account_type }}</span>
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Copy Admin (from trading info) -->
                                    <td class="text-sm">
                                        @if($tradingInfo && $tradingInfo->copy_admin_name)
                                            <div class="font-medium text-sm">{{ $tradingInfo->copy_admin_name }}</div>
                                            @if($tradingInfo->copy_server_name)
                                                <div class="text-xs text-gray-500">{{ $tradingInfo->copy_server_name }}</div>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Investment Amount -->
                                    <td class="text-sm font-semibold text-green-600">
                                        @if($tradingInfo)
                                            ${{ number_format($tradingInfo->investment_amount, 2) }}
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>

                                    <!-- Financial Alternative -->
                                    <td class="text-sm">
                                        @if($tradingInfo && $tradingInfo->financial_alternative)
                                            {{ $tradingInfo->financial_alternative }}
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Annual Income -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            {{ $tradingInfo->annual_income }}
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Deposit Source -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            {{ ucfirst(str_replace('_', ' ', $tradingInfo->deposit_source)) }}
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Ongoing Deposit Source -->
                                    <td class="text-sm">
                                        @if($tradingInfo)
                                            {{ ucfirst(str_replace('_', ' ', $tradingInfo->ongoing_deposit_source)) }}
                                        @else
                                            <span class="text-gray-400 text-xs">—</span>
                                        @endif
                                    </td>

                                    <!-- Balance -->
                                    <td class="font-semibold text-green-600">${{ number_format($user->available_balance ?? 0, 2) }}</td>

                                    <!-- Total Invested -->
                                    <td class="font-semibold text-blue-600">${{ number_format($user->amount_invested, 2) }}</td>

                                    <!-- Active Trades -->
                                    <td class="text-center">
                                        @if($activeTrades > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                <iconify-icon icon="ph:chart-line-up-fill"></iconify-icon>
                                                {{ $activeTrades }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">0</span>
                                        @endif
                                    </td>

                                    <!-- Membership Code Column -->
                                    <td class="text-center">
                                        @if($user->membership_code)
                                        <div class="inline-block text-left">
                                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-3 py-2 rounded-xl border border-green-200">
                                                <div class="text-xs font-semibold text-green-700 mb-1">✅ Code</div>
                                                <div class="font-mono text-sm font-bold text-gray-800 mb-2"
                                                    id="membershipCode-{{ $user->id }}">
                                                    {{ $user->membership_code }}
                                                </div>
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="text-xs {{ $user->has_membership ? 'text-green-600' : 'text-yellow-600' }}">
                                                        {{ $user->has_membership ? 'Active' : 'Pending' }}
                                                    </span>
                                                    <button id="copyBtn-{{ $user->id }}"
                                                        onclick="copyMembershipCode({{ $user->id }})"
                                                        class="px-2 py-1 bg-[#8AC304] text-black rounded-lg text-xs font-semibold hover:bg-[#7AB503] transition">
                                                        📋 Copy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <button onclick="generateMembershipCode({{ $user->id }})"
                                            class="px-3 py-2 bg-gradient-to-r from-[#8AC304] to-[#6ea003] text-black rounded-lg text-sm font-semibold hover:shadow-md transition">
                                            <iconify-icon icon="mdi:ticket-confirmation" class="mr-1"></iconify-icon>
                                            Generate
                                        </button>
                                        @endif
                                    </td>

                                    <!-- Membership Control Column -->
                                    <td class="text-center">
                                        @if($user->membership_code)
                                        <form method="POST" action="{{ route('admin.membership.lock', $user->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-full {{ $user->membership_locked ? 'bg-yellow-100 text-yellow-600' : 'bg-gray-100 text-gray-600' }} hover:bg-yellow-200 flex items-center justify-center mx-auto transition"
                                                title="{{ $user->membership_locked ? 'Unlock Membership' : 'Lock Membership' }}">
                                                <iconify-icon icon="{{ $user->membership_locked ? 'mdi:lock-open' : 'mdi:lock' }}"></iconify-icon>
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </td>

                                    <!-- Active / Inactive -->
                                    <td class="text-center">
                                        @if ($user->active)
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                            Active
                                        </span>
                                        @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">
                                            Inactive
                                        </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- View Details -->
                                            <a href="" 
                                               class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 flex items-center justify-center transition"
                                               title="View Details">
                                                <iconify-icon icon="heroicons:eye"></iconify-icon>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{ route('user.edit', $user->id) }}" 
                                               class="w-8 h-8 rounded-full bg-green-100 text-green-600 hover:bg-green-200 flex items-center justify-center transition"
                                               title="Edit User">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transition"
                                                    title="Delete User">
                                                    <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="27" class="text-center py-8 text-gray-500">
                                        <iconify-icon icon="material-symbols:info-outline" class="text-4xl mb-2"></iconify-icon>
                                        <p>No users found matching your search criteria.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links('vendor.pagination.tailwind') }}
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<!-- Copy Script -->
<script>
    function copyMembershipCode(userId) {
        const codeEl = document.getElementById(`membershipCode-${userId}`);
        const btn = document.getElementById(`copyBtn-${userId}`);
        const code = codeEl.textContent.trim();
        const originalText = btn.innerHTML;

        navigator.clipboard.writeText(code).then(() => {
            btn.innerHTML = "✓ Copied!";
            btn.style.background = "#22c55e";
            btn.style.color = "white";
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = "#8AC304";
                btn.style.color = "black";
            }, 2000);
        });
    }

    function generateMembershipCode(userId) {
        const btn = event.target;
        const originalHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<iconify-icon icon="svg-spinners:3-dots-fade" class="mr-1"></iconify-icon> Generating...';

        fetch("{{ route('admin.generate.membership.code') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ user_id: userId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                alert(data.message || 'Failed to generate code');
            }
        })
        .catch(err => {
            console.error(err);
            btn.disabled = false;
            btn.innerHTML = originalHtml;
            alert("Something went wrong. Please try again.");
        });
    }
</script>

@endsection