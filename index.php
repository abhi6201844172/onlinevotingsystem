<?php
require_once("admin/inc/config.php");
if (isset($_POST['sign_up__btn'])) {
    $su_username = mysqli_real_escape_string($db, $_POST['su_username']);
    $su_contact_no = mysqli_real_escape_string($db, $_POST['su_contact_no']);
    $su_password = mysqli_real_escape_string($db,sha1($_POST['su_password']));
    $su_retype_password =mysqli_real_escape_string($db, sha1($_POST['su_retype_password']));
    $user_role = "voter";

    if ($su_password === $su_retype_password) {
       

        // Insert query
        mysqli_query($db, "INSERT INTO users(username, contact_no, password, user_role) VALUES('".$su_username."', '".$su_contact_no."', '".$su_password."', '".$user_role."')") or die(mysqli_error($db));
        ?>
           <script>location.assign("index.php?sign_up&registered=1");</script>;
        <?php

        //echo '<script>location.assign("index.php?sign_up&registered=1")</script>';
    } else {
        ?>
        <script>location.assign("index.php?sign_up&invalid=1");</script>
        <?php
        //echo '<script>location.assign("index.php?sign_up&invalid=1")</script>';
    }
    
}else if(isset($_POST['btn login_btn'])){
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $password  = mysqli_real_escape_string($db, Sha1($_POST['password ']));
     //Query fatch
     $fetchingdata= mysqli_query($db,"SELECT * FROM users WHERE contact_no='".$contact_no."'") or die(mysqli_error($db));
     
     if(mysqli_num_rows( $fetchingdata)>0){
        $data=mysqli_fetch_assoc(fetchingdata);
        if($contact_no==$data['contact_no'] AND $password==$data['password'])
        {
           
        }else
        {
           ?>
              <script>location.assign("index.php?sign_up&invalid_access=1");</script>
           <?php
        }

     }else
     {
        ?>
        <script>location.assign("index.php?sign_up&not_registered=1");</script>  
        <?php
     }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Voting System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="assets/images/logo.gif" class="brand_logo" alt="logo">
                    </div>
                </div>
                <?php if (isset($_GET['sign_up'])): ?>
                    <div class="d-flex justify-content-center form_container">
                        <form method="POST" action="index.php">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="su_username" class="form-control input_user" placeholder="Username" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="su_contact_no" class="form-control input_pass" placeholder="Contact No" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_password" class="form-control input_pass" placeholder="Password" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="su_retype_password" class="form-control input_pass" placeholder="Retype Password" required />
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="sign_up__btn" class="btn login_btn">Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links text-white">
                            Already Created Account? <a href="index.php" class="ml-2 text-white">Sign In</a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="d-flex justify-content-center form_container">
                        <form method="POST" action="login.php">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="contact_no" class="form-control input_user" placeholder="contact_no" required />
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control input_pass" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label text-white" for="customControlInline">Remember me</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" class="btn login_btn">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links text-white">
                            Don't have an account? <a href="?sign_up" class="ml-2 text-white">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            <a href="#" class="text-white">Forgot your password?</a>
                        </div>
                    </div>
                <?php 
                   
                ?>
                <?php 

                    if(isset($_GET['registered']))
                    {
                        ?>
                        <span class="bg-white text-success text-center my-3"> your account has been created successfully</span>
                        <?php
                    }elseif(isset($_GET['invalid'])){
                        ?>
                        <span class="bg-white text-danger text-center my-3"> password  mismatch,please try again </span>
                        <?php
                    }elseif(isset($_GET['not_registered'])){
                        ?>
                        <span class="bg-white text-danger text-center my-3"> sorry,you are not registered! </span>
                        <?php
                    }elseif(isset($_GET['not_registered'])){
                        ?>
                        <span class="bg-white text-danger text-center my-3"> invalid username or password! </span>
                        <?php 
                   }
                ?>



            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html> 