<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
    ];
    // Wallet belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Wallet has many transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
