<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     use HasFactory;

     protected $fillable = [
          'ticket_id',
          'user_id',
          'content',
          'parent_id',
     ];

     public function user()
     {
          return $this->belongsTo(User::class);
     }

     public function ticket()
     {
          return $this->belongsTo(Ticket::class);
     }

     public function parent()
     {
          return $this->belongsTo(Comment::class, 'parent_id');
     }

     public function replies()
     {
          return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
     }
}
