<div class="w-full flex items-center flex-col">
    <div class="flex w-8/12 bg-gray-700 p-3 mt-3">
        <div class="flex w-full justify-evenly">
            {{-- Upvote Downvote --}}
            <div class="flex flex-col items-center">
                <button wire:click="upvote({{ $answer->id }})" class="{{ $answer->upvoteStatusIcon() }}"></button>
                <p class="leading-[48px]">
                    {{ $answer->votes()->where('vote_type', 'upvote')->count() -$answer->votes()->where('vote_type', 'downvote')->count() }}
                </p>
                <button wire:click="downvote({{ $answer->id }})" class="{{ $answer->downvoteStatusIcon() }}"></button>
            </div>

            {{-- Question Title , Kategori  --}}
            <div class="flex flex-col">
                <div class="w-80 whitespace-nowrap text-ellipsis overflow-hidden">
                    <p class="text-lg font-semibold text-white leading-[48px]">{{ $answer->answer }}</p>
                </div>
            </div>

            {{-- Questioner avatar and name --}}
            <div class="flex mt-7">
                <div class="avatar">
                    <div class="w-10 h-10 rounded-full">
                        <img class="w-full" src="{{ asset('storage/' . $answer->user->profile_photo_path) }}"
                            alt="user avatar questioner">
                    </div>
                </div>
                <p class="leading-[48px] ml-3">{{ $answer->user->name }}</p>
            </div>

            {{-- Questioner bookmarks --}}
            <div class="flex">
                <button wire:click="bookmark({{ $answer->id }})"
                    class="{{ $answer->bookmarkStatusIcon() }}"></button>
            </div>

        </div>
    </div>

</div>
