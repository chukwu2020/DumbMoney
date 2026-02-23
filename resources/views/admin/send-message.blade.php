@extends('layout.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            
            <!-- Page Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: #0C3A30;">Send Message to Users</h2>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ri-check-circle-line me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="ri-error-warning-line me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.send.message') }}" method="POST" id="messageForm">
                @csrf
                
                <div class="row g-4">
                    <!-- User Selection Card -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 fw-semibold" style="color: #0C3A30;">
                                        <i class="ri-user-3-line me-2"></i>Select Recipients
                                    </h5>
                                    <span class="badge bg-light text-dark" id="selectedCount">0 selected</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <!-- Country Filter Section -->
                                <div class="p-3 border-bottom" style="background-color: #f8f9fa;">
                                    <label class="form-label fw-semibold mb-2" style="color: #0C3A30;">
                                        <i class="ri-earth-line me-1"></i>Filter by Country
                                    </label>
                                    
                                    <!-- Country Selection -->
                                    <div class="mb-2">
                                        <select class="form-select" id="countryFilter">
                                            <option value="">All Countries</option>
                                            @php
                                                $countries = \App\Models\User::distinct()->orderBy('country')->pluck('country');
                                            @endphp
                                            @foreach($countries as $country)
                                                @if($country)
                                                    <option value="{{ $country }}">{{ $country }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <!-- Quick Country Select Buttons -->
                                    <div class="d-flex flex-wrap gap-2 mt-2" id="countryQuickSelect">
                                        @php
                                            $topCountries = \App\Models\User::select('country')
                                                ->selectRaw('count(*) as total')
                                                ->whereNotNull('country')
                                                ->groupBy('country')
                                                ->orderBy('total', 'desc')
                                                ->limit(5)
                                                ->get();
                                        @endphp
                                        @foreach($topCountries as $countryData)
                                            @if($countryData->country)
                                                <button type="button" class="btn btn-sm btn-outline-success country-quick-btn" data-country="{{ $countryData->country }}">
                                                    {{ $countryData->country }} ({{ $countryData->total }})
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Select All Option -->
                                <div class="p-3 border-bottom" style="background-color: #f8f9fa;">
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="selectAll"
                                            style="cursor: pointer; width: 18px; height: 18px;"
                                        >
                                        <label class="form-check-label fw-semibold ms-2" for="selectAll" style="cursor: pointer;">
                                            Select All Users
                                        </label>
                                    </div>
                                </div>

                                <!-- Search Box -->
                                <div class="p-3 border-bottom">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="ri-search-line text-muted"></i>
                                        </span>
                                        <input 
                                            type="text" 
                                            class="form-control border-start-0 ps-0" 
                                            id="searchUsers" 
                                            placeholder="Search users..."
                                        >
                                    </div>
                                </div>

                                <!-- Users List -->
                                <div class="user-list-container" style="max-height: 400px; overflow-y: auto;">
                                    @foreach(\App\Models\User::all() as $user)
                                        <div class="user-item p-3 border-bottom" 
                                             data-user-name="{{ strtolower($user->name) }}" 
                                             data-user-email="{{ strtolower($user->email) }}"
                                             data-user-country="{{ $user->country ?? 'Not Set' }}">
                                            <div class="form-check">
                                                <input 
                                                    class="form-check-input user-checkbox" 
                                                    type="checkbox" 
                                                    name="users[]" 
                                                    value="{{ $user->id }}" 
                                                    id="user{{ $user->id }}"
                                                    @if(old('users') && in_array($user->id, old('users'))) checked @endif
                                                    @if(auth()->id() == $user->id) checked @endif
                                                    style="cursor: pointer; width: 18px; height: 18px;"
                                                >
                                                <label class="form-check-label ms-2 w-100" for="user{{ $user->id }}" style="cursor: pointer;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <div class="fw-semibold" style="color: #0C3A30;">{{ $user->name }}</div>
                                                            <small class="text-muted">{{ $user->email }}</small>
                                                            @if($user->country)
                                                                <div class="mt-1">
                                                                    <span class="badge bg-info bg-opacity-10 text-info">
                                                                        <i class="ri-earth-line me-1"></i>{{ $user->country }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if(auth()->id() == $user->id)
                                                            <span class="badge bg-success bg-opacity-10 text-success">You</span>
                                                        @endif
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- No Results Message -->
                                <div id="noResults" class="p-4 text-center text-muted" style="display: none;">
                                    <i class="ri-search-line fs-1 mb-2"></i>
                                    <p class="mb-0">No users found</p>
                                </div>
                                
                                <!-- Country Selection Actions -->
                                <div class="p-3 border-top bg-light">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-success" id="selectAllFromCountry" disabled>
                                            <i class="ri-checkbox-multiple-line me-2"></i>
                                            <span id="countrySelectText">Select All from Selected Country</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Composition Card -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="mb-0 fw-semibold" style="color: #0C3A30;">
                                    <i class="ri-mail-line me-2"></i>Compose Message
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Title Field -->
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold" style="color: #0C3A30;">
                                        Message Title <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control form-control-lg @error('title') is-invalid @enderror" 
                                        id="title" 
                                        name="title" 
                                        placeholder="Enter message title..."
                                        value="{{ old('title') }}"
                                        required
                                    >
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message Field -->
                                <div class="mb-4">
                                    <label for="message" class="form-label fw-semibold" style="color: #0C3A30;">
                                        Message Content <span class="text-danger">*</span>
                                    </label>
                                    <textarea 
                                        class="form-control @error('message') is-invalid @enderror" 
                                        id="message" 
                                        name="message" 
                                        rows="10" 
                                        placeholder="Type your message here..."
                                        required
                                    >{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        <span id="charCount">0</span> characters
                                    </small>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3">
                                    <button 
                                        type="submit" 
                                        class="btn btn-lg px-5 fw-semibold" 
                                        id="sendButton"
                                        style="background: linear-gradient(145deg, #8BC905, #7AB805); color: white; border: none;"
                                    >
                                        <i class="ri-send-plane-fill me-2"></i>
                                        <span id="buttonText">Send Message</span>
                                    </button>
                                    <button 
                                        type="reset" 
                                        class="btn btn-outline-secondary btn-lg px-4"
                                        id="resetButton"
                                    >
                                        <i class="ri-refresh-line me-2"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<style>
    /* Custom Styles */
    .user-item {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }

    .user-item:hover {
        background-color: #f8f9fa;
        border-left-color: #8BC905;
    }

    .user-list-container::-webkit-scrollbar {
        width: 8px;
    }

    .user-list-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .user-list-container::-webkit-scrollbar-thumb {
        background: #8BC905;
        border-radius: 4px;
    }

    .user-list-container::-webkit-scrollbar-thumb:hover {
        background: #7AB805;
    }

    .form-check-input:checked {
        background-color: #8BC905;
        border-color: #8BC905;
    }

    .form-check-input:focus {
        border-color: #8BC905;
        box-shadow: 0 0 0 0.25rem rgba(139, 201, 5, 0.25);
    }

    /* Button disabled state */
    #sendButton:disabled {
        background: #e9ecef !important;
        color: #6c757d !important;
        cursor: not-allowed !important;
        opacity: 0.65;
    }

    /* Loading state */
    .btn-loading {
        position: relative;
        pointer-events: none;
    }

    .btn-loading::after {
        content: "";
        position: absolute;
        width: 16px;
        height: 16px;
        top: 50%;
        left: 50%;
        margin-left: -8px;
        margin-top: -8px;
        border: 2px solid transparent;
        border-top-color: currentColor;
        border-radius: 50%;
        animation: spinner 0.6s linear infinite;
    }

    @keyframes spinner {
        to { transform: rotate(360deg); }
    }
    
    /* Country filter active state */
    .country-quick-btn.active {
        background-color: #8BC905;
        color: white;
        border-color: #8BC905;
    }
    
    .country-quick-btn:hover {
        background-color: #8BC905;
        color: white;
        border-color: #8BC905;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('messageForm');
    const sendButton = document.getElementById('sendButton');
    const buttonText = document.getElementById('buttonText');
    const resetButton = document.getElementById('resetButton');
    const selectAllCheckbox = document.getElementById('selectAll');
    const userCheckboxes = document.querySelectorAll('.user-checkbox');
    const selectedCountBadge = document.getElementById('selectedCount');
    const searchInput = document.getElementById('searchUsers');
    const userItems = document.querySelectorAll('.user-item');
    const noResults = document.getElementById('noResults');
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    // Country filter elements
    const countryFilter = document.getElementById('countryFilter');
    const countryQuickBtns = document.querySelectorAll('.country-quick-btn');
    const selectAllFromCountry = document.getElementById('selectAllFromCountry');
    const countrySelectText = document.getElementById('countrySelectText');
    
    let currentSelectedCountry = '';

    // Update selected count
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.user-checkbox:checked').length;
        selectedCountBadge.textContent = selectedCount + ' selected';
        
        // Update select all checkbox state
        const allChecked = Array.from(userCheckboxes).every(cb => cb.checked);
        const someChecked = Array.from(userCheckboxes).some(cb => cb.checked);
        selectAllCheckbox.checked = allChecked;
        selectAllCheckbox.indeterminate = someChecked && !allChecked;
    }

    // Filter users by country and search
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCountry = countryFilter.value;
        let visibleCount = 0;

        userItems.forEach(item => {
            const userName = item.dataset.userName;
            const userEmail = item.dataset.userEmail;
            const userCountry = item.dataset.userCountry;
            
            const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
            const matchesCountry = !selectedCountry || userCountry === selectedCountry;
            
            if (matchesSearch && matchesCountry) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Update country select button
        if (selectedCountry) {
            selectAllFromCountry.disabled = false;
            countrySelectText.textContent = `Select All from ${selectedCountry}`;
        } else {
            selectAllFromCountry.disabled = true;
            countrySelectText.textContent = 'Select All from Selected Country';
        }

        // Update quick buttons active state
        countryQuickBtns.forEach(btn => {
            if (btn.dataset.country === selectedCountry) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }

    // Select all users from current country
    selectAllFromCountry.addEventListener('click', function() {
        const selectedCountry = countryFilter.value;
        if (!selectedCountry) return;
        
        userItems.forEach(item => {
            if (item.style.display !== 'none') {
                const checkbox = item.querySelector('.user-checkbox');
                if (checkbox) {
                    checkbox.checked = true;
                }
            }
        });
        
        updateSelectedCount();
    });

    // Country filter change
    countryFilter.addEventListener('change', filterUsers);

    // Quick country buttons
    countryQuickBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const country = this.dataset.country;
            countryFilter.value = country;
            filterUsers();
        });
    });

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        // Only affect visible users
        userItems.forEach(item => {
            if (item.style.display !== 'none') {
                const checkbox = item.querySelector('.user-checkbox');
                if (checkbox) {
                    checkbox.checked = this.checked;
                }
            }
        });
        updateSelectedCount();
    });

    // Individual checkbox change
    userCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    // Search functionality
    searchInput.addEventListener('input', filterUsers);

    // Character count
    messageTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });

    // Initialize character count
    charCount.textContent = messageTextarea.value.length;

    // Form submission - prevent double click
    form.addEventListener('submit', function(e) {
        // Check if at least one user is selected
        const selectedUsers = document.querySelectorAll('.user-checkbox:checked').length;
        
        if (selectedUsers === 0) {
            e.preventDefault();
            alert('Please select at least one user to send the message to.');
            return false;
        }

        // Disable button and show loading state
        sendButton.disabled = true;
        sendButton.classList.add('btn-loading');
        buttonText.textContent = 'Sending...';
        
        // Also disable reset button
        resetButton.disabled = true;
    });

    // Reset button
    resetButton.addEventListener('click', function() {
        setTimeout(() => {
            updateSelectedCount();
            charCount.textContent = '0';
            searchInput.value = '';
            countryFilter.value = '';
            userItems.forEach(item => item.style.display = 'block');
            noResults.style.display = 'none';
            selectAllFromCountry.disabled = true;
            countrySelectText.textContent = 'Select All from Selected Country';
            countryQuickBtns.forEach(btn => btn.classList.remove('active'));
        }, 10);
    });

    // Initial count update
    updateSelectedCount();
});
</script>
@endsection