<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'monthly_fee',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}