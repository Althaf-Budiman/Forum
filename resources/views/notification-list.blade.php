@extends('layouts.app')
@section('main')
    <div class="flex justify-center">
        <h1 class="text-2xl font-semibold mt-5 ms-5">Your Notifications.</h1>
    </div>

    {{-- Notification list --}}
    <div class="w-full flex items-center flex-col mt-2">
        @foreach ($notifications as $notification)
            @php
                // check if is readed within 1 minutes
                $isReadedWithin1Minutes = $notification->read_at == null || \Carbon\Carbon::parse($notification->read_at)->diffInSeconds(now()) <= 15;
                $bgClass = $isReadedWithin1Minutes ? 'bg-slate-600' : 'bg-gray-700';
            @endphp
            <div class="flex w-8/12 mt-1 {{ $bgClass }}">
                <div class="flex p-5">
                    @if ($isReadedWithin1Minutes)
                        <span class="rounded-full bg-cyan-300 text-transparent mr-2">.</span>
                    @endif
                    <a class="text-lg">
                        {{ $notification->message }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
