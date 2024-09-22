<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
</head>
<body class="bg-gray-200">
    <header class="mt-8">
        <a href="/">
            <h1 class="text-[2rem] text-center font-bold"><span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-blue-600">
                DevChronicles
              </span></h1>
        </a>
        <div class="flex justify-end w-[80%] m-auto">
            <div class="flex flex-col gap-2 relative">
                <button id="openLogin" class="bg-[#202020c0] text-white py-1 px-2 text-[1.2rem]">login</button>
                <form id="formLogin" class="opacity-0 absolute top-10 left-[-70px] transition-all flex flex-col gap-2" action="{{route('login')}}" method="post">
                    @csrf
                    <label for="email" class="text-gray-500">Email</label>
                    <input type="email" name="email" class="border-2 border-gray-400 rounded-md p-2">
                    <label for="password" class="text-gray-500">Password</label>
                    <input type="password" name="password" class="border-2 border-gray-400 rounded-md p-2">
                    <button type="submit">Login</button>
                </form>
            </div>

        </div>


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


    <script>
        const openLogin = document.getElementById('openLogin');
        const formLogin = document.getElementById('formLogin');
        openLogin.addEventListener('click',()=>{
            gsap.to(formLogin,{
                duration:0.5,
                x:0,
                opacity:1,
            })
        })
        document.addEventListener('click',(e)=>{
            if(!formLogin.contains(e.target) && e.target.id!='openLogin'){
                gsap.to(formLogin,{
                    duration:0.5,
                    opacity:0,
                })
            }
        })
    </script>
</body>
</html>