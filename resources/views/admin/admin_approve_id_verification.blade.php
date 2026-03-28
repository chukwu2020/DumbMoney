@extends('layout.admin')

@section('content')

<style>
    .card, .card-body, .card-header { background: #ffffff !important; color: #111827 !important; }
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

    <div class="card border-0 rounded-xl shadow-sm overflow-hidden">
        <div class="card-header border-b border-gray-100 px-6 py-4">
            <h6 class="font-bold text-lg mb-0" style="color:#0C3A30;">Recent KYC Requests</h6>
        </div>
        <div class="card-body p-6">
            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full">
                    <thead>
                        <tr style="background:#0C3A30 !important;">
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">User</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">Submitted</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">ID Document</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">Selfie</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide" style="color:#fff !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($kycs as $kyc)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">

                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#9EDD05] flex items-center justify-center text-[#0C3A30] font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $kyc->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $kyc->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                    $sc = ['pending'=>'bg-amber-50 text-amber-800 border border-amber-200','approved'=>'bg-green-50 text-green-800 border border-green-200','rejected'=>'bg-red-50 text-red-800 border border-red-200'][$kyc->status] ?? 'bg-gray-50 text-gray-800 border border-gray-200';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full {{ $sc }} capitalize">{{ $kyc->status }}</span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700">
                                {{ $kyc->created_at->format('d M, Y') }}<br>
                                <span class="text-gray-400 text-xs">{{ $kyc->created_at->diffForHumans() }}</span>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($kyc->id_document)
                                    <img src="{{ Storage::url($kyc->id_document) }}" alt="ID" class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-200 hover:border-[#9EDD05] transition" onclick="openModal('{{ Storage::url($kyc->id_document) }}')">
                                @else
                                    <span class="text-gray-400 text-sm">No ID</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($kyc->utility_bill)
                                    <img src="{{ Storage::url($kyc->utility_bill) }}" alt="Selfie" class="w-14 h-14 object-cover rounded-lg cursor-pointer border border-gray-200 hover:border-[#9EDD05] transition" onclick="openModal('{{ Storage::url($kyc->utility_bill) }}')">
                                @else
                                    <span class="text-gray-400 text-sm">No photo</span>
                                @endif
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($kyc->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <form method="POST" action="{{ route('admin.kyc.approve', $kyc->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition">
                                                <iconify-icon icon="mdi:check"></iconify-icon> Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.kyc.reject', $kyc->id) }}">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition">
                                                <iconify-icon icon="mdi:close"></iconify-icon> Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">Already {{ $kyc->status }}</span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden items-center justify-center p-4" onclick="closeModal()">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300"><iconify-icon icon="ph:x-bold" class="text-2xl"></iconify-icon></button>
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