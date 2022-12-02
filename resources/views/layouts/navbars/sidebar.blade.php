<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <h1 class="text-green">NOVADECI</h1>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img alt="Image placeholder" src="{{ asset('nvdcpics') }}/nvdc-logo.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <!--Dashboard-->
                <li class="nav-item">
                    <a class="nav-link text-default" href="{{ route('home') }}">
                    <i class="bi bi-palette text-success"></i> {{ __('Dashboard') }}
                    </a>
                </li>

                <!--Housekeeping-->
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-examples">
                        <i class="ni ni-tv-2 text-success"></i>
                        <span class="nav-link-text text-default">{{ __('Housekeeping') }}</span>
                    </a>
                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('Dashboard') }}">
                                    <i class="text-success">•</i> {{ __('Dashboard') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('RoomManagement') }}">
                                    <i class="text-success">•</i> {{ __('Room Management') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('Maintenance') }}">
                                    <i class="text-success">•</i> {{ __('Maintenance') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('LostandFound') }}">
                                    <i class="text-success">•</i> {{ __('Lost and Found') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                
                <!--Analytics-->
                <li class="nav-item">
                    <a class="nav-link text-default" href="{{ route('home') }}">
                        <i class="ni ni-chart-pie-35 text-success"></i> {{ __('Analytics') }}
                    </a>
                </li>
                
                <!--Back Office-->
                <li class="nav-item">
                    <a class="nav-link text-default" href="{{ route('BackOffice') }}">
                        <i class="ni ni-folder-17 text-success"></i> {{ __('Back Office') }}
                    </a>
                </li>

                <!--RDFM-->
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples2" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-examples3">
                        <i class="ni ni-tv-2 text-success"></i>
                        <span class="nav-link-text text-default">{{ __('RFDM') }}</span>
                    </a>
                    <div class="collapse" id="navbar-examples2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('EventInquiryForm') }}">
                                    <i class="text-success">•</i> {{ __('Event Inquiry Form') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('CommercialSpaceForm') }}">
                                    <i class="text-success">•</i> {{ __('Commercial Space Form') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('HotelReservationForm') }}">
                                    <i class="text-success">•</i> {{ __('Hotel Reservation Form') }}
                                </a>
                            </li>
                            </ul>
                    </div>
                </li>

                <!--Inventory Management-->
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples3" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-examples3">
                        <i class="bi bi-collection text-success"></i>
                        <span class="nav-link-text text-default">{{ __('Inventory Management') }}</span>
                    </a>
                    <div class="collapse" id="navbar-examples3">
                    <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('StockCount') }}">
                                    <i class="text-success">•</i> {{ __('Create Stock Count') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('StockAvailability') }}">
                                    <i class="text-success">•</i> {{ __('Stock Availability Report') }}
                                </a>
                            </li>

                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">                          
                                <a class="nav-link text-default" href="{{ route('StockPurchaseReport') }}">
                                    <i class="text-success">•</i> {{ __('Purchase Order Report') }}
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('StockReport') }}">
                                    <i class="text-success">•</i> {{ __('Stock Inventory Report ') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!--Guest Management-->
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples4" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="navbar-examples4">
                        <i class="bi bi-person text-success"></i>
                        <span class="nav-link-text text-default">{{ __('Guest Management') }}</span>
                    </a>
                    <div class="collapse" id="navbar-examples4">
                    <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('GuestTicket') }}">
                                    <i class="text-success">•</i> {{ __('Generate Ticket') }}
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-default" href="{{ route('GuestTicketManager') }}">
                                    <i class="text-success">•</i> {{ __('Guest Ticket Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
            <!-- Divider -->
            <hr class="my-3">

        </div>
    </div>
</nav>
