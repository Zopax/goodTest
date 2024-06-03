@extends('layouts.app')

@section('content')
    <form class="flex space-x-3 justify-center" action="{{ route('home') }}" method="GET">
        <input type="text" class="text-lg px-2 rounded shadow-md border-solid border outline-none w-1/2 h-10" placeholder="Поиск..." name="search">
        <button type="submit" class="text-lg bg-indigo-300 shadow-md hover:bg-sky-300 rounded w-20">Поиск</button>
    </form>
    
    <div class="flex justify-center">
        <div class="flex-wrap mt-24 grid grid-cols-3 gap-4 rounded">
            @foreach($tests as $el)
            <a href="#">
                <div class="size-72 rounded alert bg-sky-200 hover:bg-sky-400/50 shadow-md">
                    <h3 class="text-black"> {{ $el->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection
