<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getStatusBadgeAttribute()
    {
        return $this->status ?
            '<span class="badge bg-success">Active</span>' :
            '<span class="badge bg-danger">Inactive</span>';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
    }

    // In User model
public function scopeFilter($query, array $filters)
{
    $query->when($filters['search'] ?? null, function ($query, $search) {
        $query->search($search);
    })->when($filters['status'] ?? null, function ($query, $status) {
        $query->where('status', $status === 'active');
    });
}

    public function adps()
    {
        return $this->hasMany(Adp::class);
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }
}
