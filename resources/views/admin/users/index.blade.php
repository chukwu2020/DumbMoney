@extends('layout.admin')

@section('content')

<style>
    :root { 
        --brand-green: #9EDD05; 
        --brand-dark: #0C3A30; 
    }

    .user-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: var(--brand-green);
    }

    .card-header {
        background: linear-gradient(135deg, #0C3A30, #1a5c47);
        padding: 1.5rem;
        position: relative;
        text-align: center;
    }

    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid var(--brand-green);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -60px auto 0;
        position: relative;
        z-index: 2;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-avatar .initials {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--brand-dark);
    }

    .user-name {
        text-align: center;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
        padding: 0 1rem;
    }

    .user-name h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .user-name p {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }

    .badge-active {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 600;
        background: #dcfce7;
        color: #15803d;
    }

    .badge-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    .info-section {
        padding: 1rem;
    }

    .info-title {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 0.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-label {
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 0.8rem;
        font-weight: 500;
        color: #111827;
        word-break: break-word;
    }

    .info-value.balance {
        color: #16a34a;
        font-weight: 700;
    }

    .info-value.invested {
        color: #2563eb;
        font-weight: 700;
    }

    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .tag {
        display: inline-block;
        padding: 0.2rem 0.5rem;
        background: #f3f4f6;
        border-radius: 4px;
        font-size: 0.6rem;
        color: #374151;
    }

    .membership-section {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 1px solid #86efac;
        border-radius: 10px;
        padding: 0.75rem;
        margin: 0 1rem 1rem 1rem;
    }

    .membership-code {
        font-family: monospace;
        font-size: 0.8rem;
        font-weight: 700;
        color: #111827;
        text-align: center;
        margin: 0.5rem 0;
    }

    .copy-btn {
        background: var(--brand-green);
        color: var(--brand-dark);
        border: none;
        border-radius: 6px;
        padding: 0.25rem 0.75rem;
        font-size: 0.65rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .copy-btn:hover {
        background: #7bb502;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background: white;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
    }

    .action-btn.view {
        background: #dbeafe;
        color: #2563eb;
    }

    .action-btn.edit {
        background: #dcfce7;
        color: #16a34a;
    }

    .action-btn.delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .action-btn.lock {
        background: #f3f4f6;
        color: #6b7280;
    }

    .action-btn.lock.active {
        background: #fef9c3;
        color: #ca8a04;
    }

    .action-btn:hover {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-main-body">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0" style="color:#0C3A30;">Users List</h6>
        <ul class="flex items-center gap-[6px] text-sm">
            <li><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:home-smile-angle-outline" class="text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li><a href="{{ route('hidden.user') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:users-group-rounded" class="text-lg"></iconify-icon> List</a></li>
        </ul>
    </div>

    <!-- Search Section -->
    <div class="mb-6">
        <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">
            <div class="p-6">
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
                    <div class="flex gap-2">
                        <button type="submit" style="background-color:#0C3A30; color:white;" class="px-6 py-2 rounded-lg flex items-center gap-2 transition hover:opacity-90">
                            <iconify-icon icon="material-symbols:search"></iconify-icon> Search
                        </button>
                        @if(request('name') || request('email'))
                        <a href="{{ route('hidden.user') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:close"></iconify-icon> Clear
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Users Grid - Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse ($users as $user)
        @php
            $activeTrades = $user->investments->where('status','active')->count();
            $profilePic = $user->profile->profile_pic ?? null;
            $initials = collect(explode(' ',$user->name))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('') ?: 'U';
            $tradingInfo = $user->tradingInfo;
            
            // Decode JSON fields
            $investmentGoals = $tradingInfo && $tradingInfo->investment_goals ? (is_array($tradingInfo->investment_goals) ? $tradingInfo->investment_goals : json_decode($tradingInfo->investment_goals, true)) : [];
            $assetClasses = $tradingInfo && $tradingInfo->asset_classes ? (is_array($tradingInfo->asset_classes) ? $tradingInfo->asset_classes : json_decode($tradingInfo->asset_classes, true)) : [];
        @endphp

        <div class="user-card">
            <!-- Header with gradient -->
            <div class="card-header">
                <div style="color:white; font-size:0.7rem; opacity:0.8;">
                    <iconify-icon icon="ph:user-fill" class="text-lg"></iconify-icon> User Profile
                </div>
            </div>
            
            <!-- Avatar -->
            <div class="user-avatar">
                @if($profilePic)
                <img src="{{ asset('storage/profile_pics/'.$profilePic) }}" alt="{{ $user->name }}">
                @else
                <div class="initials">{{ $initials }}</div>
                @endif
            </div>
            
            <!-- Name & Basic Info -->
            <div class="user-name">
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
                <p style="font-size:0.7rem;">@{{ $user->username }}</p>
            </div>
            
            <!-- Status Badge -->
            <div class="text-center mb-2">
                @if($user->active)
                <span class="badge-active">✓ Active</span>
                @else
                <span class="badge-active badge-inactive">✗ Inactive</span>
                @endif
            </div>
            
            <!-- Contact & Basic Info Section -->
            <div class="info-section">
                <div class="info-title">📋 Contact & Basic Info</div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">📞 Phone</span>
                        <span class="info-value">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">🌍 Country</span>
                        <span class="info-value">{{ $user->country ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">📅 Joined</span>
                        <span class="info-value">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">🎯 Join Source</span>
                        <span class="info-value">{{ $user->join_source ? ucfirst(str_replace('_',' ',$user->join_source)) : 'N/A' }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Financial Info Section -->
            <div class="info-section">
                <div class="info-title">💰 Financial Info</div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Balance</span>
                        <span class="info-value balance">${{ number_format($user->available_balance ?? 0,2) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Invested</span>
                        <span class="info-value invested">${{ number_format($user->amount_invested,2) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Active Trades</span>
                        <span class="info-value">{{ $activeTrades }}</span>
                    </div>
                    @if($tradingInfo && $tradingInfo->investment_amount)
                    <div class="info-item">
                        <span class="info-label">Investment Amount</span>
                        <span class="info-value">${{ number_format($tradingInfo->investment_amount,2) }}</span>
                    </div>
                    @endif
                    @if($tradingInfo && $tradingInfo->annual_income)
                    <div class="info-item">
                        <span class="info-label">Annual Income</span>
                        <span class="info-value">{{ $tradingInfo->annual_income }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Trading Info Section -->
            @if($tradingInfo)
            <div class="info-section">
                <div class="info-title">📊 Trading Profile</div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Experience</span>
                        <span class="info-value">{{ $tradingInfo->stock_experience == 'yes' ? 'Experienced' : ($tradingInfo->stock_experience == 'no' ? 'Learning' : 'Novice') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Trading Frequency</span>
                        <span class="info-value">{{ $tradingInfo->trading_frequency ?? 'N/A' }} times</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Transaction Volume</span>
                        <span class="info-value">{{ $tradingInfo->transaction_volume ? str_replace('_',' ',str_replace('k',',000',$tradingInfo->transaction_volume)) : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Account Type</span>
                        <span class="info-value">{{ $tradingInfo->account_type ? ucfirst($tradingInfo->account_type) : 'N/A' }}</span>
                    </div>
                </div>
                
                @if($investmentGoals && count($investmentGoals) > 0)
                <div class="info-title mt-2">🎯 Investment Goals</div>
                <div class="tags-container">
                    @foreach($investmentGoals as $goal)
                    <span class="tag">{{ ucfirst(str_replace('_',' ',$goal)) }}</span>
                    @endforeach
                </div>
                @endif
                
                @if($assetClasses && count($assetClasses) > 0)
                <div class="info-title mt-2">📈 Asset Classes</div>
                <div class="tags-container">
                    @foreach($assetClasses as $asset)
                    <span class="tag">{{ ucfirst($asset) }}</span>
                    @endforeach
                </div>
                @endif
            </div>
            @endif
            
            <!-- Copy Trading Info -->
            <div class="info-section">
                <div class="info-title">🔄 Copy Trading</div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Copy Preference</span>
                        <span class="info-value">{{ $user->copy_preference == 'platform_admin' ? 'Platform Admin' : ($user->copy_preference == 'specific_admin' ? 'Specific Admin' : 'Not Set') }}</span>
                    </div>
                    @if($user->copy_preference == 'specific_admin' && $user->copy_admin_name)
                    <div class="info-item">
                        <span class="info-label">Copy Admin</span>
                        <span class="info-value">{{ $user->copy_admin_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Server</span>
                        <span class="info-value">{{ $user->copy_server_name ?? 'N/A' }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Deposit Sources -->
            @if($tradingInfo && ($tradingInfo->deposit_source || $tradingInfo->ongoing_deposit_source))
            <div class="info-section">
                <div class="info-title">💵 Deposit Sources</div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Initial Source</span>
                        <span class="info-value">{{ $tradingInfo->deposit_source ? ucfirst(str_replace('_',' ',$tradingInfo->deposit_source)) : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Ongoing Source</span>
                        <span class="info-value">{{ $tradingInfo->ongoing_deposit_source ? ucfirst(str_replace('_',' ',$tradingInfo->ongoing_deposit_source)) : 'N/A' }}</span>
                    </div>
                    @if($tradingInfo && $tradingInfo->financial_alternative)
                    <div class="info-item">
                        <span class="info-label">Financial Alternative</span>
                        <span class="info-value">{{ $tradingInfo->financial_alternative }}</span>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- Membership Section -->
            <div class="membership-section">
                @if($user->membership_code)
                <div style="font-size:0.65rem; font-weight:700; color:#15803d; text-align:center;">MEMBERSHIP CODE</div>
                <div id="membershipCode-{{ $user->id }}" class="membership-code">{{ $user->membership_code }}</div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-top:0.5rem;">
                    <span style="font-size:0.6rem; color:{{ $user->has_membership ? '#16a34a' : '#ca8a04' }};">
                        {{ $user->has_membership ? '✓ Active' : '⏳ Pending' }}
                    </span>
                    <button id="copyBtn-{{ $user->id }}" onclick="copyMembershipCode({{ $user->id }})" class="copy-btn">Copy Code</button>
                </div>
                
                <!-- Lock/Unlock Control -->
                <div class="text-center mt-2">
                    <form method="POST" action="{{ route('admin.membership.lock',$user->id) }}" style="display:inline;">
                        @csrf @method('PATCH')
                        <button type="submit" class="action-btn lock {{ $user->membership_locked ? 'active' : '' }}" style="width:28px;height:28px;" title="{{ $user->membership_locked ? 'Unlock' : 'Lock' }}">
                            <iconify-icon icon="{{ $user->membership_locked ? 'mdi:lock-open' : 'mdi:lock' }}"></iconify-icon>
                        </button>
                    </form>
                </div>
                @else
                <button onclick="generateMembershipCode({{ $user->id }})" style="background:linear-gradient(135deg,#8AC304,#6ea003); color:#0C3A30; border:none; border-radius:8px; padding:0.5rem 1rem; font-size:0.75rem; font-weight:600; cursor:pointer; width:100%;">
                    Generate Membership Code
                </button>
                @endif
            </div>
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="#" class="action-btn view" title="View Details">
                    <iconify-icon icon="heroicons:eye"></iconify-icon>
                </a>
                <a href="{{ route('user.edit',$user->id) }}" class="action-btn edit" title="Edit User">
                    <iconify-icon icon="lucide:edit"></iconify-icon>
                </a>
                <form method="POST" action="{{ route('user.destroy',$user->id) }}" onsubmit="return confirm('Delete this user?');" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="action-btn delete" title="Delete User">
                        <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div style="background:#fff; border-radius:12px; padding:3rem; text-align:center;">
                <iconify-icon icon="mdi:users-off" class="text-5xl text-gray-400 mb-3"></iconify-icon>
                <p class="text-gray-500">No users found.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $users->links('vendor.pagination.tailwind') }}
    </div>
</div>

<script>
    function copyMembershipCode(userId) {
        const code = document.getElementById(`membershipCode-${userId}`).textContent.trim();
        const btn = document.getElementById(`copyBtn-${userId}`);
        const orig = btn.innerHTML;
        navigator.clipboard.writeText(code).then(() => {
            btn.innerHTML = "Copied!";
            btn.style.background = "#22c55e";
            btn.style.color = "white";
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.style.background = "#8AC304";
                btn.style.color = "#0C3A30";
            }, 2000);
        });
    }

    function generateMembershipCode(userId) {
        const btn = event.currentTarget,
            orig = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = 'Generating...';
        fetch("{{ route('admin.generate.membership.code') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                user_id: userId
            })
        }).then(r => r.json()).then(data => {
            if (data.success) {
                location.reload();
            } else {
                btn.disabled = false;
                btn.innerHTML = orig;
                alert(data.message || 'Failed');
            }
        }).catch(() => {
            btn.disabled = false;
            btn.innerHTML = orig;
            alert("Something went wrong.");
        });
    }
</script>
@endsection