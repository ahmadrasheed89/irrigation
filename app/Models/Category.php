<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\CategoriesStatus;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Many-to-Many with Scheme through tender pivot
    public function schemes()
    {
        return $this->belongsToMany(Scheme::class, 'tenders')
                    ->withPivot(['id', 'amount', 'status', 'file'])
                    ->withTimestamps();
    }

    // (Optional) Access Tender pivot entries directly
    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'status' => CategoriesStatus::class,
        ];
    }
}
