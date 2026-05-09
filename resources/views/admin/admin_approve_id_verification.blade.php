@extends('layout.admin')

@section('content')

<style>
    :root {
        --brand-green: #9EDD05;
        --brand-dark: #0C3A30;
    }

    .sticky-header {
        position: sticky;
        top: 0;
        z-index: 50;
        background: white;
        margin: 0;
        padding: 1rem 0;
    }

    .card-header-custom {
        border-bottom: 1px solid #e5e7eb;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        background: white;
    }

    .table-scroll {
        overflow-x: auto;
        overflow-y: auto;
        max-height: calc(100vh - 280px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.78rem;
        min-width: 900px;
    }

    thead th {
        background: linear-gradient(135deg, #0C3A30, #1a5c47);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.85rem 1rem;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
        border-right: 1px solid rgba(255,255,255,0.08);
    }

    thead th:first-child {
        position: sticky;
        left: 0;
        z-index: 20;
        background: linear-gradient(135deg, #0C3A30, #1a5c47);
    }

    tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.15s;
    }

    tbody tr:hover {
        background: #f8fffe;
    }

    tbody td {
        padding: 0.85rem 1rem;
        color: #374151;
        vertical-align: middle;
        white-space: nowrap;
        border-right: 1px solid #f3f4f6;
    }

    tbody td:first-child {
        position: sticky;
        left: 0;
        background: white;
        z-index: 5;
        box-shadow: 2px 0 6px rgba(0,0,0,0.06);
    }

    tbody tr:hover td:first-child {
        background: #f8fffe;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid var(--brand-green);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #9EDD05, #8AC304);
        font-weight: 700;
        font-size: 1rem;
        color: var(--brand-dark);
        overflow: hidden;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .user-meta strong {
        display: block;
        font-weight: 700;
        color: #111827;
        font-size: 0.85rem;
    }

    .user-meta span {
        font-size: 0.7rem;
        color: #6b7280;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-pending {
        background: #fef9c3;
        color: #854d0e;
        border: 1px solid #fde047;
    }

    .badge-approved {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #86efac;
    }

    .badge-rejected {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    .doc-preview {
        width: 56px;
        height: 56px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        border: 2px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .doc-preview:hover {
        border-color: var(--brand-green);
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .action-btn.approve {
        background: #16a34a;
        color: white;
    }

    .action-btn.approve:hover {
        background: #15803d;
        transform: translateY(-1px);
    }

    .action-btn.reject {
        background: #dc2626;
        color: white;
    }

    .action-btn.reject:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }

    /* Image Modal */
    .image-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .image-modal.active {
        display: flex;
    }

    .modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
    }

    .modal-content img {
        width: 100%;
        height: auto;
        max-height: 85vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    }

    .close-modal {
        position: absolute;
        top: -40px;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 28px;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .close-modal:hover {
        opacity: 0.7;
    }
</style>

<div class="dashboard-main-body">

    <!-- Sticky Header -->
    <div class="sticky-header">
        <div class="flex flex-wrap items-center justify-between gap-2 mb-4">
            <h6 class="font-semibold mb-0" style="color:#0C3A30;">KYC Submissions</h6>
            <ul class="flex items-center gap-[6px] text-sm">
                <li class="font-medium">
                    <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="font-medium" style="color:#9EDD05;">KYC Requests</li>
            </ul>
        </div>
    </div>

    <!-- Main Card -->
    <div class="grid grid-cols-12">
        <div class="col-span-12">
            <div class="card h-full p-0 rounded-xl border-0 overflow-hidden">

                <!-- Table Body -->
                <div class="card-body p-0">
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Country</th>
                                    <th>Submitted</th>
                                    <th>ID Document</th>
                                    <th>Selfie/Utility</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kycs as $kyc)
                                @php
                                    $statusColors = [
                                        'pending'  => 'badge-pending',
                                        'approved' => 'badge-approved',
                                        'rejected' => 'badge-rejected',
                                    ];
                                    $statusClass = $statusColors[$kyc->status] ?? 'badge-pending';

                                    // ── FIX: KYC document URLs ──────────────────────────────
                                    // Documents are stored as just the filename.
                                    // They live in public/uploads/ on the host.
                                    $idDocUrl = $kyc->id_document
                                        ? asset('uploads/' . basename($kyc->id_document))
                                        : null;

                                    $utilityUrl = $kyc->utility_bill
                                        ? asset('uploads/' . basename($kyc->utility_bill))
                                        : null;
                                    // ────────────────────────────────────────────────────────
                                @endphp
                                <tr>

                                    {{-- User Info (sticky) --}}
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar">
                                                {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                                            </div>
                                            <div class="user-meta">
                                                <strong>{{ $kyc->user->name }}</strong>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td>
                                        <span class="badge {{ $statusClass }}">
                                            @if($kyc->status == 'pending')
                                                <iconify-icon icon="ph:clock-fill"></iconify-icon>
                                            @elseif($kyc->status == 'approved')
                                                <iconify-icon icon="ph:check-circle-fill"></iconify-icon>
                                            @else
                                                <iconify-icon icon="ph:x-circle-fill"></iconify-icon>
                                            @endif
                                            {{ ucfirst($kyc->status) }}
                                        </span>
                                    </td>

                                    <td>{{ $kyc->user->country ?? '—' }}</td>

                                    {{-- Submitted Date --}}
                                    <td>
                                        <div style="font-size:0.8rem; color:#374151;">{{ $kyc->created_at->format('d M, Y') }}</div>
                                        <div style="font-size:0.65rem; color:#9ca3af;">{{ $kyc->created_at->diffForHumans() }}</div>
                                    </td>

                                    {{-- ID Document --}}
                                    <td>
                                        @if($idDocUrl)
                                            <img src="{{ $idDocUrl }}"
                                                 alt="ID Document"
                                                 class="doc-preview"
                                                 onclick="openImageModal('{{ $idDocUrl }}')">
                                        @else
                                            <span class="text-gray-400 text-xs">No ID uploaded</span>
                                        @endif
                                    </td>

                                    {{-- Selfie/Utility Bill --}}
                                    <td>
                                        @if($utilityUrl)
                                            <img src="{{ $utilityUrl }}"
                                                 alt="Selfie/Utility"
                                                 class="doc-preview"
                                                 onclick="openImageModal('{{ $utilityUrl }}')">
                                        @else
                                            <span class="text-gray-400 text-xs">No photo uploaded</span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        @if($kyc->status === 'pending')
                                            <div style="display: flex; align-items: center; gap: 8px;">
                                                <form method="POST" action="{{ route('admin.kyc.approve', $kyc->id) }}" style="display:inline;">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="action-btn approve">
                                                        <iconify-icon icon="ph:check-bold"></iconify-icon> Approve
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.kyc.reject', $kyc->id) }}" style="display:inline;">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="action-btn reject">
                                                        <iconify-icon icon="ph:x-bold"></iconify-icon> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic text-sm">Already {{ $kyc->status }}</span>
                                        @endif
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:3rem; color:#9ca3af;">
                                        <iconify-icon icon="mdi:file-document-outline" style="font-size:2.5rem; display:block; margin:0 auto 0.75rem;"></iconify-icon>
                                        No KYC submissions found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <div class="modal-content">
        <button class="close-modal" onclick="closeImageModal()">
            <iconify-icon icon="ph:x-bold"></iconify-icon>
        </button>
        <img id="modalImage" src="" alt="Document Preview" onclick="event.stopPropagation()">
    </div>
</div>

<script>
    function openImageModal(url) {
        const modal = document.getElementById('imageModal');
        const img   = document.getElementById('modalImage');
        img.src = url;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeImageModal();
    });
</script>

@endsection