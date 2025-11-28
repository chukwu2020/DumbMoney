@extends('layout.user')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    
    <!-- Premium Header -->
    <div class="px-4 py-4 md:px-6 bg-slate-800/50 backdrop-blur-xl border-b border-slate-700/50">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <i class="fas fa-chart-line text-white text-lg" style="color: white !important;"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-slate-900 animate-pulse"></div>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white font-inter">
                        Live Trading Active <span class="text-emerald-400">Pro</span>
                    </h1>
                    <p class="text-slate-400 text-sm font-medium">Live Trading Arena • Professional tools • Welcome, <span class="text-emerald-400">{{ auth()->user()->name }}</span></p>
                </div>
            </div>
        </div>
    </div>

    @php
        $hasApprovedDeposit = auth()->user()->hasApprovedDeposit();
        $hasActiveMembership = auth()->user()->hasActiveMembership();
        $userMembershipCode = auth()->user()->membership_code;
    @endphp

    @if(!$hasApprovedDeposit)
    <!-- Premium Access Gate -->
    <div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-2xl border border-slate-700/50 overflow-hidden">
        <div class="p-8 text-center">
            <!-- Video Display -->
            <div class="w-full bg-black rounded-xl overflow-hidden border-2 border-red-500/50 shadow-2xl shadow-red-500/20 relative">
                <div class="relative">
                    <!-- Live Recording Indicator (Single Red Dot) -->
                    <div class="absolute top-4 left-4 z-10">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                    </div>

                    <!-- Video Display -->
                    <div class="group relative">
                        <!-- Outer Glow (Optional hover effect) -->
                        <div class="absolute -inset-4 bg-gradient-to-r from-red-500/20 to-orange-500/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="relative bg-black rounded-2xl overflow-hidden border-2 border-red-500/40 shadow-2xl shadow-red-500/20 transform group-hover:scale-[1.02] transition-all duration-500">

                            <!-- Market Status -->
                            <div class="absolute top-6 right-6 z-20">
                                <div class="bg-gradient-to-r from-green-600 to-emerald-500 px-4 py-2 rounded-full shadow-lg shadow-green-500/30 border border-green-400/50 backdrop-blur-sm" style="background-color: white!important;">
                                    <span class="text-white text-sm font-semibold flex items-center gap-2" >
                                       <!-- Blinking Red Dot -->
<div class="w-2 h-2 bg-red-500 rounded-full animate-blink" style="background-color: red!important;"></div>

