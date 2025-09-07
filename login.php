<?php include 'header.php'; ?>
<?php 
    if(isset($_SESSION['user'])){
        header('location:index.php');
    }
?>

<?php 

    try{

        if(isset($_POST['login_from'])){

            if(empty($_POST['email'])){
                throw new Exception("The email field is required");  
            }

            if(! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                throw new Exception("Invalide Email Address");
            }

            if(empty($_POST['password'])){
                throw new Exception('Password field is requred');
            }

            $query = $pdo->prepare("SELECT * FROM `users` WHERE user_email=?");
            $query->execute([$_POST['email']]);
            
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            if(! count($results)){
                throw new Exception('User not found');
            }else{
                foreach($results as $result){
                    if(! password_verify($_POST['password'], $result['password'])){
                        throw new Exception('Incorret password');
                    }
                }
            }

            $_SESSION['user'] = $result;
            header('location:index.php');
        }

    }catch(Exception $e){
        $message = $e->getMessage();
    }

?>

<div class="container-login">
    <main class="form-signin w-100 m-auto">
        <h1 class="text-center">Login</h1>
        <?php 
            if(isset($message)){
                ?>
                <p class="alert alert-danger"><?php echo $message; ?></p>
                <?php
            }
        ?>
        <form action="" method="POST">
            <div class="form-floating">
                <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" autocomplete="off">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" autocomplete="off">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login_from">Login</button>
        </form>
    </main>
</div>

<?php include 'footer.php'; ?>