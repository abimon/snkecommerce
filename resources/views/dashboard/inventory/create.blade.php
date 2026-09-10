@extends('layouts.dashboard', ['title'=>'Add Product'])
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-8 p-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="text-align: center;">Add Document Product</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-2">
                        <label class='mb-2' for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" autofocus required>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="short_description">Short Description</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="doc">Document File</label>
                        <input type="file" class="form-control" id="doc" name="doc" accept=".pdf" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Select a category</option>
                            <option value="Meal plans">Meal plans</option>
                            <option value="Recipes">Recipes</option>
                            <option value="Guides">Guides</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="cover_image">Cover Image</label>
                        <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*" required>
                    </div>
                    <div class="form-group mt-2">
                        <label class='mb-2' for="pages">Pages</label>
                        <input type="number" class="form-control" id="pages" name="pages" required>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="form-group mt-2 col-md-6">
                            <label class='mb-2' for="featured">Featured</label>
                            <input type="checkbox" checked id="featured" name="featured">
                        </div>
                        <div class="form-group mt-2 col-md-6">
                            <label class='mb-2' for="is_active">Active</label>
                            <input type="checkbox" id="is_active" checked name="is_active">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection