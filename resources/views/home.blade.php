@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title', 'Home - MyBooking')
@section('page-title', 'Hi! Ready to Book?')

@section('content')

    <!-- Tabs -->
    <ul class="nav nav-tabs custom-tabs" id="bookingTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="book-tab" data-bs-toggle="tab" data-bs-target="#book-content" type="button"
                role="tab" aria-controls="book-content" aria-selected="true">
                Book
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="mybookings-tab" data-bs-toggle="tab" data-bs-target="#mybookings-content"
                type="button" role="tab" aria-controls="mybookings-content" aria-selected="false">
                My Bookings
            </button>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content">
        <!-- ========== BOOK TAB ========== -->
        <div class="tab-pane fade show active" id="book-content" role="tabpanel" aria-labelledby="book-tab">
            <div class="text-center">
                <div class="book-heading"> <em>Book a Room or Shuttle</em> </div>
                <div class="book-subtitle">Reserve your meeting room or secure a seat on the shuttle.</div>

                <!-- Cards -->
                <div class="card-grid">
                    <!-- Room -->
                    <a href="{{ route('bookRoom') }}" class="card-option" title="Book Room">
                        <img src="https://picsum.photos/seed/room/800/520" alt="Room image">
                        <div class="overlay">
                            <div class="label">Room</div>
                        </div>
                    </a>

                    <!-- Shuttle -->
                    <a href="#" class="card-option" title="Book Shuttle">
                        <img src="https://picsum.photos/seed/shuttle/800/520" alt="Shuttle image">
                        <div class="overlay">
                            <div class="label">Shuttle</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- ========== MY BOOKINGS TAB ========== -->
        <div class="tab-pane fade" id="mybookings-content" role="tabpanel" aria-labelledby="mybookings-tab">
            <div class="text-center">
                <div class="book-heading">My Bookings</div>
                <div class="book-subtitle">Here are all your active and past bookings.</div>

                <div class="row justify-content-center gx-4">

                    <!-- Room Bookings -->
                    <div class="col-lg-5 mb-3">
                        <div style="background:#005daa;color:#fff;border-radius:20px;padding:20px;">
                            <h5 class="fw-bold mb-3">Room</h5>
                            @foreach ($rooms as $room)
                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;background:#fff;color:#000;border-radius:12px;padding:8px 12px;margin-bottom:10px;">
                                    <div style="flex:1;font-weight:700;">{{ strtoupper($room->name) }}</div>
                                    <div style="flex:1;text-align:center;">{{ $room->time }}</div>
                                    <div style="flex:1;text-align:center;">{{ $room->date }}</div>
                                    <div
                                        style="width:24px;height:24px;border-radius:50%;
                  @if ($room->status == 'Approved') background:#28a745; 
                  @elseif($room->status == 'Pending') background:#ffc107; 
                  @elseif($room->status == 'Cancelled') background:#dc3545; @endif">
                                    </div>
                                </div>
                            @endforeach

                            <!-- Legend -->
                            <div class="d-flex justify-content-around mt-3" style="font-size:13px;">
                                <div><span
                                        style="display:inline-block;width:15px;height:8px;background:#28a745;margin-right:5px;"></span>Approved
                                </div>
                                <div><span
                                        style="display:inline-block;width:15px;height:8px;background:#ffc107;margin-right:5px;"></span>Pending
                                </div>
                                <div><span
                                        style="display:inline-block;width:15px;height:8px;background:#dc3545;margin-right:5px;"></span>Cancelled
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shuttle Bookings -->
                    <div class="col-lg-5 mb-3">
                        <div style="background:#005daa;color:#fff;border-radius:20px;padding:20px;">
                            <h5 class="fw-bold mb-3">Shuttle</h5>
                            @foreach ($shuttles as $shuttle)
                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;background:#fff;color:#000;border-radius:12px;padding:8px 12px;margin-bottom:10px;">
                                    <div style="flex:1;">{{ $shuttle->date }}</div>
                                    <div style="flex:1;">{{ $shuttle->time }}</div>
                                    <div style="flex:1;display:flex;align-items:center;font-weight:700;">
                                        @if ($shuttle->direction == 'to')
                                            <i class="fas fa-map-marker-alt" style="color:#28a745;margin-right:6px;"></i>
                                        @else
                                            <i class="fas fa-map-marker-alt" style="color:#dc3545;margin-right:6px;"></i>
                                        @endif
                                        {{ strtoupper($shuttle->destination) }}
                                    </div>
                                    <div style="flex:0;">
                                        <i class="fas fa-edit" style="color:#333;"></i>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Legend -->
                            <div class="mt-2" style="font-size:13px;text-align:left;">
                                <i class="fas fa-map-marker-alt" style="color:#28a745;margin-right:4px;"></i> To BLI &nbsp;
                                <i class="fas fa-map-marker-alt" style="color:#dc3545;margin-right:4px;"></i> From BLI
                                &nbsp;
                                <span>*Reschedule only until Thursday 08:00, after that not processed.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
