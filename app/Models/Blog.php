<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'blog_title',
        'blog_introduction',
        'blog_description',
        'blog_image',
        'blog_status',
    ];

    public function users() {
        return $this->belongsto(User::class,'user_id','id');
    }
}
