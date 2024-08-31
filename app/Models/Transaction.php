<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipient_user_id',
        'type',
        'amount',
        'transaction_fee',
    ];

    /**
     * Get the user associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get the recipient associated with the transaction.
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id');
    }
    // Transaction belongs to a wallet
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
