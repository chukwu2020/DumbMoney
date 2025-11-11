@extends('layout.app')

@section('content')
<style>
    /* CSS to reduce header gap */
    .page-banner-area {
        margin-top: -1rem;
        padding-top: 4rem !important;
    }

    @media (max-width: 768px) {
        .page-banner-area {
            margin-top: -1.5rem;
        }
    }
</style>
<!-- Start Compact Page Banner Area -->
<div class="page-banner-area position-relative" style="background-image: url(assets/images/hero/hero-image-2.svg); ">
    <div class="container">
        <div class="page-banner-content">
            <h1 style="font-size: 24px; margin: 0;">My Account</h1>
            <ul style="margin: 5px 0 0; padding: 0;">
                <li style="display: inline;"><a href="/">Home</a></li>
                <li style="display: inline;"> / My Account</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Compact Page Banner Area -->

<!-- Start My Account Page -->
<div class="my-account-page ptb-80 overflow-hidden">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-10 col-md-12" data-cues="slideInLeft" data-duration="800">
                <!-- <form action="{{ route('user.create') }}" method="POST" class="login-form bg-color-fffaeb radius-30"> -->
                <form id="registerForm" action="{{ route('user.create') }}" method="POST" class="login-form bg-color-fffaeb radius-30">

                    @csrf
                    <h3>Create An Account</h3>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Name">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="">Username</label>
                            <input type="text" class="form-control" value="{{ old('username') }}" name="username" placeholder="Username">
                            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" inputmode="tel" placeholder="Phone number" value="{{ old('phone') }}">
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3 col-md-6 position-relative">
                            <label for="">Password</label>
                            <input type="password" id="regPassword" class="form-control pe-5" name="password" placeholder="Password (e.g. Ch@#%)" value="{{ old('password') }}">
                            <span class="password-toggle" onclick="toggleRegPassword()">
                                <i class="ri-eye-line" id="regToggleIcon"></i> <!-- eye without slash = visible -->
                            </span>


                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>


                        <div class="mb-3 col-md-6 position-relative">
                            <label for="">Confirm Password</label>
                            <input type="password" id="regConfirmPassword" class="form-control pe-5" name="confirm_password" placeholder="Password (e.g. Ch@#%)" value="{{ old('confirm_password') }}">
                            <span class="password-toggle" onclick="toggleRegConfirmPassword()">
                                <i class="ri-eye-line" id="regConfirmToggleIcon"></i> <!-- eye without slash = visible -->
                            </span>


                            <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
                        </div>





                      <div class="mb-3 col-md-6">
    <label for="country">Country</label>
    <select name="country" id="country" class="form-control pe-5" required>
        <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select country ▼</option>

        @php
            $countries = [
                'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia',
                'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin',
                'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi',
                'Côte d\'Ivoire', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China',
                'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic',
                'Democratic Republic of the Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt',
                'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon',
                'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana',
                'Haiti', 'Holy See', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
                'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia',
                'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi',
                'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia',
                'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal',
                'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman',
                'Pakistan', 'Palau', 'Palestine State', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland',
                'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines',
                'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone',
                'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Korea', 'South Sudan', 'Spain',
                'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste',
                'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine',
                'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam',
                'Yemen', 'Zambia', 'Zimbabwe'
            ];
        @endphp

        @foreach ($countries as $country)
            <option value="{{ $country }}" {{ old('country') == $country ? 'selected' : '' }}>
                {{ $country }}
            </option>
        @endforeach
    </select>
</div>

<style>
    .arrow-down {
        color: #555;
        font-size: 0.9rem;
    }
</style>


                        <div class="mb-3 col-md-6">
                            <label for="">Referral Id</label>
                            <input type="text" class="form-control" value="{{ old('referral_id') }}" name="referral_id" placeholder="Referral ID (optional)">

                        </div>
                    </div>
<button id="registerBtn" type="submit" class="default-btn w-100 text-center bg-[#8bc905] text-white relative">
    <span class="btn-text">Register Now</span>
    <span class="btn-loader hidden absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
            <circle cx="25" cy="25" r="20" stroke="#fff" stroke-width="5" fill="none" stroke-linecap="round">
                <animateTransform
                    attributeName="transform"
                    type="rotate"
                    dur="1s"
                    from="0 25 25"
                    to="360 25 25"
                    repeatCount="indefinite" />
            </circle>
        </svg>
    </span>
</button>




                    <p class="text-center">Already Have An Account? <a href="{{ route('login') }}">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End My Account Page -->
<style>
    .password-toggle {
        position: absolute;
        right: 15px;
        top: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        cursor: pointer;
        color: #6c757d;
        z-index: 10;
    }

    .password-toggle:hover {
        color: #0c3a30;
    }

    .form-control.pe-5 {
        padding-right: 2.5rem !important;
    }
</style>

<script>
    function toggleRegPassword() {
        const passwordInput = document.getElementById('regPassword');
        const toggleIcon = document.getElementById('regToggleIcon');

        if (passwordInput.type === 'text') {
            // Hide password (change to password)
            passwordInput.type = 'password';
            // Show eye-off (slashed eye) icon meaning hidden
            toggleIcon.classList.remove('ri-eye-line');
            toggleIcon.classList.add('ri-eye-off-line');
        } else {
            // Show password (change to text)
            passwordInput.type = 'text';
            // Show eye (unslashed eye) icon meaning visible
            toggleIcon.classList.remove('ri-eye-off-line');
            toggleIcon.classList.add('ri-eye-line');
        }
    }

    function toggleRegConfirmPassword() {
        const passwordInput = document.getElementById('regConfirmPassword');
        const toggleIcon = document.getElementById('regConfirmToggleIcon');

        if (passwordInput.type === 'text') {
            // Hide password
            passwordInput.type = 'password';
            toggleIcon.classList.remove('ri-eye-line');
            toggleIcon.classList.add('ri-eye-off-line');
        } else {
            // Show password
            passwordInput.type = 'text';
            toggleIcon.classList.remove('ri-eye-off-line');
            toggleIcon.classList.add('ri-eye-line');
        }
    }
</script>


<style>
    .loader {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-left-color: #8bc905;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 10px;
        vertical-align: middle;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<!-- delaying loading  -->
<style>
    #registerBtn {
    position: relative;
    padding: 10px 20px;
    background-color: #8bc905 !important;
    color: white !important;
    border: none;
    border-radius: 5px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
#registerBtn:hover {
    background-color: #76ad03;
}
#registerBtn:disabled {
    background-color: #ccc !important;
    cursor: not-allowed;
}
.hidden {
    display: none !important;
}

</style>

<script>
    document.getElementById('registerForm').addEventListener('submit', function () {
        const btn = document.getElementById('registerBtn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        // Disable button
        btn.disabled = true;

        // Hide text, show loader
        btnText.style.display = 'none';
        btnLoader.classList.remove('hidden'); // shows the loader
    });
</script>



@endsection