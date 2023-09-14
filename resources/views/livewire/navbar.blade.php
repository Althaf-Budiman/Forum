<div class="navbar bg-base-100 border-b border-b-gray-700 sticky top-0 z-50">

    <div class="navbar-start">
        <a href="{{ url('/') }}" class="btn btn-ghost normal-case text-xl">Forum</a>
    </div>

    <div class="navbar-end gap-6">
        @guest
            <a href="{{ url('/register') }}" class="btn btn-primary normal-case text-base">Register</a>
            <a href="{{ url('/login') }}" class="btn btn-secondary btn-outline normal-case text-base">Login</a>
        @else
            <div class="indicator">
                @if ($unreadNotifications->count() > 0)
                    <span class="indicator-item badge badge-sm badge-primary">{{ $unreadNotifications->count() }}</span>
                @endif
                <a href="{{ url('/notifications') }}"
                    class="bi {{ request()->is('notifications') ? 'bi-bell-fill' : 'bi-bell' }}"></a>
            </div>

            <a href="{{ url('/bookmarks') }}"
                class="bi {{ request()->is('bookmarks') ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></a>
            <button class="btn btn-secondary btn-outline normal-case text-base"
                onclick="document.getElementById('logout').submit()">Logout From {{ auth()->user()->name }}</button>
            <form action="{{ url('/logout') }}" method="post" id="logout">
                @csrf
            </form>
        @endguest
    </div>
</div>
