<div class="w-full flex items-center flex-col">
    <div class="flex w-8/12 bg-gray-700 p-3 mt-3 flex-col">
        <div class="flex w-full justify-evenly">
            {{-- Upvote Downvote --}}
            <div class="flex flex-col items-center">
                <button wire:click="upvote({{ $answer->id }})" class="{{ $answer->upvoteStatusIcon() }}"></button>
                <p class="leading-[48px]">
                    {{ $answer->votes()->where('vote_type', 'upvote')->count() -$answer->votes()->where('vote_type', 'downvote')->count() }}
                </p>
                <button wire:click="downvote({{ $answer->id }})" class="{{ $answer->downvoteStatusIcon() }}"></button>
            </div>

            {{-- Answer --}}
            <div class="flex flex-col">
                <div class="w-80">
                    <p class="text-lg font-semibold text-white ">{{ $answer->answer }}</p>
                </div>
            </div>

            {{-- Answer avatar and name --}}
            <div class="flex mt-7">
                <div class="avatar">
                    <div class="w-10 h-10 rounded-full">
                        <img class="w-full" src="{{ asset('storage/' . $answer->user->profile_photo_path) }}"
                            alt="user avatar questioner">
                    </div>
                </div>
                <p class="leading-[48px] ml-3">{{ $answer->user->name }}</p>
            </div>

            {{-- Answer bookmarks --}}
            <div class="flex gap-3">
                <button wire:click="bookmark({{ $answer->id }})" class="{{ $answer->bookmarkStatusIcon() }}"></button>
                <button wire:click="loadComments({{ $answer->id }})" class="bi bi-chat "></button>
            </div>

        </div>

        @if ($isCommentOpen)
            <form method="POST" action="/comment/{{ $answer->id }}">
                @csrf
                <div class="flex mt-8 gap-3">
                    <div class="avatar">
                        <div class="w-10 h-10 rounded-full">
                            <img class="w-full" src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                alt="user avatar questioner">
                        </div>
                    </div>
                    <input type="text" name="comment" placeholder="Type Your Comment"
                        class="input input-bordered w-full" value="{{ old('comment') }}" />
                    @error('comment')
                        <span class="text-red-500">
                            {{ $message }}
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">SEND</button>
                </div>
            </form>
            @isset($comments)
                @foreach ($comments as $comment)
                    @livewire('comment-item', ['comment' => $comment])
                @endforeach
            @endisset
        @endif

    </div>


</div>
