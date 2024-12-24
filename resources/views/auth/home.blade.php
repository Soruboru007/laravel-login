<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>HOME</title>
    <!-- Laravel/Viteでビルドしたapp.css/app.jsを読み込み -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-50 text-neutral-700">

    <!-- ヘッダー（ログアウトボタン） -->
    <header class="flex justify-end items-center h-16 px-5 border-b border-neutral-200">
        <form action="{{ route('logout') }}" method="POST" class="flex items-center h-full">
            @csrf
            <button
                type="submit"
                class="w-24 h-10 bg-white border border-neutral-700 rounded-md hover:text-neutral-100 hover:bg-neutral-700"
            >
                ログアウト
            </button>
        </form>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex items-start justify-center w-full min-h-screen pt-12">
        @if ($user)
            <section class="w-11/12 sm:w-1/2 md:w-1/3 lg:w-1/4 p-6 bg-white border border-neutral-300 rounded-lg shadow-lg">
                <h1 class="text-xl font-bold mb-4">ユーザー情報</h1>

                <p class="mb-2"><strong>Id:</strong> {{ $user->id }}</p>
                <p class="mb-2"><strong>Username:</strong> {{ $user->username }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="mb-2"><strong>Created at:</strong> {{ $user->created_at }}</p>
                <p class="mb-4"><strong>Updated at:</strong> {{ $user->updated_at }}</p>

                <div class="flex justify-end">
                    <!-- 必要があれば追加ボタンやリンクを設置する -->
                </div>
            </section>
        @else
            <div class="text-center">
                <p>ログインしていません。</p>
            </div>
        @endif
    </main>

</body>
</html>
