<?php
	require_once 'koneksi.php';
?>

<?php include 'navbar.php'; ?>

<div class="jumbotron cari">
    <h1 class="judul">Temukan Berita</h1>
    <p class="lead">Temukan informasi yang anda inginkan dengan cepat hanya disini</p>
    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" id="tags" placeholder="Search" aria-label="Search" name="query_src">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Search</button>
    </form>
</div>
<div class="row">
    <div class="col">
        <div class="card kartu mx-3">
            <div class="card-body">
                <?php
                    if(isset($_GET['search'])){
                        $data = $_GET['query_src'];
                        $cari = mysqli_query($koneksi,"select berita.gambar_berita, berita.dilihat, berita.isi_berita, kategori.kategori, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori where judul like '%".$data."%' order by dilihat ");
                    
                ?>
                <h1 class="result ml-5 my-5"> Hasil Pencarian "<?php echo $data ?>" : <?php echo mysqli_num_rows($cari); ?> hasil</h1>
                <?php while ($pencaharian = mysqli_fetch_array($cari)){?>
                <div class="row">
                    <div class="col-3 mt-2 mb-4 ml-2 zoom-effect">
                        <div class="kotak ml-3">
                            <img src="img/berita/<?php echo $pencaharian['gambar_berita']; ?>" style="height: 150px; width: 220px;">
                        </div>
                    </div>
                    <div class="col-7 mt-2 ml-2">
                        <div class="row">
                            <p style="color:black; font-weight:bold;"> <?php echo $pencaharian['kategori']; ?> </p><p class="ml-2" style="color:black;"> <?php echo $pencaharian['tanggal_berita']; ?> </p>
                        </div>
                        <div class="row">
                            <a class="nav-item" href="konten.php?id_berita=<?php echo $pencaharian['id_berita'];?>"><h3 style="font-weight: bold;"><?php echo $pencaharian['judul']; ?></h3></a>
                        </div>
                        <div class="row">
                            <p><?php echo substr($pencaharian['isi_berita'], 0,300); ?></p>
                        </div>
                    </div>
                </div> 
                <div class="border-bottom mb-3"></div>  
                <?php } ?> 
                <?php } ?>
                </div>
        </div>                  
    </div>
</div>


<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
$( function() {
$( "#tags" ).autocomplete({
source: 'auto.php'
});
} );
</script>
<?php include 'tata_letak/bawah.php'; ?>
