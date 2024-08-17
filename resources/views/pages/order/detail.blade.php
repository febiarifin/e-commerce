@extends($layout)

@section('content')
    <div class="row">
        <div class="col-md-6 border text-center" style="background-color: #f2f2f2;">
            <img src="{{ asset($order->items()->first()->product->image) }}"
                alt="{{ $order->items()->first()->product->name }}" height="500">
        </div>
        <div class="col-md-6 border p-3 bg-white">
            @if (Auth::user()->role == \App\Models\User::ADMIN)
            <p><span class="text-muted">Customer Info: </span> {{ $order->user->email }}</p>
        @endif
            <h2>{{ $order->items()->first()->product->name }}</h2>
            <p class="text-muted">Note: {{ $order->note }}</p>
            <hr>
            <div class="d-flex">
                <span class="flex-grow-1 fs-4">Product Price</span>
                <span class="flex-shrink-0 fs-4 fw-bold">IDR {{ $order->items()->first()->product->price }}</span>
            </div>
            <div class="d-flex">
                <span class="flex-grow-1 fs-4">Quantity</span>
                <span class="flex-shrink-0 fs-4 fw-bold">{{ $order->items()->first()->quantity }}</span>
            </div>
            <hr>
            <div class="d-flex">
                <span class="flex-grow-1 fs-4">Total</span>
                <span class="flex-shrink-0 fs-4 fw-bold">IDR {{ $order->total_price }}</span>
            </div>
            @if ($order->status == \App\Models\Order::PENDING)
                <button class="btn btn-primary mt-5" id="pay-button">PAY WITH MIDTRANS</button>
                <a href="{{ route('order.cancelled', $order->id) }}" class="btn btn-danger mt-5" onclick="return confirm('Are you sure you want to cancel it?')">CANCEL CHECKOUT</a>
            @elseif ($order->status == \App\Models\Order::COMPLETED || $order->status == \App\Models\Order::CANCELLED)
                <button
                    class="btn btn-{{ $order->status == \App\Models\Order::COMPLETED ? 'success' : 'danger' }} mt-5 text-uppercase"
                    disabled>{{ $order->status }}</button>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('order.success', $order->id) }}';
                },
                onPending: function(result) {

                },
                onError: function(result) {

                }
            });
        };
    </script>
@endsection
