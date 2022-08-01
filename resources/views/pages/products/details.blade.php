@extends('layouts.master')

@section('content')

    <section class="page-content index-page">
        <div class="container">
            <div class="card mt-5 mb-5 bg-secondary bg-gradient m-auto" style="width: 50%; --bs-bg-opacity: .3;">
                <div class="card-body">
                    <h5 class="card-title">Details Product</h5>
                    <hr />
                    <a href="{{ route('products.index') }}" class="card-link ps-5 pe-5">Back</a>
                </div>
            </div>

            <div class="card text-bg-dark mb-3 w-100">
                <div class="card-header">Details About "{{ $product->title }}" Product</div>
                <div class="card-body">
                    <form action="{{ route('products.show', $product->id) }}" method="GET">
                        @method('GET')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $product->title }}"
                                        readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}"
                                         readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="is_approved" class="form-label">Is Approved</label>
                                    <div class="form-control {{ $product->is_approved ? 'text-success' : 'text-danger' }}" 
                                        id="is_approved">{{ $product->is_approved ? 'Approved' : 'Not Approved' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="4" readonly disabled>{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/images/products/'.$product->image) }}" alt="{{ $product->title }}"height="150" />
                                @else
                                    <img src="{{ asset('storage/images/noImage.png') }}" alt="Empty" height="150" />
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="created_by" class="form-label">Created By</label>
                                    <input type="text" class="form-control" id="created_by" name="created_by" value="{{ $product->created_by }}"
                                        readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="created_at" class="form-label">Created At</label>
                                    <input type="number" class="form-control" id="created_at" name="created_at" value="{{ $product->created_at }}"
                                         readonly disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="updated_by" class="form-label">Updated By</label>
                                    <input type="text" class="form-control" id="updated_by" name="updated_by" value="{{ $product->updated_by }}"
                                        readonly disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="updated_at" class="form-label">Updated At</label>
                                    <input type="number" class="form-control" id="updated_at" name="updated_at" value="{{ $product->updated_at }}"
                                         readonly disabled>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
