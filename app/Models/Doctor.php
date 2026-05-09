<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    use HasFactory;

    protected $fillable = [
        'name', 'designation', 'qualification', 'bio', 'specializations',
        'experience_years', 'photo_url', 'email', 'phone', 'is_active',
        'display_order', 'available_days', 'work_start_time', 'work_end_time',
        'slot_duration',
    ];

    protected $casts = [
        'available_days' => 'array',
        'is_active'      => 'boolean',
    ];

    public function getSpecializationsArrayAttribute(): array
    {
        return $this->specializations ? array_map('trim', explode(',', $this->specializations)) : [];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /** Next upcoming appointment for this doctor (today or future, confirmed/pending) */
    public function nextAppointment()
    {
        return $this->appointments()
            ->with('service', 'user')
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('start_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->first();
    }

    /** All appointments for a specific date */
    public function appointmentsForDate(string $date)
    {
        return $this->appointments()
            ->with('service', 'user')
            ->whereDate('start_datetime', $date)
            ->orderBy('start_datetime')
            ->get();
    }
}
