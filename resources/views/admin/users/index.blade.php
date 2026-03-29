@extends('layout.admin')

@section('content')

<style>
    :root { --brand-green:#9EDD05; --brand-dark:#0C3A30; }

    .dashboard-main-body { max-width:100%; overflow-x:hidden; }

    .tbl-shell {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .tbl-shell::-webkit-scrollbar { height:5px; }
    .tbl-shell::-webkit-scrollbar-thumb { background:var(--brand-green); border-radius:10px; }
    .tbl-shell::-webkit-scrollbar-track { background:#f3f4f6; border-radius:10px; }
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

    <!-- Search -->
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

    <!-- Table Card — overflow:hidden is THE key containment boundary -->
    <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,.06); overflow:hidden; min-width:0; max-width:100%;">

        <div style="padding:1rem 1.5rem; border-bottom:1px solid #f1f5f9;">
            <h6 class="font-semibold text-gray-800 mb-0">All Users</h6>
        </div>

        <!-- ONLY this scrolls -->
        <div class="tbl-shell">
            <table style="width:max-content; min-width:100%; border-collapse:separate; border-spacing:0; font-size:.8rem;">
                <thead>
                    <tr>
                        @foreach(['Profile','Name','Contact','Country','Join Source','Copy Preference','Selected Admin','Join Date','Experience','Trading Freq','Transaction Vol','Investment Goals','Asset Classes','Account Type','Copy Admin','Investment Amount','Financial Alt','Annual Income','Deposit Source','Ongoing Source','Balance','Total Invested','Active Trades','Membership Code','Control','Status','Action'] as $h)
                        <th style="background:#0C3A30; color:#fff; white-space:nowrap; padding:.65rem 1rem; text-align:left; font-size:.7rem; font-weight:600; text-transform:uppercase; letter-spacing:.4px;">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    @php
                        $activeTrades = $user->investments->where('status','active')->count();
                        $profilePic   = $user->profile->profile_pic ?? null;
                        $initials     = collect(explode(' ',$user->name))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('') ?: 'U';
                        $tradingInfo  = $user->tradingInfo;
                    @endphp
                    <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center;">
                            @if($profilePic)
                                <img src="{{ asset('storage/profile_pics/'.$profilePic) }}" alt="{{ $user->name }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;display:block;margin:auto;" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#8bc905,#6ea003);color:#fff;align-items:center;justify-content:center;font-weight:600;font-size:.75rem;display:none;margin:auto;">{{ $initials }}</div>
                            @else
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#8bc905,#6ea003);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:.75rem;margin:auto;">{{ $initials }}</div>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap;">
                            <div style="font-weight:600;color:#111827;">{{ $user->name }}</div>
                            <div style="font-size:.7rem;color:#6b7280;">@{{ $user->username }}</div>
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap;">
                            <div style="font-size:.8rem;color:#374151;">{{ $user->phone ?? 'N/A' }}</div>
                            <div style="font-size:.7rem;color:#6b7280;max-width:160px;overflow:hidden;text-overflow:ellipsis;">{{ $user->email }}</div>
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $user->country ?? 'N/A' }}</td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap;">
                            @if($user->join_source)
                                <div style="display:flex;align-items:center;gap:4px;">
                                    @if($user->join_source=='discord')      <iconify-icon icon="ri:discord-line"    style="color:#5865F2;"></iconify-icon>
                                    @elseif($user->join_source=='telegram')  <iconify-icon icon="ri:telegram-line"  style="color:#26A5E4;"></iconify-icon>
                                    @elseif($user->join_source=='youtube')   <iconify-icon icon="ri:youtube-line"   style="color:#FF0000;"></iconify-icon>
                                    @elseif($user->join_source=='instagram') <iconify-icon icon="ri:instagram-line" style="color:#E4405F;"></iconify-icon>
                                    @elseif($user->join_source=='facebook')  <iconify-icon icon="ri:facebook-line"  style="color:#1877F2;"></iconify-icon>
                                    @else <iconify-icon icon="ri:global-line"></iconify-icon>
                                    @endif
                                    <span style="font-size:.8rem;color:#374151;text-transform:capitalize;">{{ str_replace('_',' ',$user->join_source) }}</span>
                                </div>
                            @else <span style="color:#9ca3af;font-size:.8rem;">Not specified</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap;">
                            @if($user->copy_preference)
                                <div style="display:flex;align-items:center;gap:4px;">
                                    @if($user->copy_preference=='platform_admin')
                                        <iconify-icon icon="ri:admin-line" style="color:#8bc905;"></iconify-icon>
                                        <span style="font-size:.8rem;color:#374151;">Platform Admin</span>
                                    @elseif($user->copy_preference=='specific_admin')
                                        <iconify-icon icon="ri:discord-line" style="color:#5865F2;"></iconify-icon>
                                        <span style="font-size:.8rem;color:#374151;">Specific Admin</span>
                                    @endif
                                </div>
                            @else <span style="color:#9ca3af;font-size:.8rem;">Not specified</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap;">
                            @if($user->copy_preference=='specific_admin' && $user->copy_admin_name)
                                <div style="font-weight:500;font-size:.8rem;color:#111827;">{{ $user->copy_admin_name }}</div>
                                <div style="font-size:.7rem;color:#6b7280;">{{ $user->copy_server_name ?? 'N/A' }}</div>
                            @else <span style="color:#9ca3af;font-size:.8rem;">—</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $user->created_at->format('d M Y') }}</td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">
                            @if($tradingInfo)
                                <span style="font-weight:500;">{{ $tradingInfo->stock_experience=='yes' ? 'Experienced' : ($tradingInfo->stock_experience=='no' ? 'Little Exp.' : 'Novice') }}</span>
                            @else <span style="color:#9ca3af;font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? $tradingInfo->trading_frequency.' times' : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? str_replace('_',' ',str_replace('k',',000',$tradingInfo->transaction_volume)) : '—' }}</td>

                        <td style="padding:.65rem 1rem; vertical-align:middle;">
                            @if($tradingInfo)
                                @php $goals = is_array($tradingInfo->investment_goals) ? $tradingInfo->investment_goals : (json_decode($tradingInfo->investment_goals,true) ?? []); @endphp
                                <div style="display:flex;flex-wrap:wrap;gap:3px;min-width:120px;">
                                    @foreach($goals as $g)
                                    <span style="padding:2px 6px;background:#eff6ff;color:#1d4ed8;border-radius:4px;font-size:.68rem;white-space:nowrap;">{{ ucfirst(str_replace('_',' ',$g)) }}</span>
                                    @endforeach
                                </div>
                            @else <span style="color:#9ca3af;font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle;">
                            @if($tradingInfo)
                                @php $assets = is_array($tradingInfo->asset_classes) ? $tradingInfo->asset_classes : (json_decode($tradingInfo->asset_classes,true) ?? []); @endphp
                                <div style="display:flex;flex-wrap:wrap;gap:3px;min-width:100px;">
                                    @foreach($assets as $a)
                                    <span style="padding:2px 6px;background:#f0fdf4;color:#15803d;border-radius:4px;font-size:.68rem;white-space:nowrap;">{{ ucfirst($a) }}</span>
                                    @endforeach
                                </div>
                            @else <span style="color:#9ca3af;font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? ucfirst($tradingInfo->account_type) : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ ($tradingInfo && $tradingInfo->copy_admin_name) ? $tradingInfo->copy_admin_name : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; font-weight:600; color:#16a34a;">{{ $tradingInfo ? '$'.number_format($tradingInfo->investment_amount,2) : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ ($tradingInfo && $tradingInfo->financial_alternative) ? $tradingInfo->financial_alternative : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? $tradingInfo->annual_income : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? ucfirst(str_replace('_',' ',$tradingInfo->deposit_source)) : '—' }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-size:.8rem; color:#374151;">{{ $tradingInfo ? ucfirst(str_replace('_',' ',$tradingInfo->ongoing_deposit_source)) : '—' }}</td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-weight:600; color:#16a34a;">${{ number_format($user->available_balance ?? 0,2) }}</td>
                        <td style="padding:.65rem 1rem; vertical-align:middle; white-space:nowrap; font-weight:600; color:#2563eb;">${{ number_format($user->amount_invested,2) }}</td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center; white-space:nowrap;">
                            @if($activeTrades > 0)
                                <span style="display:inline-flex;align-items:center;gap:3px;padding:2px 8px;border-radius:20px;background:#dcfce7;color:#15803d;font-size:.72rem;font-weight:600;">
                                    <iconify-icon icon="ph:chart-line-up-fill"></iconify-icon>{{ $activeTrades }}
                                </span>
                            @else <span style="color:#9ca3af;font-size:.8rem;">0</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center;">
                            @if($user->membership_code)
                                <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);padding:8px 10px;border-radius:10px;border:1px solid #86efac;min-width:130px;display:inline-block;text-align:left;">
                                    <div style="font-size:.65rem;font-weight:700;color:#15803d;margin-bottom:3px;">Code</div>
                                    <div id="membershipCode-{{ $user->id }}" style="font-family:monospace;font-size:.8rem;font-weight:700;color:#111827;margin-bottom:6px;">{{ $user->membership_code }}</div>
                                    <div style="display:flex;align-items:center;justify-content:space-between;gap:6px;">
                                        <span style="font-size:.65rem;color:{{ $user->has_membership ? '#16a34a' : '#ca8a04' }};">{{ $user->has_membership ? 'Active' : 'Pending' }}</span>
                                        <button id="copyBtn-{{ $user->id }}" onclick="copyMembershipCode({{ $user->id }})" style="padding:2px 8px;background:#8AC304;color:#0C3A30;border:none;border-radius:6px;font-size:.65rem;font-weight:700;cursor:pointer;">Copy</button>
                                    </div>
                                </div>
                            @else
                                <button onclick="generateMembershipCode({{ $user->id }})" style="padding:5px 10px;background:linear-gradient(135deg,#8AC304,#6ea003);color:#0C3A30;border:none;border-radius:8px;font-size:.75rem;font-weight:600;cursor:pointer;white-space:nowrap;">Generate</button>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center;">
                            @if($user->membership_code)
                                <form method="POST" action="{{ route('admin.membership.lock',$user->id) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" style="width:32px;height:32px;border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;margin:auto;background:{{ $user->membership_locked ? '#fef9c3' : '#f3f4f6' }};color:{{ $user->membership_locked ? '#ca8a04' : '#6b7280' }};">
                                        <iconify-icon icon="{{ $user->membership_locked ? 'mdi:lock-open' : 'mdi:lock' }}"></iconify-icon>
                                    </button>
                                </form>
                            @else <span style="color:#9ca3af;font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center; white-space:nowrap;">
                            @if($user->active)
                                <span style="padding:3px 10px;border-radius:20px;background:#dcfce7;color:#15803d;font-size:.72rem;font-weight:600;">Active</span>
                            @else
                                <span style="padding:3px 10px;border-radius:20px;background:#fee2e2;color:#dc2626;font-size:.72rem;font-weight:600;">Inactive</span>
                            @endif
                        </td>

                        <td style="padding:.65rem 1rem; vertical-align:middle; text-align:center; white-space:nowrap;">
                            <div style="display:flex;justify-content:center;gap:6px;">
                                <a href="" style="width:30px;height:30px;border-radius:50%;background:#dbeafe;color:#2563eb;display:flex;align-items:center;justify-content:center;text-decoration:none;" title="View">
                                    <iconify-icon icon="heroicons:eye" style="font-size:14px;"></iconify-icon>
                                </a>
                                <a href="{{ route('user.edit',$user->id) }}" style="width:30px;height:30px;border-radius:50%;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;text-decoration:none;" title="Edit">
                                    <iconify-icon icon="lucide:edit" style="font-size:14px;"></iconify-icon>
                                </a>
                                <form method="POST" action="{{ route('user.destroy',$user->id) }}" onsubmit="return confirm('Delete this user?');" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="width:30px;height:30px;border-radius:50%;background:#fee2e2;color:#dc2626;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;" title="Delete">
                                        <iconify-icon icon="fluent:delete-24-regular" style="font-size:14px;"></iconify-icon>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="27" style="text-align:center;padding:2rem;color:#9ca3af;">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="padding:1rem 1.5rem;">{{ $users->links('vendor.pagination.tailwind') }}</div>
    </div>
