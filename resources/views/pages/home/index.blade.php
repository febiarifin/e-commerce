@extends('layouts.home')

@section('content')
    <div class="row g-4 p-2">
        <div class="col-12">
            <input type="search" class="form-control" placeholder="Search product" id="search">
        </div>
    </div>
    <div class="row g-4 p-2" id="product-list">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">Stock <b
                                class="badge badge-{{ $product->stock != 0 ? 'success' : 'danger' }}">{{ $product->stock != 0 ? $product->stock : 'SOLD' }}</b>
                        </p>
                        <div class="d-flex justify-content-center">
                            <h5 class="flex-grow-1 text-primary mt-2">IDR {{ $product->price }}</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('public.product.show', $product->id) }}"
                                    class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        {{ $products->links() }}
    </div>
@endsection
@section('script')
    <script>
        $('#search').on('keyup', function() {
            search();
        });
        search();

        function search() {
            var keyword = $('#search').val();
            $.post('{{ route('product.search') }}', {
                    _token: '{{ csrf_token() }}',
                    keyword: keyword
                },
                function(data) {
                    $('#product-list').empty();
                    $.each(data.products, function(index, product) {
                        var stockBadge = product.stock != 0 ? 'success' : 'danger';
                        var stockText = product.stock != 0 ? product.stock : 'SOLD';
                        var productHtml = `
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="${product.image}" class="card-img-top" alt="${product.name}">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.name}</h5>
                                        <p class="text-muted">Stock <b class="badge badge-${stockBadge}">${stockText}</b></p>
                                        <div class="d-flex justify-content-center">
                                            <h5 class="flex-grow-1 text-primary mt-2">IDR ${product.price}</h5>
                                            <div class="flex-shrink-0">
                                                <a href="/products/detail/${product.id}" class="btn btn-primary">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#product-list').append(productHtml);
                    });
                });
        }
    </script>
@endsection
