<aside class="sidebar">
    <ul>
        <li> <a href="/kanban-board/{{ request()->route('project') }}"><i class="material-icons">view_kanban</i>Kanban Board</a></li>
        <li><a href="/create-task/{{ request()->route('project') }}"><i class="material-icons">assignment</i>Create Task</a></li>
        <li><a href="/backlog/{{ request()->route('project') }}"><i class="material-icons">format_list_bulleted</i>Backlog</a></li>
        <li><a href="/notifications/{{ request()->route('project') }}"><i class="material-icons">notifications</i>Notifications</a></li>
        <li><a href="/profile/{{ request()->route('project') }}"><i class="material-icons">account_circle</i>Profile</a></li>
    </ul>
</aside>