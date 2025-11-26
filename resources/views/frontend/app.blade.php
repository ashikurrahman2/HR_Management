<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Management | @yield('title')</title>
    @include('frontend.layouts.style')
</head>
<body>

    @include('frontend.layouts.header')

    <div class="main-content">
        @yield('content')
    </div>

    <!-- Bottom Navigation with Active State -->
    @php
        $currentRoute = Route::currentRouteName();
    @endphp

    <div class="bottom-nav">
        <a href="{{ route('dashboard') }}" 
           class="nav-item {{ $currentRoute === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>হোম</span>
        </a>

        <a href="{{ route('list.works') }}" 
           class="nav-item {{ $currentRoute === 'list.works' ? 'active' : '' }}">
            <i class="fas fa-users"></i>
            <span>কর্মচারী</span>
        </a>

        <a href="{{ route('list.salary') }}" 
           class="nav-item {{ $currentRoute === 'list.salary' ? 'active' : '' }}">
            <i class="fas fa-money-bill-wave"></i>
            <span>বেতন</span>
        </a>

        <a href="{{ route('attendance.list') }}"   class="nav-item {{ $currentRoute === 'attendance.list' ? 'active' : '' }}">
            <i class="fas fa-clock"></i>
            <span>উপস্থিতি</span>
        </a>

             <a href="{{ route('over.time') }}"   class="nav-item {{ $currentRoute === 'over.time' ? 'active' : '' }}">
            <i class="fas fa-clock"></i>
            <span>ওভারটাইম হিসাব</span>
        </a>

        <!-- আরও মেনু -->
        {{-- <div class="nav-item more-menu-wrapper"> --}}
            {{-- <a href="#" class="nav-item" id="moreBtn">
                <i class="fas fa-bars"></i>
                <span>আরও</span>
            </a> --}}
            {{-- <div class="more-dropdown" id="moreDropdown"> --}}
                {{-- <a href="#" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> ইন/আউট টাইম লগ</a> --}}
                {{-- <a href="#" class="dropdown-item"><i class="fas fa-clock"></i> ওভারটাইম হিসাব</a> --}}
                {{-- <a href="#" class="dropdown-item"><i class="fas fa-calendar-alt"></i> টাইমশীট ভিউ</a> --}}
                {{-- <a href="#" class="dropdown-item"><i class="fas fa-list-ul"></i> ছুটির আবেদন</a> --}}
               {{-- <a href="javascript:void(0)" class="dropdown-item" onclick="document.getElementById('logout-form').submit()">
    <i class="fas fa-sign-in-alt"></i> লগ আউট
</a> --}}

{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    </div>

    <div class="more-overlay" id="moreOverlay"></div>

    @include('frontend.layouts.script')
</body>
</html>