@extends('admin.layout')
   

        <!-- Main Content -->
        <main>
        <div class="main-content">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                    </a>
                </div>
                
                <!-- Content Row -->
                <div class="row">
                    <!-- Earnings (Monthly) Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card dashboard-card card-primary h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Earnings (Monthly)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card dashboard-card card-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Products</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">215</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-boxes fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card dashboard-card card-info h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            New Orders</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card dashboard-card card-warning h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">12</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <!-- Quick Actions -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-block">
                                            <i class="fas fa-box"></i> Manage Products
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="#" class="btn btn-info btn-block">
                                            <i class="fas fa-users"></i> Manage Users
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="#" class="btn btn-warning btn-block">
                                            <i class="fas fa-shopping-cart"></i> View Orders
                                        </a>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <a href="#" class="btn btn-danger btn-block">
                                            <i class="fas fa-chart-line"></i> View Analytics
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">New order received</h6>
                                            <small>15 mins ago</small>
                                        </div>
                                        <p class="mb-1">Order #12345 for $120.00</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">Product added</h6>
                                            <small>1 hour ago</small>
                                        </div>
                                        <p class="mb-1">"New Smartphone Model" added to inventory</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">User registered</h6>
                                            <small>3 hours ago</small>
                                        </div>
                                        <p class="mb-1">New customer "John Doe" registered</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            // You can add sidebar toggle functionality here if needed
            // For example when you implement a navbar with hamburger menu
            
            // Example of making cards clickable
            document.querySelectorAll('.dashboard-card').forEach(card => {
                card.style.cursor = 'pointer';
                card.addEventListener('click', function() {
                    // Add your click behavior here
                    console.log('Card clicked');
                });
            });
        });
    </script>
</body>
</html>