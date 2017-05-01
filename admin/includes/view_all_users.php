<table class="table table-responsive table-bordered">
    <thead>
    <th>ID</th>
    <th>Username</th>
    <th>Password</th>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Email</th>
    <th>Role</th>
    <th>Admin</th>
    <th>Subscriber</th>
    <th>Edit</th>
    <th>Delete</th>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$username}</td>";
        echo "<td>{$user_password}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a> </td>";
        echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a> 
              </td>";
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a> 
              </td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a> </td>";
        echo "</tr>";
    }
    ?>

    </tbody>
</table>

<?php

if (isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = 
              $the_user_id";
    $admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['change_to_subscriber'])){
    $the_user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = 
              $the_user_id";
    $subscriber_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['delete'])){
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
}