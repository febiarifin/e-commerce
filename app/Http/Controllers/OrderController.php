<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with(['orders'])->findOrFail(Auth::user()->id);
        if ($user->role == User::ADMIN) {
            $orders = Order::orderBy('created_at', 'desc')->get();
            $layout = 'layouts.template';
        } else {
            $layout = 'layouts.home';
            $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        }
        $data = [
            'title' => 'Order Product',
            'active' => 'order',
            'is_auth' => false,
            'orders' => $orders,
            'layout' => $layout,
        ];
        return view('pages.order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($request->product_id);

            $total_amount = $product->price * $request->quantity;

            $payload = [
                'transaction_details' => [
                    'order_id' => 'ORDER-PRODUCT-' . $product->id,
                    'gross_amount' => $total_amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total_amount,
                'snap_token' => $snapToken,
                'status' => 'pending',
                'note' => $request->note,
            ]);

            if ($product->stock < $request->quantity) {
                throw new \Exception("Insufficient stock for product {$product->name}");
            }

            $product->decrement('stock', $request->quantity);
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $total_amount,
            ]);

            DB::commit();

            toastr()->success('Congluration your checkout has been successfully!');
            return redirect()->route('orders.show', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $user = Auth::user();
        if ($user->role == User::CUSTOMER) {
            if ($order->user_id != $user->id) {
                return back();
            }
        }

        if ($user->role == User::ADMIN) {
            $layout = 'layouts.template';
        } else {
            $layout = 'layouts.home';
        }
        $data = [
            'title' => 'Detail Order',
            'active' => 'order',
            'is_auth' => false,
            'order' => $order,
            'layout' => $layout,
        ];
        return view('pages.order.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function success(Order $order)
    {
        $order->update([
            'status' => Order::COMPLETED,
        ]);
        toastr()->success('Congluration your payment has been successfully!');
        return redirect()->route('orders.show', $order->id);
    }

    public function cancelled(Order $order)
    {
        $order->update([
            'status' => Order::CANCELLED,
        ]);

        $product = $order->items()->first()->product;
        $product->update([
            'stock' => $product->stock + $order->items()->first()->quantity,
        ]);
        toastr()->success('Your payment has been canceled!');
        return redirect()->route('orders.show', $order->id);
    }
}
