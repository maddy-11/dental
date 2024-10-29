<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Examination;
use App\Models\User;

class PendingPayment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }
}
