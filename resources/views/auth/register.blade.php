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

    /* Professional form styling */
    .join-options,
    .copy-options {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .join-option-card,
    .copy-option-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .join-option-card:hover,
    .copy-option-card:hover {
        border-color: #8bc905;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(139, 201, 5, 0.2);
    }

    .join-option-card.selected,
    .copy-option-card.selected {
        border-color: #8bc905;
        background: linear-gradient(135deg, rgba(139, 201, 5, 0.05) 0%, rgba(139, 201, 5, 0.1) 100%);
        box-shadow: 0 0 0 3px rgba(139, 201, 5, 0.2);
    }

    .join-option-card i,
    .copy-option-card i {
        font-size: 24px;
        color: #8bc905;
        margin-bottom: 8px;
    }

    .join-option-card h5,
    .copy-option-card h5 {
        font-size: 14px;
        font-weight: 600;
        color: #0C3A30;
        margin-bottom: 4px;
    }

    .join-option-card p,
    .copy-option-card p {
        font-size: 11px;
        color: #64748b;
        margin: 0;
    }

    .selected-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #8bc905;
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .join-option-card.selected .selected-badge,
    .copy-option-card.selected .selected-badge {
        opacity: 1;
    }

    .admin-select-wrapper {
        background: white;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        padding: 16px;
        margin-top: 16px;
    }

    .admin-option {
        display: flex;
        align-items: center;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .admin-option:hover {
        background: #f8fafc;
        border-color: #8bc905;
    }

    .admin-option.selected {
        background: rgba(139, 201, 5, 0.1);
        border-color: #8bc905;
    }

    .admin-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #8bc905;
        color: #0C3A30;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-right: 12px;
        flex-shrink: 0;
        overflow: hidden;
    }

    .admin-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .admin-info {
        flex: 1;
    }

    .admin-info h6 {
        font-size: 13px;
        font-weight: 600;
        color: #0C3A30;
        margin-bottom: 2px;
    }

    .admin-info p {
        font-size: 11px;
        color: #64748b;
        margin: 0;
    }

    .admin-server-badge {
        background: #e2e8f0;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 9px;
        color: #0C3A30;
    }

    .other-input {
        margin-top: 16px;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-divider {
        position: relative;
        text-align: center;
        margin: 30px 0 20px;
    }

    .section-divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, #8bc905, transparent);
    }

    .section-divider span {
        background: white;
        padding: 0 20px;
        color: #0C3A30;
        font-weight: 600;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    /* Wikipedia-style notice */
    .wikipedia-notice {
        background: #f8f9fa;
        border: 1px solid #a2a9b1;
        border-left: 4px solid #8bc905;
        padding: 16px;
        margin-bottom: 24px;
        border-radius: 4px;
        font-size: 13px;
        color: #202122;
    }

    .wikipedia-notice i {
        color: #8bc905;
        margin-right: 8px;
    }
</style>

<!-- Start Compact Page Banner Area -->
<div class="page-banner-area position-relative py-3" style="background-image: url(assets/images/hero/hero-image-2.svg); background-size: cover; background-position: center;">
    <div class="container">
        <div class="page-banner-content text-center">
            <h1 style="font-size: 20px; margin: 0; color: #0C3A30;">Join Our Trading Community</h1>
            <ul style="margin: 2px 0 0; padding: 0; font-size: 12px;">
                <li style="display: inline;"><a href="/" style="color: #8bc905; text-decoration: none;">Home</a></li>
                <li style="display: inline; color: #666;"> / Sign Up</li>
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

                <!-- Wikipedia-style notice -->
                <div class="wikipedia-notice">
                    <i class="ri-information-line"></i>
                    <strong>Welcome to the trading community!</strong> Please tell us a bit about yourself to help us personalize your experience.
                </div>

                <form id="registerForm" action="{{ route('user.create') }}" method="POST" class="login-form bg-color-fffaeb radius-30">
                    @csrf
                    <h3>Create Your Account</h3>

                    <!-- Basic Information Section -->
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="Enter your full name">
                            <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="">Username</label>
                            <input type="text" class="form-control" value="{{ old('username') }}" name="username" placeholder="Choose a username">
                            <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="your@email.com">
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" inputmode="tel" placeholder="Phone number" value="{{ old('phone') }}">
                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6 position-relative">
                            <label for="">Password</label>
                            <input type="password" id="regPassword" class="form-control pe-5" name="password" placeholder="Create a strong password" value="{{ old('password') }}">
                            <span class="password-toggle" onclick="toggleRegPassword()">
                                <i class="ri-eye-line" id="regToggleIcon"></i>
                            </span>
                            <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6 position-relative">
                            <label for="">Confirm Password</label>
                            <input type="password" id="regConfirmPassword" class="form-control pe-5" name="password_confirmation" placeholder="Confirm your password" value="{{ old('password_confirmation') }}">
                            <span class="password-toggle" onclick="toggleRegConfirmPassword()">
                                <i class="ri-eye-line" id="regConfirmToggleIcon"></i>
                            </span>
                            <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control pe-5" required>
                                <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select your country ▼</option>
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
                                'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria','Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste',
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

                        <div class="mb-3 col-md-6">
                            <label for="">Referral ID (Optional)</label>
                            <input type="text" class="form-control" value="{{ old('referral_id') }}" name="referral_id" placeholder="Enter referral code if you have one">
                        </div>
                    </div>

                    <!-- Section Divider -->
                    <div class="section-divider">
                        <span>Community Preferences</span>
                    </div>

                    <!-- Where are you joining from? Section -->
                    <div class="join-options mb-4">
                        <h4 class="mb-3" style="font-size: 16px; color: #0C3A30; font-weight: 600;">
                            <i class="ri-map-pin-line me-2" style="color: #8bc905;"></i>
                            Where are you joining us from?
                        </h4>

                        <div class="row g-3">
                            <!-- Discord Option -->
                            <div class="col-md-4">
                                <div class="join-option-card {{ old('join_source') == 'discord' ? 'selected' : '' }}" onclick="selectJoinSource('discord')">
                                    <div class="selected-badge">✓</div>
                                    <i class="ri-discord-line" style="color:blue"></i>
                                    <h5>Discord</h5>
                                    <p>Join via our Discord community</p>
                                </div>
                            </div>

                            <!-- Telegram Option -->
                            <div class="col-md-4">
                                <div class="join-option-card {{ old('join_source') == 'telegram' ? 'selected' : '' }}" onclick="selectJoinSource('telegram')">
                                    <div class="selected-badge">✓</div>
                                    <i class="ri-telegram-line" style="color: aqua;"></i>
                                    <h5>Telegram</h5>
                                    <p>Join via our Telegram group</p>
                                </div>
                            </div>

                            <!-- Other Option -->
                            <div class="col-md-4">
                                <div class="join-option-card {{ old('join_source') == 'other' ? 'selected' : '' }}" onclick="selectJoinSource('other')">
                                    <div class="selected-badge">✓</div>
                                    <i class="ri-global-line"></i>
                                    <h5>Other</h5>
                                    <p>Social media, friend, etc.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden input for join_source -->
                        <input type="hidden" name="join_source" id="join_source" value="{{ old('join_source') }}">

                        <!-- Other source input (shown only when 'other' is selected) -->
                        <div id="otherSourceInput" class="other-input {{ old('join_source') == 'other' ? '' : 'hidden' }}">
                            <label for="join_source_other">Please specify:</label>
                            <input type="text" class="form-control" name="join_source_other" id="join_source_other" value="{{ old('join_source_other') }}" placeholder="e.g., Facebook, Twitter, Friend referral">
                        </div>
                    </div>

                   <!-- Who would you like to copy? Section -->
<div class="copy-options mb-4">
    <h4 class="mb-3" style="font-size: 16px; color: #0C3A30; font-weight: 600;">
        <i class="ri-user-star-line me-2" style="color: #8bc905;"></i>
        Who would you like to copy trades from?
    </h4>

    <div class="row g-3">
           <!-- Discord Admin Option -->
        <div class="col-md-4">
            <div class="copy-option-card {{ old('copy_preference') == 'specific_admin' ? 'selected' : '' }}" onclick="selectCopyPreference('specific_admin')">
                <div class="selected-badge">✓</div>
                <i class="ri-discord-line"></i>
                <h5>Discord Admin</h5>
                <p style="font-weight: 600;">Copy from Your Discord expert community Admin</p>
            </div>
        </div>
        <!-- Platform Admin Option -->
        <div class="col-md-4">
            <div class="copy-option-card {{ old('copy_preference') == 'platform_admin' ? 'selected' : '' }}" onclick="selectCopyPreference('platform_admin')">
                <div class="selected-badge">✓</div>
                <i class="ri-admin-line"></i>
                <h5>Platform Admin</h5>
                <p style="font-weight: 600;">Copy from our expert admins</p>
            </div>
        </div>

     
    </div>

    <!-- Hidden input for copy_preference -->
    <input type="hidden" name="copy_preference" id="copy_preference" value="{{ old('copy_preference') }}">

    <!-- Admin Selection Area (shown when specific_admin is selected) -->
    <div id="adminSelectionArea" class="admin-select-wrapper {{ old('copy_preference') == 'specific_admin' ? '' : 'hidden' }}">
        
        <!-- Header with count and search -->
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 gap-2" style="border-bottom: 1px dashed #e2e8f0;">
            <div class="d-flex align-items-center gap-2">
                <h5 style="font-size: 14px; color: #0C3A30; font-weight: 600; margin: 0;">
                    <i class="ri-user-star-line me-2" style="color: #8bc905;"></i>
                    Select an admin to copy
                </h5>
                @if(isset($feeds) && $feeds->count() > 0)
                <span class="badge rounded-pill" style="background: #8bc90520; color: #0C3A30; font-size: 11px; padding: 4px 10px;">
                    <span id="adminCount">{{ $feeds->count() }}</span> available
                </span>
                @endif
            </div>
            
            <!-- Search Bar -->
            <div class="search-wrapper" style="position: relative; min-width: 250px;">
                <i class="ri-search-line" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px;"></i>
                <input type="text" 
                       id="adminSearch" 
                       class="form-control form-control-sm" 
                       placeholder="Search by name or server..." 
                       style="padding-left: 35px; height: 38px; border-radius: 20px; border: 1px solid #e2e8f0; background: #f8fafc; font-size: 13px;">
                <button type="button" 
                        class="btn btn-sm" 
                        onclick="clearSearch()"
                        style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; padding: 0; display: none;"
                        id="clearSearchBtn">
                    <i class="ri-close-line" style="font-size: 16px;"></i>
                </button>
            </div>
        </div>

        @if(isset($feeds) && $feeds->count() > 0)
        <!-- Search Results Count -->
        <div id="searchResultsInfo" class="mb-2 px-1" style="display: none;">
            <small style="color: #64748b;">
                Found <span id="resultsCount">0</span> matching admins
            </small>
        </div>

        <!-- Admin List with Search Filter -->
     <div class="row g-3" style="max-height: 380px; overflow-y: auto; padding-right: 4px; scrollbar-width: thin; scrollbar-color: #8bc905 #e2e8f0;" id="adminList">
    @foreach($feeds as $feed)
    <div class="col-12 admin-item" 
         data-admin-name="{{ strtolower($feed->admin_name) }}" 
         data-server-name="{{ strtolower($feed->server_name) }}"
         data-profit="{{ $feed->profit_margin }}">

        <div class="admin-option d-flex align-items-center p-3 rounded-3 w-100 {{ old('copy_admin_id') == $feed->id ? 'selected' : '' }}"
            onclick="selectAdmin('{{ $feed->id }}', '{{ $feed->admin_name }}', '{{ $feed->server_name }}', '{{ $feed->profit_margin }}')"
            style="background: {{ old('copy_admin_id') == $feed->id ? '#f0f9e8' : '#ffffff' }};
                   border: 1px solid {{ old('copy_admin_id') == $feed->id ? '#8bc905' : '#edf2f7' }};
                   transition: all 0.2s ease;
                   cursor: pointer;">

            <!-- Avatar -->
            <div class="flex-shrink-0 me-3">
                @if($feed->admin_profile_image)
                <div class="rounded-circle overflow-hidden border-2"
                    style="width: 50px; height: 50px; border-color: {{ old('copy_admin_id') == $feed->id ? '#8bc905' : '#e2e8f0' }};">
                    <img src="{{ asset('storage/admins/'.$feed->admin_profile_image) }}"
                        class="w-100 h-100 object-fit-cover">
                </div>
                @else
                <div class="rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 50px; height: 50px; background: #8bc90520; color: #0C3A30; border: 2px solid {{ old('copy_admin_id') == $feed->id ? '#8bc905' : '#e2e8f0' }};">
                    <span style="font-weight: 700; font-size: 18px;">
                        {{ strtoupper(substr($feed->admin_name, 0, 1)) }}
                    </span>
                </div>
                @endif
            </div>
            
            <!-- Info -->
            <div class="flex-grow-1">

                <div class="d-flex align-items-center justify-content-between mb-2">
                    <!-- Admin Name (Bigger + Bold + Darker) -->
                    <h6 style="font-size: 17px; font-weight: 700; color: #0C3A30; margin: 0;">
                        {{ $feed->admin_name }}
                    </h6>

                    <span class="admin-server-badge ms-2"
                        style="background: #8bc905; color: white; padding: 4px 10px; border-radius: 14px; font-size: 12px; font-weight: 600;">
                        Copy
                    </span>
                </div>

                <div class="d-flex align-items-center gap-3 mb-2">

                    <!-- Server Name (Bigger + Bold) -->
                    <span style="font-size: 14px; font-weight: 600; color: #1e293b;">
                        <i class="ri-server-line me-1" style="font-size: 12px;"></i>
                        {{ $feed->server_name }}
                    </span>

                    <!-- ❗ Profit (UNCHANGED as requested) -->
                    <span style="color: #8bc905; font-size: 12px; font-weight: 600;">
                        Profit =  ${{ number_format($feed->profit_margin, 2) }}
                    </span>
                </div>

                <div class="d-flex align-items-center gap-4">
                    <small style="font-size: 12px; font-weight: 600; color: #475569;">
                        <i class="ri-user-line text-black-50 me-1"></i>
                        {{ number_format($feed->active_members) }} active
                    </small>

                    <small style="font-size: 12px; font-weight: 600; color: #475569;">
                        <i class="ri-file-copy-line me-1"></i>
                        {{ number_format($feed->copying_trades ?? 0) }} copying
                    </small>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>

        <!-- No Results Message -->
        <div id="noSearchResults" class="text-center py-5" style="display: none;">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                    style="width: 64px; height: 64px; background: #8bc90510;">
                    <i class="ri-search-line" style="color: #8bc905; font-size: 24px;"></i>
                </div>
            </div>
            <p class="text-dark mb-1" style="font-size: 14px; font-weight: 500;">No matching admins found</p>
            <p class="text-muted" style="font-size: 12px;">Try adjusting your search terms</p>
            <button class="btn btn-sm mt-2" onclick="clearSearch()" style="background: #8bc905; color: white; border: none; padding: 6px 16px; border-radius: 20px;">
                Clear Search
            </button>
        </div>

        <!-- Selected indicator -->
        <div class="mt-3 text-center" id="selectedAdminIndicator" style="display: none;">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill" style="background: #8bc90510; border: 1px solid #8bc90530;">
                <i class="ri-check-line" style="color: #8bc905; font-size: 14px;"></i>
                <span style="font-size: 12px; color: #0C3A30;">Selected: <span id="selectedAdminName"></span></span>
            </div>
        </div>

        @else
        <div class="text-center py-5">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                    style="width: 64px; height: 64px; background: #8bc90510;">
                    <i class="fa-solid fa-user-slash" style="color: #8bc905; font-size: 24px;"></i>
                </div>
            </div>
            <p class="text-dark mb-1" style="font-size: 14px; font-weight: 500;">No admins available yet</p>
            <p class="text-muted" style="font-size: 12px;">Check back later for available trading admins</p>
        </div>
        @endif

        <!-- Hidden inputs for selected admin -->
        <input type="hidden" name="copy_admin_id" id="copy_admin_id" value="{{ old('copy_admin_id') }}">
        <input type="hidden" name="copy_admin_name" id="copy_admin_name" value="{{ old('copy_admin_name') }}">
        <input type="hidden" name="copy_server_name" id="copy_server_name" value="{{ old('copy_server_name') }}">

      
    </div>
</div>

                    <button id="registerBtn" type="submit" class="default-btn w-100 text-center bg-[#8bc905] text-white relative">
                        <span class="btn-text">Create Account & Join Community</span>
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

                    <p class="text-center mt-3">Already Have An Account? <a href="{{ route('login') }}">Login</a></p>
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

    #registerBtn {
        position: relative;
        padding: 12px 20px;
        background-color: #8bc905 !important;
        color: white !important;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    #registerBtn:hover {
        background-color: #76ad03 !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(139, 201, 5, 0.4);
    }

    #registerBtn:disabled {
        background-color: #ccc !important;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .hidden {
        display: none !important;
    }

    /* Add to your styles */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#noSearchResults {
    animation: fadeIn 0.3s ease;
}
/* Add to your styles */
@media (max-width: 768px) {
    .search-wrapper {
        min-width: 100% !important;
    }
    
    .admin-option {
        flex-wrap: wrap;
    }
    
    .admin-option .flex-shrink-0 {
        margin-bottom: 10px;
    }
    
    .admin-server-badge {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    
    .admin-option {
        position: relative;
        padding-top: 15px;
    }
}
</style>

<script>
    // Password toggle functions
    function toggleRegPassword() {
        const passwordInput = document.getElementById('regPassword');
        const toggleIcon = document.getElementById('regToggleIcon');

        if (passwordInput.type === 'text') {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('ri-eye-line');
            toggleIcon.classList.add('ri-eye-off-line');
        } else {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('ri-eye-off-line');
            toggleIcon.classList.add('ri-eye-line');
        }
    }

    function toggleRegConfirmPassword() {
        const passwordInput = document.getElementById('regConfirmPassword');
        const toggleIcon = document.getElementById('regConfirmToggleIcon');

        if (passwordInput.type === 'text') {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('ri-eye-line');
            toggleIcon.classList.add('ri-eye-off-line');
        } else {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('ri-eye-off-line');
            toggleIcon.classList.add('ri-eye-line');
        }
    }

    // Join Source Selection
    function selectJoinSource(source) {
        document.getElementById('join_source').value = source;

        document.querySelectorAll('.join-option-card').forEach(card => {
            card.classList.remove('selected');
        });

        event.currentTarget.classList.add('selected');

        const otherInput = document.getElementById('otherSourceInput');
        if (source === 'other') {
            otherInput.classList.remove('hidden');
        } else {
            otherInput.classList.add('hidden');
            document.getElementById('join_source_other').value = '';
        }
    }

    // Copy Preference Selection
    function selectCopyPreference(preference) {
        document.getElementById('copy_preference').value = preference;

        document.querySelectorAll('.copy-option-card').forEach(card => {
            card.classList.remove('selected');
        });

        event.currentTarget.classList.add('selected');

        const adminArea = document.getElementById('adminSelectionArea');
        if (preference === 'specific_admin') {
            adminArea.classList.remove('hidden');
            setTimeout(() => {
                initializeSearch();
            }, 100);
        } else {
            adminArea.classList.add('hidden');
            document.getElementById('copy_admin_id').value = '';
            document.getElementById('copy_admin_name').value = '';
            document.getElementById('copy_server_name').value = '';
            
            const indicator = document.getElementById('selectedAdminIndicator');
            if (indicator) {
                indicator.style.display = 'none';
            }
        }
    }

    // Admin Selection
    function selectAdmin(adminId, adminName, serverName, profitMargin) {
        document.getElementById('copy_admin_id').value = adminId;
        document.getElementById('copy_admin_name').value = adminName;
        document.getElementById('copy_server_name').value = serverName;

        document.querySelectorAll('.admin-option').forEach(option => {
            option.classList.remove('selected');
            option.style.background = '#ffffff';
            option.style.borderColor = '#edf2f7';

            const avatar = option.querySelector('.rounded-circle');
            if (avatar) {
                avatar.style.borderColor = '#e2e8f0';
            }
        });

        const selectedOption = event.currentTarget;
        selectedOption.classList.add('selected');
        selectedOption.style.background = '#f0f9e8';
        selectedOption.style.borderColor = '#8bc905';

        const selectedAvatar = selectedOption.querySelector('.rounded-circle');
        if (selectedAvatar) {
            selectedAvatar.style.borderColor = '#8bc905';
        }

        const indicator = document.getElementById('selectedAdminIndicator');
        const selectedNameSpan = document.getElementById('selectedAdminName');
        if (indicator && selectedNameSpan) {
            selectedNameSpan.textContent = adminName;
            indicator.style.display = 'block';
        }
    }

    // Search functionality - SINGLE FUNCTION (FIXED)
    function searchAdmins() {
        const searchInput = document.getElementById('adminSearch');
        if (!searchInput) return;
        
        const searchWrapper = document.querySelector('.search-wrapper');
        if (searchWrapper) {
            searchWrapper.style.opacity = '0.7';
        }
        
        const searchTerm = searchInput.value.toLowerCase().trim();
        const adminItems = document.querySelectorAll('.admin-item');
        const clearBtn = document.getElementById('clearSearchBtn');
        const searchResultsInfo = document.getElementById('searchResultsInfo');
        const resultsCountSpan = document.getElementById('resultsCount');
        const noResultsDiv = document.getElementById('noSearchResults');
        const adminList = document.getElementById('adminList');
        
        let visibleCount = 0;
        
        // Show/hide clear button
        if (clearBtn) {
            clearBtn.style.display = searchTerm.length > 0 ? 'block' : 'none';
        }
        
        // Filter admin items
        adminItems.forEach(item => {
            const adminName = item.getAttribute('data-admin-name');
            const serverName = item.getAttribute('data-server-name');
            
            if (searchTerm === '' || adminName.includes(searchTerm) || serverName.includes(searchTerm)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Update results count and visibility
        if (searchTerm.length > 0) {
            if (resultsCountSpan) resultsCountSpan.textContent = visibleCount;
            if (searchResultsInfo) searchResultsInfo.style.display = 'block';
            
            if (visibleCount === 0) {
                if (adminList) adminList.style.display = 'none';
                if (noResultsDiv) noResultsDiv.style.display = 'block';
            } else {
                if (adminList) adminList.style.display = 'block';
                if (noResultsDiv) noResultsDiv.style.display = 'none';
            }
        } else {
            if (searchResultsInfo) searchResultsInfo.style.display = 'none';
            if (adminList) adminList.style.display = 'block';
            if (noResultsDiv) noResultsDiv.style.display = 'none';
        }
        
        // Remove loading indicator
        if (searchWrapper) {
            setTimeout(() => {
                searchWrapper.style.opacity = '1';
            }, 200);
        }
    }
    
    function clearSearch() {
        const searchInput = document.getElementById('adminSearch');
        if (searchInput) {
            searchInput.value = '';
            searchAdmins();
            searchInput.focus();
        }
    }
    
    function initializeSearch() {
        const searchInput = document.getElementById('adminSearch');
        if (searchInput) {
            // Remove any existing event listeners
            const newSearchInput = searchInput.cloneNode(true);
            searchInput.parentNode.replaceChild(newSearchInput, searchInput);
            
            // Add new event listener with debounce
            let timeout;
            newSearchInput.addEventListener('keyup', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    searchAdmins();
                }, 300);
            });
            
            // Add input event for immediate feedback
            newSearchInput.addEventListener('input', function() {
                if (this.value === '') {
                    searchAdmins();
                }
            });
            
            // Update the clear button functionality
            const clearBtn = document.getElementById('clearSearchBtn');
            if (clearBtn) {
                clearBtn.onclick = function() {
                    clearSearch();
                };
            }
        }
    }

    // Form submission loader
    document.getElementById('registerForm').addEventListener('submit', function() {
        const btn = document.getElementById('registerBtn');
        const btnText = btn.querySelector('.btn-text');
        const btnLoader = btn.querySelector('.btn-loader');

        btn.disabled = true;
        btnText.style.display = 'none';
        btnLoader.classList.remove('hidden');
    });

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Preload admin images
        const adminImages = document.querySelectorAll('.admin-option img');
        adminImages.forEach(img => {
            const src = img.getAttribute('src');
            if (src) {
                const preloadLink = document.createElement('link');
                preloadLink.rel = 'preload';
                preloadLink.as = 'image';
                preloadLink.href = src;
                document.head.appendChild(preloadLink);
            }
        });

        // Preselect join source
        const joinSource = document.getElementById('join_source').value;
        if (joinSource) {
            document.querySelectorAll('.join-option-card').forEach(card => {
                if (card.getAttribute('onclick')?.includes(joinSource)) {
                    card.classList.add('selected');
                }
            });
            
            if (joinSource === 'other') {
                document.getElementById('otherSourceInput')?.classList.remove('hidden');
            }
        }

        // Preselect copy preference
        const copyPreference = document.getElementById('copy_preference').value;
        if (copyPreference) {
            document.querySelectorAll('.copy-option-card').forEach(card => {
                if (card.getAttribute('onclick')?.includes(copyPreference)) {
                    card.classList.add('selected');
                }
            });

            if (copyPreference === 'specific_admin') {
                document.getElementById('adminSelectionArea')?.classList.remove('hidden');
                
                setTimeout(() => {
                    initializeSearch();
                }, 100);
                
                const copyAdminId = document.getElementById('copy_admin_id').value;
                if (copyAdminId) {
                    document.querySelectorAll('.admin-option').forEach(option => {
                        if (option.getAttribute('onclick')?.includes(`'${copyAdminId}'`)) {
                            option.classList.add('selected');
                            option.style.background = '#f0f9e8';
                            option.style.borderColor = '#8bc905';
                            
                            const adminName = document.getElementById('copy_admin_name').value;
                            if (adminName) {
                                const indicator = document.getElementById('selectedAdminIndicator');
                                const selectedNameSpan = document.getElementById('selectedAdminName');
                                if (indicator && selectedNameSpan) {
                                    selectedNameSpan.textContent = adminName;
                                    indicator.style.display = 'block';
                                }
                            }
                        }
                    });
                }
            }
        } else {
            initializeSearch();
        }
    });
</script>
@endsection