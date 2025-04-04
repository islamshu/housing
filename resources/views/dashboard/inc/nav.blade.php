<body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu"
    data-col="2-columns">
    <!-- fixed-top-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="{{ route('dashboard') }}">
                            <img class="brand-logo" alt="modern admin logo"
                                src="https://madares-abqary.com/uploads/site_logo/7KlIYLEG6UbFTU8N08bl2UR0uwhliCilmAbT9IB9.png" width="40" height="40">
                            <h3 class="brand-text">المساكن</h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                                class="la la-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                      
                        {{-- <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#"
                                data-toggle="dropdown">Mega</a>
                            <ul class="mega-dropdown-menu dropdown-menu row">
                                <li class="col-md-2">
                                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="la la-newspaper-o"></i> News</h6>
                                    <div id="mega-menu-carousel-example">
                                        <div>
                                            <img class="rounded img-fluid mb-1"
                                                src="{{ asset('/app-assets/images/slider/slider-2.png') }}"
                                                alt="First slide"><a class="news-title mb-0" href="#">Poster
                                                Frame PSD</a>
                                            <p class="news-content">
                                                <span class="font-small-2">January 26, 2018</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-3">
                                    <h6 class="dropdown-menu-header text-uppercase"><i class="la la-random"></i> Drill
                                        down menu</h6>
                                    <ul class="drilldown-menu">
                                        <li class="menu-list">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="layout-2-columns.html"><i
                                                            class="ft-file"></i> Page layouts & Templates</a>
                                                </li>
                                                <li><a href="#"><i class="ft-align-left"></i> Multi level
                                                        menu</a>
                                                    <ul>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="la la-bookmark-o"></i> Second level</a></li>
                                                        <li><a href="#"><i class="la la-lemon-o"></i> Second
                                                                level menu</a>
                                                            <ul>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-heart-o"></i> Third level</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-file-o"></i> Third level</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-trash-o"></i> Third level</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="la la-clock-o"></i> Third level</a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="la la-hdd-o"></i> Second level, third
                                                                link</a></li>
                                                        <li><a class="dropdown-item" href="#"><i
                                                                    class="la la-floppy-o"></i> Second level, fourth
                                                                link</a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="color-palette-primary.html"><i
                                                            class="ft-camera"></i> Color palette system</a>
                                                </li>
                                                <li><a class="dropdown-item" href="sk-2-columns.html"><i
                                                            class="ft-edit"></i> Page starter kit</a></li>
                                                <li><a class="dropdown-item" href="changelog.html"><i
                                                            class="ft-minimize-2"></i> Change log</a></li>
                                                <li>
                                                    <a class="dropdown-item" href="https://pixinvent.ticksy.com/"><i
                                                            class="la la-life-ring"></i> Customer support center</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-md-3">
                                    <h6 class="dropdown-menu-header text-uppercase"><i class="la la-list-ul"></i>
                                        Accordion</h6>
                                    <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                                        <div class="card border-0 box-shadow-0 collapse-icon accordion-icon-rotate">
                                            <div class="card-header p-0 pb-2 border-0" id="headingOne"
                                                role="tab"><a data-toggle="collapse" data-parent="#accordionWrap"
                                                    href="#accordionOne" aria-expanded="true"
                                                    aria-controls="accordionOne">Accordion Item #1</a></div>
                                            <div class="card-collapse collapse show" id="accordionOne"
                                                role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                                                <div class="card-content">
                                                    <p class="accordion-text text-small-3">Caramels dessert chocolate
                                                        cake pastry jujubes bonbon.
                                                        Jelly wafer jelly beans. Caramels chocolate cake liquorice
                                                        cake wafer jelly beans croissant apple pie.</p>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-2 border-0" id="headingTwo"
                                                role="tab"><a class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordionWrap" href="#accordionTwo"
                                                    aria-expanded="false" aria-controls="accordionTwo">Accordion Item
                                                    #2</a></div>
                                            <div class="card-collapse collapse" id="accordionTwo" role="tabpanel"
                                                aria-labelledby="headingTwo" aria-expanded="false">
                                                <div class="card-content">
                                                    <p class="accordion-text">Sugar plum bear claw oat cake chocolate
                                                        jelly tiramisu
                                                        dessert pie. Tiramisu macaroon muffin jelly marshmallow
                                                        cake. Pastry oat cake chupa chups.</p>
                                                </div>
                                            </div>
                                            <div class="card-header p-0 pb-2 border-0" id="headingThree"
                                                role="tab"><a class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordionWrap" href="#accordionThree"
                                                    aria-expanded="false" aria-controls="accordionThree">Accordion
                                                    Item #3</a></div>
                                            <div class="card-collapse collapse" id="accordionThree" role="tabpanel"
                                                aria-labelledby="headingThree" aria-expanded="false">
                                                <div class="card-content">
                                                    <p class="accordion-text">Candy cupcake sugar plum oat cake wafer
                                                        marzipan jujubes
                                                        lollipop macaroon. Cake dragée jujubes donut chocolate
                                                        bar chocolate cake cupcake chocolate topping.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-4">
                                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="la la-envelope-o"></i> Contact Us</h6>
                                    <form class="form form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label"
                                                    for="inputName1">Name</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <input class="form-control" type="text" id="inputName1"
                                                            placeholder="John Doe">
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-user"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label"
                                                    for="inputEmail1">Email</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <input class="form-control" type="email" id="inputEmail1"
                                                            placeholder="john@example.com">
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-envelope-o"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-control-label"
                                                    for="inputMessage1">Message</label>
                                                <div class="col-sm-9">
                                                    <div class="position-relative has-icon-left">
                                                        <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                                                        <div class="form-control-position pl-1"><i
                                                                class="la la-commenting-o"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 mb-1">
                                                    <button class="btn btn-info float-right" type="button"><i
                                                            class="la la-paper-plane-o"></i> Send </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li> --}}
                     
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown">
                                <span class="mr-1">{{ __('مرحبا') }},
                                    <span class="user-name text-bold-700">{{ auth()->user()->name }}</span>
                                </span>
                                <span class="avatar avatar-online profile-image">
                                    <img src="{{ asset('backend/default.png') }}"
                                        alt="avatar" ><i></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"><i
                                        class="ft-power"></i> {{ __('تسجيل خروج') }}</a>
                            </div>
                        </li>
                        {{-- <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                <i class="ficon ft-bell"></i>
                                <span class="badge badge-pill badge-default badge-danger badge-up badge-glow" id="notification-counter">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" id="notifications-container">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Notifications</span>
                                        <span class="notification-tag badge badge-danger float-right m-0" id="notification-count">
                                            {{ auth()->user()->unreadNotifications->count() }} New
                                        </span>
                                    </h6>
                                </li>
                                <li class="scrollable-container media-list" id="notifications-list">
                                    @foreach(auth()->user()->notifications as $notification)
                                        <li class="media">
                                            <div class="media-body">
                                                <h6 class="media-heading">{{ $notification->data['destination'] }}</h6>
                                                <p>{{ $notification->data['exit_time'] }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </li>
                                <li class="dropdown-menu-footer">
                                    <a class="dropdown-item text-muted text-center" href="#">Read all notifications</a>
                                </li>
                            </ul>
                        </li> --}}
                        
                        
                        {{-- <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-bell"></i>
                                <span
                                    class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">5</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Notifications</span>
                                    </h6>
                                    <span class="notification-tag badge badge-default badge-danger float-right m-0">5
                                        New</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">You have new order!</h6>
                                                <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor
                                                    sit amet, consectetuer elit.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">99% Server load</h6>
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt
                                                    mauris eu risus.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                                <p class="notification-text font-small-3 text-muted">Vestibulum auctor
                                                    dapibus neque.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Complete the task</h6>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last week</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-file icon-bg-circle bg-teal"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last month</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-mail"> </i></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">Messages</span>
                                    </h6>
                                    <span class="notification-tag badge badge-default badge-warning float-right m-0">4
                                        New</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-online rounded-circle">
                                                    <img src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-19.png') }}"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Margaret Govan</h6>
                                                <p class="notification-text font-small-3 text-muted">I like your
                                                    portfolio, let's start.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-busy rounded-circle">
                                                    <img src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-2.png') }}"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Bret Lezama</h6>
                                                <p class="notification-text font-small-3 text-muted">I have seen your
                                                    work, there is</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Tuesday</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-online rounded-circle">
                                                    <img src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-3.png') }}"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Carie Berra</h6>
                                                <p class="notification-text font-small-3 text-muted">Can we have call
                                                    in this week ?</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Friday</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left">
                                                <span class="avatar avatar-sm avatar-away rounded-circle">
                                                    <img src="{{ asset('backend/app-assets/images/portrait/small/avatar-s-6.png') }}"
                                                        alt="avatar"><i></i></span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Eric Alsobrook</h6>
                                                <p class="notification-text font-small-3 text-muted">We have project
                                                    party this saturday.</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">last month</time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all messages</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- ////////////////////////////////////////////////////////////////////////////-->