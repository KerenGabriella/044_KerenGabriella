<?php
	require_once 'koneksi.php';
?>

<?php include 'navbar.php'; ?>
<?php
    $ambil_kategori = 'SELECT kategori.id_kategori, kategori.kategori FROM kategori ';
    $qry_kat = $koneksi -> query($ambil_kategori) or die($koneksi ->error);
    $trend = 'select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.isi_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by dilihat desc limit 3';
    $car_trend = $koneksi -> query($trend) or die($koneksi ->error);
    $terkini = 'select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.isi_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by id_berita desc limit 3';
    $tr = mysqli_query($koneksi, $terkini);
    $dunia = 'select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.isi_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori where kategori.kategori = "dunia" order by id_berita desc limit 3';
    $du = mysqli_query($koneksi, $dunia);
    $lainnya = 'select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.isi_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori where berita.id_kategori not like "1" order by kategori desc';
    $more = mysqli_query($koneksi, $lainnya);

?>



        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                        <?php 
                        $total = 0;
                        foreach($car_trend as $row){
                            $status = ' ';
                            if($total == 0){
                            $status = 'active';
                            }
                        ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$total; ?>" class="active"></li><?php $total++; } ?>
                        </ul>
                    <div class="carousel-inner">
                    <?php 
                        $total = 0;
                        foreach($car_trend as $row){
                            $status = ' ';
                            if($total == 0){
                            $status = 'active';
                            }
                        ?>
                        <div class="carousel-item <?=$status; ?>">
                            <img class="d-block w-100" src="img/berita/<?php echo $row['gambar_berita'] ?>" alt="Mandalika">
                            <div class="carousel-caption-modelku d-none d-md-block">
                            <a class="text-white" href="konten.php?id_berita=<?php echo $row['id_berita'];?>"><h4><?php echo $row['judul'] ?></h4></a>
                              <p><?php echo substr($row['isi_berita'], 0,300); ?>... </p>
                            </div>
                            <?php $total++; ?>
                        </div>
                        <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="opsi col col-lg-11">
                    <h2 class="mt-3" style="text-align: center;">Kategori</h2>
                    <hr style="border-top: 1px solid grey;">
                    <div class="row">
                        <div class="col">
                            <h5 class="ml-auto">
                                <?php
                                    while($kat= $qry_kat->fetch_assoc()){?>
                                    <a class="nav-item nav-link" href="halaman.php?id_kategori=<?php echo $kat['id_kategori'];?>"><h6><?php echo $kat['kategori'];?></h6></a>
                                <?php }  ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class=" bg-white my-5" style="border-radius: 20px;" >
                <div class="row ml-2">
                    <h3 class="mt-5 ml-5">Berita Dunia<hr style="height:6px;border-width:0;  ;background-color: #5EA6E5"></h3>
                </div>
                <div class="row px-5 py-5">
                <?php while ($du_que = mysqli_fetch_array($du)){ ?>
                    <div class="col">
                        <div class="card mr-2" style="width: 17.2rem; height: 30rem;">
                            <img class="card-img-top" src="img/berita/<?php echo $du_que['gambar_berita'] ?>" alt="Card image cap">
                            <div class="card-body">
                            <a class="nav-item" href="konten.php?id_berita=<?php echo $du_que['id_berita'];?>"><h5 class="card-title"><?php echo $du_que['judul'] ?></h5></a>
                                <p class="card-text"><?php echo substr($du_que['isi_berita'], 0,240); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class=" bg-white my-5" style="border-radius: 20px;" >
                <div class="row ml-2">
                    <h3 class="mt-5 ml-5">Berita Terkini<hr style="height:6px;border-width:0;  ;background-color: #5EA6E5"></h3>
                </div>
                <div class="row px-5 py-5">
                <?php while ($data = mysqli_fetch_array($tr)){ ?>
                    <div class="col">
                        <div class="card mr-2" style="width: 17.2rem; height: 30rem; ">
                            <img class="card-img-top" src="img/berita/<?php echo $data['gambar_berita'] ?>" alt="Card image cap">
                            <div class="card-body">
                            <a class="nav-item" href="konten.php?id_berita=<?php echo $data['id_berita'];?>"><h5 class="card-title"><?php echo $data['judul'] ?></h5></a>
                                <p class="card-text"><?php echo substr($data['isi_berita'], 0,240); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
            <div class="container mt-3">
                <div class="row mb-5">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <div class="col">
                            <div class="row my-4 ml-4">
                                <h3>Lainnya<hr style="height:6px;border-width:0;  ;background-color: #5EA6E5"></h3>
                            </div>
                            <?php while ($mo = mysqli_fetch_array($more)){ ?>
                            <div class="row">
                                <div class="col-3 mt-2 mb-4 ml-2 zoom-effect">
                                    <div class="kotak ml-3">
                                        <img src="img/berita/<?php echo $mo['gambar_berita'] ?>" style="height: 150px;">
                                    </div>
                                </div>
                                <div class="col-7 mt-2 ml-5">
                                    <div class="row">
                                        <p style="color:black; font-weight:bold;"> <?php echo $mo['kategori'] ?> </p><p class="ml-2" style="color:black;"> <?php echo $mo['tanggal_berita'] ?> </p>
                                    </div>
                                    <div class="row ">
                                        <a class="nav-item" href="konten.php?id_berita=<?php echo $mo['id_berita'];?>"><h3 style="font-weight: bold;"><?php echo $mo['judul'] ?></h3></a>
                                    </div>
                                    <div class="row">
                                        <p><?php echo substr($mo['isi_berita'], 0,320); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="border-bottom mb-3"></div>            
                            <?php } ?>   
                        </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
            <?php include 'tata_letak/bawah.php'; ?>
            <?php include 'user/logout_conf.php'; ?>

        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>