@extends('layout.admin')

@section('content')

<style>
    .dashboard-main-body {
        max-width: 100%;
        overflow-x: hidden;
    }
    .card, .card-body, .card-header {
        background: #ffffff !important;
        color: #111827 !important;
    }
    .kyc-scroll {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .kyc-scroll::-webkit-scrollbar { height: 5px; }
    .kyc-scroll::-webkit-scrollbar-thumb { background: #9EDD05; border-radius: 10px; }
    .kyc-scroll::-webkit-scrollbar-track { background: #f3f4f6; border-radius: 10px; }
</style>

<div class="dashboard-main-body px-6 py-8">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0" style="color:#0C3A30;">KYC Submissions</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium"><a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-[#9EDD05]" style="color:#0C3A30;"><iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon> Dashboard</a></li>
            <li>-</li>
            <li class="font-medium" style="color:#9EDD05;">KYC Requests</li>
        </ul>
    </div>

    {{-- Card: overflow:hidden is the key fix --}}
    <div style="background:#fff; border-radius:12px; border:1px solid #e5e7eb; box-shadow:0 1px 3px rgba(0,0,0,.06); overflow:hidden; min-width:0; max-width:100%;">

        {{-- Header — does NOT scroll --}}
        <div style="padding:1rem 1.5rem; border-bottom:1px solid #f1f5f9;">
            <h6 class="font-bold text-lg mb-0" style="color:#0C3A30;">Recent KYC Requests</h6>
        </div>

        {{-- Only this wrapper scrolls --}}
        <div class="kyc-scroll" style="padding:1.5rem;">
            <table style="
                width: max-content;
                min-width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                font-size: .85rem;
            ">
                <thead>
                    <tr>
                        @foreach(['User','Status','Submitted','ID Document','Selfie','Actions'] as $h)
                        <th style="
                            background:#0C3A30;
                            color:#fff;
                            padding: .75rem 1.25rem;
                            text-align: left;
                            font-size: .72rem;
                            font-weight: 600;
                            text-transform: uppercase;
                            letter-spacing: .5px;
                            white-space: nowrap;
                        ">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kycs as $kyc)
                    <tr style="border-bottom:1px solid #f1f5f9; transition:background .15s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background=''">

                        <td style="padding:.85rem 1.25rem; white-space:nowrap; vertical-align:middle;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:38px;height:38px;border-radius:50%;background:#9EDD05;display:flex;align-items:center;justify-content:center;color:#0C3A30;font-weight:700;font-size:.8rem;flex-shrink:0;">
                                    {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;color:#111827;font-size:.85rem;">{{ $kyc->user->name }}</div>
                                    <div style="font-size:.72rem;color:#6b7280;">{{ $kyc->user->email }}</div>
                                </div>
                            </div>
                        </td>

                        <td style="padding:.85rem 1.25rem; white-space:nowrap; vertical-align:middle;">
                            @php
                                $styles = [
                                    'pending'  => 'background:#fef9c3;color:#854d0e;border:1px solid #fde047;',
                                    'approved' => 'background:#dcfce7;color:#166534;border:1px solid #86efac;',
                                    'rejected' => 'background:#fee2e2;color:#991b1b;border:1px solid #fca5a5;',
                                ][$kyc->status] ?? 'background:#f3f4f6;color:#374151;border:1px solid #e5e7eb;';
                            @endphp
                            <span style="padding:3px 12px;border-radius:20px;font-size:.72rem;font-weight:600;text-transform:capitalize;{{ $styles }}">
                                {{ $kyc->status }}
                            </span>
                        </td>

                        <td style="padding:.85rem 1.25rem; white-space:nowrap; vertical-align:middle;">
                            <div style="font-size:.82rem;color:#374151;">{{ $kyc->created_at->format('d M, Y') }}</div>
                            <div style="font-size:.7rem;color:#9ca3af;">{{ $kyc->created_at->diffForHumans() }}</div>
                        </td>

                        <td style="padding:.85rem 1.25rem; vertical-align:middle;">
                            @if($kyc->id_document)
                                <img src="{{ Storage::url($kyc->id_document) }}" alt="ID"
                                     style="width:52px;height:52px;object-fit:cover;border-radius:8px;cursor:pointer;border:1px solid #e5e7eb;transition:border-color .2s;"
                                     onmouseover="this.style.borderColor='#9EDD05'"
                                     onmouseout="this.style.borderColor='#e5e7eb'"
                                     onclick="openModal('{{ Storage::url($kyc->id_document) }}')">
                            @else
                                <span style="color:#9ca3af;font-size:.8rem;">No ID</span>
                            @endif
                        </td>

                        <td style="padding:.85rem 1.25rem; vertical-align:middle;">
                            @if($kyc->utility_bill)
                                <img src="{{ Storage::url($kyc->utility_bill) }}" alt="Selfie"
                                     style="width:52px;height:52px;object-fit:cover;border-radius:8px;cursor:pointer;border:1px solid #e5e7eb;transition:border-color .2s;"
                                     onmouseover="this.style.borderColor='#9EDD05'"
                                     onmouseout="this.style.borderColor='#e5e7eb'"
                                     onclick="openModal('{{ Storage::url($kyc->utility_bill) }}')">
                            @else
                                <span style="color:#9ca3af;font-size:.8rem;">No photo</span>
                            @endif
                        </td>

                        <td style="padding:.85rem 1.25rem; white-space:nowrap; vertical-align:middle;">
                            @if($kyc->status === 'pending')
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <form method="POST" action="{{ route('admin.kyc.approve', $kyc->id) }}" style="display:inline;">
                                        @csrf @method('PATCH')
                                        <button type="submit" style="display:inline-flex;align-items:center;gap:4px;padding:5px 12px;background:#16a34a;color:#fff;border:none;border-radius:8px;font-size:.75rem;font-weight:600;cursor:pointer;transition:background .2s;" onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">
                                            <iconify-icon icon="mdi:check"></iconify-icon> Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.kyc.reject', $kyc->id) }}" style="display:inline;">
                                        @csrf @method('PATCH')
                                        <button type="submit" style="display:inline-flex;align-items:center;gap:4px;padding:5px 12px;background:#dc2626;color:#fff;border:none;border-radius:8px;font-size:.75rem;font-weight:600;cursor:pointer;transition:background .2s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                                            <iconify-icon icon="mdi:close"></iconify-icon> Reject
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span style="color:#9ca3af;font-style:italic;font-size:.82rem;">Already {{ $kyc->status }}</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden items-center justify-center p-4" onclick="closeModal()">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
            <iconify-icon icon="ph:x-bold" class="text-2xl"></iconify-icon>
        </button>
        <img id="modalImage" class="w-full max-h-[80vh] rounded-lg shadow-2xl object-contain" onclick="event.stopPropagation();">
    </div>
</div>

<script>
function openModal(url) {
    document.getElementById('modalImage').src = url;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}
function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endsection