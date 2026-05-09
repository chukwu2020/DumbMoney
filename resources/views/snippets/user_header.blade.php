@php

use App\Models\WithdrawalCard;

$user = auth()->user();

$cardExists = auth()->check()
    ? WithdrawalCard::where('user_id', auth()->id())->exists()
    : false;

/*
|--------------------------------------------------------------------------
| PROFILE IMAGE — resolves filename stored in DB to a public URL
| Handles: "image.png", "uploads/profile_pics/image.png", full URLs
|--------------------------------------------------------------------------
*/

$profilePic = $user->profile->profile_pic ?? null;

$initials = collect(explode(' ', $user->name))
    ->map(fn($word) => strtoupper(substr($word, 0, 1)))
    ->take(2)
    ->join('') ?: 'U';

$profileUrl = null;

if ($profilePic) {
    if (filter_var($profilePic, FILTER_VALIDATE_URL)) {
        // Already a full URL (legacy records)
        $profileUrl = $profilePic;
    } else {
        // Strip any path prefix — always just serve from uploads/profile_pics/
        $profileUrl = asset('uploads/profile_pics/' . basename($profilePic));
    }
}

@endphp

<header class="main-header">

    <style>

        .main-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background: #fffaeb;
            z-index: 1100;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        body {
            padding-top: 80px;
        }

        .header-content {
            height: 100%;
            padding: 0 1.2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        /* =========================
           LEFT CONTROLS
        ========================== */

        .left-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =========================
           RIGHT CONTROLS
        ========================== */

        .right-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* =========================
           MOBILE HAMBURGER
        ========================== */

        .mobile-hamburger {
            width: 58px !important;
            height: 58px !important;
            border: none;
            outline: none;
            border-radius: 20px;
            cursor: pointer;
            position: relative;
            overflow: hidden;

            display: flex;
            align-items: center;
            justify-content: center;

            background: transparent;

            transition: all 0.3s ease;
        }

        .mobile-hamburger::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mobile-hamburger:hover::before {
            opacity: 1;
        }

        .mobile-hamburger:hover {
            transform: translateY(-2px) scale(1.03);
        }

        .mobile-hamburger.active {
            background: linear-gradient(135deg, #9EDD05 0%, #84cc16 100%);
        }

        .mobile-hamburger iconify-icon {
            font-size: 50px !important;
            color: #9EDD05 !important;
            transition: all 0.35s ease;
            z-index: 2;
        }

        .mobile-hamburger.active iconify-icon {
            color: #0C3A30 !important;
            transform: rotate(180deg) scale(1.08);
        }

        /* =========================
           DISCORD BUTTON
        ========================== */

        .discord-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #5865F2;
            color: white !important;
            text-decoration: none;

            transition: all 0.25s ease;
        }

        .discord-btn:hover {
            background: #4752c4;
            transform: translateY(-2px) scale(1.03);
        }

        .discord-btn iconify-icon {
            font-size: 22px;
            color: white !important;
        }

        /* =========================
           PROFILE AVATAR
        ========================== */

        .profile-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;

            border: 2px solid #9EDD05;

            transition: all 0.25s ease;

            box-shadow:
                0 6px 16px rgba(158, 221, 5, 0.20);
        }

        .profile-avatar:hover {
            transform: scale(1.05);
        }

        .profile-initials {
            width: 48px;
            height: 48px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #9EDD05;
            color: #0C3A30;

            font-weight: 700;
            font-size: 15px;

            border: 2px solid #9EDD05;

            transition: all 0.25s ease;

            box-shadow:
                0 6px 16px rgba(158, 221, 5, 0.20);
        }

        .profile-initials:hover {
            transform: scale(1.05);
        }

        /* =========================
           DROPDOWN
        ========================== */

        .dropdown-menu-custom {
            position: absolute;
            right: 0;
            top: calc(100% + 12px);

            width: 190px;

            background: white;

            border-radius: 18px;

            padding: 10px;

            border: 1px solid #ececec;

            box-shadow:
                0 18px 35px rgba(0, 0, 0, 0.10);

            z-index: 999;
        }

        .dropdown-header {
            font-size: 13px;
            font-weight: 700;
            color: #0C3A30;

            text-align: center;

            padding-bottom: 10px;
            margin-bottom: 10px;

            border-bottom: 1px solid #eee;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;

            padding: 12px;

            border-radius: 12px;

            text-decoration: none;

            color: #374151;

            transition: all 0.2s ease;

            font-size: 14px;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #9EDD05;
            color: #0C3A30;
        }

        .dropdown-divider {
            height: 1px;
            background: #eee;
            margin: 8px 0;
        }

        .logout-item {
            background: #e97676;
            color: #dc2626;
        }

        .logout-item:hover {
            background: #dc2626;
            color: white;
        }

        /* =========================
           HIDE HAMBURGER ON DESKTOP
        ========================== */

        @media (min-width: 1024px) {

            .mobile-hamburger {
                display: none !important;
            }
        }

        /* =========================
           MOBILE RESPONSIVE
        ========================== */

        @media (max-width: 768px) {

            .header-content {
                padding: 0 0.9rem;
            }

            .mobile-hamburger {
                width: 54px !important;
                height: 54px !important;
                border-radius: 18px;
            }

            .mobile-hamburger iconify-icon {
                font-size: 40px !important;
            }

            .discord-btn,
            .profile-avatar,
            .profile-initials {
                width: 42px;
                height: 42px;
            }

            .discord-btn iconify-icon {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {

            .right-controls {
                gap: 8px;
            }

            .dropdown-menu-custom {
                width: 175px;
                right: -5px;
            }
        }

    </style>

    <div class="header-content">

        {{-- LEFT --}}
        <div class="left-controls">

            <button class="sidebar-mobile-toggle mobile-hamburger">

                <iconify-icon
                    icon="heroicons:bars-3-solid">
                </iconify-icon>

            </button>

        </div>

        {{-- RIGHT --}}
        <div class="right-controls">

            {{-- DISCORD --}}
            <a href="https://discord.gg/dumbmoney"
                target="_blank"
                class="discord-btn"
                rel="noopener noreferrer">

                <iconify-icon
                    icon="ic:baseline-discord">
                </iconify-icon>

            </a>

            {{-- PROFILE --}}
            <div x-data="{ open: false }" class="relative">

                <button
                    @click="open = !open"
                    class="focus:outline-none rounded-full overflow-hidden cursor-pointer">

                    @if($profileUrl)

                        <img
                            src="{{ $profileUrl }}"
                            alt="{{ $user->name }}"
                            class="profile-avatar"
                            loading="lazy"

                            onerror="
                                this.style.display='none';
                                document.getElementById('headerProfileFallback').style.display='flex';
                            "
                        >

                        <div
                            id="headerProfileFallback"
                            class="profile-initials"
                            style="display:none;">

                            {{ $initials }}

                        </div>

                    @else

                        <div class="profile-initials">

                            {{ $initials }}

                        </div>

                    @endif

                </button>

                {{-- DROPDOWN --}}
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="dropdown-menu-custom">

                    <div class="dropdown-header">
                        My Account
                    </div>

                    <a
                        href="{{ route('profile.show') }}"
                        class="dropdown-item">

                        <iconify-icon
                            icon="solar:user-linear"
                            style="font-size: 1.2rem;">
                        </iconify-icon>

                        Profile Settings

                    </a>

                    <div class="dropdown-divider"></div>

                    <a
                        href="{{ route('signout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item logout-item">

                        <iconify-icon
                            icon="lucide:power"
                            style="font-size: 1.2rem;">
                        </iconify-icon>

                        Logout

                    </a>

                    <form
                        id="logout-form"
                        method="POST"
                        action="{{ route('signout') }}"
                        style="display:none;">

                        @csrf

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>

<script>

const sidebarBtn = document.querySelector('.sidebar-mobile-toggle');

const sidebar = document.querySelector('.sidebar');

const menuIcon = sidebarBtn?.querySelector('iconify-icon');

sidebarBtn?.addEventListener('click', function() {

    sidebar?.classList.toggle('open');

    const isOpen = sidebar?.classList.contains('open');

    sidebarBtn.classList.toggle('active', isOpen);

    if (isOpen) {

        menuIcon.setAttribute(
            'icon',
            'heroicons:x-mark-solid'
        );

    } else {

        menuIcon.setAttribute(
            'icon',
            'heroicons:bars-3-solid'
        );

    }

});

</script>