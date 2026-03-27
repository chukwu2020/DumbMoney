{{-- resources/views/auth/registration-success.blade.php --}}
@extends('layout.app')

@section('content')

<style>
    .success-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .success-card {
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

    .success-card::before {
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

    .success-card::after {
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
        width: 50px; /* Reduced from 100px */
        height: 50px; /* Reduced from 100px */
        background: #8bc905;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px; /* Reduced bottom margin */
        font-size: 35px; /* Reduced from 50px */
        color: white;
        box-shadow: 0 8px 20px rgba(139, 201, 5, 0.3); /* Adjusted shadow */
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 8px 20px rgba(139, 201, 5, 0.3); transform: scale(1); }
        50% { box-shadow: 0 15px 35px rgba(139, 201, 5, 0.5); transform: scale(1.03); } /* Reduced scale */
        100% { box-shadow: 0 8px 20px rgba(139, 201, 5, 0.3); transform: scale(1); }
    }

    .success-card h2 {
        color: #0C3A30;
        font-size: 32px;
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
    .success-card p {
        color: #4A5C5A;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .user-email {
        background: #f8f9fa;
        border-radius: 50px;
        padding: 12px 20px;
        display: inline-block;
        margin-bottom: 20px;
        color: #0C3A30;
        font-weight: 500;
        border: 1px solid #e2e8f0;
    }

    .user-email i {
        color: #8bc905;
        margin-right: 8px;
    }

    .proceed-btn {
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

    .proceed-btn:hover {
        background: #76ad03;
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(139, 201, 5, 0.3);
        color: white;
    }

    .proceed-btn i {
        transition: transform 0.3s ease;
    }

    .proceed-btn:hover i {
        transform: translateX(5px);
    }

    .progress-steps {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 10px;
    }

    .step {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #64748b;
    }

    .step.active {
        background: #8bc905;
        color: white;
    }

    .step.completed {
        background: #0C3A30;
        color: white;
    }
</style>

<!-- Success Page -->
<div class="success-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step completed">1</div>
                    <div class="step active">2</div>
                    <div class="step">3</div>
                </div>

                <div class="success-card" data-aos="fade-up" data-aos-duration="800">
                    
                    <div class="success-icon">
                        <i class="ri-check-line"></i>
                    </div>

                    <div class="user-email">
                        <i class="ri-mail-line"></i>
                        {{ $user->email }}
                    </div>

                    <h2>Account Created Successfully!</h2>
                  

                    <div class="alert alert-info text-start mb-4" style="background: #f0f9ff; border-left: 4px solid #8bc905;">
                        <i class="ri-information-line me-2" style="color: #8bc905;"></i>
                        <strong>Step 2 of 3:</strong> We need a bit more information to personalize your trading experience.
                    </div>

                    <a href="{{ route('user.additional.info') }}" class="proceed-btn">
                        Proceed to Complete Profile <i class="ri-arrow-right-line"></i>
                    </a>

                    <div class="mt-4 pt-3">
                        <small class="text-muted">
                            <i class="ri-time-line"></i>
                            This will only take 2-3 minutes
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection