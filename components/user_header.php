<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
      <a href="home.php" class="logo"><img src="images/homie-logo.png" alt="Homie Logo"></a>

         <ul>
            <li><a href="post_property.php">post property<i class="fas fa-paper-plane"></i></a></li>
         </ul>
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
         
            <ul>
            <ul>
               <li><a href="listings.php"><i class="fa-solid fa-list"></i> listings</a></i></li>
               <li><a href="search.php"><i class="fas fa-search"></i> search</a></li>
               </li>
               <li><a href="#">help<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="about.php">about us</a></i></li>
                     <li><a href="contact.php">contact us</a></i></li>
                     <li><a href="contact.php#faq">FAQ</a></i></li>
                  </ul>
               </li>
            </ul>
         </div>

         <ul>
            <li><a href="saved.php">saved <i class="far fa-heart"></i></a></li>
            <li><a href="#">account <i class="fas fa-angle-down"></i></a>
               <ul>
                  <li><a href="login.php">login now</a></li>
                  <li><a href="register.php">register new</a></li>
                  <?php if($user_id != ''){ ?>
                  <li><a href="update.php">update profile</a></li>
                  <li><a href="components/user_logout.php" onclick="return confirm('logout from this website?');">logout</a>
                  <?php } ?></li>
               </ul>
               <li><a href="dashboard.php">dashboard</a></a>
            </li>
         </ul>
      </section>
   </nav>

</header>

<!-- header section ends -->