<!-- Add this CSS somewhere in your styles -->
<style>
@keyframes blink {
  0%, 50%, 100% { opacity: 1; }
  25%, 75% { opacity: 0; }
}
.animate-blink {
  animation: blink 1s infinite;
}
</style>

                                        MARKET LIVE
                                    </span>
                                </div>
                            </div>

                            <!-- Video Element -->
                            <div class="aspect-video bg-gradient-to-br from-slate-900 to-slate-800 flex items-center justify-center relative overflow-hidden">
                                <video 
                                    src="{{ asset('assets/images/livetradevideo.mp4') }}" 
                                    class="w-full h-full object-cover"
                                    autoplay
                                    muted
                                    loop
                                    onerror="this.style.display='none'; document.getElementById('fallback-content').style.display='flex';"
                                >
                                    Your browser does not support the video tag.
                                </video>

                                <!-- Premium Fallback Content -->
                                <div id="fallback-content" class="hidden absolute inset-0 flex items-center justify-center bg-gradient-to-br from-slate-900/95 to-slate-800/95 backdrop-blur-sm">
                                    <div class="text-center p-8 max-w-md">
                                        <div class="relative w-28 h-28 mx-auto mb-6">
                                            <div class="absolute inset-0 border-4 border-transparent border-t-red-500 border-r-orange-500 rounded-full animate-spin"></div>
                                            <div class="absolute inset-2 border-4 border-transparent border-b-orange-400 border-l-amber-400 rounded-full animate-spin-slow"></div>
                                            <div class="absolute inset-4 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-2xl shadow-red-500/30">
                                                <i class="fas fa-lock text-white text-3xl"></i>
                                            </div>
                                        </div>

                                        <h3 class="text-white text-2xl font-bold mb-3 bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">
                                            Premium Stream Locked
                                        </h3>
                                        <p class="text-slate-300 mb-6 leading-relaxed">
                                            Unlock real-time trading sessions, professional analysis, and live market data by funding your account
                                        </p>

                                        <!-- Status Indicators -->
                                        <div class="flex justify-center gap-3 mb-6">
                                            <div class="px-4 py-2 bg-slate-700/80 rounded-xl border border-slate-600/50 backdrop-blur-sm">
                                                <div class="text-slate-300 text-xs mb-1">Stream Status</div>
                                                <div class="text-white font-bold text-sm flex items-center gap-2">
                                                    <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                                                    OFFLINE
                                                </div>
                                            </div>
                                            <div class="px-4 py-2 bg-amber-500/20 rounded-xl border border-amber-500/30 backdrop-blur-sm">
                                                <div class="text-amber-400 text-xs mb-1">Access Level</div>
                                                <div class="text-white font-bold text-sm">PREMIUM</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Bar -->
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/95 via-black/80 to-transparent p-1 backdrop-blur-sm border-t border-slate-700/50">
                                <div class="flex items-center justify-between flex-wrap gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center gap-3">
                                            <div class="relative flex items-center gap-2">
                                                <div class="relative w-3 h-3">
                                                    <div class="absolute inset-0 bg-red-500 rounded-full animate-ping"></div>
                                                    <div class="relative w-3 h-3 bg-red-500 rounded-full"></div>
                                                </div>
                                                <span class="text-white font-semibold text-sm"  style="color:white!important;">Live Session Active</span>
                                            </div>
                                            <div class="h-4 w-px bg-slate-600"></div>
                                            <span class="text-slate-300 text-sm" style="color:white!important;">4K Broadcast</span>
                                        </div>
                                    </div>

                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lock Icon & CTA -->
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                    <i class="fas fa-lock-open text-white text-2xl" style="color: red !important;"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-3 font-inter">Join Trading Arena</h2>
                <p class="text-slate-400 mb-8">Make your first deposit to access live trading features</p>

                <!-- Steps -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-6">
                    <div class="text-center group" style="border-bottom: 1px solid #065f46 ;  border-radius:6px">
                        <div class="w-12 h-12 mx-auto mb-3 bg-slate-700 rounded-xl flex items-center justify-center group-hover:bg-amber-500/20 transition-colors">
                            <span class="text-amber-500 text-lg font-bold" style="color: #065f46 !important;">1</span>
                        </div>
                        <p class="text-white font-medium text-sm">Fund Account</p>
                        <p class="text-slate-500 text-xs mt-1">Secure deposit</p>
                    </div>
                    <div class="text-center group" style="border-bottom: 1px solid #065f46 ;  border-radius:6px" >
                        <div class="w-12 h-12 mx-auto mb-3 bg-slate-700 rounded-xl flex items-center justify-center group-hover:bg-amber-500/20 transition-colors">
                            <span class="text-amber-500 text-lg font-bold" style="color: #065f46 !important; ">2</span>
                        </div>
                        <p class="text-white font-medium text-sm">Get Approved</p>
                        <p class="text-slate-500 text-xs mt-1">Instant verification and get your membership live code</p>
                    </div>
                    <div class="text-center group"  style="border-bottom: 1px solid #065f46 ;  border-radius:6px">
                        <div class="w-12 h-12 mx-auto mb-3 bg-slate-700 rounded-xl flex items-center justify-center group-hover:bg-amber-500/20 transition-colors">
                            <span class="text-amber-500 text-lg font-bold" style="color: #065f46 !important; border-radius:6px">3</span>
                        </div>
                        <p class="text-white font-medium text-sm">Start Trading</p>
                        <p class="text-slate-500 text-xs mt-1">Live markets access</p>
                    </div>
                </div>

                <!-- Deposit CTA -->
           <a href="{{ route('user.deposit') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl font-bold hover:shadow-lg hover:shadow-amber-500/25 transition-all duration-300 transform hover:scale-105">
    <!-- Blinking Rocket -->
    <i class="fas fa-rocket text-red-500 animate-blink"></i>
    Start Trading Journey
</a>

<!-- Add this CSS somewhere in your styles -->
<style>
@keyframes blink {
  0%, 50%, 100% { opacity: 1; }
  25%, 75% { opacity: 0; }
}
.animate-blink {
  animation: blink 1s infinite;
}
</style>

            </div>
        </div>
    </div>
</div>

    @elseif($hasApprovedDeposit && !$hasActiveMembership)
