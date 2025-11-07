<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocFile extends Model
{
    /** @use HasFactory<\Database\Factories\NocFileFactory> */
    use HasFactory;

      protected $fillable = [
        'noc_id', 'noc_category_id', 'description', 'date', 'attached_files', 'user_id'
    ];

    protected $casts = [
        'attached_files' => 'array',
        'date' => 'date',
    ];
// Belongs to one Scheme
    public function noc()
    {
        return $this->belongsTo(Noc::class);
    }

    // Belongs to one Category
    public function nocCategory()
    {
        return $this->belongsTo(NocCategory::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
