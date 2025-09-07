<?php include 'header.php'; ?>
<?php 

    if(! isset($_SESSION['user'])){
        header('location:login.php');
    }

?>
<?php include 'topbar.php'; ?>

<div class="right-part container-fluid">
    <div class="row">

        <?php include 'sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pb-3">

            <h1 class="page-heading">Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="number">3</div>
                        <div class="text">Roles</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <div class="number">10</div>
                        <div class="text">Users</div>
                    </div>
                </div>
            </div>

            <h2 class="page-heading mt_10">Recent Users</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Robin</td>
                            <td>robin@gmail.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>David</td>
                            <td>david@gmail.com</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Smith</td>
                            <td>smith@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php include 'footer.php'; ?>