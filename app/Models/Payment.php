<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Examination;
use App\Models\Invoice;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
