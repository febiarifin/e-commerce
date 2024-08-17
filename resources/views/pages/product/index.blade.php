@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-title flex-grow-1">{{ $title }}</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus-circle"></i> Add Product
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="product-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->image }}"
                                                height="50">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>IDR {{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            @if ($product->status == \App\Models\Product::ACTIVE)
                                                <span
                                                    class="badge badge-success text-uppercase">{{ $product->status }}</span>
                                            @else
                                                <span
                                                    class="badge badge-danger text-uppercase">{{ $product->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                                                &nbsp;
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                &nbsp;
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete it?')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#product-datatables').DataTable();
        });
    </script>
@endsection
