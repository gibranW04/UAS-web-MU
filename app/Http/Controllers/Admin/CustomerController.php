<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::withCount('orders')->latest()->paginate(15);
        return view('admin.customers.index', compact('users'));
    }
}
