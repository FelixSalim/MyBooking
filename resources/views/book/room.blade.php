@extends('layouts.app')

@section('title', 'Book Room - MyBooking')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/book/room.css') }}">
@endsection

@section('page-title', 'Book Your Room')

@section('content')
    <div class="inner-container">
        <h2 class="inner-title">Choose one room</h2>
        <p class="inner-subtitle">Choose the room type and time that suits your needs</p>

        <div class="room-grid">
            @foreach ($rooms as $room)
                <a href="{{ route('rooms.show', $room->name) }}" class="room-link" title="Book {{ $room->name }}">
                    <div class="room-card">
                        <div class="room-image" style="background-image: url('{{ asset('images/' . $room->name . '.jpg') }}');">
                            <div class="room-overlay">
                                <span class="room-name">{{ $room->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection

{{-- url('{{ asset('images/rooms/' . $room->image) }}') --}}
