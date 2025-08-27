<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'reference',
        'account_id',
        'amount',
        'type',
        'description',
        'processed_at',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
