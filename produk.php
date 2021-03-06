<?php
session_start();
//koneksi ke database
    include 'koneksi.php';

    $cekjenis = $koneksi->query("SELECT id_jenis FROM kategori_produk_jenis WHERE id_jenis = '$_GET[produk]'")->num_rows;
    $cekedisi = $koneksi->query("SELECT id_edisi FROM kategori_produk_edisi WHERE id_edisi = '$_GET[edisi]'")->num_rows;

    if($cekjenis > 0 && $cekedisi > 0 && $_GET['produk'] != 3){
      $jenis = $_GET['produk'];
      $edisi = $_GET['edisi'];
    }
    else{
        echo "<script>alert('Halaman yang dicari tidak ditemukan!');</script>";
        echo "<script>window.history.back();</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Masker & Scrunchie</title>
	<meta charset="utf-8">
    <?php include 'scrsty.php'; ?>
</head>
<body>

	<?php include 'navbar.php'; ?>

<br><br>

<div class="container" align="center">
 <div class="row">
  <div class="dropdown col-md-7">
    <button style="color: #48695a;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Edisi
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <?php 
        $takeedisi = $koneksi->query("SELECT e.id_edisi, e.edisi FROM produk p JOIN kategori_warna_produk w 
                                      ON p.id_jenis = '$jenis' AND p.stok_produk > 0 AND p.id_warna = w.id_warna 
                                      JOIN kategori_produk_edisi e 
                                      ON w.id_edisi = e.id_edisi 
                                      GROUP BY e.id_edisi");

        if ($jenis == 2) {
          $takeedisi = $koneksi->query("SELECT e.id_edisi, e.edisi FROM produk p JOIN kategori_warna_produk w 
                                      ON (p.id_jenis = '2' OR p.id_jenis = '3') AND p.stok_produk > 0 AND p.id_warna = w.id_warna 
                                      JOIN kategori_produk_edisi e 
                                      ON w.id_edisi = e.id_edisi 
                                      GROUP BY e.id_edisi");
        }
        while($data = $takeedisi->fetch_assoc()){
      ?>
      <a style="color: #48695a" class="dropdown-item" href="?produk=<?php echo $jenis ?>&edisi=<?php echo $data['id_edisi'] ?>"><?php echo $data['edisi']; ?></a>
      <?php } ?>
    </div>
  </div>
  <div class="dropdown col-md-2">
    <!-- sortby button -->
    <button style="color: #48695a;" class="btn dropdown-toggle" type="button" id="dropdownMenuButton_sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Sort By ...
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_sort">
      <a style="color: #48695a" class="dropdown-item" href="produk_sortBy.php?produk=<?php echo $jenis ?>&edisi=<?php echo $edisi ?>&sort=Nama, A - Z">Nama, A - Z</a>
      <a style="color: #48695a" class="dropdown-item" href="produk_sortBy.php?produk=<?php echo $jenis ?>&edisi=<?php echo $edisi ?>&sort=Nama, Z - A">Nama, Z - A</a>
      <a style="color: #48695a" class="dropdown-item" href="produk_sortBy.php?produk=<?php echo $jenis ?>&edisi=<?php echo $edisi ?>&sort=Harga, rendah - tinggi">Harga, rendah - tinggi</a>
      <a style="color: #48695a" class="dropdown-item" href="produk_sortBy.php?produk=<?php echo $jenis ?>&edisi=<?php echo $edisi ?>&sort=Harga, tinggi - rendah">Harga, tinggi - rendah</a>
    </div>
  </div>
 </div>
</div>

<div class="container mt-5">

<div class="row justify-content-center">
  <?php
    $take = $koneksi->query("SELECT p.id_produk, p.id_warna, p.nama_produk, p.harga_produk, p.foto_produk, p.stok_produk 
                                      FROM produk p JOIN kategori_warna_produk w 
                                      WHERE p.stok_produk > 0 AND p.id_jenis = '$jenis' AND w.id_edisi = '$edisi' AND p.id_warna = w.id_warna 
                                      GROUP BY p.id_produk ORDER BY p.nama_produk");

    $banyakdata = $take->num_rows;

    if($jenis == 2){
      $take = $koneksi->query("SELECT p.id_produk, p.id_warna, p.nama_produk, p.harga_produk, p.foto_produk, p.stok_produk 
                                      FROM produk p JOIN kategori_warna_produk w 
                                      WHERE p.stok_produk > 0 AND (p.id_jenis = '2' OR p.id_jenis = '3') AND w.id_edisi = '$edisi' AND p.id_warna = w.id_warna 
                                      GROUP BY p.id_warna ORDER BY p.nama_produk");

      $banyakdata = $take->num_rows;
    }

    if($banyakdata == 0){
        echo "<h2 align='center'>Produk kosong.&nbsp;</h2>";
        echo "<br><br><h2 align='center'> Ayo lihat pilihan barang lainnya <a href='allstuff.php'>di sini</a>!</h2>";
    }

      $batas = 6;
      $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
      $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;  
 
      $previous = $halaman - 1;
      $next = $halaman + 1;
        
      // $data = mysqli_query($koneksi,"select * from pegawai");
      $jumlah_data = $banyakdata;
      $total_halaman = ceil($jumlah_data / $batas);

      if($halaman > $total_halaman && $banyakdata != 0){
          echo "<script>alert('Halaman yang dicari tidak ditemukan!');</script>";
          echo "<script>window.history.back();</script>";
      }

      $take = $koneksi->query("SELECT p.id_produk, p.id_warna, p.nama_produk, p.harga_produk, p.foto_produk, p.stok_produk 
                                      FROM produk p JOIN kategori_warna_produk w 
                                      WHERE p.stok_produk > 0 AND p.id_jenis = '$jenis' AND w.id_edisi = '$edisi' AND p.id_warna = w.id_warna 
                                      GROUP BY p.id_produk ORDER BY p.nama_produk LIMIT $halaman_awal, $batas");

      if ($jenis == 2) {
        $take = $koneksi->query("SELECT p.id_produk, p.id_warna, p.nama_produk, p.harga_produk, p.foto_produk, p.stok_produk 
                                      FROM produk p JOIN kategori_warna_produk w 
                                      WHERE p.stok_produk > 0 AND (p.id_jenis = '2' OR p.id_jenis = '3') AND w.id_edisi = '$edisi' AND p.id_warna = w.id_warna 
                                      GROUP BY p.id_warna ORDER BY p.nama_produk LIMIT $halaman_awal, $batas");
      }

      while ($data = $take->fetch_assoc()){
  ?>
  <div class="col-md-4"> <!-- column -->
    <!-- script -->
      
  	<a href="detail.php?id=<?php echo $data['id_produk'] ?>" style="color: inherit; text-decoration: none;">
    <figure class="card card-product"> 
      <div class="img-wrap"><img src="image/<?php echo $data['foto_produk'] ?>"></div>
      <figcaption class="info-wrap">
          <h4 class="title"><?php echo $data['nama_produk']; ?></h4>
          <p class="desc">Stok : <?php echo number_format($data['stok_produk']); ?></p>
          <!-- <div class="rating-wrap">	
            <div class="label-rating">132 reviews</div>
            <div class="label-rating">154 orders </div>
          </div> //.rating-wrap.// -->
      </figcaption>
      <div class="bottom-wrap">
       <?php if ($jenis == 1): ?>
        <a href="action_cart_in.php?id=<?php echo $data['id_produk'] ?>" class="btn btn-sm btn-danger active float-right">Add To Cart</a> 

       <?php else: ?>
        <a href="detail.php?id=<?php echo $data['id_produk'] ?>" class="btn btn-sm btn-primary active float-right">Detail</a>

       <?php endif ?>
        <div class="price-wrap h5 float-left">
          <span class="price-new">Rp <?php echo number_format($data['harga_produk']); ?></span>
        </div> <!-- price-wrap.// -->
      </div> <!-- bottom-wrap.// -->
    </figure>
    </a>
  </div>
  <?php 
      }
  ?>
</div>
<br><br>
<!-- pagination button -->
  <nav>
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" <?php if($halaman > 1){ echo "href='?produk=$jenis&edisi=$edisi&halaman=$previous'"; } ?>>Previous</a>
        </li>
        <?php 
        for($x=1;$x<=$total_halaman;$x++){
          ?> 
          <li class="page-item"><a class="page-link" href="?produk=<?php echo $jenis ?>&edisi=<?php echo $edisi ?>&halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
          <?php
        }
        ?>        
        <li class="page-item">
          <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?produk=$jenis&edisi=$edisi&halaman=$next'"; } ?>>Next</a>
        </li>
      </ul>
    </nav>

</div> 
<!--container.//-->
<br><br>

<?php include 'footer.php'; ?>

</body>
</html>