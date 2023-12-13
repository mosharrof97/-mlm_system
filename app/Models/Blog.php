<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
  protected $primaryKey = 'blog_id';
    protected $fillable = [
        'blog_id',
        'user_id',
        'blog_desc',
        'blog_img',
        'blog_condition',
    ];
}
