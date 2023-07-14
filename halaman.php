
<?php
  include 'koneksi.php';
  $hal = $_GET['id_kategori'];
  $mod = mysqli_query($koneksi, "select kategori from kategori where id_kategori = $hal");
  $halaman = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.id_berita, berita.judul, berita.isi_berita, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori where berita.id_kategori = $hal order by berita.tanggal_berita desc ");
  $trend = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by dilihat desc limit 3");
  $baru = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by id_berita desc limit 3");
  while ($kat = mysqli_fetch_array($mod)){
?>

<?php include 'navbar.php'; ?>

<div class=" container">
    <div class=" bg-white my-5" style="border-radius: 20px;" >
        <br/>
			<p class="judul2 text-center"><?php echo $kat['kategori']?></p>
		<br/>
        <div class="row">
            <div class="col-8">        
            <?php while ($data = mysqli_fetch_array($halaman)){ ?>
                <div class="card-body">
                    <div class="col">
                        <div class="row">
                            <div class="col-3 mt-2 mb-4 ml-2 zoom-effect">
                                <div class="kotak ml-3">
                                    <img src="img/berita/<?php echo $data['gambar_berita']?>" style="height: 120px;">
                                </div>
                            </div>
                            <div class="col-7 mt-2 ml-3">
                                <div class="row">
                                    <p style="color:black; font-weight:bold;"> <?php echo $data['kategori']?> </p> <p class="ml-2" style="color:black;"> <?php echo $data['tanggal_berita']?> </p>
                                </div>
                                <div class="row">
                                <a class="nav-item" href="konten.php?id_berita=<?php echo $data['id_berita'];?>"><h3 style="font-weight: bold; font-size: 25px;"><?php echo $data['judul']?></h3></a>
                                </div>
                                <div class="row">
                                    <p><?php echo substr($data['isi_berita'], 0,250); ?>...</p>
                                    <a class="nav-item" href="konten.php?id_berita=<?php echo $data['id_berita'];?>"><h6>Baca selengkapnya</h6></a>
                                </div>                    
                                <div class="border-bottom my-2"></div>   
                            </div>
                        </div>
                    </div>                  
                </div>
            <?php } ?>
            </div>
            <div class="col-4 mt-3">
                <div class="row mr-3">
                    <h4 class="mb-3" style="font-weight: bold;">Trending Topic</h4>
                    <?php while ($tr = mysqli_fetch_array($trend)){ ?> 
                    <div class="row mr-5">
                        <img src="img/berita/<?php echo $tr['gambar_berita'] ?>" style="height: 160px; width: 100%;">
                    </div>
                    <div class="row mt-1 mr-3">
                        <a href="konten.php?id_berita=<?php echo $tr['id_berita'] ?>"><h5 style="font-weight: bold;"><?php echo $tr['judul'] ?></h5></a>
                    </div>
                    <div class="row">
                        <p style="color:black; font-weight:bold;"> <?php echo $tr['kategori'] ?> </p> <p class="ml-2" style="color:black;"> <?php echo $tr['tanggal_berita'] ?> </p>
                    </div>
                <?php } ?>
                </div>
                <div class="row mt-3 mr-3">
                    <h4 class="mb-3" style="font-weight: bold;">Berita Terkini</h4>
                    <?php while ($br = mysqli_fetch_array($baru)){ ?> 
                    <div class="row mr-5">
                        <img src="img/berita/<?php echo $br['gambar_berita'] ?>" style="height: 160px; width: 100%;">
                    </div>
                    <div class="row mt-1 mr-3">
                        <a href="konten.php?id_berita=<?php echo $br['id_berita'] ?>"><h5 style="font-weight: bold;"><?php echo $br['judul'] ?></h5></a>
                    </div>
                    <div class="row">
                        <p style="color:black; font-weight:bold;"> <?php echo $br['kategori'] ?> </p> <p class="ml-2" style="color:black;"> <?php echo $br['tanggal_berita'] ?> </p>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>     
</div>
        

<?php include 'tata_letak/bawah.php'; ?>



