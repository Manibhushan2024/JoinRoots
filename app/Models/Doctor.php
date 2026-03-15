<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    use HasFactory;
    protected $fillable = ['name','designation','qualification','bio','specializations','experience_years','photo_url','email','phone','is_active','display_order'];
    public function getSpecializationsArrayAttribute() {
        return $this->specializations ? array_map('trim', explode(',', $this->specializations)) : [];
    }
}
