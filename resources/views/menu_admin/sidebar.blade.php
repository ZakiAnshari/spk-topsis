<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="d-flex align-items-center text-decoration-none">
            <span class="app-brand-logo">
                <!-- Simple Circle Logo with "H" -->
                <svg width="50" height="50" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <!-- Bulatan -->
                    <circle cx="50" cy="50" r="48" fill="#696cff" />
                    <!-- Huruf H -->
                    <text x="50%" y="55%" text-anchor="middle" fill="#ffffff" font-size="48"
                        font-family="Arial, sans-serif" font-weight="bold" dominant-baseline="middle">
                        F
                    </text>
                </svg>
            </span>
            <span class="app-brand-text fw-bold ms-4 fs-4 text-dark">Fantasi</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <!-- Digital Clock -->

    <div class="menu-inner-shadow"></div>
    <hr>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (auth()->check() && auth()->user()->role_id == 1)
            {{-- Alternatif Merek Hp --}}
            <li class="menu-item {{ Request::is('alternatif*') ? 'active' : '' }}">
                <a href="/alternatif" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-mobile"></i>
                    <div data-i18n="kriteria">Alternatif</div>
                </a>
            </li>
        @endif

        {{-- Kriteria --}}
        @if (auth()->check() && auth()->user()->role_id == 1)
            <li class="menu-item {{ Request::is('kriteria*') ? 'active' : '' }}">
                <a href="/kriteria" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-slider-alt"></i>
                    <div data-i18n="kriteria">Kriteria</div>
                </a>
            </li>
        @endif




        {{-- PENILAIAN --}}
        @if (auth()->check() && auth()->user()->role_id == 1)
            <li class="menu-item {{ Request::is('penilaian*') ? 'active' : '' }}">
                <a href="/penilaian" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                    <div data-i18n="Penilaian">Penilaian</div>
                </a>
            </li>
        @endif



        {{-- HITUNG --}}
        <li class="menu-item {{ Request::is('perhitungan*') ? 'active' : '' }}">
            <a href="/perhitungan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calculator"></i>
                <div data-i18n="Perhitungan">Hitung</div>
            </a>
        </li>
        {{-- //Hasil Akhir --}}



        @if (auth()->check() && auth()->user()->role_id == 1)
            {{-- ADMIN --}}
            <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
                <a href="/user" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-circle"></i>
                    <div data-i18n="Analytics">Hak Akses</div>
                </a>
            </li>
        @endif


    </ul>
</aside>
