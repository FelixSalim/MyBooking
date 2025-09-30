@extends('layouts.app')

@section('title', 'Choose Room')
@section('page-title', 'Choose a Room')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/book/pick-room.css') }}">
@endsection

@section('content')
<div class="inner-container">
    <h4 class="inner-title">Select Room</h4>
    <div class="floor-label">
        Floor {{ $floor }}{{ $floor == 1 ? 'st' : ($floor == 2 ? 'nd' : ($floor == 3 ? 'rd' : 'th')) }}
    </div>

    <div class="room-grid">
        @foreach ($rooms as $room)
        <a href="{{ route('class.form', $room->id) }}" class="room-card" title="Book {{ $room->name }}">
            <div class="room-image" style="background-image: url('https://picsum.photos/400/300')">
                <div class="room-overlay">
                    <span class="room-name">{{ $room->name }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
