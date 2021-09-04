@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard - Create
            </header>

            <div class="w-full p-6">
                <form method="POST" action="/home/store" class="w-full">
                @csrf
                <div class="flex flex-wrap -mx-3 mb-6">
                  <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                      Title
                    </label>
                    <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none  focus:border-gray-500" id="grid-password" type="text" placeholder="Title" name="title">
                  </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                  <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                        Content
                    </label>
                    <textarea name="content" cols="50" rows="10" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none  focus:border-gray-500" id="content" maxlength="255" placeholder="Content" name="content"></textarea>
                    <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like (max: 255)</p>
                  </div>
                </div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded float-right">
                    Create
                </button>
              </form>
              <a href="/home" >
                <button class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded float-right mr-5">
                    Cancel
                </button>
            </button></a>
            </div>
        </section>
    </div>
</main>
@endsection
