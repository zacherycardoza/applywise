<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              brand: {
                DEFAULT: '#2563eb',
                dark: '#1e40af',
              }
            }
          }
        }
      }
    </script>

    <script>
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
        function toggleTheme() {
            let html = document.documentElement
            if (html.classList.contains('dark')) {
                html.classList.remove('dark')
                localStorage.theme = 'light'
            } else {
                html.classList.add('dark')
                localStorage.theme = 'dark'
            }
        }
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    @if (request()->routeIs('landing'))
    <header class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center">
            <img src="{{ asset('favicon.png') }}" alt="Logo" class="w-6 h-6" />
            <a href="/" class="text-2xl font-bold pl-2">{{ config('app.name', 'ApplyWise') }}</a>
        </div>

        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login.index') }}"
                class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-800 text-gray-900 dark:text-gray-100 hover:bg-gray-300 dark:hover:bg-gray-700 font-semibold">
                Login
                </a>
                <a href="{{ route('register.index') }}"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 font-semibold">
                Register
                </a>
            @else
                <span class="text-gray-700 dark:text-gray-300">Hello, {{ Auth::user()->name }}</span>
                <a href="{{ route('dashboard') }}"
                class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-500 font-semibold">
                Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-500 font-semibold">
                        Logout
                    </button>
                </form>
            @endguest

            <!-- Dark Mode Toggle -->
            <button id="theme-toggle" class="ml-4 px-3 py-2 rounded bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200">
                🌙
            </button>
        </div>

    </header>
    @endif
<main>
    @yield('content')
</main>
</body>
<script>
    const toggle = document.getElementById('theme-toggle');
    const html = document.documentElement;

    function applyTheme(theme) {
        theme === 'dark' ? html.classList.add('dark') : html.classList.remove('dark');
        theme === 'dark' ? toggle.textContent = '☀️' : toggle.textContent = '🌙';
    }

    if (localStorage.getItem('theme')) applyTheme(localStorage.getItem('theme'));
    else window.matchMedia('(prefers-color-scheme: dark)').matches ? applyTheme('dark') : applyTheme('light');

    toggle.addEventListener('click', () => {
        html.classList.contains('dark') ? localStorage.setItem('theme', 'light') : localStorage.setItem('theme', 'dark');
        html.classList.contains('dark') ? applyTheme('light') : applyTheme('dark');
    });

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('theme')) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });
</script>
@stack('scripts')
</html>
