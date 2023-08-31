<div class="flex w-full items-center flex-col">
    @foreach ($questions as $question)
        <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
            <div class="flex w-full justify-evenly">
                {{-- Upvote Downvote --}}
                <div class="flex flex-col items-center">
                    <button wire:click="upvote({{ $question->id }})" class="{{ $question->upvoteStatusIcon() }}"></button>
                    <p class="leading-[48px]">
                        {{ $question->votes()->where('vote_type', 'upvote')->count() - $question->votes()->where('vote_type', 'downvote')->count() }}
                    </p>
                    <button wire:click="downvote({{ $question->id }})" class="{{ $question->downvoteStatusIcon() }}"></button>
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
                    <button wire:click="bookmark({{ $question->id }})" class="{{ $question->bookmarkStatusIcon() }}"></button>
                </div>
            </div>
        </div>
    @endforeach
</div>
