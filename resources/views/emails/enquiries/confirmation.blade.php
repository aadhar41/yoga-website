<x-mail::message>
# Namaste {{ $enquiry->name }},

Thank you for reaching out to **{{ config('app.name') }}** (Yogacharya Deepashree Gaur). We have received your enquiry and will review your preferences shortly.

**Enquiry Summary:**
- **Programme:** {{ $enquiry->programme?->title ?? 'General Wellness / Consultation' }}
- **Mode Preference:** {{ ucfirst($enquiry->preference) }}
@if ($enquiry->preferred_date)
- **Preferred Start Date:** {{ $enquiry->preferred_date->format('d M Y') }}
@endif
@if ($enquiry->preferred_time)
- **Preferred Time Slot:** {{ $enquiry->preferred_time }}
@endif

> **Wellness Note:** Yoga and holistic wellness guidance support general well-being and mindfulness; they are not a substitute for professional medical diagnosis or treatment.

Warm regards,
**Yogacharya Deepashree Gaur**
{{ config('app.name') }}
</x-mail::message>
