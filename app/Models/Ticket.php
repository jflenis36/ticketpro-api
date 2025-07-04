<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
     use HasFactory;

     protected $fillable = [
          'title',
          'description',
          'status',
          'priority',
          'user_id',
          'category_id',
          'project_id'
     ];

     public function user()
     {
          return $this->belongsTo(User::class);
     }

     public function category()
     {
          return $this->belongsTo(Category::class);
     }

     public function comments()
     {
          return $this->hasMany(Comment::class)->whereNull('parent_id')->orderBy('created_at', 'desc');
     }

     public function project()
     {
          return $this->belongsTo(Project::class);
     }
}
