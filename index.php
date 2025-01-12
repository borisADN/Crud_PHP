<?php
session_start();
include 'db.php';
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
      <div class="d-flex p-2 d-flex justify-content-between mb-2">
        <h2>All Users</h2>
        <div><a href="add_user.php"><i data-feather="user-plus"></i></a>
        </div>

      </div>
      <hr>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <?php
        foreach ($users as $user) {
          echo "<tr>
      <th scope='row'>" . $user['id'] . "</th>
      <td>" . $user['name'] . "</td>
      <td>" . $user['email'] . "</td>
      <td>" . $user['mobile'] . "</td>
      <td>
          <div class='d-flex p-2 d-flex justify-content-between mb-2'>
        <a class='text-primary' href='edit_user.php?id=" . $user['id'] . "'><i data-feather='edit'></i></a>
        <a onclick='return confirm(\"Are you sure you want to delete this user?\")' class='text-danger' href='delete_user.php?id=" . $user['id'] . "'><i  data-feather='trash-2'></i></a>
        </div>
      </td>
    </tr>";
        }

        ?>
      </table>
      <?php
      if (mysqli_num_rows($result) == 0) {
        echo "<div class='alert alert-info'>
    <strong>No users found</strong>
</div>";
      }
      ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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