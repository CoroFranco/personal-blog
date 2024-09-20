<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
    @vite('resources/css/app.css')
</head>
<body>
    <main class="max-w-[600px] w-[95%] m-auto py-10">
        <a class="pl-4 font-semibold text-[0.9rem]"  href="/admin"><- Back to Posts</a>
        <h1 class="mt-10 text-[2.2rem] font-bold">Create New Post</h1>

        <form class="font-semibold" method="POST" action="{{route('create-post')}}">
            @csrf
            <div class="flex flex-col">
                <label for="title">Title</label>
                <input class="border-[1px] border-gray-300 rounded-lg py-2 px-2" name="title" type="text" id="title">
            </div>
            <div class="flex flex-col">
                <label for="content">Content</label>
                <textarea class="border-[1px] border-gray-300 rounded-lg py-2 px-2 h-[500px]" name="content"  type="text" id="content"></textarea>
            </div>  
            <button type="submit" class="bg-black text-gray-100 font-semibold px-3 text-[1.2rem] py-1 rounded-lg hover:bg-[#383838] mt-8" type="submit">Create</button>         
        </form>
    </main>
</body>
</html>