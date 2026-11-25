<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreEnquiryRequest;
use App\Mail\EnquiryConfirmationMail;
use App\Mail\NewEnquiryAlertMail;
use App\Models\Enquiry;
use App\Models\Programme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function create(Request $request): View
    {
        $programmes = Programme::published()
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $selectedProgrammeId = $request->integer('programme') ?: null;

        return view('public.contact', compact('programmes', 'selectedProgrammeId'));
    }

    public function store(StoreEnquiryRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['website']);
        $data['status'] = 'new';
        $data['ip_address'] = $request->ip();

        $enquiry = Enquiry::create($data)->load('programme');

        Mail::to($enquiry->email)->queue(new EnquiryConfirmationMail($enquiry));
        Mail::to('deepaajm01@gmail.com')->queue(new NewEnquiryAlertMail($enquiry));

        return redirect()
            ->route('contact')
            ->with('status', 'Thank you. Your enquiry has been recorded and will be reviewed shortly.');
    }
}
