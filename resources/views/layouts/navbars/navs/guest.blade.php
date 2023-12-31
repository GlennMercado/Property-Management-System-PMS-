<nav class="navbar fixed-top navbar-horizontal navbar-expand-md" style="background-color: #30bc6c">
    <div class="container px-2">
        <img src="{{ asset('nvdcpics') }}/nvdc-logo.png" style="width: 50px; height: 50px; margin-right:1%;">
        <a class="navbar-brand" href="{{ url('/') }}">
            <h2 class="text-white">NVDC Properties</h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="ni ni-bullet-list-67 text-default"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-8 collapse-brand">
                        <a href="{{ url('/') }}">
                             <h3>NVDC Properties</h3>
                        </a>
                    </div>
                    <div class="col-4 collapse-close">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">

                        </button>
                    </div>
                </div>
            </div>
            <!-- Navbar items -->
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ url('/') }}">
                        <i class="bi bi-house-fill"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('Home') }}</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('WelcomeAboutUs') }}">
                        <i class="ni ni-single-02"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('About Us') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('WelcomeContactUs') }}">
                        <i class="bi bi-telephone-fill"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('Contact Us') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('WelcomeMap') }}">
                        <i class="ni ni-pin-3"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('Map') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('FAQs') }}">
                        <i class="bi bi-question-circle-fill"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('FAQs') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('login') }}">
                        <i class="ni ni-key-25"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('Login') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon text-white font-weight-bold" href="{{ route('register') }}">
                        <i class="bi bi-person-fill"></i>
                        <span class="nav-link-inner--text text-uppercase">{{ __('Sign Up') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    body{
        overflow-x: hidden;
    }
</style>