<form action="" method="post">
    <div class="form-group">
        <!--                    Editing categories-->
        <?php
        if (isset($_GET['edit'])){
            $cat_id = $_GET['edit'];
            $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
            $select_categories = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                ?>
                <input value="<?php if (isset($cat_title)){echo $cat_title;} ?>" type="text"
                       class="form-control" name="cat_title">
                <?php
            }
        }
        ?>
        <!--                        Update query-->
        <?php
        if (isset($_POST['update_category'])){
            $cat_title_edit = $_POST['cat_title'];
            $query  = "UPDATE categories SET cat_title = '{$cat_title_edit}' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);
            if (!$update_query){
                die("Query Failed " . mysqli_error($connection));
            }
        }
        ?>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-success" name="update_category" value="Update Category">
    </div>
</form>