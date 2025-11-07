<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Scheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_name', 'cost', 'adp_code',
        'contractor_id', 'contractor_premium', 'bid_cost', 'user_id'
    ];
    protected array $searchable = ['scheme_name', 'cost', 'adp_code'];

    protected static function booted(): void
    {
        static::creating(function ($scheme) {
            if (Auth::check() && empty($scheme->user_id)) {
                $scheme->user_id = Auth::id();
            }
        });
    }

    public function contractor() {
        return $this->belongsTo(Contractor::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Belongs to an ADP
    public function adp()
    {
        return $this->belongsTo(Adp::class);
    }

    // One Scheme has many Tenders
    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    // Many-to-Many with Category through tender pivot
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tenders');
    }
}
