<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    protected $fillable = ['constractor_name', 'email', 'phone','vendor_no'];
    protected $searchable = ['constractor_name','email','phone','vendor_no'];

    public function schemes() {
        return $this->hasMany(Scheme::class);
    }
     public function scopeSearch($query, $search)
    {
        return $query->where('constractor_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('vendor_no', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->search($search);
        });
    }
}
