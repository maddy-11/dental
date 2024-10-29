<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Examination;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id');
    }
}
