<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonobankPayment extends Model
{
    protected  $fillable = ['x_sign', 'invoiceId', 'status', 'amount', 'reference', 'destination'];
}
