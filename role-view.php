<?php include 'header.php'; ?>

<?php 
    $query = $pdo->prepare("SELECT * FROM roles");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<?php include 'topbar.php'; ?>

<?php include 'sidebar.php'; ?>


<div class="right-part container-fluid">
    <div class="row">
        
        <?php include 'sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pb-3">
            <h2 class="page-heading mt_10">Recent Users
                <a href="role-create.php" class="btn btn-primary">Create Role</a>
            </h2>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i=0;
                            foreach($results as $result):
                                $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['roles_name']; ?></td>
                            <td>
                                <a href="role-update.php?id=<?php echo $result['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="role-delete.php?id=<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>


<?php include 'footer.php'; ?>