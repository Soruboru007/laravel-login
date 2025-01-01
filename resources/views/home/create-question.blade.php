<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>問題作成</title>
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

            <!-- ホーム -->
            <button type="button" onclick="window.location='{{ route('home') }}'"
                class="w-32 px-2 bg-white border rounded-md hover:text-neutral-100 hover:bg-neutral-700 border-neutral-700 hover:cursor-pointer">
                ホーム
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
    <main class="grid w-1/3 h-full grid-flow-row p-20 mx-auto">

        <!-- Display Success Message -->
        @if (session('success'))
            <section class="p-4 mb-4 text-green-800 bg-green-200 rounded-md">
                {{ session('success') }}
            </section>
        @endif

        <section class="w-full p-4 bg-white border rounded-lg shadow-lg border-neutral-300">
            <h1 class="mb-4 text-2xl font-bold">問題作成</h1>

            <form action="{{ route('create-question') }}" method="POST" class="grid grid-flow-row gap-4">
                @csrf

                <select name="category_id"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">
                    <option>カテゴリを選択</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>

                <input type="text" name="question" placeholder="問題"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <input type="text" name="option_1" placeholder="オプション1"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <input type="text" name="option_2" placeholder="オプション2"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <input type="text" name="option_3" placeholder="オプション3"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <input type="text" name="option_4" placeholder="オプション4"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <input type="text" name="answer" placeholder="回答"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">

                <button type="submit"
                    class="w-full h-12 bg-white border rounded-md border-neutral-700 hover:bg-neutral-700 hover:text-neutral-100">
                    作成
                </button>
            </form>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-4 my-4 text-red-800 bg-red-200 rounded-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>
    </main>
</body>

</html>
