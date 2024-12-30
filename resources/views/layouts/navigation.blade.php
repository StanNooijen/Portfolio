<nav class="w-100 nav flex-row" x-data="{ open: false }">

    <div class="w-25 flex-row gap-1 p-1">
        <x-responsive-nav-link :href="route('dashboard')">
            {{ __('Dashboard') }}
        </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('profile.edit')">
            {{ __('Profile') }}
        </x-responsive-nav-link>
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                                   onclick="event.preventDefault();
                                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </form>
    </div>
</nav>
