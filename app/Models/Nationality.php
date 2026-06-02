<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'nationality_ar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
