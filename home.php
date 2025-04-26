<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'components/save_send.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">

   <!-- uphome-specific css file -->
   <link rel="stylesheet" href="css/uphome.css">
</head>
<body>



<?php include 'components/user_header.php'; ?>
<!-- Background section starts -->
<section class="hero-section">
   <div class="hero-bg">
      <h1>Welcome to Homie</h1>
      <p>Your Trusted Home-Finding Companion</p>
   </div>
</section>
<!-- Background section ends -->

<!-- home section starts -->
<div class="home">
   <section class="center">
      <!-- Swiper container -->
      <div class="swiper-container">
         <div class="swiper-wrapper">
            <?php
               $select_properties = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
               $select_properties->execute();
               if($select_properties->rowCount() > 0){
                  while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
                     $image_path = !empty($fetch_property['image_01']) ? 'uploaded_files/' . $fetch_property['image_01'] : 'images/default-image.jpg';
            ?>
            <div class="swiper-slide">
               <div class="listing-box">
                  <div class="image-container">
                     <img src="<?= $image_path; ?>" alt="Property Image">
                  </div>
                  <div class="info-container">
                     <h3><?= $fetch_property['property_name']; ?></h3>
                     <p><?= $fetch_property['address']; ?></p>
                     <p><strong>Price:</strong> <?= $fetch_property['price']; ?></p>
                     <a href="view_property.php?get_id=<?= $fetch_property['id']; ?>" class="btn">View Property</a>
                  </div>
               </div>
            </div>
            <?php
                  }
               } else {
                  echo '<p class="empty">No properties added yet!</p>';
               }
            ?>
         </div>
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
      </div>
   </section>
</div>
<!-- home section ends -->

<!-- Include Swiper.js -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- uphome-specific js file -->
<script src="js/uphome.js"></script>

</body>
</html>


<!-- listings section starts  -->

<section class="listings">

   <h1 class="heading">latest listings</h1>

   <div class="box-container">
      <?php
         $total_images = 0;
         $select_properties = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
         $select_properties->execute();
         if($select_properties->rowCount() > 0){
            while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
               
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            if(!empty($fetch_property['image_02'])){
               $image_coutn_02 = 1;
            }else{
               $image_coutn_02 = 0;
            }
            if(!empty($fetch_property['image_03'])){
               $image_coutn_03 = 1;
            }else{
               $image_coutn_03 = 0;
            }
            if(!empty($fetch_property['image_04'])){
               $image_coutn_04 = 1;
            }else{
               $image_coutn_04 = 0;
            }
            if(!empty($fetch_property['image_05'])){
               $image_coutn_05 = 1;
            }else{
               $image_coutn_05 = 0;
            }

            $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);

            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
            $select_saved->execute([$fetch_property['id'], $user_id]);

      ?>
      <form action="" method="POST">
         <div class="box">
            <input type="hidden" name="property_id" value="<?= $fetch_property['id']; ?>">
            <?php
               if($select_saved->rowCount() > 0){
            ?>
            <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>saved</span></button>
            <?php
               }else{ 
            ?>
            <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>save</span></button>
            <?php
               }
            ?>
            <div class="thumb">
               <p class="total-images"><i class="far fa-image"></i><span><?= $total_images; ?></span></p> 
               <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
            </div>
            <div class="admin">
               <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
               <div>
                  <p><?= $fetch_user['name']; ?></p>
                  <span><?= $fetch_property['date']; ?></span>
               </div>
            </div>
         </div>
         <div class="box">
            <div class="price"><i class="fas fa-bangladeshi-taka-sign"></i><span><?= $fetch_property['price']; ?></span></div>
            <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address']; ?></span></p>
            <div class="flex">
               <p><i class="fas fa-house"></i><span><?= $fetch_property['type']; ?></span></p>
               <p><i class="fas fa-tag"></i><span><?= $fetch_property['offer']; ?></span></p>
               <p><i class="fas fa-bed"></i><span><?= $fetch_property['bhk']; ?> BHK</span></p>
               <p><i class="fas fa-trowel"></i><span><?= $fetch_property['status']; ?></span></p>
               <p><i class="fas fa-couch"></i><span><?= $fetch_property['furnished']; ?></span></p>
               <p><i class="fas fa-maximize"></i><span><?= $fetch_property['carpet']; ?>sqft</span></p>
            </div>
            <div class="flex-btn">
               <a href="view_property.php?get_id=<?= $fetch_property['id']; ?>" class="btn">view property</a>
               <input type="submit" value="send enquiry" name="send" class="btn">
            </div>
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no properties added yet! <a href="post_property.php" style="margin-top:1.5rem;" class="btn">add new</a></p>';
      }
      ?>
      
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="listings.php" class="inline-btn">view all</a>
   </div>

</section>

<!-- listings section ends -->

<!-- services section starts  -->

<section class="services">

   <h1 class="heading">our services</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>Rent House</h3>
         <p>Rent a house for a large family.</p>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>Rent Flat</h3>
         <p>Rent a flat for your family.</p>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>Bachelor</h3>
         <p>Rent a room if you're bachelor.</p>
      </div>

   </div>

</section>

<!-- services section ends -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

<script>

   let range = document.querySelector("#range");
   range.oninput = () =>{
      document.querySelector('#output').innerHTML = range.value;
   }

</script>

</body>
</html>