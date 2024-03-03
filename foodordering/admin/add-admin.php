<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])) //cheaking the sessin is set or not
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

        ?><br>
        <form action="" method="POST" >

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td> <input type="text" name="full_name" placeholder="Enter Your Name"></td>

            </tr>

            <tr>
                <td>UserName:</td>
                <td>
                    <input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php');?>

<?php

    if(isset($_POST['submit']))
    {
        // get data from the form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  //Password Ecryption with MD5


        // 2. sql query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
        Full_name='$full_name',
        username= '$username',
        password='$password'
        ";

        // 3. exexuting query and saving data into database

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. check wether the data is inserted or not display appropriate message

        if($res == TRUE)
        {
            $_SESSION['add']= "<div class='success'>Admin Added Sucessfully</div>";
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else{
            $_SESSION['add']= "<div class='error'>Failed to Add Sucessfully</div>";
            header("location:".SITEURL."admin/add-admin.php");

        }
        
    }


?>