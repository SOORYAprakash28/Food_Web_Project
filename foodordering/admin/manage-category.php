<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>

            <!-- Button to add admin -->
            <a href="http://localhost/foodordering/admin/add-category.php" class="btn-primary">Add Category</a>

            <br><br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['no-categroy-found']))
                {
                    echo $_SESSION['no-categroy-found'];
                    unset($_SESSION['no-categroy-found']);
                }
                if(isset($_SESSION['no-categroy-found']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if(isset($_SESSION['failed-reomve']))
                {
                    echo $_SESSION['failed-reomve'];
                    unset($_SESSION['failed-reomve']);
                }
            ?>

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Fearured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                <?php

                    $sql = "SELECT * FROM tbl_category";


                    $res= mysqli_query($conn,$sql);
                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            $n=1;
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                // this will run till all data in the table
                                $id= $rows['id'];
                                $title = $rows['title'];
                                $image_name=$rows['image_name'];
                                $featurd=$rows['featured'];
                                $active = $rows['active']
                                ?>

                                <tr>
                                    <td><?php echo $n++ ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                            if($image_name!="")
                                            {
                                                ?>

                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width='100'>
                                                <?php
                                            }
                                            else
                                            {
                                                echo "<div class='error'> Image not Added.</div>";
                                            }
                                            ?>
                                    </td>
                                    <td><?php echo $featurd ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>;" class="btn-secondary" >update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                        else
                        {

                        }
                    }
                ?>

            </table>
    </div>

</div>

<?php include('partials/footer.php');?>