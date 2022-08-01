@extends('layouts.master')

@section('content')
    <section class="page-content index-page">
        <div class="container">
            <div class="card mt-5 mb-3 bg-secondary bg-gradient m-auto" style="width: 50%; --bs-bg-opacity: .3;">
                <div class="card-body">
                    <h5 class="card-title">Products List</h5>
                    <hr />
                    <a href="{{ route('products.create') }}" class="btn btn-primary ps-5 pe-5">Create</a>
                    <a href="{{ route('products.trash') }}" class="btn btn-outline-dark ps-5 pe-5">Trash</a>
                </div>
            </div>
            <div class="container">
                @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show w-50 m-auto mb-3" role="alert">
                    {{$message}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
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
                                <a href="{{ route('products.show', $product->id ) }}" class="btn btn-info text-light btn-sm">Show</a>
                                @if ($product->is_approved == 0)
                                    <a href="{{ route('product.active', $product->id ) }}" class="btn btn-success text-light btn-sm" style="width: 106.1px">Approved</a>
                                @else
                                    <a href="{{ route('product.deactive', $product->id ) }}" class="btn btn-secondary text-light btn-sm">Not Approved</a>
                                @endif
                                <a href="{{ route('products.edit', $product->id ) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('product.softDelete', $product->id ) }}" class="btn btn-warning text-light btn-sm">Delete</a>
                                {{-- <form action="{{ route('products.destroy ', $product->id ) }}"  method="POST" class="m-0 p-0 d-inline "> 
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning text-light btn-sm">Delete</button>
                                </form> --}}
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
