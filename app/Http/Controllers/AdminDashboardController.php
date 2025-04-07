<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'restrictToAdmin']);
    }

    public function index()
    {
        $products = Product::all();
        $orders = Order::with('user')->get();
        $contacts = Contact::all();

        return view('admin.dashboard', compact('products', 'orders', 'contacts'));
    }
}