<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model {
    use HasFactory;
    protected $fillable = ['title','slug','excerpt','content','cover_image_url','video_url','author','category','is_published','published_at'];
    protected $casts = ['published_at' => 'datetime', 'is_published' => 'boolean'];
    public function getRouteKeyName() { return 'slug'; }
}
