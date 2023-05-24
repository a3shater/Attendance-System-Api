<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'attendance_time',
        'attendance_state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
