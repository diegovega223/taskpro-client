<header class="navbar">
    <div class="logo-mobile">
        <a href="/project"> <img src="img/taskpro.png" alt="Logo" class="logo"></a>
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
            <a href="logout">
                <button class="log-out">
                    <span class="material-icons">
                        logout
                    </span>LOG OUT
                </button>
            </a>
        </li>
        <ul>
            @php
                $validationData = json_decode(request()->cookie('validation'), true);
            @endphp
            <li class="profile">
                <p>{{ ucfirst(substr($validationData['name'], 0, 1)) }}</p>
            </li>
        </ul>
</header>
<div class="nav-menu">
    <ul>
        <li> <a href="kanban-board.html"><i class="material-icons">view_kanban</i>Kanban Board </a></li>
        <li><a href="create-task.html"><i class="material-icons">assignment</i>Create Task</a></li>
        <li><a href="backlog.html"><i class="material-icons">format_list_bulleted</i>Backlog</a></li>
        <li>
            <a href="profile.html"> <span class="material-icons">account_circle</span> Profile</a>
        </li>
        <li><a href="notifications.html"> <span class="material-icons">notifications_none</span> Notifications</a>
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
