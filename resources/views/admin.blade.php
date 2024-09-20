<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="flex justify-between max-w-[1200px] py-6 w-[95%] m-auto place-items-center">
        <h1 class="text-[2rem] font-bold">Manage Posts</h1>
        <a href="/admin/create" class="bg-black text-gray-100 font-semibold px-3 text-[0.9rem] py-1 rounded-lg hover:bg-[#383838]">+ New Post</a href="/admin/create">
    </header>

    <main class="max-w-[1200px] w-[95%] m-auto">
        <table class="w-full my-6">
            <thead class="py-4">
                <tr class="font-bold">
                    <td>Title</td>
                    <td>Date</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $post)
                    <tr class="border-b-[1px] border-b-black">
                        <td class="">{{$post->title}}</td>
                        <td>{{$post->created_at->format('Y-m-d')}}</td>
                        <td class="flex flex-col md:flex-row gap-2 py-4 text-center">
                            <button id="openModal" class="openModal p-1 border-[1px] border-gray-400 bg-gray-100 rounded-lg" data-title="{{$post->title}}" data-content="{{$post->content}}" data-id="{{$post->id}}">Edit</button>
                            <button class="deleteBtn p-1 border-[1px] border-gray-400 bg-red-100 rounded-lg" data-id="{{$post->id}}">Delete</button>
                        </td>                       
                    </tr>
                    <hr>
                    
                @endforeach
            </tbody>
        </table>

        <div id="overlay" class="hidden absolute top-0 left-0 w-screen bg-[#7c7c7c25] h-screen"></div>
        <div id="modal" class="hidden absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] max-w-[500px] w-[500px] bg-gray-300 p-8">
            <form class="font-semibold" method="POST" action="{{route('update-post')}}">
                @csrf
                <input type="" name="id" id="postIdUpdate">
                <div class="flex flex-col">
                    <label for="titleUpdate">Title</label>
                    <input class="border-[1px] border-gray-300 rounded-lg py-2 px-2" name="title" type="text" id="titleUpdate">
                </div>
                <div class="flex flex-col">
                    <label for="contentUpdate">Content</label>
                    <textarea class="border-[1px] border-gray-300 rounded-lg py-2 px-2 h-[500px]" name="content"  type="text" id="contentUpdate"></textarea>
                </div>  
                <button type="submit" class="bg-black text-gray-100 font-semibold px-3 text-[1.2rem] py-1 rounded-lg hover:bg-[#383838] mt-8" type="submit">Create</button>         
            </form>
        </div>
    </main>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.deleteBtn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const postId = this.getAttribute('data-id');
            if (confirm('¿Estás seguro de que deseas eliminar este post?')) {
                fetch(`/admin/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Eliminación exitosa');
                        this.closest('tr').remove(); 
                    } else {
                        alert(data.message || 'Error al eliminar el post');
                    }
                })
                .catch(error => {
                    console.error(`Error: ${error}`);
                    alert('Ocurrió un error al eliminar el post');
                });
            }
        });
    });

    const openModal = document.querySelectorAll('.openModal')
    openModal.forEach(openModal => {
        openModal.addEventListener('click', function(){
        const modal = document.getElementById('modal')
        const overlay = document.getElementById('overlay')
        const titleUpdate = document.getElementById('titleUpdate')
        const contentUpdate = document.getElementById('contentUpdate')
        const idUpdate = document.getElementById('postIdUpdate')
        const postTitle = this.getAttribute('data-title');
        const postContent = this.getAttribute('data-content');
        const postIdUpdate = this.getAttribute('data-id');

        titleUpdate.value = postTitle;
        contentUpdate.value = postContent;
        idUpdate.value = postIdUpdate;

        modal.classList.remove('hidden')
        overlay.classList.remove('hidden')
        overlay.addEventListener('click', function(e){
            if(!modal.contains(e.target)){
                modal.classList.add('hidden')
        overlay.classList.add('hidden')
            }
        })
        
});
    })
    
    })         
    </script>
</body>
</html>