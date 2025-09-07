<?php include 'header.php'; ?>

<?php 
    try{ 
        if(isset($_POST['add_role'])){
            if(empty($_POST['name'])){
                throw new Exception('The name field is required');
            }

            if(empty($_POST['update_id'])){
                throw new Exception('The id is required');
            }

            $query = $pdo->prepare("UPDATE roles SET roles_name=? WHERE id=?");
            $query->execute([$_POST['name'], $_POST['update_id']]);

            if($query->rowCount()){
                throw new Exception('User update successfull!');
            }
        }
    }catch(Exception $e){
        $message = $e->getMessage();
    }
?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $query = $pdo->prepare("SELECT * FROM roles WHERE id=?");
    $query->execute([$id]);

    $result = $query->fetch(PDO::FETCH_ASSOC);
?>

<?php include 'topbar.php'; ?>


    <div class="right-part container-fluid">
        <div class="row">
            
            <?php include 'sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pb-3">
                <h1 class="page-heading">Update Role
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
                    <input type="hidden" name="update_id" value="<?php echo $result['id']; ?>">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $result['roles_name']; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="submit" value="Update" name="add_role" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <?php include 'footer.php'; ?>