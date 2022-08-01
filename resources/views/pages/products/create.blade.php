@extends('layouts.master')

@section('content')
    <section class="page-content index-page">
        <div class="container">
            <div class="card mt-5 mb-5 bg-secondary bg-gradient m-auto" style="width: 50%; --bs-bg-opacity: .3;">
                <div class="card-body">
                    <h5 class="card-title">Create Product</h5>
                    <hr />
                    <a href="{{ route('products.index') }}" class="card-link ps-5 pe-5">Back</a>
                </div>
            </div>

            <div class="card text-bg-dark mb-3 w-100">
                <div class="card-header">Create New Product</div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Labtop Apple" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" min="0"
                                        placeholder="35000" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image"  accept="image/*"  onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        placeholder="The MacBook is carved out of solid aluminum, thus giving it a distinctive look and a grayish-white hue..."
                                        rows="4"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <img src="{{ asset('storage/images/noImage.png') }}" id="preview" alt="Empty" height="150" />
                            </div>
                        </div>

                        <div class="d-inline-flex justify-content-between align-items-center w-100">
                            <button type="submit" class="btn btn-primary ps-5 pe-5">Add</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
