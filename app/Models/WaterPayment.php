<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WaterPayment extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'paid_at' => 'date'
    ];

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WaterBillInvoice::class);

    }


}
