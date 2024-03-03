<?php include('partilas-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

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
                        $image_name =$row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id1; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name =="")
                                    {
                                        echo "<div class = 'error'> Image Not Available.</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></title></h3> 

                            </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    ?>
                        echo "<div class = 'error'> Categroy Not Added.</div>";
                    <?php
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partilas-front/footer.php'); ?>