<?php 
session_start();
include 'db.php';

if(isset($_POST['submit'])){    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    if(!empty($name) && !empty($email) && !empty($password) && !empty($mobile)){
        $sql1="SELECT * FROM users WHERE email='$email' OR mobile='$mobile'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            //echo "User already exists";
            $_SESSION['message'] = 'User already exists';
            $_SESSION['message_type'] = 'error';
        } else {
            $sql = "INSERT INTO users (name, email, password, mobile) VALUES ('$name', '$email', '$password', '$mobile')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               // echo "User added successfully";
               $_SESSION['message'] = 'User added successfully';
               $_SESSION['message_type'] = 'success';
            } else {
                echo "Failed to add user";
                $_SESSION['message'] = 'All fields are required';
        $_SESSION['message_type'] = 'error';
            }
        }

    }else{
       // echo "All fields are required";
       $_SESSION['message'] = 'All fields are required';
       $_SESSION['message_type'] = 'error';
            
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="toastr.css">
    <title>Document</title>
</head>
<body>
<div class="container">
 <div class="wrapper p-5 m-5">
    <div class="d-flex p-2 d-flex justify-content-between">
        <h2>Add User</h2>
        <div><a href="index.php"><i data-feather="corner-down-left"></i></a></div>
    </div>
    <form action="add_user.php" method="post">
    <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" >  
    </div>
    <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email">
    </div>
    <div class="mb-3">
    <label for="password" class="form-label">Mobile</label>
    <input type="number" class="form-control" placeholder="Enter your mobile" id="password" name="mobile">
    </div>
    <div class="mb-3">
    <label for="password2" class="form-label">Password</label>
    <input type="password" class="form-control" id="password2" placeholder="Enter your password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Save</button>
    </form>

 </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="toastr.js"></script>
    <script>
      feather.replace();
      
      <?php
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $messageType = $_SESSION['message_type'];
        echo "toastr.$messageType('$message');";
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
      
    }
    ?>
    </script>   
</body>
</html>