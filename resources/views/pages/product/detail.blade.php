@extends($layout)

@section('content')
    <div class="row">
        <div class="col-md-6 border text-center" style="background-color: #f2f2f2;">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" height="500">
        </div>
        <div class="col-md-6 border p-3 bg-white">
            <form action="" method="post">
                @csrf
                <h2>{{ $product->name }}</h2>
                <div class="text-muted">{!! nl2br($product->description) !!}</div>
                <p class="mt-3">
                    Stock <b> {{ $product->stock }}</b> <br>
                    <span class="fs-4">IDR {{ $product->price }}</span>
                </p>
                <div class="mb-5">
                    <label for="quantity" class="form-label">Quantity:</label>
                    <div class="input-group" style="max-width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQty"
                            {{ $product->stock == 0 ? 'disabled' : '' }}>-</button>
                        <input type="text" id="quantity" name="quantity" class="form-control text-center" value="1"
                            min="1" max="{{ $product->stock }}" {{ $product->stock == 0 ? 'disabled' : '' }}>
                        <button class="btn btn-outline-secondary" type="button" id="increaseQty"
                            {{ $product->stock == 0 ? 'disabled' : '' }}>+</button>
                    </div>
                </div>
                <button type="submit"
                    class="btn btn-primary mt-3 {{ $product->stock == 0 ? 'disabled' : '' }}">Checkout</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('decreaseQty').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity');
            var currentValue = parseInt(qtyInput.value);
            if (currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });

        document.getElementById('increaseQty').addEventListener('click', function() {
            var qtyInput = document.getElementById('quantity');
            var currentValue = parseInt(qtyInput.value);
            var maxStock = parseInt(qtyInput.max);
            if (currentValue < maxStock) {
                qtyInput.value = currentValue + 1;
            }
        });
    </script>
@endsection
