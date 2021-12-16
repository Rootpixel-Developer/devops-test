@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9">{{ __('Product') }}</div>
                            <div class="col-3">
                                <a href="{{ url('home/create') }}" class="btn btn-sm btn-primary float-end">Create
                                    Product</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Module</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ number_format($product->price) }}</td>
                                    <td>{{ $product->product_module }}</td>
                                    <td>
                                        <a href="{{ url('/home/edit/'.$product->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="#" class="btn btn-danger" data-id="{{ $product->id }}">Delete</a>
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
        $('.btn-danger').click(function () {
            if (confirm("Are you sure you want to delete this?")) {
                var id = $(this).data('id');
                $.post({
                    url: '{{ url('/home/delete/') }}/' + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'delete'
                    },
                    success: (response) => {
                        location.reload();
                    }
                })
            } else {
                return false;
            }
        })
    </script>
@endsection
