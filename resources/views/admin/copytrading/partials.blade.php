{{-- resources/views/admin/copy-trading/partials/request-card.blade.php --}}
@php
    if($type == 'pending') {
        $badgeClass = 'badge-pending';
        $badgeIcon = 'ph:clock-fill';
        $badgeText = 'Pending';
    } elseif($type == 'approved') {
        $badgeClass = 'badge-approved';
        $badgeIcon = 'ph:check-circle-fill';
        $badgeText = 'Approved';
    } else {
        $badgeClass = 'badge-rejected';
        $badgeIcon = 'ph:x-circle-fill';
        $badgeText = 'Rejected';
    }
    
    $userParticipations = \App\Models\Investment::where('user_id', $request->user_id)
        ->where('plan_id', $request->plan_id)
        ->where('type', 'copy_trading')
        ->count();
    
    $planLimit = $request->plan->max_participations ?? 3;
    $hasReachedLimit = $userParticipations >= $planLimit;
    $remainingSlots = max(0, $planLimit - $userParticipations);
    $totalParticipations = \App\Models\Investment::where('user_id', $request->user_id)
        ->where('type', 'copy_trading')
        ->count();
@endphp

<div class="request-card">
    <div class="flex flex-wrap items-start justify-between gap-4">
        <!-- User Info -->
        <div class="flex items-start gap-4 flex-1">
            <div class="user-avatar">
                {{ strtoupper(substr($request->user->name, 0, 1)) }}
            </div>
            <div>
                <div class="flex items-center gap-3 mb-1 flex-wrap">
                    <h6 class="font-bold text-lg">{{ $request->user->name }}</h6>
                    <span class="{{ $badgeClass }}">
                        <iconify-icon icon="{{ $badgeIcon }}"></iconify-icon>
                        {{ $badgeText }}
                    </span>
                </div>
                <p class="text-sm text-gray-500">{{ $request->user->email }}</p>
                <p class="text-xs text-gray-400 mt-1">Member since: {{ $request->user->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Request Details -->
        <div class="flex-1">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-500 mb-2">Request Details</p>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <p class="text-xs text-gray-400">Plan</p>
                        <p class="font-semibold">{{ $request->plan->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Amount</p>
                        <p class="font-bold text-green-600">${{ number_format($request->amount, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Duration</p>
                        <p class="font-semibold">{{ $request->plan->duration }} {{ $request->plan->duration_unit ?? 'days' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Return Rate</p>
                        <p class="text-green-600">{{ $request->plan->interest_rate }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Participation Stats (only for pending) -->
        @if($type == 'pending')
        <div class="flex-1">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-500 mb-2 flex items-center gap-1">
                    <iconify-icon icon="ph:trend-up-fill"></iconify-icon>
                    Participation History
                </p>
                <div class="grid grid-cols-2 gap-3 mb-2">
                    <div>
                        <p class="text-xs text-gray-400">This Plan</p>
                        <p class="font-semibold text-lg">
                            {{ $userParticipations }} 
                            <span class="text-xs text-gray-400">/ {{ $planLimit }}</span>
                        </p>
                        @if($hasReachedLimit)
                            <p class="text-xs text-red-500 mt-1">
                                <iconify-icon icon="ph:warning-circle-fill"></iconify-icon>
                                Limit reached
                            </p>
                        @elseif($remainingSlots > 0)
                            <p class="text-xs text-green-600 mt-1">
                                <iconify-icon icon="ph:check-circle-fill"></iconify-icon>
                                {{ $remainingSlots }} slots remaining
                            </p>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Total Trades</p>
                        <p class="font-semibold text-lg">{{ $totalParticipations ?? 0 }}</p>
                    </div>
                </div>
                @if($userParticipations > 0)
                <div class="progress-bar mt-2">
                    <div class="progress-fill" style="width: {{ min(100, ($userParticipations / $planLimit) * 100) }}%"></div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Admin Info -->
        <div class="flex-1">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-500 mb-1">Copying Admin</p>
                <p class="font-semibold">{{ $request->copy_admin_name ?? 'Platform Admin' }}</p>
                <p class="text-xs text-gray-500">{{ $request->copy_server_name ?? 'Official Server' }}</p>
                <p class="text-xs text-green-600 mt-1">
                    <iconify-icon icon="ph:check-circle-fill" class="inline"></iconify-icon>
                    Active
                </p>
            </div>
        </div>

        <!-- Actions -->
        @if($type == 'pending')
        <div class="flex gap-2">
            @if($hasReachedLimit)
                <div class="bg-red-50 p-3 rounded-lg max-w-xs border-l-4 border-red-500">
                    <div class="flex items-center gap-2">
                        <iconify-icon icon="ph:warning-circle-fill" class="text-red-600"></iconify-icon>
                        <p class="text-xs text-red-700">
                            User has reached the maximum limit for this plan ({{ $planLimit }} participations)
                        </p>
                    </div>
                </div>
            @else
                <button onclick="approveRequest({{ $request->id }})" 
                        class="action-btn approve">
                    <iconify-icon icon="ph:check-bold" class="mr-1"></iconify-icon>
                    Approve
                </button>
                <button onclick="showRejectModal({{ $request->id }})" 
                        class="action-btn reject">
                    <iconify-icon icon="ph:x-bold" class="mr-1"></iconify-icon>
                    Reject
                </button>
            @endif
        </div>
        @endif
    </div>

    <!-- Request Meta -->
    <div class="flex items-center gap-4 mt-4 pt-3 border-t border-gray-100 text-xs text-gray-400">
        <span>
            <iconify-icon icon="ph:clock-fill" class="mr-1"></iconify-icon>
            @if($type == 'approved')
                Approved: {{ $request->approved_at->format('M d, Y H:i') }}
            @elseif($type == 'rejected')
                Rejected: {{ $request->rejected_at->format('M d, Y H:i') }}
            @else
                Requested: {{ $request->created_at->diffForHumans() }}
            @endif
        </span>
        <span>
            <iconify-icon icon="ph:flag-fill" class="mr-1"></iconify-icon>
            {{ $request->user->country }}
        </span>
        @if($type == 'pending' && $userParticipations > 0)
        <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full text-xs">
            <iconify-icon icon="ph:repeat-fill" class="mr-1"></iconify-icon>
            {{ $userParticipations }}x previous
        </span>
        @endif
        @if($type == 'rejected' && $request->rejection_reason)
        <span class="bg-red-100 text-red-600 px-2 py-0.5 rounded-full text-xs cursor-help" title="{{ $request->rejection_reason }}">
            <iconify-icon icon="ph:info-fill"></iconify-icon>
            Reason provided
        </span>
        @endif
    </div>

    @if($type == 'rejected' && $request->rejection_reason)
    <div class="mt-3 pt-2">
        <div class="bg-red-50 rounded-lg p-3 text-xs border-l-4 border-red-500">
            <span class="font-semibold text-red-600">Rejection Reason:</span>
            <span class="text-gray-600 ml-2">{{ $request->rejection_reason }}</span>
        </div>
    </div>
    @endif
</div>