<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\HasMany;
=======
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
<<<<<<< HEAD
            'is_active' => 'boolean',
        ];
    }

    public function simpananDibuat(): HasMany
    {
        return $this->hasMany(\App\Models\Simpanan::class, 'dibuat_oleh');
    }

    public function simpananDiverifikasi(): HasMany
    {
        return $this->hasMany(\App\Models\Simpanan::class, 'diverifikasi_oleh');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
=======
        ];
    }
}
>>>>>>> cc2282c4008e976e311c2f097f7febbee9aa6c86
