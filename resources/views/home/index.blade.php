<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>HOME</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-50 text-neutral-700">
    <header class="flex justify-end h-16 px-5 py-2 border border-b-neutral-200">
        <div class="grid grid-cols-[1fr,8rem,8rem] gap-4">

            <!-- ユーザー -->
            <div class="flex items-center justify-center w-full">
                <img src="{{ asset('images/profile.jpg') }}" alt="プロフィール画像" class="w-12 h-12 mr-2 rounded-full" />
                {{ $user->username }}さん
            </div>

            <!-- カテゴリ作成 -->
            <button type="button" onclick="window.location='{{ route('create-category') }}'"
                class="w-32 px-2 bg-white border rounded-md hover:text-neutral-100 hover:bg-neutral-700 border-neutral-700 hover:cursor-pointer">
                カテゴリ作成
            </button>

            <!-- ログアウト -->
            <form action="{{ route('logout') }}" method="POST" class="flex items-center justify-end w-full h-full">
                @csrf

                <button type="submit"
                    class="w-32 h-full bg-white border rounded-md border-neutral-700 hover:text-neutral-100 hover:bg-neutral-700">
                    <h2>ログアウト</h2>
                </button>
            </form>
        </div>
    </header>
    <main class="grid w-full grid-cols-3 gap-12 px-40 py-20">
        @foreach ($categories as $category)
            <a href="{{ route('get-questions', ['category_id' => $category->id]) }}"
                class="w-full p-4 transition-transform duration-300 bg-white border rounded-lg shadow-lg h-52 border-neutral-300 hover:cursor-pointer hover:scale-105">
                <h1 class="text-3xl font-bold">{{ $category->category_name }}</h1>
            </a>
        @endforeach
    </main>
</body>

</html>
