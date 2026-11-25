<?php

use App\Mail\EnquiryConfirmationMail;
use App\Mail\NewEnquiryAlertMail;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    Validator::fakeDnsLookups();
});

afterEach(function () {
    Validator::fakeDnsLookups(false);
});

it('queues confirmation and admin alert emails when an enquiry is submitted', function () {
    Mail::fake();

    $this->post(route('contact.store'), [
        'name' => 'Kavita Joshi',
        'email' => 'kavita@example.com',
        'phone' => '9829012345',
        'preference' => 'offline',
        'preferred_date' => now()->addDays(2)->toDateString(),
        'preferred_time' => '06:30 AM',
        'message' => 'Interested in morning Hatha yoga sessions.',
    ])->assertRedirect(route('contact'));

    $enquiry = Enquiry::where('email', 'kavita@example.com')->firstOrFail();

    Mail::assertQueued(EnquiryConfirmationMail::class, function (EnquiryConfirmationMail $mail) use ($enquiry) {
        return $mail->hasTo('kavita@example.com')
            && $mail->enquiry->is($enquiry);
    });

    Mail::assertQueued(NewEnquiryAlertMail::class, function (NewEnquiryAlertMail $mail) use ($enquiry) {
        return $mail->hasTo('deepaajm01@gmail.com')
            && $mail->enquiry->is($enquiry);
    });
});
