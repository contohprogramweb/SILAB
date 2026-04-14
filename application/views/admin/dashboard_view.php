<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $total_users; ?></h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?php echo site_url('admin/users'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $total_products; ?></h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="<?php echo site_url('admin/products'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Welcome to Admin Dashboard</h3>
            </div>
            <div class="card-body">
                <p>Selamat datang di sistem administrasi berbasis CodeIgniter 3.11 dengan tema AdminLTE 3.</p>
                <p>Gunakan menu di sebelah kiri untuk navigasi ke berbagai fitur sistem.</p>
            </div>
        </div>
    </div>
</div>
