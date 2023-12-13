<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="p-20">

    <h1 class="text-4xl">Hello, {{ auth()->user()->name }}</h1>
    <form action="{{ route('client.auth.logout') }}" method="post">
        <button class="bg-zinc-200 px-4 py-1 rounded-md mt-5">Logout</button>
    </form>

</body>
</html>
