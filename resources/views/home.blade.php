@extends('layouts.app')
@section('main')
    <div class="flex flex-col items-center">
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3 justify-between">
            <h1 class="text-xl font-semibold text-white leading-[48px]">Ask a question, or answer!</h1>
            <button class="btn btn-primary">Ask Question</button>
        </div>

        {{-- Questions --}}
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <div class="flex w-full justify-evenly">
                <div class="flex flex-col">
                    <p class="leading-[48px]">0 answer</p>
                </div>
                <div class="flex flex-col">
                    <div class="w-80 whitespace-nowrap text-ellipsis overflow-hidden">
                        <a href="#"
                        class="text-lg font-semibold text-white underline">question</a>
                    </div>
                    <p>Kategori</p>
                </div>
                <div class="flex">
                    <div class="avatar">
                        <div class="w-14 rounded-full">
                            <img class="w-full" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                alt="user avatar questioner">
                        </div>
                    </div>
                    <p class="leading-[48px] ml-3">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
        {{-- End Of Questions --}}
    </div>
@endsection
