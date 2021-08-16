<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-1 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Funny Movies') }}
                    </x-nav-link>
                </div>
            </div>
            @if (Auth::user() != null)
                <!-- Login Form -->
                <div class="hidden sm:flex sm:items-center sm:ml-5 float-right">
                    <div class="w-full max-w-2xl">
                      <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-auto px-3 mt-3">
                            <strong>Welcome: </strong><span>{{ Auth::user()->email }}</span>
                        </div>
                        <div class="w-full md:w-auto px-3 mt-2">
                            <a href="{{ route('movies.create') }}" id="share-movie-btn" class="g-white hover:bg-gray-100 text-gray-800 py-2 px-4  font-semibold btn border border-gray-400 rounded shadow">
                              Share a movies
                            </a>
                        </div>
                        <div class="w-full md:w-auto px-3 mt-2">
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                                <a class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 btn border border-gray-400 rounded shadow" id="logoutBtn" href="#">
                                  Logout
                                </a>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
            @else
                <div class="hidden sm:flex sm:items-center sm:ml-5 user-navigation-box">
                    <form method="POST" action="{{ route('login') }}" class="w-full max-w-2xl">
                        @csrf
                      <div class="flex flex-wrap -mx-3">
                        <div class="w-full md:w-1/3 px-3">
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white" id="email" type="text" name="email" placeholder="Email">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" id="password" type="password" placeholder="Password">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                              Login / Register
                            </button>
                        </div>
                      </div>
                    </form>
                </div>
            @endif
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Funny Movies') }}
            </x-responsive-nav-link>
        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">Auth::user()->name </div>
                <div class="font-medium text-sm text-gray-500">Auth::user()->email</div>
            </div>

            <div class="mt-3 space-y-1">
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
        </div>
    </div>
</nav>
@push('footer_scripts')
    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function(e) {
                e.preventDefault();
                $('#logout-form').submit();
            });
        });
    </script>
@endpush