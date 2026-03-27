{{-- resources/views/auth/registration-complete.blade.php --}}
@extends('layout.app')

@section('content')

<style>
    .complete-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .complete-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 50px 40px;
        text-align: center;
        max-width: 550px;
        margin: 0 auto;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(139, 201, 5, 0.1);
    }

    .complete-card::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 201, 5, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .complete-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(12, 58, 48, 0.05) 0%, transparent 70%);
        pointer-events: none;
    }

    .success-icon {
        width: 120px;
        height: 120px;
        background: #8bc905;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 60px;
        color: white;
        box-shadow: 0 10px 30px rgba(139, 201, 5, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 10px 30px rgba(139, 201, 5, 0.3); transform: scale(1); }
        50% { box-shadow: 0 20px 50px rgba(139, 201, 5, 0.5); transform: scale(1.05); }
        100% { box-shadow: 0 10px 30px rgba(139, 201, 5, 0.3); transform: scale(1); }
    }

    .complete-card h2 {
        color: #0C3A30;
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }
.breadcrumb-item::after,
.breadcrumb-item::before,
.breadcrumb li::after,
.breadcrumb li::before {
    content: none !important;
    display: none !important;
}
    .complete-card p {
        color: #4A5C5A;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .login-btn {
        background: #8bc905;
        color: white;
        border: none;
        padding: 16px 40px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-decoration: none;
        box-shadow: 0 10px 20px rgba(139, 201, 5, 0.2);
        width: 100%;
    }

    .login-btn:hover {
        background: #76ad03;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(139, 201, 5, 0.3);
        color: white;
    }

    .login-btn i {
        transition: transform 0.3s ease;
    }

    .login-btn:hover i {
        transform: translateX(5px);
    }

    .progress-steps {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 20px;
    }

    .step {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #64748b;
    }

    .step.completed {
        background: #0C3A30;
        color: white;
    }

    .checklist {
        text-align: left;
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        margin: 25px 0;
        border: 1px solid #e2e8f0;
    }

    .checklist-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        color: #0C3A30;
    }

    .checklist-item i {
        color: #8bc905;
        font-size: 18px;
    }

    .checklist-item:last-child {
        margin-bottom: 0;
    }
</style>

<!-- Complete Page -->
<div class="complete-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step completed">1</div>
                    <div class="step completed">2</div>
                    <div class="step completed">3</div>
                </div>

                <div class="complete-card" data-aos="fade-up" data-aos-duration="800">
                    
                    <div class="success-icon">
                        <i class="ri-check-double-line"></i>
                    </div>

                    <h2>Registration Complete!</h2>
                    
                    <p>Your account has been successfully verified and your profile is complete. You can now log in to access your trading dashboard.</p>

                    <div class="checklist">
                        <div class="checklist-item">
                            <i class="ri-checkbox-circle-fill"></i>
                            <span>✓ Account created successfully</span>
                        </div>
                        <div class="checklist-item">
                            <i class="ri-checkbox-circle-fill"></i>
                            <span>✓ Trading profile completed</span>
                        </div>
                        <div class="checklist-item">
                            <i class="ri-checkbox-circle-fill"></i>
                            <span>✓ Ready to start trading</span>
                        </div>
                    </div>

                    <a href="{{ route('login') }}" class="login-btn">
                        Proceed to Login <i class="ri-arrow-right-line"></i>
                    </a>

                    <div class="mt-4 pt-3">
                        <small class="text-muted">
                            <i class="ri-question-line"></i>
                            Need help? <a href="#" style="color: #8bc905;">Contact Support</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection