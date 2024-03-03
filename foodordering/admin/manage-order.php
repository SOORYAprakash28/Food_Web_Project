<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br><br>
        <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
                
            }
        ?>

            

            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food</th>
                    <!-- <th>Price</th> -->
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                
                


                    <?php
                         $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; 

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
                                     $food = $rows['food'];
                                     $price=$rows['price'];
                                     $id= $rows['id'];
                                     $qty=$rows['qty'];
                                     $total = $rows['total'];
                                     $status = $rows['status'];
                                     $customer_name = $rows['customer_name'];
                                     $customer_contact = $rows['customer_contact'];
                                     $order_date = $rows['order_date'];
                                     $customer_email = $rows['customer_email'];
                                     $customer_address = $rows['customer_address'];

                            
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $n++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <!-- <td><?php echo $price; ?></td> -->
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>



                                        <td>
                                            <?php

                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>



                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>

                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                                            
                                        </td>
                                    </tr>

                                        
                                        
                                        
                                        
                                    <?php
     
                                 }
                             }
                             else
                             {
                                    echo "<tr colspan='12' calss='error' ><td> Order Not Available</td></tr>";
                             }
                         }
                     ?>

                </tr>

                 
            </table>
    </div>

</div>

<?php include('partials/footer.php');?>