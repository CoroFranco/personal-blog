<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200">
    <header class="mt-8">
        <a href="/">
            <h1 class="text-[2rem] text-center font-bold"><span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-blue-600">
                DevChronicles
              </span></h1>
        </a>

    </header>



    <main class="max-w-[800px] w-[95%] m-auto mt-8 flex flex-col gap-4">
        @foreach ($blogs as $blog)
        <article class="shadow-sm  hover:shadow-xl  py-2 px-4 bg-white rounded border-[1px] border-gray-400 flex flex-col gap-6">
            <h2 class="text-[2rem] font-bold">{{$blog->title}}</h2>
            <p class="text-gray-600">{{$blog->content}}</p>
            <div class="flex justify-between place-items-center">
                <p class="text-[0.8rem] text-gray-500">{{$blog->created_at->format('Y-m-d')}}</p>
                <a class="text-teal-400" href="{{route('post',$blog->id)}}">Read More -></a>
            </div>
            
        </article>
        
    @endforeach
    </main>

</body>
</html>