<div class="max-w-md mx-auto px-4 py-8">
    @php
        $user = auth()->user();
        $hasApprovedDeposit = $user->deposits()->where('status', 1)->exists();
        $depositStatus = $hasApprovedDeposit ? 'approved' : 'pending';
    @endphp

    <div class="bg-gradient-to-br from-slate-900 via-purple-900/30 to-slate-900 rounded-3xl shadow-2xl border-2 border-purple-500/40 overflow-hidden relative">
        <!-- Enhanced Crypto Background Effects -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-600/10 via-cyan-500/10 to-blue-600/10"></div>
        
        <!-- Animated Border Glow -->
        <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 via-cyan-500 to-blue-600 rounded-3xl blur-lg opacity-30 animate-pulse"></div>
        
        <!-- Premium Header Bar -->
        <div class="relative h-2 bg-gradient-to-r from-purple-600 via-cyan-500 to-blue-600 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-transparent shimmer-animation"></div>
        </div>
        
        <!-- Animated Crypto Particles -->
        <div class="absolute top-6 right-6 w-3 h-3 bg-cyan-400 rounded-full animate-pulse shadow-lg shadow-cyan-400/50"></div>
        <div class="absolute bottom-6 left-6 w-2 h-2 bg-purple-400 rounded-full animate-ping" style="animation-delay: 0.3s"></div>
        <div class="absolute top-1/2 left-1/4 w-1 h-1 bg-blue-400 rounded-full animate-bounce"></div>
        
        <div class="p-8 text-center relative z-10">
            <!-- Enhanced Crypto Icon with Glow -->
            <div class="relative w-24 h-24 mx-auto mb-8">
                <div class="absolute -inset-4 bg-cyan-500/20 rounded-full blur-xl animate-pulse"></div>
                <div class="relative w-24 h-24 bg-gradient-to-br from-purple-600 to-cyan-500 rounded-2xl flex items-center justify-center shadow-2xl shadow-purple-500/40">
                    
                </div>
                <!-- Floating Ring -->
                <div class="absolute -inset-2 border-2 border-cyan-400/30 rounded-2xl animate-spin-slow"></div>
            </div>
            
            <!-- Enhanced Crypto Steps Container -->
            <div class="bg-slate-800/70 rounded-2xl p-6 mb-8 border-2 border-purple-500/30 backdrop-blur-sm relative">
                <!-- Background Pattern -->
                <div class="absolute inset-0 rounded-2xl opacity-5">
                    <div class="absolute inset-0" style="
                        background-image: 
                            radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.3) 0%, transparent 50%),
                            radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.3) 0%, transparent 50%);
                    "></div>
                </div>
                
                <h3 class="relative text-white font-bold mb-6 text-sm uppercase tracking-widest text-cyan-400">
                    🔒 ACTIVATION PROCESS
                </h3>
                <div class="relative space-y-4">
                    <!-- Step 1: Deposit Status -->
                    <div class="flex items-center gap-4 p-4 rounded-2xl border-2 backdrop-blur-sm transform hover:scale-105 transition-transform duration-300"
                         style="background: linear-gradient(to right, #8bc90515, #065f4610); border-color: #8bc90540;">
                        <div class="relative">
                            <div class="absolute -inset-2" style="background: #8bc905; border-radius: 9999px; filter: blur(8px); opacity: 0.4;"></div>
                            <div class="relative w-10 h-10 rounded-full flex items-center justify-center text-sm text-white shadow-2xl"
                                 style="background: #8bc905; box-shadow: 0 25px 50px -12px rgba(139, 201, 5, 0.4);">
                                <i class="fas 
                                    @if($hasApprovedDeposit) 
                                        fa-check 
                                    @else 
                                        fa-clock 
                                    @endif"></i>
                            </div>
                        </div>
                        <div class="text-left flex-1">
                            <span class="text-white text-sm font-bold">DEPOSIT STATUS</span>
                            <p class="text-xs font-semibold" style="color: #8bc905;">
                                @if($hasApprovedDeposit)
                                    ✅ VERIFIED & APPROVED
                                @else
                                    ⏳ AWAITING APPROVAL
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Step 2: Code Generated -->
                    <div class="flex items-center gap-4 p-4 rounded-2xl border-2 backdrop-blur-sm transform hover:scale-105 transition-transform duration-300"
                         style="background: linear-gradient(to right, #8bc90515, #065f4610); border-color: #8bc90540;">
                        <div class="relative">
                            <div class="absolute -inset-2" style="background: #8bc905; border-radius: 9999px; filter: blur(8px); opacity: 0.4;"></div>
                            <div class="relative w-10 h-10 rounded-full flex items-center justify-center text-sm text-white shadow-2xl"
                                 style="background: #8bc905; box-shadow: 0 25px 50px -12px rgba(139, 201, 5, 0.4);">
                                <i class="fas fa-barcode"></i>
                            </div>
                        </div>
                        <div class="text-left flex-1">
                            <span class="text-white text-sm font-bold">CODE GENERATED</span>
                            <p class="text-xs font-semibold" style="color: #8bc905;">UNIQUE ACCESS</p>
                        </div>
                    </div>
                    
                    <!-- Step 3: Enter Code -->
                    <div class="flex items-center gap-4 p-4 rounded-2xl border-2 backdrop-blur-sm transform scale-105 shadow-2xl"
                         style="background: linear-gradient(to right, #8bc90520, #065f4615); border-color: #8bc90550; box-shadow: 0 25px 50px -12px rgba(139, 201, 5, 0.2);">
                        <div class="relative">
                            <div class="absolute -inset-2" style="background: #8bc905; border-radius: 9999px; filter: blur(8px); opacity: 0.5; animation: pulse 2s infinite;"></div>
                            <div class="relative w-10 h-10 rounded-full flex items-center justify-center text-sm text-white shadow-2xl"
                                 style="background: linear-gradient(to bottom right, #8bc905, #065f46); box-shadow: 0 25px 50px -12px rgba(139, 201, 5, 0.4);">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <div class="text-left flex-1">
                            <span class="text-white text-sm font-bold">ENTER CODE</span>
                            <p class="text-xs font-semibold" style="color: #8bc905;">ACTIVATE TRADING FEATURES</p>
                        </div>
                        <div class="w-3 h-3 rounded-full animate-ping shadow-lg" style="background: #8bc905; box-shadow: 0 0 20px rgba(139, 201, 5, 0.5);"></div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Crypto Code Input -->
            <div class="bg-slate-800/50 rounded-2xl p-6 border-2 border-purple-500/30 backdrop-blur-sm relative">
                <!-- Background Pattern -->
                <div class="absolute inset-0 rounded-2xl opacity-5">
                    <div class="absolute inset-0" style="
                        background-image: linear-gradient(45deg, transparent 48%, rgba(139, 92, 246, 0.1) 50%, transparent 52%);
                        background-size: 20px 20px;
                    "></div>
                </div>
                
                <h4 class="relative text-white font-bold mb-4 text-sm uppercase tracking-widest text-cyan-400">
                    🔑 ENTER ACCESS CODE
                </h4>
                
                <div class="relative mb-6">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-cyan-500 rounded-2xl blur opacity-30 group-hover:opacity-50 transition-opacity duration-300"></div>
                    <input 
                        type="text" 
                        id="membership_code"
                        placeholder="VIP-CRYPTO-XXXX"
                        class="relative w-full px-6 py-5 rounded-2xl bg-slate-800/80 text-white font-mono text-center border-2 
                            @if($hasApprovedDeposit) 
                                border-cyan-500 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/30
                            @else 
                                border-slate-600 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/30
                            @endif 
                        transition-all duration-300 text-lg tracking-widest font-bold backdrop-blur-sm"
                        maxlength="20"
                        value="{{ $user->membership_code ?? '' }}"
                        @if(!$hasApprovedDeposit) disabled @endif
                    />
                </div>
                
                @if($hasApprovedDeposit)
                <button 
                    onclick="activateMembership()"
                    class="group relative w-full px-10 py-5 text-white rounded-2xl font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden border-2"
                    style="background: linear-gradient(to right, #8bc905, #065f46); border-color: #8bc90530; box-shadow: 0 25px 50px -12px rgba(139, 201, 5, 0.4);"
                >
                    <!-- Animated Shine Effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    
                    <!-- Button Content -->
                    <div class="relative flex items-center justify-center gap-3" style="border: 1px solid #8bc905; padding: 3px; border-radius: 8px;">
                        <span class="tracking-wider" style="color: white;">JOIN LIVE ARENA</span> 
                        <i class="fas fa-rocket text-white transform group-hover:translate-x-1 transition-transform duration-300"></i>
                    </div>
                </button>
                @else
                <button 
                    class="w-full px-10 py-5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-2xl font-bold text-lg border-2 border-amber-400/30 opacity-60 cursor-not-allowed shadow-lg"
                    disabled
                >
                    <div class="flex items-center justify-center gap-3">
                        <i class="fas fa-lock"></i>
                        <span class="tracking-wider">WAITING FOR DEPOSIT APPROVAL</span>
                        <i class="fas fa-clock"></i>
                    </div>
                </button>
                @endif
            </div>

            <!-- Enhanced Crypto Footer -->
            <div class="mt-8 text-center">
                <p class="text-slate-400 text-sm flex items-center justify-center gap-3 font-semibold">
                    <i class="fas fa-shield-alt text-cyan-400/70 text-lg"></i>
                    SECURE BLOCKCHAIN VERIFICATION
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes spin-slow {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(-360deg); }
}

