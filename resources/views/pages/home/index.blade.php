@extends('layouts.home')

@section('content')
    <div class="row g-4 p-2">
        @foreach ($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-muted">Stock <b>{{ $product->stock }}</b></p>
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
