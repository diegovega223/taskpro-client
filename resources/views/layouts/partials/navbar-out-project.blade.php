    <header class="navbar">
        <div class="logo-mobile">
            <a href="/project"> <img src="{{ asset('img/taskpro.png') }}" alt="Logo" class="logo"></a>
        </div>
        <div class="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>

        <ul class="menu-list">
            <li class="notification-icon">
                <i class="fa-regular fa-bell"></i>
            </li>
            <li class="switch">
                <label class="switch-label">
                    <input type="checkbox" class="modoSwitch">
                    <span class="slider"></span>
                    <span class="modo-text left active">LIGHT</span>
                    <span class="modo-text right">DARK</span>
                </label>
            </li>
            <li>
                <a href="/logout">
                    <button class="log-out">
                        <span class="material-icons">
                            logout
                        </span>LOG OUT
                    </button>
                </a>
            </li>
            <li class="profile">
                <a href="/profile">
                    @if (request()->cookie('foto'))
                        <img src="{{ request()->cookie('foto') }}" alt="Profile Picture" class="profile-img">
                    @elseif (request()->cookie('name'))
                        <p>{{ ucfirst(substr(request()->cookie('name'), 0, 1)) }}</p>
                    @else
                    @endif
                </a>
            </li>
        </ul>
        </ul>
    </header>

    <div class="nav-menu">
        <ul>
            <li>
                <a href="/profile"> <span class="material-icons">account_circle</span> Porfile</a>
            </li>
            <li>
                <a href="/notifications"> <span class="material-icons">notifications_none</span>Notifications</a>
            </li>
            <li class="switch">
                <label class="switch-label">
                    <input type="checkbox" class="modoSwitch">
                    <span class="slider"></span>
                    <span class="modo-text left active">LIGHT</span>
                    <span class="modo-text right">DARK</span>
                </label>
            </li>
            <li class="log-out-mobile">
                <a href="login.html"><button class="log-out">
                        <span class="material-icons">
                            logout
                        </span>LOG OUT
                    </button></a>
            </li>
        </ul>
    </div>
