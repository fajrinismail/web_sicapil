
  <header class="main-header">
    <nav id="menu" class="navbar navbar-default navbar-fixed-top navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand">SI - <b>CAPIL</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
       
      
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
             <?php
                if($_SESSION['level'] == '2'){ 
                    if(isset($_GET['p'])){

                       if($_GET['p'] == 'verifikasi_pengurusan' || $_GET['p'] == 'verifikasi_pengambilan'){
                          $active1 = '';
                          $active2 = 'active';
                       }
                      
                    }else{
                       $active1 = 'active';
                       $active2 = '';
                    }
                  ?>

                  <ul class="nav navbar-nav">
                    <li ><a href="index.php">Beranda <span class="sr-only">(current)</span></a></li>
                     <li class=' dropdown '>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sistem <span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                          <li><a href="index.php?dir=mod/admin&p=jenis_pengurusan">Jenis Pengurusan</a></li>
                          <li><a href="#">Kategori Pengurusan</a></li>
                          <li><a href="#">Persyaratan Pengurusan</a></li>
                          
                        </ul>
                    </li>
                    <li class=' dropdown '>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">Verifikasi <span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                          <li><a href="index.php?dir=mod/admin&p=verifikasi_pengurusan">Pengurusan</a></li>
                          <li><a href="index.php?dir=mod/admin&p=verifikasi_selesai_proses">Selesai Pengurusan</a></li>
                          <li><a href="index.php?dir=mod/admin&p=verifikasi_pengambilan">Pengambilan</a></li>
                        </ul>
                    </li>
                  </ul>
          <?php } ?>
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul> -->
          
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="images/avatar5.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?=$_SESSION['nama']?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="images/avatar5.png" class="img-circle" alt="User Image">

                  <p>
                    <?=$_SESSION['nama']?>
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
               
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a onclick="confirm('Apakah Anda Yakin ?')" href="config/proses_login.php?op=logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>


<!-- <div class="row" style="background-color:#00BF9A;">
    <div class="col-md-10 col-md-offset-1 text-center" style=" padding:5rem; color:#FFFFFF;">
         <center><img src="images/logo_sicapil.png" class="img-responsive" alt="Responsive image"  style="height:130px;"></center>
         <h3 style="margin-top:10px;">Apa So Itu SI CAPIL ???</h3>
         <h4 style="margin-top:10px;">Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen Lorem Ipsum Kremenen kresmenen </h4>
    </div>
</div> -->