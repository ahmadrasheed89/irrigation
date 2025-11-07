<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Builder;

class Tender extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'category_id', 'description', 'date', 'attached_files', 'user_id'
    ];

    protected $casts = [
        'attached_files' => 'array',
        'date' => 'date',
    ];
// Belongs to one Scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    // Belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


    /**
     * Scope: Get the latest tender per scheme, with filters applied.
     */
    public function scopeLatestPerScheme(Builder $query,array $filters = [])
    {

        // Build the subquery separately to find the latest tender IDs per scheme
        $subQuery = self::query()
                    ->select(DB::raw('MAX(id) as id'))
                    ->when($filters['scheme_id'] ?? null, fn($q, $v) => $q->where('scheme_id', $v))
                    ->when($filters['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
                    ->when($filters['q'] ?? null, function ($q, $v) {
                        $q->where('description', 'like', "%{$v}%");
                    })
                    ->groupBy('scheme_id');

                // Main query: fetch the full tender records for those latest IDs
                return $query
                    ->with(['scheme', 'category'])
                    ->when($filters['scheme_id'] ?? null, fn($q, $v) => $q->where('scheme_id', $v))
                    ->when($filters['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
                    ->when($filters['q'] ?? null, function ($q, $v) {
                        $q->where(function ($inner) use ($v) {
                            $inner->where('description', 'like', "%{$v}%")
                                ->orWhereHas('scheme', function ($sq) use ($v) {
                                    $sq->where('scheme_name', 'like', "%{$v}%")
                                    ->orWhere('adp_code', 'like', "%{$v}%");
                                })
                                ->orWhereHas('category', function ($cq) use ($v) {
                                    $cq->where('name', 'like', "%{$v}%")
                                    ->orWhere('description', 'like', "%{$v}%");
                                });
                        });
                    })
                    ->whereIn('id', $subQuery)
                    ->latest();

    }


}
