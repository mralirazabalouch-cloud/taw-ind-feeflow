<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'student_id',
        'invoice_number',
        'amount',
        'due_date',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
