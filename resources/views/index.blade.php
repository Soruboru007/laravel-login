<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>INDEX</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 text-neutral-700">
    <main class="flex items-start justify-center w-full h-screen p-20">
        <section class="w-1/4 p-4 bg-white border rounded-lg shadow-lg border-neutral-300">
            <h1 class="text-2xl font-bold">さあ、テストをしよう😅</h1>
            <button type="button" onclick="window.location='{{ route('login') }}'"
                class="w-full px-4 py-2 mt-4 bg-white border rounded-md hover:text-neutral-100 hover:bg-neutral-700 border-neutral-700 hover:cursor-pointer">
                ログイン
            </button>
            <button type="button" onclick="window.location='{{ route('signup') }}'"
                class="w-full px-4 py-2 mt-4 bg-white border rounded-md hover:text-neutral-100 hover:bg-neutral-700 border-neutral-700 hover:cursor-pointer">
                登録
            </button>
        </section>
    </main>
    
</body>
