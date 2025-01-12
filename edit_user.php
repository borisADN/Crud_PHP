<?php
session_start();
include('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $sql = "UPDATE users SET name='$name', email='$email', mobile='$mobile' WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['message'] = 'User updated successfully';
                $_SESSION['message_type'] = 'success';
                header('Location: index.php');
                exit();
            }
        }
    
}

?>
<?php

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
                <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM users WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_assoc($result);
                ?>
                <h2>Edit User</h2>
                <div><a href="index.php"><i data-feather="corner-down-left"></i></a></div>
            </div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" value="<?= $user['name'] ?>" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" value="<?= $user['email'] ?>" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mobile</label>
                    <input type="number" class="form-control" placeholder="Enter your mobile" value="<?= $user['mobile'] ?>" id="password" name="mobile">
                </div>
                <!-- <div class="mb-3">
    <label for="password2" class="form-label">Password</label>
    <input type="password" class="form-control" id="password2" placeholder="Enter your password" name="password">
    </div> -->
                <button type="submit" class="btn btn-primary" name="submit">Update</button>
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
    <script src="main.js"></script>

</body>

</html>