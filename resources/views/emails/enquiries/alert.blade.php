<x-mail::message>
# New Enquiry Received

A new session or programme enquiry has been submitted on **{{ config('app.name') }}**.

- **Name:** {{ $enquiry->name }}
- **Email:** {{ $enquiry->email }}
- **Phone:** {{ $enquiry->phone }}
- **Programme:** {{ $enquiry->programme?->title ?? 'General Wellness / Consultation' }}
- **Mode Preference:** {{ ucfirst($enquiry->preference) }}
@if ($enquiry->preferred_date)
- **Preferred Date:** {{ $enquiry->preferred_date->format('d M Y') }}
@endif
@if ($enquiry->preferred_time)
- **Preferred Time:** {{ $enquiry->preferred_time }}
@endif

**Message:**
{{ $enquiry->message }}

<x-mail::button :url="url('/admin')">
Open Admin Studio
</x-mail::button>
</x-mail::message>
