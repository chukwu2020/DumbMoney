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
                    
                   
                    
                    
                    
                    <!-- Search Button -->
                    <div class="flex gap-2">
                        <button type="submit" style="color: #0C3A30;" 
                                class="px-6 py-2 bg-[#0C3A30] text-white rounded-lg hover:bg-[#154e40] transition-colors duration-200 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:search"></iconify-icon>
                            Search
                        </button>
                        
                        <!-- Clear Button (only show if there are search parameters) -->
                        @if(request('name') || request('email') || request('country') || request('join_source') || request('copy_preference'))
                        <a href="{{ route('hidden.user') }}" 
                           class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 flex items-center gap-2">
                            <iconify-icon icon="material-symbols:close"></iconify-icon>
                            Clear
                        </a>
                        @endif
                    </div>
                </form>

                <!-- Search Stats -->
                @if(request('name') || request('email') || request('country') || request('join_source') || request('copy_preference'))
                <div class="mt-3 text-sm text-gray-600">
                    Showing results for: 
                    @if(request('name')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:person" class="text-[#0C3A30]"></iconify-icon> Name: "{{ request('name') }}"</span> @endif
                    @if(request('email')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:mail" class="text-[#0C3A30]"></iconify-icon> Email: "{{ request('email') }}"</span> @endif
                    @if(request('country')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:location-on" class="text-[#0C3A30]"></iconify-icon> Country: "{{ request('country') }}"</span> @endif
                    @if(request('join_source')) <span class="inline-flex items-center gap-1 mr-3"><iconify-icon icon="material-symbols:login" class="text-[#0C3A30]"></iconify-icon> Joined via: {{ ucfirst(request('join_source')) }}</span> @endif
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
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Balance</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Investment</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Membership Code</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Control</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Status</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3 text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($users as $user)
                                <tr>

                                    <!-- Profile -->
                                    <td>
                                        @php
                                        $profilePic = $user->profile->profile_pic ?? null;
                                        $hasProfilePic = $profilePic && file_exists(public_path('uploads/' . $profilePic));
                                        $initials = collect(explode(' ', $user->name))
                                        ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                        ->take(2)
                                        ->join('') ?: 'U';
                                        @endphp

                                        @if($hasProfilePic)
                                        <img src="{{ asset('uploads/' . $profilePic) }}" class="w-10 h-10 rounded-full object-cover" />
                                        @else
                                        <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">
                                            {{ $initials }}
                                        </div>
                                        @endif
                                    </td>

                                    <!-- Name & Email -->
                                    <td>
                                        <div class="font-semibold">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->username }}</div>
                                    </td>

                                    <!-- Phone & Email -->
                                    <td>
                                        <div>{{ $user->phone }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </td>

                                    <!-- Country -->
                                    <td>{{ $user->country ?? 'N/A' }}</td>

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
                                                <span class="capitalize">{{ str_replace('_', ' ', $user->join_source) }}</span>
                                            </div>
                                            @if($user->join_source_other)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <span class="font-medium">Other:</span> {{ $user->join_source_other }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-gray-400">Not specified</span>
                                        @endif
                                    </td>

                                    <!-- Copy Preference -->
                                    <td>
                                        @if($user->copy_preference)
                                            <div class="flex items-center gap-1">
                                                @if($user->copy_preference == 'platform_admin')
                                                    <iconify-icon icon="ri:admin-line" style="color: #8bc905;"></iconify-icon>
                                                    <span>Platform Admin</span>
                                                @elseif($user->copy_preference == 'specific_admin')
                                                    <iconify-icon icon="ri:discord-line" style="color: #5865F2;"></iconify-icon>
                                                    <span>Specific Admin</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400">Not specified</span>
                                        @endif
                                    </td>

                                    <!-- Selected Admin -->
                                    <td>
                                        @if($user->copy_preference == 'specific_admin' && $user->copy_admin_name)
                                            <div class="font-medium">{{ $user->copy_admin_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->copy_server_name ?? 'Server not specified' }}</div>
                                            @if($user->copy_admin_id)
                                                <div class="text-xs text-gray-400">ID: {{ $user->copy_admin_id }}</div>
                                            @endif
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>

                                    <!-- Join Date -->
                                    <td>{{ $user->created_at->format('d M Y') }}</td>

                                    <!-- Balance -->
                                    <td>${{ number_format($user->total_income ?? 0, 2) }}</td>

                                    <!-- Investment Status -->
                                    <td>
                                        @php
                                        $latestInvestment = $user->investments->sortByDesc('end_date')->first();
                                        @endphp

                                        @if($latestInvestment)
                                        @if(\Carbon\Carbon::parse($latestInvestment->end_date)->isPast())
                                        <span class="px-4 py-1 rounded text-white text-sm" style="background:red !important;">
                                            Due
                                        </span>
                                        @else
                                        <span class="px-4 py-1 rounded text-white text-sm" style="background:green !important;">
                                            Ongoing
                                        </span>
                                        @endif
                                        @else
                                        <span class="px-4 py-1 rounded text-sm border">N/A</span>
                                        @endif
                                    </td>

                                    <!-- Membership Code Column -->
                                    <td class="text-center">
                                        @if($user->membership_code)
                                        <div style="background: linear-gradient(to right, #22c55e, #10b981) !important;
                                                padding:0.5rem 0.75rem !important; border-radius:0.75rem !important;
                                                box-shadow:0 4px 6px rgba(0,0,0,0.1) !important; margin-bottom:0.5rem !important;">
                                            <div class="text-xs font-semibold mb-1">✅ Generated</div>
                                            <div class="font-mono text-sm font-bold mb-2"
                                                id="membershipCode-{{ $user->id }}">
                                                {{ $user->membership_code }}
                                            </div>
                                            <div class="flex gap-2">
                                                <span class="text-xs mt-1 opacity-90 flex-1">
                                                    Status:
                                                    @if($user->has_membership)
                                                    🟢 Active
                                                    @else
                                                    🟡 Pending
                                                    @endif
                                                </span>
                                                <button id="copyBtn-{{ $user->id }}"
                                                    onclick="copyMembershipCode({{ $user->id }})"
                                                    style="padding:0.25rem 0.5rem !important;
                                                        background:#8AC304 !important; color:black !important;
                                                        border-radius:0.5rem !important; font-size:0.75rem !important;
                                                        font-weight:bold !important; cursor:pointer !important;">
                                                    📋 Copy
                                                </button>
                                            </div>
                                        </div>
                                        @else
                                        <button onclick="generateMembershipCode({{ $user->id }})"
                                            style="padding:0.5rem 1rem !important; background: linear-gradient(to right, #8AC304, #6ea003) !important;
                                                    border-radius:0.5rem !important; font-size:0.875rem !important;
                                                    font-weight:bold !important; color:black !important;">
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
                                                class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 hover:bg-yellow-200 flex items-center justify-center mx-auto"
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
                                        <span class="px-6 py-1.5 rounded bg-green-100 text-green-600 border border-green-600 text-sm font-medium" style="background:green !important;">
                                            Active
                                        </span>
                                        @else
                                        <span class="px-6 py-1.5 rounded bg-red-100 text-red-600 border border-red-600 text-sm font-medium" style="background:red !important;">
                                            Inactive
                                        </span>
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- Edit -->
                                            <a href="{{ route('user.edit', $user->id) }}" style="color: green;">
                                                <button
                                                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 hover:bg-green-200 flex items-center justify-center">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </button>
                                            </a>
                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}" style="color: red;"
                                                  onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="w-10 h-10 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center">
                                                    <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="14" class="text-center py-8 text-gray-500">
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

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = "#8AC304";
            }, 2000);
        });
    }

    function generateMembershipCode(userId) {
        // Disable button while loading
        const btn = event.target;
        const oldHtml = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = "Generating...";

        fetch("{{ route('admin.generate.membership.code') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    user_id: userId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    btn.disabled = false;
                    btn.innerHTML = oldHtml;
                    alert(data.message);
                }
            })
            .catch(err => {
                console.error(err);
                btn.disabled = false;
                btn.innerHTML = oldHtml;
                alert("Something went wrong.");
            });
    }
</script>

@endsection