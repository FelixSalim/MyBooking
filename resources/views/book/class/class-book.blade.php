@extends('layouts.app')

@section('title', 'Class Room - MyBooking')
@section('page-title', 'Class ' . $room['floor_number'] . ' Room')

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

                <form action="{{ route('class.bookings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Booking Date --}}
                    <div class="form-group">
                        <label for="booking_date">Booking Date <span class="required">*</span> :</label>
                        <input type="date" name="booking_date" class="date-input" required>
                    </div>

                    {{-- Time --}}
                    <div class="form-group">
                        <label for="start_time">Time <span class="required">*</span> :</label>

                        <input type="time" name="start_time" class="time-input" required>
                        <span class="time-separator">-</span>
                        <input type="time" name="end_time" class="time-input" required>

                    </div>

                    <small class="validation">
                        Validation: Selected time is available / Overlaps with existing booking
                    </small>

                    {{-- Name + Role --}}
                    <div class="form-group">
                        <label for="name">Name <span class="required">*</span> :</label>
                        <input type="text" name="name" placeholder="Your name" required>
                        <span class="as-text">as</span>
                        <input type="text" name="role" placeholder="Komti / Lecturer">
                    </div>
                    <div class="form-group">
                        <label for="detail">Detail <span class="required">*</span> :</label>
                        <input type="text" name="detail" placeholder="PPBP 6" required>
                    </div>

                    {{-- Category / Detail / Purpose --}}
                    <div class="form-group">
                        <label for="room_id">Category <span class="required">*</span> :</label>
                        <select name="room_id" required>
                            @foreach ($rooms as $r)
                                <option value="{{ $r->id }}" {{ old('room_id', $room->id) == $r->id ? 'selected' : '' }}>
                                    {{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="purpose">Purpose <span class="required">*</span> :</label>
                        <input type="text" name="purpose" placeholder="Latihan" required>
                    </div>

                    {{-- Participants --}}
                    <div class="form-group">
                        <label for="participants">Participants <span class="required">*</span> :</label>
                        <input type="number" name="participants" placeholder="45" required>
                    </div>

                    {{-- Attendance File --}}
                    <div class="form-group">
                        <label for="attendance_file">Attendance Data <span class="required">*</span> :</label>
                        <input type="file" name="attendance_file" accept=".jpg,.jpeg,.png" required>
                    </div>

                    {{-- Actions --}}
                    <div class="form-actions">
                        <a href="{{ route('rooms.show', 'Discussion') }}" class="cancel">Cancel</a>
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>

            {{-- Right: Booking Info --}}
            <div class="booking-info">
                <h3><i class="fas fa-calendar-alt"></i> Check Availability</h3>
                <div class="underline"></div>

                <p style="font-weight: 600; font-style: italic;">Who else booked this room? :</p>
                @foreach ($waiting as $w)
                    <div class="time-card">
                        <span style="font-weight: 600">{{ $w->booking_date }}&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;{{ $w->start_time }} - {{ $w->end_time }}</span>
                        <span class="badge {{ $w->status }}">{{ ucfirst($w->status) }}</span>
                    </div>
                @endforeach

                <p class="note"><span class="required">*</span> Only available time slots can be booked.</p>
            </div>
        </div>
    </div>
@endsection
