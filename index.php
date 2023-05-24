<?php 
    require 'config.php'; 
    
    require 'functions.php';

    $errmsg = '';
    $errmsg2 = '';
    $errmsg3 = '';
    
    

    if ($_POST) {


        $name = security($_POST['Fname']);
        $userName = security($_POST['Uname']);
        $email = security($_POST['mail']);
        $pass = security($_POST['Pass']);
        $passTwo = security($_POST['Pass2']);
        

        if ((!$name) || (!$userName) || (!$email) || (!$pass)) {
            $errmsg = 'Please fill in the required fields.';
            
            
        } elseif ($pass != $passTwo) {
            $errmsg2 = 'The passwords you entered do not match.';
            

        } else {
            
            $user = $db -> prepare("SELECT * FROM user WHERE user_username=? or user_mail=?");

            $user -> execute(array($userName, $email));

            $user -> fetchAll(PDO::FETCH_ASSOC);
            $x = $user -> rowCount();
            if ($x) {
                $errmsg3 = 'Username and email used before.';
                

            } else {
                $register = $db -> 
                prepare("INSERT INTO user SET user_Fullname=?, user_username=?, user_mail=?, user_password=?");
                
                $z = $register -> execute(array($name, $userName, $email, $pass));
                if ($z) {
                    echo 'Registration created';
                    
                    die();

                } else {
                    echo 'Error in registration';
                    die();
                }
            }


        }


    }

?>
    



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>

    <style>
        body{
            font-family: monospace;
        }
        .form{
            padding: 20px;
            border: 1px solid #666666;
            margin: 200px auto;
            border-radius: 10px;
        }

        .header{
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    
    <div class="container">
        
        <div class="form col-sm-10 col-md-9 col-lg-6">

            <?php if (isset($errmsg)) {?>
                <div class="header">
                    <span style="color: red;"><?= $errmsg?> </span>
                </div>
            <?php }?> 
            <?php if (isset($errmsg2)) {?>
                <div class="header">
                    <span style="color: red;"><?= $errmsg2?> </span>
                </div>
            <?php }?>
            <?php if (isset($errmsg3)) {?>
                <div class="header">
                    <span style="color: red;"><?= $errmsg3?> </span>
                </div>
            <?php }?> 
                
            <?php if (isset($succesmsg)) {?>
                <div class="header">
                    <span style="color: red;"><?= $succesmsg?> </span>
                </div>
            <?php }?> 
                

            <div class="header">
                <span >USER REGİSTER FORM</span>
            </div>
            <form action="#" method="post">
                <div class="mb-4">
                
                    <input type="text" name="Fname" class="form-control" placeholder="Enter Your Fullname" id="">
                </div>
                <div class="mb-4">
                    <input type="text" name="Uname" placeholder="Enter Your username.." class="form-control" id="">
                </div>
                <div class="mb-4">
                    <input type="email" name="mail" placeholder="Enter your email" class="form-control" id="">
                </div>
                <div class="mb-4">
                    <input type="password" name="Pass" placeholder="Enter your password" class="form-control" id="">
                </div>
                <div class="mb-4">
                    <input type="password" name="Pass2" placeholder="Again enter your password" class="form-control" id="">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>