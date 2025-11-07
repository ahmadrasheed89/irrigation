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

}
