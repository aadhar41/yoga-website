<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEnquiryRequest;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $search = trim($request->string('q')->toString());

        $allowedStatuses = ['new', 'contacted', 'resolved', 'archived'];

        $enquiries = Enquiry::with('programme')
            ->when(in_array($status, $allowedStatuses, true), fn ($q) => $q->where('status', $status))
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $counts = [
            'all' => Enquiry::count(),
            'new' => Enquiry::where('status', 'new')->count(),
            'contacted' => Enquiry::where('status', 'contacted')->count(),
            'resolved' => Enquiry::where('status', 'resolved')->count(),
            'archived' => Enquiry::where('status', 'archived')->count(),
        ];

        return view('admin.enquiries.index', compact('enquiries', 'status', 'search', 'counts'));
    }

    public function show(Enquiry $enquiry): View
    {
        $enquiry->load('programme');

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update($request->validated());

        return back()->with('status', 'Enquiry status updated to '.ucfirst($enquiry->status).'.');
    }

    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()
            ->route('admin.enquiries.index')
            ->with('status', 'Enquiry deleted.');
    }
}
