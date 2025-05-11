<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    protected $fillable = [
        'user_id',
        'tracking_no',
        'fullname',
        'phone',
        'email',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'payment_id',
        'agent_id',
        'type',
    ];

    /* public function user () {
        return $this->belongsTo(User::class);
    } */
    public function agent () {
        return $this->belongsTo(User::class, 'agent_id');
    }

    /**
     * Get all of the orderItems for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockItems(): HasMany
    {
        return $this->hasMany(StockItem::class);
    }

}
