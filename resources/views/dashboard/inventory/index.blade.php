@extends('layouts.dashboard', ['title'=>'Inventory'])
@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center w-100">
        <h1 class="page-title">Product Inventory</h1>
        <a href="/products/document/create" class="btn btn-primary btn-sm">Add Product</a>

    </div>
    <div class="table-card-custom">
        <!-- Header Controls -->
        <div class="table-header-control">
            <!-- Search bar -->
            <div class="table-search-box">
                <i class="bi bi-search table-search-icon"></i>
                <input type="text" class="table-search-input" placeholder="Search products...">
            </div>
            <!-- Action buttons / Filter options -->
            <div class="table-filter-group">
                <div class="dropdown">
                    <button class="btn-table-action dropdown-toggle" type="button" id="dropdownFilterStatus"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-funnel"></i> Status Filter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownFilterStatus">
                        <li><a class="dropdown-item" href="#">All</a></li>
                        <li><a class="dropdown-item" href="#">Available</a></li>
                        <li><a class="dropdown-item" href="#">Featured</a></li>
                        <li><a class="dropdown-item" href="#">Out of Stock</a></li>
                    </ul>
                </div>
                <!-- <button class="btn-table-action" type="button">
                        <i class="bi bi-file-earmark-arrow-down"></i> Export
                    </button> -->
            </div>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            @if($products->count() > 0)
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="table-user-cell">
                                {{$product->name}}
                            </div>
                        </td>
                        <td class="table-product-name">{{ $product->category }}</td>
                        <td class="text-capitalize">{{$product->status}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <a href="#" class="table-btn-action" title="View details"><i class="bi bi-eye"></i></a>
                                <a href="#" class="table-btn-action" title="Edit row"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="table-btn-action delete" title="Delete row"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center p-4 gap-2">
                <i class="bi bi-inbox fs-5 mb-3"></i>
                <div class="mb-3">No products found</div>
                <a href="/products/document/create" class="btn btn-primary btn-sm">Add Product</a>
            </div>
            @endif
        </div>

        <!-- Footer Controls / Pagination -->
        <div class="table-footer-control">
            <span class="table-pagination-info">{{$products->links()}}</span>
            <a href="/enrollments" class="">View All...</a>
        </div>
    </div>
</div>
@endsection