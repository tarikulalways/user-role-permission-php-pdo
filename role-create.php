<?php include 'header.php'; ?>

<?php 
    try{

        if(isset($_POST['add_role'])){
            if(empty($_POST['name'])){
                throw new Exception('Role name is required');
            }

            $query = $pdo->prepare("INSERT INTO roles (roles_name) VALUES (?)");
            $query->execute([$_POST['name']]);

            if($pdo->lastInsertId()){
                $message = 'Role Added Successfull';
            }else{
                $message = 'Role do not added';
            }
        }

    }catch(Exception $e){
        $message = $e->getMessage();
    }
?>



<?php include 'topbar.php'; ?>


    <div class="right-part container-fluid">
        <div class="row">
            
            <?php include 'sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pb-3">
                <h1 class="page-heading">Add Role
                    <a href="role-view.php" class="btn btn-primary">All Role</a>
                </h1>

                <?php 
                    if(isset($message)){
                        ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php
                    }
                ?>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="submit" value="Create" name="add_role" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <?php include 'footer.php'; ?>