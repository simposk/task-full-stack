<nav class="col-sm-2 sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{  preg_match('/\/(posts)[\/ | 0-9 |a-zA-Z]*/', request()->getRequestUri()) ? 'active' : '' }}" href="{{ route('posts.index') }}">Dashboard</a>
        </li>
        @if(Auth::user()->role == "admin" || Auth::user()->role == "developer")
            <li class="nav-item">
                <a class="nav-link {{  preg_match('/\/(users)[\/ | 0-9 |a-zA-Z]*/', request()->getRequestUri()) ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  preg_match('/\/(roles)[\/ | 0-9 |a-zA-Z]*/', request()->getRequestUri()) ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a>
            </li>
        @endif
    </ul>
</nav>
