<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        
        <br><br>

        <?php
            $id = $_GET['id'];

            $sql="SELECT * FROM tbl_order WHERE id = $id";

            $res= mysqli_query($conn, $sql);
            if($res==true)
            {
                $count = mysqli_num_rows($res);
                
                if($count==1)
                {
                    $rows = mysqli_fetch_assoc($res);

                    $food = $rows['food'];
                    $price=$rows['price'];
                    $qty=$rows['qty'];
                    $total = $rows['total'];
                    $status = $rows['status'];
                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $order_date = $rows['order_date'];
                    $customer_email = $rows['customer_email'];
                    $customer_address = $rows['customer_address'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin/manage-order.php');  
            }
            
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td><?php echo $food; ?></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><?php echo $price; ?></td>
                </tr>

                <tr></tr>
                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                

                <tr> 
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr> 
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr> 
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr> 
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5" ><?php echo $customer_address; ?>"></textarea>
                    </td>
                </tr>
                <tr>
                    <td clospan="2" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>" >
                        <input type="hidden" name="price" value="<?php echo $price; ?>" >

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
if(isset($_POST['submit']))
{
    $id2 = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;
    $status = $_POST['status'];

    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    $sql2 = "UPDATE tbl_order SET 
    qty = $qty,
    total = $total,
    status = '$status',
    customer_name = '$customer_name',
    customer_contact = '$customer_contact',
    customer_email = '$customer_email',
    customer_address = '$customer_address'
    WHERE id=$id2";

    $res2 = mysqli_query($conn, $sql2);

    if($res2 == true)
    {
        $_SESSION['update']="<div class='success'> Ordered Updated Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        $_SESSION['update']="<div class='error'> Failed To Update Order.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }

}
?>

<?php include('partials/footer.php'); ?>

