<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'JAMKO',
            'active' => null,
            'is_auth' => false,
            'products' => Product::orderBy('created_at', 'desc')->paginate(8),
        ];
        return view('pages.home.index', $data);
    }

}
