@extends('layouts.dashboard', ['title'=>'Dashboard'])
@section('content')
<section>
    <div class="container">
        <div class="row g-3" id="dashboard-stats">
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-stat-card total">
                    <div class="dashboard-stat-icon"><i class="bi bi-file-earmark"></i></div>
                    <div class="dashboard-stat-content">
                        <div class="dashboard-stat-title">Total Stock</div>
                        <div class="dashboard-stat-value">{{ $stats['inventory'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-stat-card rejected">
                    <div class="dashboard-stat-icon"><i class="bi bi-list"></i></div>
                    <div class="dashboard-stat-content">
                        <div class="dashboard-stat-title">Total Sales</div>
                        <div class="dashboard-stat-value">{{ $stats['sales'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-stat-card pending">
                    <div class="dashboard-stat-icon"><i class="bi bi-hourglass-split"></i></div>
                    <div class="dashboard-stat-content">
                        <div class="dashboard-stat-title">Pending Orders</div>
                        <div class="dashboard-stat-value">{{ $stats['orders'] }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="dashboard-stat-card registered">
                    <div class="dashboard-stat-icon"><i class="bi bi-check-circle"></i></div>
                    <div class="dashboard-stat-content">
                        <div class="dashboard-stat-title">Returned Orders</div>
                        <div class="dashboard-stat-value">{{ $stats['returned'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header">
        <div>
            <h1 class="page-title">Recent Orders</h1>
        </div>
        <div class="table-card-custom">
            <!-- Header Controls -->
            <div class="table-header-control">
                <!-- Search bar -->
                <div class="table-search-box">
                    <i class="bi bi-search table-search-icon"></i>
                    <input type="text" class="table-search-input" placeholder="Search orders...">
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
                            <li><a class="dropdown-item" href="#">Pending</a></li>
                            <li><a class="dropdown-item" href="#">Completed</a></li>
                            <li><a class="dropdown-item" href="#">Returned</a></li>
                        </ul>
                    </div>
                    <!-- <button class="btn-table-action" type="button">
                        <i class="bi bi-file-earmark-arrow-down"></i> Export
                    </button> -->
                </div>
            </div>

            <!-- Responsive Table Wrapper -->
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $order)
                        <tr>
                            <td>
                                <div class="table-user-cell">
                                    {{$order->order->order_number}}
                                </div>
                            </td>
                            <td class="table-product-name">{{ $order->product_name }}</td>
                            <td class="text-capitalize">{{$order->order->status}}</td>
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
            </div>

            <!-- Footer Controls / Pagination -->
            <div class="table-footer-control">
                <span class="table-pagination-info">Showing 1 to 10 of 10 entries</span>
                <a href="/enrollments" class="">View All...</a>
            </div>
        </div>
    </div>
</section>
@endsection