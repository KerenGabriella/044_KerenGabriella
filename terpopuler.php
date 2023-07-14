<?php include 'navbar.php'; ?>

<?php
  include 'koneksi.php';
  $trend = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori,berita.isi_berita, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by dilihat desc");
?>


<div class=" container">
    <div class=" bg-white my-5" style="border-radius: 20px;" >
        <br/>
			<p class="judul2 text-center">Trending Topic</p>
		<br/>
        <div class="row">
                <div class="card-body">
                    <?php while ($pop = mysqli_fetch_array($trend)){?>
                        <div class="row">
                            <div class="col-3 mt-2 mb-4 ml-4 zoom-effect">
                                <div class="kotak ml-3">
                                    <img src="img/berita/<?php echo $pop['gambar_berita']?>" style="height: 120px;">
                                </div>
                            </div>
                            <div class="col-7 mt-2 ml-3">
                                <div class="row">
                                    <p style="color:black; font-weight:bold;"> <?php echo $pop['kategori']?> </p> <p class="ml-2" style="color:black;"> <?php echo $pop['tanggal_berita']?> </p>
                                </div>
                                <div class="row">
                                    <a class="nav-item" href="konten.php?id_berita=<?php echo $pop['id_berita'];?>"><h3 style="font-weight: bold; font-size: 25px;"><?php echo $pop['judul']?></h3></a>
                                </div>
                                <div class="row">
                                    <p><?php echo substr($pop['isi_berita'], 0,300); ?>...</p>
                                    <a class="nav-item" href="konten.php?id_berita=<?php echo $data['id_berita'];?>"><h6>Baca selengkapnya</h6></a>
                                </div>                    
                                <div class="border-bottom my-2"></div>   
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
 
    </div>     
</div>
        

<?php include 'tata_letak/bawah.php'; ?>
<?php include 'user/logout_conf.php'; ?>



