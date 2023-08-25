@extends('layouts.app')
@section('main')
    <div class="flex flex-col items-center">
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3 justify-between">
            <h1 class="text-xl font-semibold text-white leading-[48px]">Hi, {{ Auth::user()->name }}!</h1>
            <label for="modal_add_question" class="btn btn-primary">Ask Question</button>
        </div>

        {{-- Modal add question --}}
        <input type="checkbox" id="modal_add_question" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <form action="{{ url('/question') }}" method="post">
                    @csrf
                    <h3 class="font-bold text-lg">Ask a question!</h3>

                    <label class="label" for="title">
                        <span class="label-text">Question Title</span>
                    </label>
                    <input type="text" name="title" id="title" placeholder="Input Your Question Title Here"
                        class="input input-bordered w-full max-w-xs" value="{{ old('title') }}" />
                    @error('title')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror

                    <label class="label" for="description">
                        <span class="label-text">Question Description</span>
                    </label>
                    <textarea type="text" name="description" id="description" placeholder="Input Your Question Description Here"
                        class="textarea textarea-bordered w-full max-w-xs" value="{{ old('description') }}"></textarea>
                    @error('description')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror

                    <label class="label" for="category">
                        <span class="label-text">Question Category</span>
                    </label>
                    <select name="category" id="category" class="select select-bordered w-full max-w-xs">
                        <option selected value="IT">IT</option>
                        <option value="Video Game">Video Game</option>
                        <option value="Umum">Umum</option>
                    </select>
                    @error('category')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror

                    <div class="modal-action">
                        <label for="modal_add_question" class="btn btn-primary">Close!</label>
                        <button type="submit" class="btn btn-outline btn-success">Add</button>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="modal_add_question">Tutup</label>
        </div>
        {{-- End modal add question --}}

        {{-- Questions --}}
        @foreach ($questions as $question)
            <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
                <div class="flex w-full justify-evenly">
                    {{-- Upvote Downvote --}}
                    <div class="flex flex-col items-center">
                        <i class="bi bi-caret-up"></i>
                        <p class="leading-[48px]">0</p>
                        <i class="bi bi-caret-down"></i>
                    </div>

                    {{-- Answer Count --}}
                    <div class="flex flex-col">
                        <p class="leading-[96px]">0 answer</p>
                    </div>

                    {{-- Question Title And Kategori --}}
                    <div class="flex flex-col">
                        <div class="w-80 whitespace-nowrap text-ellipsis overflow-hidden">
                            <a href="#"
                                class="text-lg font-semibold text-white underline leading-[48px]">{{ $question->title }}</a>
                        </div>
                        <span class="badge">{{ $question->category }}</span>
                    </div>

                    {{-- Questioner avatar and name --}}
                    <div class="flex mt-12">
                        <div class="avatar">
                            <div class="w-10 h-10 rounded-full">
                                <img class="w-full" src="{{ asset('storage/' . $question->user->profile_photo_path) }}"
                                    alt="user avatar questioner">
                            </div>
                        </div>
                        <p class="leading-[48px] ml-3">{{ $question->user->name }}</p>
                    </div>

                    {{-- Questioner bookmarks --}}
                    <div class="flex mt-12">
                        <i class="bi bi-bookmark ml-3"></i>
                    </div>
                </div>
            </div>
            {{-- End Of Questions --}}
        @endforeach
    </div>
@endsection
