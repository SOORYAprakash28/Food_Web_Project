<?php include('partials/menu.php');?>
    
    <!--Main start-->

    <div class="main-content">
        <div class="wrapper">
            <h1>Mange Admin</h1>
            <br><br>

            <!-- Button to add admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br><br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add']; 
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }

                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
            ?>
            

            <br><br>


            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full name</th>
                    <th>username</th>
                    <th>Actions</th>
                </tr>
                
                <?php

                    $sql = "SELECT * FROM tbl_admin";

                    $res= mysqli_query($conn,$sql);
                    if($res==TRUE)
                    {
                        $rows = mysqli_num_rows($res);

                        if($rows>0)
                        {
                            $n=1;
                            while($rows = mysqli_fetch_assoc($res))
                            {
                                // this will run till all data in the table
                                $id= $rows['id'];
                                $full_name=$rows['Full_name'];
                                $username=$rows['username'];

                                ?>

                                <tr>
                                    <td><?php echo $n++ ?></td>
                                    <td><?php echo $full_name?></td>
                                    <td><?php echo $username?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id ?>;" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id ?>;" class="btn-secondary" >update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id ?>;" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                    }
                ?>
    
            </table>
        </div>
    </div>

    <!--Main ends-->


    <?php include('partials/footer.php');?>