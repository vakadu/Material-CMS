<?php

if (isset($_GET['p_id'])) {

    $edit_p_id = $_GET['p_id'];

    $query = "SELECT * FROM posts WHERE post_id = $edit_p_id";
    $select_posts_by_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_content = mysqli_real_escape_string($connection, $row['post_content']);
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
    }
}

if (isset($_POST['update_post'])){

    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_content = str_replace("'", "''", $post_content);
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $edit_p_id ";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)){
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id ='{$post_category_id}', ";
    $query .= "post_date = now(),  ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = '{$edit_p_id}'";
    $update_query = mysqli_query($connection, $query);
    confirmQuery($update_query);

    echo "<div class='alert alert-success text-center'>
            <div class='container-fluid'>
              <div class='alert-icon'>
                <i class='material-icons'>check</i>
              </div>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'><i class='material-icons'>clear</i></span>
              </button>
              <b>Success! </b> Post has been updated.<b><a href=
              '../post.php?p_id={$edit_p_id}'> View Post</a> </b>
            </div>
          </div>";
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" value="<?php echo $post_title ?>" class="form-control"
               name="post_title">
    </div>

    <div class="form-group">
        <label for="post_category">Category</label>
        <select name="post_category" class="form-control">
            <?php
            $query = "SELECT * FROM categories";
            $category_query = mysqli_query($connection, $query);
            confirmQuery($category_query);
            while($row = mysqli_fetch_assoc($category_query)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                if ($cat_id == $post_category_id){
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                }
                else{
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $post_author ?>" class="form-control"
               name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value='<?php echo $post_status; ?>'><?php echo ucfirst($post_status); ?></option>
            <?php
            if ($post_status == 'publish'){
                echo "<option value='draft'>Draft</option>";
            }
            else{
                echo "<option value='publish'>Publish</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label>Post Image</label>
        <img src="../images/<?php echo $post_image; ?>" width="200" alt="Image not
        displayed" class="img-responsive">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags ?>" class="form-control"
               name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="" cols="30" rows="6"
                  class="form-control"><?php echo str_replace('\r\n', '</br>',
                $post_content) ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>