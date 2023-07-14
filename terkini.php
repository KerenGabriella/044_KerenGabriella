
<?php
  include 'koneksi.php';
  $berita = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori,berita.isi_berita, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by id_berita desc");
?>

<?php include 'navbar.php'; ?>


<div class=" container">
    <div class=" bg-white my-5" style="border-radius: 20px;" >
        <br/>
			<p class="judul2 text-center">Terkini</p>
		<br/>
        <div class="row">
                <div class="card-body">
                    <?php while ($baru = mysqli_fetch_array($berita)){?>
                        <div class="row">
                            <div class="col-3 mt-2 mb-4 ml-4 zoom-effect">
                                <div class="kotak ml-3">
                                    <img src="img/berita/<?php echo $baru['gambar_berita']?>" style="height: 120px;">
                                </div>
                            </div>
                            <div class="col-7 mt-2 ml-3">
                                <div class="row">
                                    <p style="color:black; font-weight:bold;"> <?php echo $baru['kategori']?> </p> <p class="ml-2" style="color:black;"> <?php echo $baru['tanggal_berita']?> </p>
                                </div>
                                <div class="row">
                                    <a class="nav-item" href="konten.php?id_berita=<?php echo $baru['id_berita'];?>"><h3 style="font-weight: bold; font-size: 25px;"><?php echo $baru['judul']?></h3></a>
                                </div>
                                <div class="row">
                                    <p><?php echo substr($baru['isi_berita'], 0,300); ?>...</p>
                                    <a class="nav-item" href="konten.php?id_berita=<?php echo $baru['id_berita'];?>"><h6>Baca selengkapnya</h6></a>
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




