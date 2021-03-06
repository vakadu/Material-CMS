<?php include 'includes/header.php' ?>

<?php

if (isset($_SESSION['username'])){

    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $profile_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['user_profile'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname ='{$user_lastname}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username}'";
    $update_query = mysqli_query($connection, $query);
    confirmQuery($update_query);
}

?>

<?php include 'includes/navigation.php' ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Profile
                </h1>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input type="text" class="form-control" name="user_firstname"
                               value="<?php echo $user_firstname; ?>">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="user_lastname"
                               value="<?php echo $user_lastname; ?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username"
                               value="<?php echo $username; ?>">
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="user_role" class="form-control">
                            <option value="Subscriber"><?php echo $user_role; ?></option>
                            <?php
                            if ($user_role == 'Admin'){
                                echo "<option value='Subscriber'>Subscriber</option>";
                            }
                            else {
                                echo "<option value='Admin'>Admin</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="user_email"
                               value="<?php echo $user_email; ?>">
                    </div>

                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" name="user_password"
                               value="<?php echo $user_password; ?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="user_profile"
                               value="Update Profile">
                    </div>
                </form>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include 'includes/footer.php' ?>
