<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased">
<main class="bg-zinc-900 h-screen w-full text-white flex items-center justify-center">
    <form method="post" action="{{ route('client.auth.register') }}" class="flex flex-col items-center gap-10">
        <label for="name" class="flex flex-col text-xl">
            Name
            <input class="px-4 py-1 placeholder-black text-black" type="text" placeholder="Your name" name="name" id="name">
        </label>
        <label for="email" class="flex flex-col text-xl">
            Email
            <input class="px-4 py-1 placeholder-black text-black" type="email" placeholder="Your email here" name="email" id="email">
        </label>
        <label for="password" class="flex flex-col text-xl">
            Password
            <input type="password" name="password" id="password" class="text-black px-4 py-1">
        </label>
        <label for="confirm_password" class="flex flex-col text-xl">
            Repeat your password
            <input type="password" name="confirm_password" id="confirm_password" class="text-black px-4 py-1">
        </label>
        <button class="bg-zinc-400 text-black px-8 py-2 rounded-md text-xl">Register</button>
    </form>
</main>
</body>
</html>
