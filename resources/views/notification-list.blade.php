@extends('layouts.app')
@section('main')
    <div class="flex justify-center">
        <h1 class="text-2xl font-semibold mt-5 ms-5">Your Notifications.</h1>
    </div>

    {{-- Notification list --}}
    <div class="w-full flex items-center flex-col mt-2">
        {{-- Not readed yet notifications --}}
        @if ($unreadNotifications->count() > 0)
            <h2 class="text-lg font-semibold mt-5 ms-5">unread notifications.</h2>
            @foreach ($unreadNotifications as $notification)
                <div class="flex w-8/12 mt-1 bg-slate-600">
                    <div class="flex p-5">
                        <i class="bi bi-circle-fill mr-2"></i>
                        <p class="text-lg">
                            {{ $notification->message }}
                        </p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="w-full flex items-center flex-col mt-2">
        {{-- Readed notifications --}}
        @foreach ($readNotifications as $notification)
            <div class="flex w-8/12 mt-1 bg-gray-700">
                <div class="flex p-5">
                    <p class="text-lg">
                        {{ $notification->message }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
