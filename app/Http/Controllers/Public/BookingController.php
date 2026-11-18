<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreBookingRequest;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        Booking::create($request->validated());

        return back()->with('status', 'Your booking enquiry has been submitted successfully. Our team will review and contact you shortly.');
    }
}
