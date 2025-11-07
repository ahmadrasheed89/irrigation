<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'designation','description','personal_no','cnic', 'file_path','duty_station', 'user_id'];

    protected $casts = [
        'file_path' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($scheme) {
            if (Auth::check() && empty($scheme->user_id)) {
                $scheme->user_id = Auth::id();
            }
        });
    }
}
