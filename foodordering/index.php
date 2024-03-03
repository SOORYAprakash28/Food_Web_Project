<?php include('partilas-front/menu.php'); ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql4 = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

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
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id1; ?> ">
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
                        echo "<div class = 'error'> Categroy Not Added.</div>";
                }         
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                


            <?php
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row  = mysqli_fetch_assoc($res2))
                    {
                        $id2 = $row['id'];
                        $title2 = $row['title'];
                        $image_name2 =$row['image_name'];
                        $price= $row['prcie'];
                        $des= $row['description'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name2 =="")
                                    {
                                        echo "<div class = 'error'> Image Not Available.</div>";
                                    }
                                    else{
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name2; ?>"  class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>

                                </div>
                                <div class = "food-menu-desc">
                                    <h4><?php echo $title2; ?></h4>
                                    <p class="food-price">$<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $des; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                                </div>   
                        <?php
                    }
                }
                else
                {
                        echo "<div class = 'error'> Categroy Not Added.</div>";

                }         
            ?>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partilas-front/footer.php'); ?>