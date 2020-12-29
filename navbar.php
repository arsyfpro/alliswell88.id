

    <!--Main Navigation-->
    <header>

        <!--Navbar-->
        <nav class="navbar navbar-dark navbar-expand-lg scrolling-navbar">

            <div class="container">

                <!-- Navbar brand -->
              <ul class="navbar-nav">
             <li class="nav-item">
                   <a class="navbar-brand" href="index.php">
            <img src="icon/logoputih.png" height="30">
              </a>
            </li>
          </ul>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse justify-content-center" id="navbar">


              <!-- Right -->
              <ul class="navbar-nav">
            <li class="nav-item">
            <a href="edisi.php?item=1" class="nav-link waves-effect">
            Masker
            </a>
            </li>
            <li class="nav-item">
            <a href="edisi.php?item=2" class="nav-link waves-effect">
            Scrunchie
            </a>
            </li>
            <li class="nav-item">
            <a href="allstuff.php" class="nav-link waves-effect">
            Shop All
            </a>
            </li>
            </ul>
            </div>
                    <!-- Links -->

                    <!-- Shopping cart icon -->
    <ul class="nav justify-content-end" >
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
		<a class="nav-link navbar-link-2 waves-effect" href="#!" data-toggle="modal" data-target="#myModal"><img src="icon/Search2.png" height="30"></a>
	  </li>
      <li class="nav-item">
        <a href="keranjang.php" class="nav-link navbar-link-2 waves-effect">
          <?php

            if (isset($_SESSION['customer']) && isset($_SESSION['cart'])){
              $isikeranjang = 0;

                foreach ($_SESSION['cart'] as $id => $jumlah) {
                  $isikeranjang += $jumlah;
                }
                
              echo "<span class='badge badge-pill badge-danger'>".$isikeranjang."</span>";
            }
          ?>
          <img src="icon/Cart2.png" height="30"> 
        </a>
      </li>

      <li class="nav-item">
        <a <?php if(isset($_SESSION['customer'])){echo "href='profil.php'";} else{echo "href='login.php'";} ?> class="nav-link navbar-link-2 waves-effect">
          <img src="icon/People2.png" height="30">
        </a>
      </li>
    </ul>
    </ul>

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
      <!-- konten modal-->
      <div class="modal-content modal-xl">
        <!-- heading modal -->
        <div class="modal-header modal-xl">
          <form action="search.php" method="get" class="form-inline form-xl">
            <input name="keyword" class="form-control" type="text" style="width: 376px;" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><img src="icon/Search2.png" height="30"></button>
          </form>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      </div>
    </div>
  </div>

    		</div>
        </nav>
  </header>
        <!--/.Navbar--> 




      



    
