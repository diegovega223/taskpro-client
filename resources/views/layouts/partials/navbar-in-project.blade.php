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
            <a href="/profile/{{ request()->route('project') }}">
                @if (request()->cookie('foto'))
                    <img src="{{ request()->cookie('foto') }}" alt="Profile Picture" class="profile-img">
                @elseif (request()->cookie('name'))
                    <p>{{ ucfirst(substr(request()->cookie('name'), 0, 1)) }}</p>
                @else
                @endif
            </a>
        </li>
    </ul>
</header>
<div class="nav-menu">
    <ul>
        <li> <a href="/kanban-board/{{ request()->route('project') }}"><i class="material-icons">view_kanban</i>Kanban
                Board </a></li>
        <li><a href="/create-task/{{ request()->route('project') }}"><i class="material-icons">assignment</i>Create
                Task</a></li>
        <li><a href="/backlog/{{ request()->route('project') }}"><i
                    class="material-icons">format_list_bulleted</i>Backlog</a></li>
        <li>
            <a href="/profile/{{ request()->route('project') }}"> <span class="material-icons">account_circle</span>
                Profile</a>
        </li>
        <li><a href="/notifications/{{ request()->route('project') }}"> <span
                    class="material-icons">notifications_none</span> Notifications</a>
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
            <a href="/logout"><button class="log-out">
                    <span class="material-icons">
                        logout
                    </span>LOG OUT
                </button></a>
        </li>
    </ul>
</div>
