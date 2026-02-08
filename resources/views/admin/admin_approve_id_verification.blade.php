@extends('layout.admin')

@section('content')
<div class="dashboard-main-body px-6 py-8">

    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0">KYC Submissions</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{ route('admin_dashboard') }}" class="flex items-center gap-2 hover:text-primary-600">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="font-medium">KYC Requests</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card border-0 h-full w-full">
                <div class="card-header">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <h6 class="font-bold text-lg mb-0">Recent KYC Requests</h6>
                    </div>
                </div>
                <div class="card-body p-6" style="color:#0C3A30;">
                    <div class="overflow-x-auto">
                        <table class="min-w-[1000px] w-full table bordered-table mb-0">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>ID Document</th>
                                     <th>selfie</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kycs as $kyc)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium">
                                                {{ strtoupper(substr($kyc->user->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $kyc->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $kyc->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-50 text-amber-800 border border-amber-200',
                                                'approved' => 'bg-green-50 text-green-800 border border-green-200',
                                                'rejected' => 'bg-red-50 text-red-800 border border-red-200',
                                            ][$kyc->status] ?? 'bg-gray-50 text-gray-800 border border-gray-200';
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-medium rounded-full {{ $statusClasses }} capitalize">
                                            {{ $kyc->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                                        {{ $kyc->created_at->format('d M, Y') }} <br>
                                        <span class="text-gray-500 text-xs">{{ $kyc->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if ($kyc->id_document)
                                            <img src="{{ Storage::url($kyc->id_document) }}"
                                                 alt="ID Document"
                                                 class="w-[60px] h-[60px] object-cover rounded cursor-pointer"
                                                 onclick="openModal('{{ Storage::url($kyc->id_document) }}')">
                                        @else
                                            <span class="text-gray-400">No ID</span>
                                        @endif
                                    </td>

                                     <td class="px-4 py-3 whitespace-nowrap">
                                        @if ($kyc->utility_bill)
                                            <img src="{{ Storage::url($kyc->utility_bill) }}"
                                                 alt="photo"
                                                 class="w-[60px] h-[60px] object-cover rounded cursor-pointer"
                                                 onclick="openModal('{{ Storage::url($kyc->utility_bill) }}')">
                                        @else
                                            <span class="text-gray-400">No photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        @if($kyc->status === 'pending')
                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('admin.kyc.approve', $kyc->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded flex items-center">
                                                    <iconify-icon icon="mdi:check" class="mr-1"></iconify-icon> Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.kyc.reject', $kyc->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded flex items-center">
                                                    <iconify-icon icon="mdi:close" class="mr-1"></iconify-icon> Reject
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                            <span class="text-gray-400 italic">Already {{ $kyc->status }}</span>
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
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden items-center justify-center p-4" onclick="closeModal()">
    <img id="modalImage" class="max-w-full max-h-full rounded-lg shadow-lg object-contain" onclick="event.stopPropagation();">
</div>

<script>
function openModal(imageUrl) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imageUrl;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
