@component('mail::message')
# Appointment Confirmed

Dear {{ $appointment->user->name ?? $appointment->name }},

Your appointment for **{{ $appointment->service->title ?? 'Consultation' }}** has been successfully confirmed.

**Appointment Details:**
- **Date & Time:** {{ \Carbon\Carbon::parse($appointment->start_datetime)->format('l, F j, Y \a\t g:i A') }}
- **Mode:** {{ ucfirst($appointment->mode) }}
@if($appointment->mode == 'online' && $appointment->meet_link)
- **Meeting Link:** [Join Video Call]({{ $appointment->meet_link }})
@endif

If you have any questions or need to reschedule, please contact us at least 24 hours in advance.

@component('mail::button', ['url' => route('profile.show')])
View Your Appointments
@endcomponent

Thanks,<br>
JoinRoots Team
@endcomponent
