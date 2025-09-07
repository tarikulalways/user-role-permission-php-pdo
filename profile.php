<?php include 'header.php'; ?>
<?php include 'topbar.php'; ?>

<?php 
    $query = $pdo->prepare("SELECT * FROM `users` WHERE user_email=?");
    $query->execute([$_SESSION['user']['user_email']]);

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row){
        $data = $row;
    } 

    $role_id = $data['role_id'];

    $role_q = $pdo->prepare("SELECT * FROM roles WHERE id=?");
    $role_q->execute([$role_id]);

    $role_results = $role_q->fetchAll(PDO::FETCH_ASSOC);
    foreach($role_results as $role){
        $role_name = $role['roles_name'];
    }

?>

<?php 

    if(isset($_POST['profile_update'])){
        try{
            if(empty($_POST['name'])){
                throw new Exception('The Name field is required');
            }

            if(empty($_POST['email'])){
                throw new Exception('The email field is required');
            }

            if($_POST['password'] != $_POST['confirm_password']){
                throw new Exception('New password & confirm password not match!');
            }

            if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                throw new Exception('Invalide email');
            }

            $up_query = $pdo->prepare("UPDATE users SET user_name=?, user_email=?, password=? WHERE id=?");
            
            $up_query->execute([
                $_POST['name'],
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_DEFAULT),
                $role_id
            ]);

            if($up_query->rowCount()){
                unset($_SESSION['user']);
                header('location:login.php');
            }
        }catch(Exception $e){
            $message = $e->getMessage();
        }
    }

?>

    <div class="right-part container-fluid">
        <div class="row">
            
            <?php include 'sidebar.php'; ?>

            <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 pb-3">

                <h1 class="page-heading">Edit Profile</h1>
                <?php 
                    if(isset($message)):
                ?>
                <div class="alert alert-danger"><?php if(isset($message)){echo $message; } ?></div>

                <?php endif; ?>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $data['user_name']; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $data['user_email']; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Role</label>
                            <input type="text" class="form-control" name="" value="<?php echo $role_name; ?>" disabled>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="submit" value="Update" name="profile_update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <?php include 'footer.php'; ?>