<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>SIGNUP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-50 text-neutral-700">
    <main class="grid w-1/3 h-full grid-flow-row p-20 mx-auto">
        <section class="w-full p-4 bg-white border rounded-lg shadow-lg border-neutral-300">
            <h1 class="mb-4 text-2xl font-bold">登録</h1>

            <form action="{{ route('signup') }}" method="POST" class="grid grid-flow-row gap-4">
                @csrf

                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">
                <input type="password" name="password" placeholder="Password"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">
                <input type="password" name="password_confirmation" placeholder="Confirm Password"
                    class="w-full h-12 p-2 border border-gray-300 rounded-md outline-none focus:border-neutral-700 hover:border-neutral-700">
                <button type="submit"
                    class="w-full h-12 bg-white border rounded-md border-neutral-700 hover:bg-neutral-700 hover:text-neutral-100">
                    登録
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

            <div class="mt-4">
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">もうすでにアカウントをお持ちの方はログインしてください</a>
            </div>
        </section>
    </main>
</body>

</html>
