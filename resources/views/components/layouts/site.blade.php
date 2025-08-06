<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark text-zinc-800 dark:text-zinc-300">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-white antialiased dark:bg-linear-to-b dark:from-zinc-950 dark:to-zinc-900">
        <main class="max-w-2xl mx-auto px-8 py-24">
            {{ $slot }}
        </main>
        @fluxScripts
    </body>
</html>
