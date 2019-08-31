<div class="side-menu">
    <aside class="menu">
        <p class="menu-label">
            General
        </p>
        <ul class="menu-list">
            <li ><a class="menu-link {{ Nav::isRoute('manage.dashboard') }}" href="{{ route('manage.dashboard') }}">Dashboard</a></li>
        </ul>
        <p class="menu-label">
            Content
        </p>
        <ul class="menu-list">
            <li><a class="menu-link {{ Nav::isResource('posts') }}" href="{{ route('posts.index') }}">Blog Posts</a></li>
        </ul>
        <p class="menu-label">
            Administration
        </p>
        <ul class="menu-list">
            <li><a class="menu-link {{ Nav::isResource('users') }}" href="{{ route('users.index') }}">Manage Users</a></li>
            <li>
                <a class="has-submenu menu-link {{ Nav::hasSegment(['roles', 'permissions'], 2) }}" href="#">Roles &amp; Permissions</a>
                <ul class="submenu">
                    <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
