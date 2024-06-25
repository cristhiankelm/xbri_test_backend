<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'total_amount',
        'status',
    ];

    // Relation with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation with client
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    // Relation with order items
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relation with payments
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
