@props([
    'livewire',
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament-panels::layout.direction') ?? 'ltr' }}"
    @class([
        'fi min-h-screen',
        'dark' => filament()->hasDarkModeForced(),
    ])
>
    <head>
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::head.start') }}

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        @if ($favicon = filament()->getFavicon())
            <link rel="icon" href="{{ $favicon }}" />
        @endif

        <title>
            {{ filled($title = strip_tags($livewire->getTitle())) ? "{$title} - " : null }}
            {{ filament()->getBrandName() }}
        </title>

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::styles.before') }}

        <style>
            [x-cloak=''],
            [x-cloak='x-cloak'],
            [x-cloak='1'] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak='-lg'] {
                    display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak='lg'] {
                    display: none !important;
                }
            }
        </style>

        @filamentStyles

        {{ filament()->getTheme()->getHtml() }}
        {{ filament()->getFontHtml() }}

        <style>
            :root {
                --font-family: '{!! filament()->getFontFamily() !!}';
                --sidebar-width: {{ filament()->getSidebarWidth() }};
                --collapsed-sidebar-width: {{ filament()->getCollapsedSidebarWidth() }};
            }
        </style>

        @stack('styles')

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::styles.after') }}

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const activeSidebarItem = document.querySelector('.fi-sidebar-item-active')
                    const sidebarWrapper = document.querySelector('.fi-sidebar-nav')

                    sidebarWrapper.scrollTo(0, activeSidebarItem.offsetTop - (window.innerHeight / 2))
                }, 0)
            })
        </script>

        @if (! filament()->hasDarkMode())
            <script>
                localStorage.setItem('theme', 'light')
            </script>
        @elseif (filament()->hasDarkModeForced())
            <script>
                localStorage.setItem('theme', 'dark')
            </script>
        @else
            <script>
                const theme = localStorage.getItem('theme') ?? @js(filament()->getDefaultThemeMode()->value)

                if (
                    theme === 'dark' ||
                    (theme === 'system' &&
                        window.matchMedia('(prefers-color-scheme: dark)')
                            .matches)
                ) {
                    document.documentElement.classList.add('dark')
                }
            </script>
        @endif
        <script>
            var checkSessionInterval = setInterval(function() {
                // Check if on login page
                if (window.location.href === 'http://localhost:8000/admin/login') {
                    clearInterval(checkSessionInterval); // Stop the interval
                    if (sessionStorage.getItem('loggedOut') === 'true') {
                        alert('You have been logged out.');
                        sessionStorage.removeItem('loggedOut'); // Clear the flag
                    }
                } else {
                    fetch('http://localhost:8000/admin/check-session')
                        .then(response => response.json())
                        .then(data => {
                            if (data.session_valid === false) {
                                sessionStorage.setItem('loggedOut', 'true'); // Set the flag
                                window.location.href = 'http://localhost:8000/admin/login';
                                clearInterval(checkSessionInterval); // Stop the interval
                            }
                        });
                }
            }, 10000);
        </script>
        

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::head.end') }}
    </head>

    <body
        class="fi-body fi-panel-{{ filament()->getId() }} min-h-screen bg-gray-50 font-normal text-gray-950 antialiased dark:bg-gray-950 dark:text-white"
    >
        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::body.start') }}

        {{ $slot }}

        @livewire(Filament\Livewire\Notifications::class)

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::scripts.before') }}

        @filamentScripts(withCore: true)

        @if (config('filament.broadcasting.echo'))
            <script data-navigate-once>
                window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                window.dispatchEvent(new CustomEvent('EchoLoaded'))
            </script>
        @endif

        @stack('scripts')

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::scripts.after') }}

        {{ \Filament\Support\Facades\FilamentView::renderHook('panels::body.end') }}
        
    </body>
</html>
