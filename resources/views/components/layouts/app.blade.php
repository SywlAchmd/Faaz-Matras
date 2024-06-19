<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>{{ $title ?? "Faaz Matraz" }}</title>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        @vite("resources/css/app.css")
        <livewire:styles />
    </head>
    <body class="min-h-screen bg-gray-300">
        @auth
            {{-- <div class="h- bg-red-400"> --}}
            {{ $slot }}
            {{-- </div> --}}
        @endauth

        @guest
            <div class="flex h-screen flex-col items-center justify-center">
                {{ $slot }}
            </div>
        @endguest
        <livewire:scripts />
    </body>
</html>