</div>

<script>
function copyMembershipCode(userId) {
    const code = document.getElementById(`membershipCode-${userId}`).textContent.trim();
    const btn  = document.getElementById(`copyBtn-${userId}`);
    const orig = btn.innerHTML;
    navigator.clipboard.writeText(code).then(() => {
        btn.innerHTML="Copied!"; btn.style.background="#22c55e"; btn.style.color="white";
        setTimeout(()=>{ btn.innerHTML=orig; btn.style.background="#8AC304"; btn.style.color="#0C3A30"; },2000);
    });
}
function generateMembershipCode(userId) {
    const btn=event.currentTarget, orig=btn.innerHTML;
    btn.disabled=true; btn.innerHTML='Generating...';
    fetch("{{ route('admin.generate.membership.code') }}",{
        method:"POST",
        headers:{"Content-Type":"application/json","X-CSRF-TOKEN":"{{ csrf_token() }}"},
        body:JSON.stringify({user_id:userId})
    }).then(r=>r.json()).then(data=>{
        if(data.success){location.reload();}
        else{btn.disabled=false;btn.innerHTML=orig;alert(data.message||'Failed');}
    }).catch(()=>{btn.disabled=false;btn.innerHTML=orig;alert("Something went wrong.");});
}
</script>
@endsection