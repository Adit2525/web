<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'kode_invoice',
        'total_harga',
        'status',
        'tanggal_pesan',
        'tanggal_selesai',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'tanggal_pesan' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
