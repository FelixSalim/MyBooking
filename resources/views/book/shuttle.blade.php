@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shuttle.css') }}">
@endsection

@section('title', 'Shuttle - MyBooking')
@section('page-title', 'Shuttle')

@section('overlay')
@if ($selected != null)
        <div class="route-container">
            <div class="route-box">
                <div class="route-header">
                    <i class="fas fa-map-marker-alt"></i>
                    <h2>Choose Your Route</h2>
                    <p>{{ $destination }}</p>
                </div>

                <div class="route-options">
                    {{-- To Destination --}}
                    <form action="{{ route('shuttle.form', $toShuttle->id) }}" method="GET">
                        <input type="hidden" name="shuttle_id" value="{{ $toShuttle->id }}">
                        <button type="submit" class="route-btn outline">
                            From <strong>BLI</strong> → To <strong>{{ $destination }}</strong>
                        </button>
                    </form>

                    {{-- From Destination --}}
                    <form action="{{ route('shuttle.form', $fromShuttle->id) }}" method="GET">
                        <input type="hidden" name="shuttle_id" value="{{ $fromShuttle->id }}">
                        <button type="submit" class="route-btn filled">
                            From <strong>{{ $destination }}</strong> → To <strong>BLI</strong>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="inner-container">
        <h3 class="fw-bold">Book your shuttle</h3>
        <p class="text-muted">Choose your preferred shuttle</p>

        <div class="card-grid">
            @foreach ($shuttles as $shuttle)
                <a href="{{ route('bookShuttle', ['selected' => $shuttle->destination]) }}" class="card-option">
                    <img src="https://picsum.photos/seed/shuttle{{ $shuttle->id }}/600/400" alt="Shuttle">
                    <div class="overlay">
                        <div class="label">{{ strtoupper($shuttle->destination) }}</div>
                        <div class="subtitle">Available : {{ $shuttle->remainingSeats(now()->toDateString()) }} seat</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
