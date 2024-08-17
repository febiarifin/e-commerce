@extends($layout)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="card-title flex-grow-1">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if (Auth::user()->role == \App\Models\User::ADMIN)
                                        <th>Customer Info</th>
                                    @endif
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    @if (Auth::user()->role == \App\Models\User::ADMIN)
                                        <th>Customer Info</th>
                                    @endif
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        @if (Auth::user()->role == \App\Models\User::ADMIN)
                                            <td>{{ $order->user->email }}</td>
                                        @endif
                                        <td>{{ $order->items()->first()->product->name }}</td>
                                        <td>{{ $order->items()->first()->quantity }}</td>
                                        <td>IDR {{ $order->total_price }}</td>
                                        <td>
                                            @if ($order->status == \App\Models\Order::COMPLETED)
                                                <span class="badge badge-success text-uppercase">{{ $order->status }}</span>
                                            @elseif ($order->status == \App\Models\Order::CANCELLED)
                                                <span class="badge badge-danger text-uppercase">{{ $order->status }}</span>
                                            @elseif ($order->status == \App\Models\Order::PENDING)
                                                <span
                                                    class="badge badge-secondary text-uppercase">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == \App\Models\Order::COMPLETED)
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            @elseif ($order->status == \App\Models\Order::CANCELLED)
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            @elseif ($order->status == \App\Models\Order::PENDING)
                                                @if (Auth::user()->role == \App\Models\User::ADMIN)
                                                    <a href="{{ route('orders.show', $order->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('orduers.show', $order->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-dollar-sign"></i> PAYMENT
                                                    </a>
                                                @endif
                                            @endif
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
            $('#order-datatables').DataTable();
        });
    </script>
@endsection
