<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <main class="bg-gray-50 max-w-[1200px] p-8 w-[100%] m-auto mt-8">
        <a class="text-teal-400 text-[0.8rem]" href="/"><- Back to all posts </a>
        <article class="bg-white max-w-[1000px] w-[95%] m-auto my-8 p-4">
            <h1 class="text-[2.5rem] font-bold mb-4"> <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-blue-600">{{$blog->title}}</span></h1>
            <p class="text-[0.8rem] text-gray-400 mb-10">{{$blog->created_at->format('Y-m-d')}}</p>
            <p class="text-pretty">{{$blog->content}}</p>
        </article>
        
    </main>
</body>
</html>