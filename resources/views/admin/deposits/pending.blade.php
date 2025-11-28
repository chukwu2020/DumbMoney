@extends('layout.admin')
@section('content')

<div class="dashboard-main-body" style="background: linear-gradient(135deg, #0C3A30 0%, #1a5c4a 50%, #0C3A30 100%); min-height: 100vh;">
    <div class="flex flex-wrap items-center justify-between gap-2 mb-6">
        <h6 class="font-semibold mb-0 text-white text-2xl">⏳ Pending Deposits</h6>
        <ul class="flex items-center gap-[6px]">
            <li class="font-medium">
                <a href="{{route('admin_dashboard')}}" class="flex items-center gap-2 text-[#8AC304] hover:text-white transition-colors">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li class="text-white">-</li>
            <li class="font-medium text-gray-300">Pending deposits</li>
        </ul>
    </div>

    <div class="grid grid-cols-1 2xl:grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="card border-0 h-full w-full" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 16px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);">
                <div class="card-header" style="background: linear-gradient(135deg, #8AC304 0%, #6ea003 100%); border-radius: 16px 16px 0 0; padding: 20px;">
                    <div class="flex items-center flex-wrap gap-2 justify-between">
                        <h6 class="font-bold text-xl mb-0 text-white flex items-center gap-2">
                            <span class="text-2xl">📋</span> Recent Pending Deposits
                        </h6>
                        <span class="bg-white text-[#0C3A30] px-4 py-2 rounded-full font-bold text-sm">
                            {{ $deposits->count() }} Pending
                        </span>
                    </div>
                </div>
                <div class="card-body p-6">
                    @if($deposits->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-[900px] w-full table bordered-table mb-0">
                            <thead>
                                <tr style="background: #0C3A30;">
                                    <th class="text-white">#</th>
                                    <th class="text-white">User</th>
                                    <th class="text-white">Email</th>
                                    <th class="text-white">Plan</th>
                                    <th class="text-white">Proof</th>
                                    <th class="text-white">Country</th>
                                    <th class="text-white">Amount ($)</th>
                                    <th class="text-white">Payment Method</th>
                                    <th class="text-white">Membership Code</th>
                                    <th class="text-white">Date</th>
                                    <th class="text-white">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deposits as $deposit)
                                <tr style="border-bottom: 1px solid #e0e0e0; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                                    <td><span class="font-semibold text-[#0C3A30]">{{ $loop->iteration }}</span></td>
                                    <td><span class="text-gray-700 font-medium">{{ $deposit->user->name }}</span></td>
                                    <td><span class="text-gray-600 text-sm">{{ $deposit->user->email }}</span></td>
                                    <td>
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            {{ $deposit->plan->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($deposit->proof)
                                        <img src="{{ Storage::url($deposit->proof) }}"
                                            alt="Proof"
                                            class="w-[60px] h-[60px] cursor-pointer object-cover rounded-lg shadow-md hover:scale-110 transition-transform"
                                            onclick="openModal('{{ Storage::url($deposit->proof) }}')">
                                        @else
                                        <span class="text-gray-400">No proof</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-gray-700 flex items-center gap-1">
                                            <iconify-icon icon="circle-flags:{{ strtolower($deposit->user->country ?? 'us') }}" class="text-xl"></iconify-icon>
                                            {{ $deposit->user->country }}
                                        </span>
                                    </td>
                                    <td><span class="text-[#8AC304] font-bold text-lg">${{ number_format($deposit->amount_deposited, 2) }}</span></td>
                                    <td>
                                        <div class="text-gray-700">
                                            <h6 class="text-base mb-0 font-semibold">{{ $deposit->wallet->crypto_name }}</h6>
                                            <span class="text-xs text-gray-500 font-mono">{{ substr($deposit->wallet->wallet_address, 0, 10) }}...</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($deposit->user->membership_code)
                                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-2 rounded-lg shadow-md">
                                                <div class="text-xs font-semibold mb-1">✅ Generated</div>
                                                <div class="font-mono text-sm font-bold">{{ $deposit->user->membership_code }}</div>
                                                <div class="text-xs mt-1 opacity-90">
                                                    Status: {{ $deposit->user->has_membership ? '🟢 Active' : '🟡 Pending Activation' }}
                                                </div>
                                            </div>
                                        @else
                                            <button onclick="generateMembershipCode({{ $deposit->user->id }})" 
                                                    class="px-4 py-2 bg-gradient-to-r from-[#8AC304] to-[#6ea003] text-white rounded-lg text-sm font-bold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                                <iconify-icon icon="mdi:ticket-confirmation" class="mr-1"></iconify-icon>
                                                Generate Code
                                            </button>
                                        @endif
                                    </td>
                                    <td><span class="text-gray-600 text-sm">{{ $deposit->created_at->format('d M, Y') }}</span></td>
                                    <td>
                                        <div class="flex gap-2">
                                            <form method="POST" action="{{ route('admin.approve.deposit', $deposit->id) }}" 
                                                  onsubmit="this.querySelector('button').disabled = true;">
                                                @csrf
                                                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg font-semibold text-sm shadow-md transition-all duration-300 transform hover:scale-105">
                                                    ✓ Approve
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('admin.reject.deposit', $deposit->id) }}" 
                                                  onsubmit="return confirm('Are you sure you want to reject this deposit?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg font-semibold text-sm shadow-md transition-all duration-300 transform hover:scale-105">
                                                    ✗ Reject
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">📭</div>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">No Pending Deposits</h3>
                        <p class="text-gray-500">All deposits have been processed!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4 backdrop-blur-sm" onclick="closeModal()">
    <div class="relative max-w-4xl w-full">
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-white text-gray-800 rounded-full w-10 h-10 flex items-center justify-center hover:bg-gray-200 transition-colors z-10">
            ✕
        </button>
        <img id="modalImage" class="max-w-full max-h-[90vh] rounded-2xl shadow-2xl object-contain mx-auto" onclick="event.stopPropagation();">
    </div>
</div>

<!-- Enhanced Membership Code Modal -->
<div id="membershipModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl transform transition-all" onclick="event.stopPropagation();">
        <div class="text-center mb-6">
            <div class="text-6xl mb-4">🎉</div>
            <h3 class="text-2xl font-bold text-[#0C3A30] mb-2">Membership Code Generated!</h3>
            <p class="text-gray-600">Share this code with the user</p>
        </div>
        
        <div class="bg-gradient-to-r from-[#0C3A30] to-[#1a5c4a] p-6 rounded-2xl mb-6 text-white">
            <p class="text-sm opacity-90 mb-2">User:</p>
            <p class="font-semibold text-lg mb-4" id="userName"></p>
            <p class="text-sm opacity-90 mb-2">Membership Code:</p>
            <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-lg p-4">
                <p class="font-mono text-3xl font-bold text-[#8AC304] text-center" id="generatedCode"></p>
            </div>
        </div>
        
        <div class="flex gap-3">
            <button onclick="copyToClipboard()" class="flex-1 bg-gradient-to-r from-[#8AC304] to-[#6ea003] text-white py-3 rounded-xl font-bold text-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                📋 Copy Code
            </button>
            <button onclick="closeMembershipModal()" class="flex-1 bg-gray-600 text-white py-3 rounded-xl font-bold text-lg hover:bg-gray-700 transition-all duration-300">
                Close
            </button>
        </div>
    </div>
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

async function generateMembershipCode(userId) {
    try {
        const response = await fetch('/admin/generate-membership-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ user_id: userId })
        });

        const data = await response.json();
        
        if (data.success) {
            document.getElementById('userName').textContent = data.user_name;
            document.getElementById('generatedCode').textContent = data.membership_code;
            document.getElementById('membershipModal').classList.remove('hidden');
            document.getElementById('membershipModal').classList.add('flex');
        } else {
            alert(data.message || 'Error generating membership code');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error generating membership code');
    }
}

function closeMembershipModal() {
    document.getElementById('membershipModal').classList.add('hidden');
    document.getElementById('membershipModal').classList.remove('flex');
    location.reload();
}

function copyToClipboard() {
    const code = document.getElementById('generatedCode').textContent;
    navigator.clipboard.writeText(code).then(() => {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '✓ Copied!';
        btn.classList.add('bg-green-600');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('bg-green-600');
        }, 2000);
    });
}

// Auto-close success messages
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
</script>

<style>
.table th, .table td {
    padding: 16px;
    vertical-align: middle;
}

.table thead tr {
    border-bottom: 2px solid #8AC304;
}

.card {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

@endsection