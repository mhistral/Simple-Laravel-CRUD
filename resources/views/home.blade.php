@extends('layouts.app')

@section('content')

<main class="sm:container sm:mx-auto sm:mt-10">

    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('toast_success'))
            <div class="alert alert-success">
                {{-- {{ session('toast_success') }} --}}
            </div>
        @endif

        @if (session('toast_warning'))
        <div class="alert alert-success">
            {{-- {{ session('toast_warning') }} --}}
        </div>
    @endif



        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
                <span class="float-right text-indigo-600 hover:text-indigo-900"><a href="home/create">Create New Post</a></span>

            </header>

            <div class="w-full p-6">
                <div class="flex flex-col">

                    <span class="float-right mr-5">


                        <form action="/home/search" method="GET">
                            <input class=" border border-gray-200 rounded py-2 px-3 mb-5 leading-tight focus:outline-none focus:bg-white" id="search" name="search" type="text" placeholder="Search Title or Content">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>

                            <a href="/home" class="text-indigo-600 hover:text-indigo-900">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="button">
                                    Refresh
                                </button>
                            </a>
                        </form>



                    </span>

                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Content
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Updated At
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($posts as $post)

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $post->title }}
                                        </div>
                                    </div>
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900">
                                    {{ $post->content }}
                                </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex leading-5">
                                    {{ $post->created_at }}
                                </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $post->updated_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                <a href="/home/edit/{{ $post->id }}" ><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </button></a>

                                <a href="/home/view/{{ $post->id }}" ><button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    View
                                </button></a>

                                {{-- <form action="/home/delete/{{ $post->id }}">
                                    @method('DELETE')
                                    @csrf --}}
                                    {{-- <a href="" class="text-indigo-600 hover:text-indigo-900"> --}}
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded del" id="{{ $post->id }}">
                                            Delete
                                        </button>
                                    {{-- </a> --}}
                                {{-- </form> --}}

                                </td>
                            </tr>

                            @endforeach


                            <!-- More people... -->
                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>


<script>

    $( document ).ready(function() {
        $( ".del" ).click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {

                    var id = $(this).attr('id')
                    $.ajax({
                        type: "GET",
                        url : '{{url("home/delete")}}' + '/' + id,
                        data: {id:id},
                        success: function (data) {
                            Swal.fire(
                                    'Deleted!',
                                    'Post Succesfully Deleted!',
                                    'success'
                                ).then(function() {
                                    location.reload();
                                });
                            }
                    });
                }
            })
        });
    });
</script>

@endsection