.shimmer-animation {
    animation: shimmer 3s infinite;
}

.animate-spin-slow {
    animation: spin-slow 8s linear infinite;
}

/* Enhanced focus states */
#membership_code:focus {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px -10px rgba(6, 182, 212, 0.4);
}

/* Smooth transitions */
button, input, .transform {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

<script>
function activateMembership() {
    const code = document.getElementById('membership_code').value.trim();
    
    if (!code) {
        const input = document.getElementById('membership_code');
        input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/30');
        input.placeholder = "⚠️ PLEASE ENTER YOUR MEMBERSHIP CODE";
        return;
    }
    
    const button = document.querySelector('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i> ACTIVATING CRYPTO ACCESS...';
    button.disabled = true;
    
    fetch("/activate-membership", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            membership_code: code
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message);
            button.innerHTML = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        alert('❌ NETWORK ERROR. PLEASE TRY AGAIN.');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

document.getElementById('membership_code')?.addEventListener('input', function(e) {
    this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500/30');
});
</script>
    @else
    <!-- Premium Trading Dashboard -->
    <div class="px-4 py-6 max-w-7xl mx-auto">
        
        <!-- Performance Metrics -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-slate-800/60 rounded-xl p-4 border border-slate-700/50 backdrop-blur-sm">
                <p class="text-slate-400 text-xs uppercase tracking-wider mb-1">Portfolio Value</p>
               
                <p class="text-3xl font-black text-emerald-400 font-mono mt-2">
                        ${{ number_format(auth()->user()->available_balance ?? 0, 2) }}
                    </p>
                <div class="flex items-center gap-2 mt-1">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse" style="background-color: #10b981 !important;"></div>
                    <p class="text-slate-400 text-xs">Live</p>
                </div>
            </div>
            <div class="bg-slate-800/40 rounded-xl p-4 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-slate-400 text-xs uppercase tracking-wider">Active Sessions</span>
                    <i class="fas fa-users text-cyan-400 text-sm" style="color: #22d3ee !important;"></i>
                </div>
                <p id="active_sessions" class="text-2xl font-bold text-white font-mono">25</p>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fas fa-arrow-up text-emerald-400 text-xs" style="color: #10b981 !important;"></i>
                    <span class="text-emerald-400 text-xs" style="color: #10b981 !important;">+2.4%</span>
                </div>
            </div>
            <div class="bg-slate-800/40 rounded-xl p-4 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-slate-400 text-xs uppercase tracking-wider">Online Traders</span>
                    <i class="fas fa-signal text-blue-400 text-sm" style="color: #60a5fa !important;"></i>
                </div>
                <p id="online_traders" class="text-2xl font-bold text-white font-mono">172</p>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fas fa-arrow-up text-emerald-400 text-xs" style="color: #10b981 !important;"></i>
                    <span class="text-emerald-400 text-xs" style="color: #10b981 !important;">+2.2%</span>
                </div>
            </div>
            <div class="bg-slate-800/40 rounded-xl p-4 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-slate-400 text-xs uppercase tracking-wider">24h Volume</span>
                    <i class="fas fa-chart-bar text-amber-400 text-sm" style="color: #f59e0b !important;"></i>
                </div>
                <p id="daily_volume" class="text-2xl font-bold text-white font-mono">$12.8M</p>
                <div class="flex items-center gap-1 mt-1">
                    <i class="fas fa-arrow-up text-emerald-400 text-xs" style="color: #10b981 !important;"></i>
                    <span class="text-emerald-400 text-xs" style="color: #10b981 !important;">+3.8%</span>
                </div>
            </div>
        </div>

        <!-- Trading Terminal -->
        <div class="grid grid-cols-1 gap-6">
            <!-- Important Notice Section -->
            <div class="bg-gradient-to-r from-red-500/10 to-orange-500/10 rounded-2xl p-1 border border-red-500/20 backdrop-blur-sm">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-white text-xl" style="color: white !important;"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-xl" style="color: #dc2626 !important;">ATTENTION REQUIRED</h3>
                        <p class="text-red-400">Important Notification Regarding Live Trading Access</p>
                    </div>
                </div>
                
                <div class="bg-slate-800/50 rounded-xl p-1 border border-slate-700/50">
                    <div class="text-center mb-6">
                        <h4 class="text-white text-lg font-bold mb-2">Hello {{ auth()->user()->name }},</h4>
                        <p class="text-slate-300 text-lg leading-relaxed">
                            You are currently not eligible to view the live trading stream. 
                            Contact your trader or support for authorization.
                        </p>
                    </div>

                    <!-- Video Display -->
                    <div class="w-full bg-black rounded-xl overflow-hidden border-2 border-red-500/50 shadow-2xl shadow-red-500/20 relative">
                        <div class="relative">
                            <!-- Live Recording Indicator -->
                            <div class="absolute top-4 left-4 z-10 flex items-center gap-2 bg-red-500/90 px-3 py-1 rounded-full">
                                <div class="w-2 h-2 bg-white rounded-full animate-pulse" style="background-color: white !important;"></div>
                                <span class="text-white text-xs font-bold" style="color: white !important;">LIVE</span>
                            </div>
                            
                            <!-- Video Display -->
                            <div class="aspect-video bg-gradient-to-br from-slate-1000 to-slate-900 flex items-center justify-center relative overflow-hidden">
                                <!-- Video element -->
                                <video 
                                    src="{{ asset('assets/images/livetradevideo.mp4') }}" 
                                    class="w-full h-full object-cover"
                                    autoplay
                                    muted
                                    loop
                                    onerror="this.style.display='none'; document.getElementById('fallback-content').style.display='flex';"
                                >
                                    Your browser does not support the video tag.
                                </video>
                                
                                <!-- Fallback Content -->
                                <div id="fallback-content" class="hidden absolute inset-0 flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-800">
                                    <div class="text-center p-8">
                                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-red-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg shadow-red-500/20">
                                            <i class="fas fa-lock text-white text-2xl" style="color: white !important;"></i>
                                        </div>
                                        <h3 class="text-white text-xl font-bold mb-2">Live Trading Stream</h3>
                                        <p class="text-slate-400">Access restricted - Contact support for authorization</p>
                                        <div class="mt-4 flex justify-center gap-3">
                                            <div class="px-4 py-2 bg-slate-700 rounded-lg text-slate-300 text-sm">
                                                <i class="fas fa-video mr-2" style="color: #cbd5e1 !important;"></i>Stream Offline
                                            </div>
                                            <div class="px-4 py-2 bg-red-500/20 rounded-lg text-red-400 text-sm">
                                                <i class="fas fa-shield-alt mr-2" style="color: #f87171 !important;"></i>Authorization Required
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Bar -->
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse" style="background-color: #ef4444 !important;"></div>
                                        <span class="text-white text-sm font-medium">Live Trading Session</span>
                                    </div>
                                    <div class="text-slate-300 text-sm">
                                        <i class="fas fa-clock mr-1" style="color: #cbd5e1 !important;"></i>
                                        <span id="stream-timer">00:00:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <button class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-4 rounded-xl font-bold hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-headset mr-2" style="color: white !important;"></i>
                            Contact Support Team
                        </button>
                        <button onclick="window.open('https://wa.me/YOUR_WHATSAPP_NUMBER', '_blank')" class="w-full bg-gradient-to-r from-emerald-500 to-green-500 text-white py-4 rounded-xl font-bold hover:shadow-lg hover:shadow-emerald-500/25 transition-all duration-300 transform hover:scale-105">
                            <i class="fab fa-whatsapp mr-2" style="color: white !important;"></i>
                            Message Your Trader
                        </button>
                    </div>
                </div>
            </div>

            <!-- Live Chat -->
            <div class="bg-slate-800/30 rounded-2xl p-6 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-comments text-cyan-400" style="color: #22d3ee !important;"></i>
                        Trading Chat
                    </h3>
                    <div class="flex items-center gap-2 text-emerald-400 text-sm">
                        <i class="fas fa-circle animate-pulse" style="color: #10b981 !important;"></i>
                        <span id="online-count">856</span> Online
                    </div>
                </div>
                <div id="chat_messages" class="bg-slate-900/50 rounded-xl h-64 p-4 mb-4 overflow-y-auto border border-slate-700/50">
                    <div class="text-center py-8">
                        <i class="fas fa-comment-dots text-slate-600 text-2xl mb-2" style="color: #475569 !important;"></i>
                        <p class="text-slate-400 text-sm">Live trading chat loading...</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <input 
                        type="text" 
                        id="chat_input"
                        placeholder="Connect with the trading community..." 
                        class="flex-1 bg-slate-800/50 text-white rounded-xl px-4 py-3 border border-slate-600 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/20 transition-all"
                    >
                    <button onclick="sendMessage()" class="px-6 bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-cyan-500/25 transition-all transform hover:scale-105">
                        <i class="fas fa-paper-plane" style="color:#10b981 !important; font:600;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
            <!-- Active Traders -->
            <div class="bg-slate-800/30 rounded-2xl p-6 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-users text-purple-400" style="color: #a855f7 !important;"></i>
                        Active Traders
                    </h3>
                    <div class="text-slate-400 text-sm">Real-time</div>
                </div>
                <div id="active_traders" class="space-y-3 max-h-96 overflow-y-auto pr-2">
                    <!-- Traders populated by JS -->
                </div>
            </div>

            <!-- Trading Stats -->
            <div class="bg-slate-800/30 rounded-2xl p-6 border border-slate-700/50 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-bold text-lg flex items-center gap-2">
                        <i class="fas fa-trophy text-amber-400" style="color: #f59e0b !important;"></i>
                        Performance
                    </h3>
                    <div class="text-emerald-400 text-sm" style="color: #10b981 !important;">Today</div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Win Rate</span>
                        <span class="text-emerald-400 font-bold" style="color: #10b981 !important;">78.3%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Total Trades</span>
                        <span class="text-white font-bold">24</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Profit/Loss</span>
                        <span class="text-emerald-400 font-bold" style="color: #10b981 !important;">+$284</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400">Success Streak</span>
                        <span class="text-emerald-400 font-bold" style="color: #10b981 !important;">8 trades</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
// Enhanced DOM caching
const domCache = {
    activeSessions: document.getElementById('active_sessions'),
    onlineTraders: document.getElementById('online_traders'),
    dailyVolume: document.getElementById('daily_volume'),
    activeTraders: document.getElementById('active_traders'),
    chatMessages: document.getElementById('chat_messages'),
    chatInput: document.getElementById('chat_input'),
    onlineCount: document.getElementById('online-count'),
    streamTimer: document.getElementById('stream-timer')
};

// Realistic market state with proper numbers
const marketState = {
    baseStats: {
        activeSessions: 25,
        onlineTraders: 856,
        dailyVolume: 12.8,
        onlineCount: 856
    },
    targets: {
        activeSessions: 25,
        onlineTraders: 856,
        dailyVolume: 12.8,
        onlineCount: 856
    },
    streamTime: 0,
    lastUpdate: Date.now()
};

// Enhanced traders data
const tradersCache = {
    names: [
        'CryptoKing', 'TraderPro', 'DiamondHands', 'MoonShot', 'BitcoinBull', 
        'EthereumWhale', 'StockGuru', 'ForexMaster', 'CryptoQueen', 'DayTrader',
        'ProfitHunter', 'MarketWizard', 'AlphaTrader', 'QuantMaster', 'SwingPro'
    ],
    lastUpdate: 0,
    updateInterval: 10000 // 10 seconds
};

// Enhanced chat system with professional messages (no emojis)
const chatCache = {
    messages: [
        'Bitcoin breaking resistance at $45k. Next target $48k.',
        'Just caught a 2.5% move on Ethereum. Perfect entry point.',
        'Market volatility creating good opportunities today.',
        'Risk management paying off - stopped out with minimal loss.',
        'Institutional flow is noticeable in today session.',
        'Secured 4.2% returns on my portfolio this week.',
        'Technical analysis working well on this breakout pattern.',
        'Dip buyers showing strength in current market conditions.',
        'Market sentiment shifting bullish across timeframes.',
        'Another profitable trade using the 15min chart strategy.',
        'Liquidity flowing into altcoins with good momentum.',
        'Perfect risk-reward setup on that last trade execution.',
        'Market makers creating interesting patterns today.',
        'Volume confirming the breakout pattern validity.',
        'Support holding strong on the daily timeframe.',
        'Resistance level tested multiple times now.',
        'Momentum indicators showing positive divergence.',
        'Order book depth looking healthy for continuation.',
        'Fibonacci levels providing accurate targets.',
        'Market structure remains intact despite volatility.'
    ],
    lastMessage: 0
};

// Smooth number counting animation
function animateNumber(element, target, duration = 5000) { // Slower animation
    const start = parseFloat(element.textContent.replace(/[^0-9.-]+/g, ""));
    const startTime = performance.now();
    
    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        const current = start + (target - start) * progress;
        
        if (element.id === 'daily_volume') {
            element.textContent = `$${current.toFixed(1)}M`;
        } else {
            element.textContent = Math.floor(current).toLocaleString();
        }
        
        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }
    
    requestAnimationFrame(update);
}

// Update stats with realistic gradual fluctuations
function updateStats() {
    const now = Date.now();
    
    // Only update every 5 seconds for more realistic feel
    if (now - marketState.lastUpdate < 5000) return;
    
    marketState.lastUpdate = now;
    
    // Generate new realistic targets with very small, gradual movements
    marketState.targets.activeSessions = Math.max(15, Math.min(50, 
        marketState.targets.activeSessions + (Math.random() - 0.5) * 2 // Much smaller increments
    ));
    
    marketState.targets.onlineTraders = Math.max(200, Math.min(1500, 
        marketState.targets.onlineTraders + (Math.random() - 0.5) * 20 // Smaller increments
    ));
    
    marketState.targets.dailyVolume = Math.max(8.5, Math.min(18.2, 
        marketState.targets.dailyVolume + (Math.random() - 0.5) * 0.3 // Smaller increments
    ));
    
    marketState.targets.onlineCount = Math.max(200, Math.min(1500, 
        marketState.targets.onlineCount + (Math.random() - 0.5) * 20 // Smaller increments
    ));
    
    // Animate to new targets with slower animation
    animateNumber(domCache.activeSessions, marketState.targets.activeSessions, 5000);
    animateNumber(domCache.onlineTraders, marketState.targets.onlineTraders, 5000);
    animateNumber(domCache.dailyVolume, marketState.targets.dailyVolume, 5000);
    animateNumber(domCache.onlineCount, marketState.targets.onlineCount, 5000);
    
    // Update base stats
    marketState.baseStats.activeSessions = marketState.targets.activeSessions;
    marketState.baseStats.onlineTraders = marketState.targets.onlineTraders;
    marketState.baseStats.dailyVolume = marketState.targets.dailyVolume;
    marketState.baseStats.onlineCount = marketState.targets.onlineCount;
}

// Enhanced traders with realistic profit ranges and proper colors using inline styles
function updateActiveTraders() {
    const now = Date.now();
    if (now - tradersCache.lastUpdate < tradersCache.updateInterval) return;
    
    tradersCache.lastUpdate = now;
    let html = '';
    
    const activeCount = 4 + Math.floor(Math.random() * 3);
    const shuffledTraders = [...tradersCache.names].sort(() => 0.5 - Math.random()).slice(0, activeCount);
    
    shuffledTraders.forEach(trader => {
        const profit = (Math.random() * 400 + 50).toFixed(0); // Max $450
        const isPositive = Math.random() > 0.3; // 70% positive, 30% negative
        const tradingPair = ['BTC/USD', 'ETH/USD', 'BNB/USD', 'SOL/USD', 'XRP/USD', 'ADA/USD'][Math.floor(Math.random() * 6)];
        const status = Math.random() > 0.7 ? 'Pro Trader' : 'Active Trader';
        
        // Inline styles for color importance
        const profitColor = isPositive ? 'color: #10b981 !important;' : 'color: #ef4444 !important;';
        const dotColor = isPositive ? 'background-color: #10b981 !important;' : 'background-color: #ef4444 !important;';
        const statusColor = status === 'Pro Trader' ? 'from-emerald-500 to-green-500' : 'from-purple-500 to-pink-500';
        const statusBg = status === 'Pro Trader' ? 'background-color: rgba(16, 185, 129, 0.2) !important; color: #10b981 !important;' : 'background-color: rgba(168, 85, 247, 0.2) !important; color: #a855f7 !important;';
        
        html += `
            <div class="flex items-center gap-3 p-3 bg-slate-800/50 rounded-xl border border-slate-700/30 hover:border-slate-600/50 transition-all duration-300">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br ${statusColor} rounded-xl flex items-center justify-center text-white text-sm font-bold">
                        ${trader[0]}
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border-2 border-slate-800" style="${dotColor}"></div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <p class="text-white font-medium text-sm">${trader}</p>
                        <span class="px-2 py-1 rounded-lg text-xs font-medium" style="${statusBg}">${status}</span>
                    </div>
                    <p class="text-slate-400 text-xs">Trading ${tradingPair}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-sm font-mono" style="${profitColor}">
                        ${isPositive ? '+' : '-'}$${profit}
                    </p>
                    <div class="w-2 h-2 rounded-full animate-pulse" style="${dotColor}"></div>
                </div>
            </div>
        `;
    });
    
    domCache.activeTraders.innerHTML = html;
}

// Enhanced chat with professional messages (no emojis)
function addRandomChatMessage() {
    const now = Date.now();
    if (now - chatCache.lastMessage < 5000 + Math.random() * 5000) return; // Slower chat updates
    
    chatCache.lastMessage = now;
    const randomUser = tradersCache.names[Math.floor(Math.random() * tradersCache.names.length)];
    const randomMessage = chatCache.messages[Math.floor(Math.random() * chatCache.messages.length)];
    const isPro = Math.random() > 0.7;
    
    const messageElement = document.createElement('div');
    messageElement.className = 'mb-3 animate-fade-in';
    messageElement.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="relative">
                <div class="w-8 h-8 ${isPro ? 'bg-gradient-to-br from-emerald-500 to-green-500' : 'bg-slate-700'} rounded-lg flex items-center justify-center text-xs text-white font-bold">
                    ${randomUser[0]}
                </div>
                ${isPro ? '<div class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-400 rounded-full border border-slate-800" style="background-color: #10b981 !important;"></div>' : ''}
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <p class="text-white font-medium text-sm">${randomUser}</p>
                    ${isPro ? '<span class="px-1.5 py-0.5 bg-emerald-500/20 text-emerald-400 rounded text-xs" style="background-color: rgba(16, 185, 129, 0.2) !important; color: #10b981 !important;">PRO</span>' : ''}
                    <span class="text-slate-500 text-xs">Just now</span>
                </div>
                <p class="text-slate-300 text-sm">${randomMessage}</p>
            </div>
        </div>
    `;
    
    domCache.chatMessages.appendChild(messageElement);
    
    // Limit messages and auto-scroll
    if (domCache.chatMessages.children.length > 10) {
        domCache.chatMessages.removeChild(domCache.chatMessages.firstChild);
    }
    domCache.chatMessages.scrollTop = domCache.chatMessages.scrollHeight;
}

// Stream timer update
function updateStreamTimer() {
    marketState.streamTime++;
    const hours = Math.floor(marketState.streamTime / 3600);
    const minutes = Math.floor((marketState.streamTime % 3600) / 60);
    const seconds = marketState.streamTime % 60;
    
    if (domCache.streamTimer) {
        domCache.streamTimer.textContent = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }
}

// Enhanced initialization with realistic updates
document.addEventListener('DOMContentLoaded', function() {
    @if($hasActiveMembership)
    // Initial data load
    updateActiveTraders();
    updateStats();
    
    // Set up efficient intervals with realistic updates
    setInterval(() => {
        updateActiveTraders();
        updateStats();
        addRandomChatMessage();
        updateStreamTimer();
    }, 5000); // Update every 5 seconds instead of continuous
    
    // Load initial chat messages
    for (let i = 0; i < 6; i++) {
        setTimeout(addRandomChatMessage, i * 2000);
    }
    
    // Start stream timer
    setInterval(updateStreamTimer, 1000);
    @endif
});

// Membership activation function
async function activateMembership() {
    const codeInput = document.getElementById('membership_code');
    const code = codeInput.value.trim();
    
    if (!code) {
        showNotification('Please enter your membership code', 'warning');
        return;
    }

    try {
        const response = await fetch('{{ route("user.activate.membership") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ membership_code: code })
        });

        const data = await response.json();
        showNotification(data.message, data.success ? 'success' : 'error');
        
        if (data.success) {
            setTimeout(() => location.reload(), 1500);
        }
    } catch (error) {
        console.error('Activation error:', error);
        showNotification('Error activating membership', 'error');
    }
}

// Chat function
async function sendMessage() {
    const input = domCache.chatInput;
    const message = input.value.trim();
    
    if (!message) return;
    
    try {
        const response = await fetch('{{ route("live.trading.message") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });

        const data = await response.json();
        
        if (data.success) {
            input.value = '';
            // Add user's message to chat
            const messageElement = document.createElement('div');
            messageElement.className = 'mb-3';
            messageElement.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center text-xs text-white font-bold">
                        Y
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <p class="text-cyan-400 font-medium text-sm" style="color: #22d3ee !important;">You</p>
                            <span class="text-slate-500 text-xs">Just now</span>
                        </div>
                        <p class="text-white text-sm">${message}</p>
                    </div>
                </div>
            `;
            domCache.chatMessages.appendChild(messageElement);
            domCache.chatMessages.scrollTop = domCache.chatMessages.scrollHeight;
        }
    } catch (error) {
        console.error('Chat error:', error);
    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

.font-inter {
    font-family: 'Inter', sans-serif;
}

/* Enhanced scrollbar */
#active_traders::-webkit-scrollbar,
#chat_messages::-webkit-scrollbar {
    width: 6px;
}

#active_traders::-webkit-scrollbar-track,
#chat_messages::-webkit-scrollbar-track {
    background: rgba(30, 41, 59, 0.3);
    border-radius: 3px;
}

#active_traders::-webkit-scrollbar-thumb,
#chat_messages::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #10b981, #059669);
    border-radius: 3px;
}

#active_traders::-webkit-scrollbar-thumb:hover,
#chat_messages::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #34d399, #10b981);
}

/* Enhanced animations */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

/* Enhanced glass morphism */
.backdrop-blur-sm {
    backdrop-filter: blur(12px);
}

.backdrop-blur-xl {
    backdrop-filter: blur(24px);
}

/* Live recording indicator */
.live-indicator {
    background: linear-gradient(45deg, #ef4444, #dc2626);
    box-shadow: 0 0 20px rgba(239, 68, 68, 0.4);
}

/* Ensure video displays properly */
.aspect-video video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

@endsection