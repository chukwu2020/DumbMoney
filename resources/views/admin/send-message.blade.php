@extends('layout.admin')

@section('content')

<style>
    /* ── Override any dark theme leakage ── */
    .card, .card-body, .card-header, .card-footer { background: #ffffff !important; color: #111827 !important; }
    label, .form-label { color: #111827 !important; }
    .form-control, .form-select { color: #111827 !important; background: #ffffff !important; }

    /* ── User list item ── */
    .user-item { transition: all .2s ease; border-left: 3px solid transparent; }
    .user-item:hover { background-color: #f8f9fa; border-left-color: #8BC905; }

    /* ── Scrollbar ── */
    .user-list-container::-webkit-scrollbar { width: 8px; }
    .user-list-container::-webkit-scrollbar-track { background: #f1f1f1; }
    .user-list-container::-webkit-scrollbar-thumb { background: #8BC905; border-radius: 4px; }
    .user-list-container::-webkit-scrollbar-thumb:hover { background: #7AB805; }

    /* ── Checkboxes ── */
    .form-check-input:checked { background-color: #8BC905 !important; border-color: #8BC905 !important; }
    .form-check-input:focus { border-color: #8BC905 !important; box-shadow: 0 0 0 .25rem rgba(139,201,5,.25) !important; }

    /* ── Send button ── */
    #sendButton { background: linear-gradient(145deg,#8BC905,#7AB805) !important; color: #ffffff !important; border: none !important; }
    #sendButton:disabled { background: #e9ecef !important; color: #6c757d !important; cursor: not-allowed !important; opacity: .65; }

    /* ── Country quick buttons ── */
    .country-quick-btn { font-size:.75rem; padding:.25rem .65rem; border-radius:20px; border:1px solid #d1d5db; background:#fff; color:#374151; cursor:pointer; transition:all .15s; }
    .country-quick-btn:hover, .country-quick-btn.active { background:#8BC905; color:#0C3A30; border-color:#8BC905; }

    /* ── Loading spinner ── */
    .btn-loading { position:relative; pointer-events:none; }
    .btn-loading::after { content:""; position:absolute; width:16px; height:16px; top:50%; left:50%; margin:-8px 0 0 -8px; border:2px solid transparent; border-top-color:currentColor; border-radius:50%; animation:spinner .6s linear infinite; }
    @keyframes spinner { to { transform: rotate(360deg); } }
</style>

<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="fw-bold mb-1" style="color:#0C3A30;">Send Message to Users</h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="ri-check-circle-line me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('admin.send.message') }}" method="POST" id="messageForm">
                @csrf
                <div class="row g-4">

                    {{-- ── USER SELECTION ── --}}
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0 fw-semibold" style="color:#0C3A30;"><i class="ri-user-3-line me-2"></i>Select Recipients</h5>
                                    <span class="badge bg-light text-dark border" id="selectedCount">0 selected</span>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                {{-- Country filter --}}
                                <div class="p-3 border-bottom" style="background:#f8f9fa;">
                                    <label class="form-label fw-semibold mb-2" style="color:#0C3A30;"><i class="ri-earth-line me-1"></i>Filter by Country</label>
                                    <select class="form-select text-gray-800" id="countryFilter">
                                        <option value="">All Countries</option>
                                        @php $countries = \App\Models\User::distinct()->orderBy('country')->pluck('country'); @endphp
                                        @foreach($countries as $country)
                                            @if($country)<option value="{{ $country }}">{{ $country }}</option>@endif
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @php $topCountries = \App\Models\User::select('country')->selectRaw('count(*) as total')->whereNotNull('country')->groupBy('country')->orderBy('total','desc')->limit(5)->get(); @endphp
                                        @foreach($topCountries as $cd)
                                            @if($cd->country)<button type="button" class="country-quick-btn" data-country="{{ $cd->country }}">{{ $cd->country }} ({{ $cd->total }})</button>@endif
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Select all --}}
                                <div class="p-3 border-bottom" style="background:#f8f9fa;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll" style="cursor:pointer; width:18px; height:18px;">
                                        <label class="form-check-label fw-semibold ms-2" for="selectAll" style="cursor:pointer; color:#111827;">Select All Users</label>
                                    </div>
                                </div>

                                {{-- Search --}}
                                <div class="p-3 border-bottom">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="ri-search-line text-muted"></i></span>
                                        <input type="text" class="form-control border-start-0 ps-0 text-gray-800" id="searchUsers" placeholder="Search users...">
                                    </div>
                                </div>

                                {{-- Users list --}}
                                <div class="user-list-container" style="max-height:400px; overflow-y:auto;">
                                    @foreach(\App\Models\User::all() as $u)
                                    <div class="user-item p-3 border-bottom" data-user-name="{{ strtolower($u->name) }}" data-user-email="{{ strtolower($u->email) }}" data-user-country="{{ $u->country ?? 'Not Set' }}">
                                        <div class="form-check">
                                            <input class="form-check-input user-checkbox" type="checkbox" name="users[]" value="{{ $u->id }}" id="user{{ $u->id }}"
                                                @if(old('users') && in_array($u->id, old('users'))) checked @endif
                                                @if(auth()->id() == $u->id) checked @endif
                                                style="cursor:pointer; width:18px; height:18px;">
                                            <label class="form-check-label ms-2 w-100" for="user{{ $u->id }}" style="cursor:pointer;">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <div class="fw-semibold" style="color:#0C3A30;">{{ $u->name }}</div>
                                                        <small class="text-muted">{{ $u->email }}</small>
                                                        @if($u->country)<div class="mt-1"><span class="badge bg-info bg-opacity-10 text-info"><i class="ri-earth-line me-1"></i>{{ $u->country }}</span></div>@endif
                                                    </div>
                                                    @if(auth()->id() == $u->id)<span class="badge bg-success bg-opacity-10 text-success">You</span>@endif
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div id="noResults" class="p-4 text-center text-muted" style="display:none;"><i class="ri-search-line fs-1 mb-2"></i><p class="mb-0">No users found</p></div>

                                <div class="p-3 border-top bg-light">
                                    <button type="button" class="btn btn-success w-100" id="selectAllFromCountry" disabled>
                                        <i class="ri-checkbox-multiple-line me-2"></i><span id="countrySelectText">Select All from Selected Country</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── MESSAGE COMPOSITION ── --}}
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="mb-0 fw-semibold" style="color:#0C3A30;"><i class="ri-mail-line me-2"></i>Compose Message</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold" style="color:#0C3A30;">Message Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter message title..." value="{{ old('title') }}" required>
                                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label fw-semibold" style="color:#0C3A30;">Message Content <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="10" placeholder="Type your message here..." required>{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <small class="text-muted"><span id="charCount">0</span> characters</small>
                                </div>
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-lg px-5 fw-semibold text-white" id="sendButton">
                                        <i class="ri-send-plane-fill me-2"></i><span id="buttonText">Send Message</span>
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg px-4" id="resetButton">
                                        <i class="ri-refresh-line me-2"></i>Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 p-3 bg-light rounded border" id="translationPreview" style="display:none;">
                            <h6 class="fw-semibold mb-3" style="color:#0C3A30;"><i class="ri-translate-2 me-2"></i>Translation Preview</h6>
                            <div id="selectedCountriesList" class="mb-2"></div>
                            <p class="small text-muted mb-0"><i class="ri-information-line me-1"></i>Messages will be automatically translated to each user's native language.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
    const countryFilter = document.getElementById('countryFilter');
    const countryQuickBtns = document.querySelectorAll('.country-quick-btn');
    const selectAllFromCountry = document.getElementById('selectAllFromCountry');
    const countrySelectText = document.getElementById('countrySelectText');
    const translationPreview = document.getElementById('translationPreview');
    const selectedCountriesList = document.getElementById('selectedCountriesList');

    function updateSelectedCount() {
        const n = document.querySelectorAll('.user-checkbox:checked').length;
        selectedCountBadge.textContent = n + ' selected';
        const all = Array.from(userCheckboxes).every(c => c.checked);
        const some = Array.from(userCheckboxes).some(c => c.checked);
        selectAllCheckbox.checked = all;
        selectAllCheckbox.indeterminate = some && !all;
        updateTranslationPreview();
    }

    function filterUsers() {
        const term = searchInput.value.toLowerCase().trim();
        const country = countryFilter.value;
        let visible = 0;
        userItems.forEach(item => {
            const match = (!term || item.dataset.userName.includes(term) || item.dataset.userEmail.includes(term)) && (!country || item.dataset.userCountry === country);
            item.style.display = match ? 'block' : 'none';
            if (match) visible++;
        });
        selectAllFromCountry.disabled = !country;
        countrySelectText.textContent = country ? `Select All from ${country}` : 'Select All from Selected Country';
        countryQuickBtns.forEach(b => b.classList.toggle('active', b.dataset.country === country));
        noResults.style.display = visible === 0 ? 'block' : 'none';
    }

    selectAllFromCountry.addEventListener('click', () => {
        userItems.forEach(item => { if (item.style.display !== 'none') { const cb = item.querySelector('.user-checkbox'); if (cb) cb.checked = true; } });
        updateSelectedCount();
    });

    countryFilter.addEventListener('change', filterUsers);
    countryQuickBtns.forEach(b => b.addEventListener('click', () => { countryFilter.value = b.dataset.country; filterUsers(); }));
    selectAllCheckbox.addEventListener('change', function() {
        userItems.forEach(item => { if (item.style.display !== 'none') { const cb = item.querySelector('.user-checkbox'); if (cb) cb.checked = this.checked; } });
        updateSelectedCount();
    });
    userCheckboxes.forEach(cb => cb.addEventListener('change', updateSelectedCount));
    searchInput.addEventListener('input', filterUsers);
    messageTextarea.addEventListener('input', () => charCount.textContent = messageTextarea.value.length);
    charCount.textContent = messageTextarea.value.length;

    function updateTranslationPreview() {
        const checked = document.querySelectorAll('.user-checkbox:checked');
        const countries = new Set();
        const langMap = { 'Australia':'en','Canada':'en','United Kingdom':'en','United States':'en','Germany':'de','France':'fr','Spain':'es','Italy':'it','Brazil':'pt','Russia':'ru','China':'zh-CN','Japan':'ja','South Korea':'ko','India':'hi','Nigeria':'en','Saudi Arabia':'ar','United Arab Emirates':'ar','Turkey':'tr','Netherlands':'nl','Sweden':'sv','Norway':'no','Denmark':'da','Finland':'fi','Poland':'pl','Ukraine':'uk' };
        checked.forEach(cb => { const item = cb.closest('.user-item'); const c = item ? item.dataset.userCountry : null; if (c && c !== 'Not Set') countries.add(c); });
        if (countries.size > 0) {
            translationPreview.style.display = 'block';
            let html = '';
            countries.forEach(c => { const lang = langMap[c] || 'en'; html += `<span class="badge bg-success bg-opacity-10 text-success me-1 mb-1 p-2">🌐 ${c} (${lang})</span>`; });
            selectedCountriesList.innerHTML = html;
        } else { translationPreview.style.display = 'none'; }
    }

    form.addEventListener('submit', function(e) {
        if (!document.querySelectorAll('.user-checkbox:checked').length) { e.preventDefault(); alert('Please select at least one user.'); return false; }
        sendButton.disabled = true; sendButton.classList.add('btn-loading'); buttonText.textContent = 'Sending...'; resetButton.disabled = true;
    });

    resetButton.addEventListener('click', () => {
        setTimeout(() => { updateSelectedCount(); charCount.textContent='0'; searchInput.value=''; countryFilter.value=''; userItems.forEach(i => i.style.display='block'); noResults.style.display='none'; selectAllFromCountry.disabled=true; countrySelectText.textContent='Select All from Selected Country'; countryQuickBtns.forEach(b => b.classList.remove('active')); }, 10);
    });

    updateSelectedCount();
});
</script>
@endsection