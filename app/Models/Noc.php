<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noc extends Model
{
    use HasFactory;

    protected $fillable = ['issue_no','noc_subject','nature_of_noc','noc_number','department','remarks','issued_date','attachment','user_id','nocstatus', 'filestatus'];

    protected $casts = ['issued_date' => 'date'];
    public function getNocStatusNameAttribute()
    {
        return match ($this->status) {
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Rejected',
            default => 'Unknown',
        };
    }

    public function getFileStatusNameAttribute()
    {
        return match ($this->status) {
            0 => 'XEN',
            1 => 'SDO',
            2 => 'Return To XEN',
            default => 'Unknown',
        };
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
