<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tiketing'; 

    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
