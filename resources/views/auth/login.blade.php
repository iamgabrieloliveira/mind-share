<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-zinc-900 w-full h-screen flex items-center justify-center">

    <main class="px-10 py-5 w-full max-w-xl text-white flex flex-col items-center justify-center">

        <h1 class="text-5xl font-bold self-start font-title tracking-tight">Welcome back</h1>

        <hr class="border-zinc-400 w-full mb-12 my-4">

        <form method="post" action="{{ route('client.auth.login') }}" class="w-full flex flex-col items-center gap-10">
            @csrf
            <input class="login-input" type="email" placeholder="Email" name="email" id="email">
            <input class="login-input" type="password" placeholder="Password" name="password" id="password">
            <button class="self-start button">Log in</button>
        </form>

    </main>

</body>
</html>
