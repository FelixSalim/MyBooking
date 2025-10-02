@extends('layouts.app')

@section('title', 'Book Shuttle - MyBooking')
@section('page-title', 'Pick Your Shuttle')

@section('content')
<div class="form-container">
    <h4 class="fw-bold">{{ $shuttle->destination }}</h4>
    <p>Departure Time: {{ $shuttle->departure_time }}</p>
{{-- {{ route('shuttle.store', $shuttle->id) }}  --}}
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Your Name</label>
            <input type="text" name="employee_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Booking Date</label>
            <input type="date" name="booking_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Shuttle</button>
    </form>
</div>
@endsection
