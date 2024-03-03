<?php
    include('../config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];
        if($image_name !="")
        {
            $path = "../images/Food/".$image_name;

            $remove = unlink($path);
            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'>Faile to Remove Category Image.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Deleted Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        
        }
    }
    else
    {
        $_SESSION['unauthorize']=" <div class='error' >Unauthoruze Access.</div>";
        header('localhost:'.SITEURL.'admin/manage-food.php');
    }
?>