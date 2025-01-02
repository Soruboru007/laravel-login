<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>問題</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-50 text-neutral-700">
    <header class="sticky top-0 flex justify-end h-16 px-5 py-2 border border-b-neutral-200">
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
    <main class="flex items-start justify-center w-full h-screen p-2 xl:p-20">
        <section class="w-full p-4 bg-white border rounded-lg shadow-lg md:w-4/5 2xl:w-1/3 border-neutral-300">
            <h1 class="mb-4 text-2xl font-bold">{{ $category->category_name }}</h1>

            <form action="{{ route('save-answers', ['category_id' => $category->id]) }}" method="POST"
                class="grid grid-flow-row gap-4">
                @csrf

                @foreach ($questions as $question)
                    <!-- Question -->
                    <div class="py-2">

                        <!-- Display as raw HTML -->
                        <h2 class="mb-4 text-xl">{!! $question->question !!}</h2>

                        <ul class="w-full border rounded-md border-neutral-300">
                            @foreach ($question->options as $option)
                                <li class="w-full border-b border-neutral-300 hover:bg-neutral-100"
                                    onclick="document.getElementById('option_{{ $option }}').checked = true;">
                                    <div class="flex items-center p-2 cursor-pointer">
                                        <input id="option_{{ $option }}" type="radio" name="{{ $question->id }}"
                                            value="{{ $option }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 cursor-pointer focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            required>
                                        <label for="{{ $option }}"
                                            class="w-full py-3 text-sm font-medium text-gray-900 cursor-pointer ms-2 dark:text-gray-300">{{ $option }}</label>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                @endforeach

                <button type="submit"
                    class="w-full h-12 bg-white border rounded-md border-neutral-700 hover:bg-neutral-700 hover:text-neutral-100">
                    結果へ
                </button>

            </form>

        </section>
    </main>
</body>

</html>
