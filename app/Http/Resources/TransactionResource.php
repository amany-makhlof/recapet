<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'amount' => $this->amount,
            'transaction_fee' => $this->transaction_fee,
            'user_name' => $this->user->name, // Sender's name
            'recipient_name' => $this->recipient_user_id ? $this->recipient->name : null, // Recipient's name (if available)
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
