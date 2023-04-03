<div class="dropdown d-md-none topbar-head-dropdown header-item">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="bx bx-search fs-22"></i>
    </button>

</div>






<div class="dropdown" >
    <button style="background-color:#c0c0c0; border: none ; width: 110px" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      {{ __('site.language') }}
    </button>
    <ul class="dropdown-menu">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
            {{-- {{ $localeCode }} --}}
            {{-- @if ($localeCode == 'ar')
            <img width="20" src="{{ asset('adminassets/img/ps.png') }}" alt="">
            @else
            <img width="20" src="{{ asset('adminassets/img/uk.png') }}" alt="">
            @endif --}}
            <img width="20" src="{{ asset('adminassets/images/'.$properties['flag']) }}" alt="">
            {{ $properties['native'] }}
        </a>
    @endforeach

    </ul>
  </div>











<div class="ms-1 header-item d-none d-sm-flex">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
        <i class='bx bx-fullscreen fs-22'></i>
    </button>
</div>

<div class="ms-1 header-item d-none d-sm-flex">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
        <i class='bx bx-moon fs-22'></i>
    </button>
</div>





<div class="dropdown ms-sm-3 header-item topbar-user">
    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="d-flex align-items-center">
            <img class="rounded-circle header-profile-user" src="{{ Auth::guard(session('guardName'))->user()->image }}" alt="Header Avatar">
            <span class="text-start ms-xl-2">
                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->guard(session('guardName'))->user()->name }}</span>
                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{__('site.admin')}}</span>
            </span>
        </span>
    </button>
    <div class="dropdown-menu dropdown-menu-end">
        <!-- item-->
        <h6 class="dropdown-header">{{ __('site.welocme') }} {{ Auth::user()->name }}</h6>
        <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">{{ __('site.profile') }}</span></a>



        <div class="dropdown-divider"></div>



        <form action="{{ route('logout') }}" method="POST">
            @csrf
                <button class="dropdown-item"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> {{ __('site.logout') }}</button>
            </form>
    </div>
</div>
