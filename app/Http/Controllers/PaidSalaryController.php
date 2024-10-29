<?php

namespace App\Http\Controllers;
use App\Models\PaidSalary;

use Illuminate\Http\Request;

class PaidSalaryController extends Controller
{
    public function destroy($id)
    {
        PaidSalary::findOrFail($id)->delete();
        return back()->with('success', 'Payment Deleted successfuly');
    }
}
