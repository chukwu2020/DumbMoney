@extends('layout.app')

@section('content')

<!-- Start Verify Email Page -->
<div class="verify-email-page py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="card border-0 shadow-lg radius-30 overflow-hidden">
                    
                    <!-- Card Header with Branding -->
                    <div class="card-header bg-[#0c3a30] text-white border-0 py-4">
                        <h3 class="text-center mb-0 fw-bold">
                            <i class="fas fa-envelope me-2"></i>Verify Your Email
                        </h3>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-5">
                        
                        <!-- Info / Warning -->
                        <div class="alert alert-info bg-info-soft border-0 text-center mb-4" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            We've sent a 6-digit verification code to your email address. 
                            <br class="d-none d-sm-block">
                            <small style="color: red !important;" class="text-muted">Please check your inbox and spam folder.</small>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('otp.submit') }}" id="otpForm">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <!-- Email Display with Icon -->
                            <div class="mb-4 text-center">
                                <div class="bg-light p-3 rounded-3">
                                    <i class="fas fa-envelope-open-text text-[#0c3a30] me-2"></i>
                                    <span class="fw-semibold text-muted">Verification code sent to:</span>
                                    <br>
                                    <strong class="text-[#0c3a30]" style="word-break: break-all;">{{ $email }}</strong>
                                </div>
                            </div>

                            <!-- OTP Input Field -->
                            <div class="mb-4">
                                <label for="otp" class="form-label fw-semibold text-muted mb-2">
                                    <i class="fas fa-key me-1 text-[#0c3a30]"></i>Enter 6-Digit OTP
                                </label>
                                <div class="otp-input-wrapper">
                                    <input type="text" 
                                           name="otp" 
                                           maxlength="6" 
                                           class="form-control form-control-lg text-center border-2" 
                                           style="border-color: #e0e0e0; font-size: 1.5rem; letter-spacing: 8px;"
                                           placeholder="______"
                                           required 
                                           autocomplete="off"
                                           inputmode="numeric"
                                           pattern="[0-9]*">
                                    <div class="form-text text-center mt-2">
                                        <i class="far fa-clock text-muted me-1"></i>
                                        Code expires in <span class="fw-bold text-[#0c3a30]" id="countdown">10:00</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success w-100 py-3 fw-bold mb-3" style="background-color: #0c3a30; border-color: #0c3a30;">
                                <i class="fas fa-check-circle me-2"></i>Verify Email
                            </button>
                        </form>

                        <!-- Resend Form -->
                        <form method="POST" action="{{ route('otp.resend') }}" class="text-center" id="resendForm">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mt-3">
                                <small class="text-muted d-block mb-2">Didn't receive the code?</small>
                                <button type="submit" class="btn btn-link text-decoration-none p-0" id="resendBtn">
                                    <span class="fw-semibold" style="color: #0c3a30;">
                                        <i class="fas fa-redo-alt me-1"></i>Resend Verification Code
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!-- Additional Help Link -->
                        <div class="text-center mt-4 pt-3 border-top">
                            <small class="text-muted">
                                <i class="fas fa-question-circle me-1"></i>
                                Having trouble? 
                                <a href="#" class="text-decoration-none" style="color: #0c3a30;">Contact Support</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Add this CSS for custom styling -->
<style>
.bg-info-soft {
    background-color: rgba(12, 58, 48, 0.05);
    color: #0c3a30;
}

.otp-input-wrapper input:focus {
    border-color: #0c3a30 !important;
    box-shadow: 0 0 0 0.25rem rgba(12, 58, 48, 0.1) !important;
}

.btn-success:hover {
    background-color: #0a3228 !important;
    border-color: #0a3228 !important;
    transform: translateY(-1px);
    transition: all 0.3s ease;
}

.btn-success {
    transition: all 0.3s ease;
}

.radius-30 {
    border-radius: 30px !important;
}
</style>

<!-- Optional: Add countdown timer JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown timer
    let timeLeft = 600; // 10 minutes in seconds
    const countdownEl = document.getElementById('countdown');
    
    function updateCountdown() {
        if (timeLeft > 0) {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            timeLeft--;
        } else {
            countdownEl.textContent = "Expired";
            countdownEl.style.color = "red";
        }
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
    
    // Auto-focus OTP input
    document.querySelector('input[name="otp"]').focus();
    
    // Auto-submit when 6 digits are entered
    const otpInput = document.querySelector('input[name="otp"]');
    otpInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length === 6) {
            document.getElementById('otpForm').submit();
        }
    });
});
</script>
<!-- End Verify Email Page -->

@endsection