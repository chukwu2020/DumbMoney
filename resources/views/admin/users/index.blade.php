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

    <!-- Table -->
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card rounded-xl overflow-hidden border-0 bg-white shadow-sm">

                <div class="card-body p-6">

                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table sm-table mb-0">

                            <thead>
                                <tr style="background:#0C3A30 !important;">
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Profile</th>
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Name</th>
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Phone</th>
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Country</th>
                                    <th style="background:#0C3A30 !important;" class="text-white py-3">Email</th>
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Join Date</th>
                                    <th  style="background:#0C3A30 !important;" class="text-white py-3">Available Balance</th>
                                    <th  style="background:#0C3A30 !important;"class="text-white py-3">Investment Status</th>
                                    <th  style="background:#0C3A30 !important;"class="text-white py-3 text-center">Membership Code</th>
                                    <th  style="background:#0C3A30 !important;"class="text-white py-3 text-center">Status</th>
                                    <th  style="background:#0C3A30 !important;"class="text-white py-3 text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($users as $user)
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

                                    <!-- Name -->
                                    <td>{{ $user->name }}</td>

                                    <!-- Phone -->
                                    <td>{{ $user->phone }}</td>

                                    <!-- Country -->
                                    <td>{{ $user->country }}</td>

                                    <!-- Email -->
                                    <td>{{ $user->email }}</td>

                                    <!-- Join Date -->
                                    <td>{{ $user->created_at->format('d M Y') }}</td>

                                    <!-- Balance -->
                                    <td>${{ number_format($user->total_income, 2) }}</td>

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
                                                            🟡 Pending Activation
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
                                                Generate Code
                                            </button>
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
                                        <div class="flex justify-center gap-3">

                                            <!-- Edit -->
                                            <a href="{{ route('user.edit', $user->id) }}"  style="background:green !important;">
                                                <button class="w-10 h-10 rounded-full bg-green-100 text-green-600 hover:bg-green-200 flex items-center justify-center">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </button>
                                            </a>

                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('user.destroy', $user->id) }}"
                                                  onsubmit="return confirm('Are you sure?');" style="background:red !important;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="w-10 h-10 rounded-full bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center">
                                                    <iconify-icon icon="fluent:delete-24-regular"></iconify-icon>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                                @endforeach

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
</script>


<script>
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
        body: JSON.stringify({ user_id: userId })
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {

            // Reload the page so the generated code appears
            location.reload();

        } else {

            // Restore button
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
