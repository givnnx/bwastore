<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::sum('total_price');
        $transaction = Transaction::count();
        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'transaction' => $transaction,
            'revenue' => $revenue,
        ]);
    }
}
