<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'transaction_id',
        'currency_id',
        'order_number',
        'status',
        'total_amount',
        'return_amount',
        'exchange_rate',
        'placed_at',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function account(): BelongsTo
    {
        return $this->transaction()->account();
    }

    public function user(): BelongsTo
    {
        return $this->account()->user();
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
