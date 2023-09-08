<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class UserBlog extends Model
{
    protected $fillable = ['blog_id', 'user_id'];
}
