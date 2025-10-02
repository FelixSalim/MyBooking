@extends('layouts.app')

@section('title', 'Book Shuttle - MyBooking')
@section('page-title', 'Pick Your Shuttle')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/book/discussion-book.css') }}">
@endsection

@section('content')
    <div class="booking-container">
        <div class="booking-card">
            {{-- Left: Booking Form --}}
            <div class="booking-form">
                <h3><i class="fas fa-user"></i> Booking Form</h3>
                <div class="underline"></div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('shuttle.bookings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Booking Date --}}
                    <div class="form-group">
                        <label for="booking_date">Booking Date <span class="required">*</span> :</label>
                        <input type="date" name="booking_date" class="date-input" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span> :</label>
                        <input type="text" name="name" placeholder="Your name" required>

                        <span class="as-text">as</span>
                        <input type="text" name="role" placeholder="Komti / Lecturer">
                    </div>

                    {{-- Class + Phone --}}
                    <div class="form-group">
                        <label for="class">Class <span class="required">*</span> :</label>
                        <input type="text" name="class" placeholder="PPTI 20" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">No. Hp <span class="required">*</span> :</label>
                        <input type="text" name="phone_number" placeholder="0812-9098-3242" required>
                    </div>

                    <div class="form-group">
                        <label for="shuttle_id">Route <span class="required">*</span> :</label>
                        <select type="text" name="shuttle_id" required>
                            @if ($shuttle->direction == 'to')
                                <option value="{{ $shuttle->id }}">BLI, {{ $shuttle->destination }}</option>
                            @else
                                <option value="{{ $shuttle->id }}">{{ $shuttle->destination }}, BLI</option>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail <span class="required">*</span> :</label>
                        <input type="text" name="detail" placeholder="PPBP 6" required>
                    </div>

                    {{-- Actions --}}
                    <div class="form-actions">
                        <a href="{{ route('bookShuttle', 'None') }}" class="cancel">Cancel</a>
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>

            {{-- Right: Booking Info --}}
            <div class="booking-info">
                <h3><i class="fas fa-bus"></i> Barcode Route Bus</h3>
                <div class="underline"></div>

                <p style="font-weight: 600; font-style: italic;">Scan me</p>

                <img src="{{ asset('images/qr-bus.png') }}" alt="QR Bus Route" class="w-75" style="margin: auto;">
                

                <small class="mt-3"><span class="required">*</span> Scan the barcode to view bus route details.</small>
            </div>
        </div>
    </div>
@endsection
