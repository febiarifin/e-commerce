<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'JAMKO',
            'active' => 'home',
            'is_auth' => false,
            'products' => Product::orderBy('created_at', 'desc')->where('status', Product::ACTIVE)->paginate(8),
        ];
        return view('pages.home.index', $data);
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'is_auth' => false,
            'product_count' => Product::all()->count(),
            'order_count' => Order::all()->count(),
            'customer' => User::where('role', User::CUSTOMER)->get()->count(),
            'sales' => Order::where('status', Order::COMPLETED)->sum('total_price'),
        ];
        return view('pages.dashboard.index', $data);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }

}
