<!-- Navbar start -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm expand-header">
        <div class="header-left d-flex ">
            <div class="logo">
                <img src="/assets/images/logo2.jpg" class="logo-image" alt="logo">
                <span class="logo-text"> RK Tech</span>
            </div>
            <a href="#" class="sidebarCollapse " id="toggleSidebar" data-placement="bottom">
                <i class="bi bi-list"></i>
            </a>
            <i class="bi bi-arrows-fullscreen header-icon d-none d-sm-inline-block py-2" onClick="toggleFullScreen()"></i>
        </div>
        <div class="mx-auto">
            @yield('datefilter')
        </div>
        <ul class="navbar-item flex-row ms-auto">
            <!-- Notification section -->
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="#" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <p class="count purple-gradient">5</p>
                </a>
                <div class="dropdown-menu">
                    <div class="dp-main-menu">
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/img8.png" alt="" class="user-note">
                            <div class="note-info-dismis">
                                <div class="user-notify-info">
                                    <p class="note-name">{{__('en.Server Rebooted')}}</p>
                                    <p class="note-time">20 min ago</p>
                                </div>
                                <p href="#" class="status-link"><span><i class="bi bi-x"></i></span></p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/img9.png" alt="" class="user-note">
                            <div class="note-info-dismis">
                                <div class="user-notify-info">
                                    <p class="note-name">{{__('en.Stay Blessed')}}</p>
                                    <p class="note-time">22 min ago</p>
                                </div>
                                <p href="#" class="status-link"><span><i class="bi bi-x"></i></span></p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/img11.png" alt="" class="user-note">
                            <div class="note-info-dismis">
                                <div class="user-notify-info">
                                    <p class="note-name">{{__('en.Love your work')}}</p>
                                    <p class="note-time">25 min ago</p>
                                </div>
                                <p href="#" class="status-link"><span><i class="bi bi-x"></i></span></p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/img10.png" alt="" class="user-note">
                            <div class="note-info-dismis">
                                <div class="user-notify-info">
                                    <p class="note-name">{{__('en.Update required')}}</p>
                                    <p class="note-time">30 min ago</p>
                                </div>
                                <p href="#" class="status-link"><span><i class="bi bi-x"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Messages section -->
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="#" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
                    <i class="bi bi-envelope"></i>
                    <p class="count bg-clc">5</p>
                </a>
                <div class="dropdown-menu">
                    <div class="dp-main-menu">
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/user1.png" alt="" class="sms-user">
                            <div class="user-message-info">
                                <p class="m-user-name">User 1</p>
                                <p class="user-role">{{__('en.Super Admin')}}</p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/user2.png" alt="" class="sms-user">
                            <div class="user-message-info">
                                <p class="m-user-name">User 2</p>
                                <p class="user-role">{{__('en.Admin')}}</p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/user3.png" alt="" class="sms-user">
                            <div class="user-message-info">
                                <p class="m-user-name">User 3</p>
                                <p class="user-role">{{__('en.Co-Admin')}}</p>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item message-item">
                            <img src="/assets/images/user4.png" alt="" class="sms-user">
                            <div class="user-message-info">
                                <p class="m-user-name">User 4</p>
                                <p class="user-role">{{__('en.Writer')}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <!-- Profile section -->
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="#" class="nav-link user" id="Notify" data-bs-toggle="dropdown">
                    <i class="bi bi-gear"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="/assets/images/user3.png" alt="" class="img-fluid mr-2">
                            <div class="media-body">
                                <h5>Muhammad Uzair</h5>
                                <p>{{__('en.Super Admin')}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="dp-main-menu">
                        <a href="{{ route('user-profile-setting') }}" class="dropdown-item"><span><i
                                    class="bi bi-person-fill"></i></span>{{__('en.Profile')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            <span><i class="bi bi-box-arrow-left"></i></span>{{ __('en.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!-- Navbar End -->

