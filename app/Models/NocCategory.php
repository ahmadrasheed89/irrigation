<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocCategory extends Model
{
    /** @use HasFactory<\Database\Factories\NocCategoryFactory> */
    use HasFactory;
    protected $table = 'noc_categories';
    protected $fillable = ['name', 'description'];

    public function nocs()
    {
        return $this->belongsToMany(NOC::class, 'noc_files')
                    ->withPivot(['id', 'amount', 'status', 'file'])
                    ->withTimestamps();
    }

    // (Optional) Access Tender pivot entries directly
    public function nocFiles()
    {
        return $this->hasMany(NocFile::class);
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
