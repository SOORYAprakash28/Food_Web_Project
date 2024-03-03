<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql1 = "SELECT * FROM tbl_food WHERE id=$id";


                $res1 = mysqli_query($conn, $sql1);

                $count1 = mysqli_num_rows($res1);

                if($count1==1)
                {
                    $row = mysqli_fetch_assoc($res1);
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['prcie'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-categroy-found'] = "<div class='error'> Food not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');

                }
            }

            else
            {
                header('location:'.SITEURL.'admin/manage-food.php');
            }
?>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>" >
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td>
                    <textarea name="description"  cols="30" rows="5"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>" >
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $current_image; ?>" width='100'>
                            <?php
                        }
                        else
                        {
                            echo "<div class='error'> Image is Not Added.</div>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php
                            $sql4 = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res4 = mysqli_query($conn, $sql4);

                            $count4 = mysqli_num_rows($res4);

                            if($count4>0)
                            {
                                while($row  = mysqli_fetch_assoc($res4))
                                {
                                    $id1 = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id1; ?>"> <?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0"> No Category Found</option>
                                <?php
                            }
                        ?>
                        
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td >
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="update Food" calss="btn-secondary" >
                </td>
            </tr>
        </table>
    </form>

    <?php

    if(isset($_POST['submit']))
    {
        $di = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];
        
        
        // check if image is selected or not 

        if(isset($_FILES['image']['name']))
        {
            // uplode
            $image_name = $_FILES['image']['name'];

            if($image_name !="")
            {

            
                // auto rename image 

                $ext = end(explode('.',$image_name));

                $image_name = "Food_Name_".rand(000,999).'.'.$ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/Food/".$image_name;
                $upload = move_uploaded_file($source_path, $destination_path);
                // check if the file is uploaded
                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed To Upload Image. </div>";

                    header('location:'.SITEURL.'admin/add-food.php');

                    die();
                }

                if($current_image != "")
                {
                    $remove_path = "../images/Food/".$current_image;
                    $remove = unlink($remove_path);

                    if($remove==false)
                    {
                        $_SESSION['failed-remove'] = "<div class= 'error' > Failed to remove.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }
                }
            
                
        }   
        else
        {
             $image_name=$current_image;
        }
    }
    else
    {             
        $image_name=$current_image;

    }
        $sql2 = "UPDATE tbl_food SET
        title ='$title',
        prcie = $price,
        description = '$description',
        image_name = '$image_name',
        category_id = $category,
        featured ='$featured',
        active = '$active'
        WHERE id=$id
        ";

        $res2 = mysqli_query($conn, $sql2);

        if($res2==true)
        {
            $_SESSION['update']= "<div class='success'>Food Updated Sucessfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else
        {
            $_SESSION['update']= "<div class='error'>Failed to Update Food</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }
    
}
    
    
?>

    </div>
</div>










<?php include('partials/footer.php'); ?>