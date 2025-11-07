<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    protected $fillable = ['constractor_name', 'email', 'phone'];
    protected $searchable = ['constractor_name','email','phone'];

    public function schemes() {
        return $this->hasMany(Scheme::class);
    }
}
