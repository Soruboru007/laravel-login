<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>HOME</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-50 text-neutral-700">
    <header class="flex justify-end h-16 px-5 py-2 border border-b-neutral-200">
        <form action="{{ route('logout') }}" method="POST" class="flex items-center justify-end w-full h-full">
            @csrf

            <button type="submit"
                class="w-24 h-full bg-white border rounded-md border-neutral-700 hover:text-neutral-100 hover:bg-neutral-700">
                <h2>ログアウト</h2>
            </button>
        </form>
    </header>
    <main class="flex items-start justify-center w-full h-screen p-20">
        <section class="w-1/4 p-4 bg-white border rounded-lg shadow-lg border-neutral-300">
            <strong>Username:</strong> {{ $user->username }}
            <br>
            <strong>Email:</strong> {{ $user->email }}
        </section>
    </main>
</body>

</html>
