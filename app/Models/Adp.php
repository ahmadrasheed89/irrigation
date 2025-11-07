<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adp extends Model
{
    /** @use HasFactory<\Database\Factories\AdpFactory> */
    use HasFactory;

    protected $fillable = [
        'adp_code', 'allocation', 'adp_t_s_cost', 'total_expenditure', 'accured_liability','attached_files', 'user_id',
    ];

    // protected $casts = [
    //     'accured_liability' => 'numeric',
    //     'adp_t_s_cost' => 'numeric',
    //     'total_expenditure' => 'numeric',
    //     'allocation' => 'numeric',
    //     'adp_code' => 'string',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One ADP has many Schemes
    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    // (Optional) Direct access to categories through schemes
    public function categories()
    {
        return $this->hasManyThrough(Category::class, Scheme::class);
    }
}
