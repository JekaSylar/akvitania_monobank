<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonobankPayment extends Model
{
    protected  $fillable = ['invoiceId', 'status', 'amount', 'reference', 'destination'];
}
