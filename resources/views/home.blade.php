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

        {{-- Questions Item --}}
        <div class="flex w-full items-center flex-col">
            @foreach ($questions as $question)
                @livewire('question-item', ['question' => $question])
            @endforeach
        </div>
        {{-- End Of Questions --}}
    </div>
@endsection
