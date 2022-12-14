<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->hasOne(TypeTodo::class);
    }
}
