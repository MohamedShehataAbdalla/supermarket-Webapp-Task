@extends('layouts.master')

@section('content')
    <section class="page-content index-page">
        <div class="container">
            <div class="card mt-5 mb-3 bg-secondary bg-gradient m-auto" style="width: 50%; --bs-bg-opacity: .3;">
                <div class="card-body">
                    <h5 class="card-title">Trash List of Products</h5>
                    <hr />
                    <a href="{{ route('products.index') }}" class="card-link ps-5 pe-5">Back</a>
                </div>
            </div>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">description</th>
                        <th scope="col">Image</th>
                        <th scope="col">Approved</th>
                        <th scope="col">Controls</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td class="text-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/products/'.$product->image) }}" alt="{{ $product->title }}"height="80" />
                                @else
                                    <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" height="80" />
                                @endif
                            </td>
                            <td class="{{ $product->is_approved ? 'text-success' : 'text-danger' }}">
                                {{ $product->is_approved ? 'Approved' : 'Not Approved' }}
                            </td>
                            <td>
                                <a href="{{ route('product.recover', $product->id ) }}" class="btn btn-success text-light btn-sm">recover</a>
                                <a href="{{ route('product.hardDelete', $product->id ) }}" class="btn btn-danger text-light btn-sm">Delete For Ever</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                {{-- {{ $products->links() }} --}}
            </div>
        </div>
    </section>
@endsection
