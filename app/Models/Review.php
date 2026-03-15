<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    use HasFactory;
    protected $fillable = ['name','role','location','rating','review_text','avatar_color','is_approved','display_order','service_id'];
    public function service() { return $this->belongsTo(Service::class); }
}
