<?php
	require_once 'koneksi.php';
?>

<?php include 'navbar.php'; ?>

<?php
  $id = $_GET['id_berita'];
  $trend = mysqli_query($koneksi,"select berita.gambar_berita, kategori.kategori, berita.tanggal_berita, berita.id_berita, berita.judul, berita.id_kategori from berita inner join kategori on berita.id_kategori = kategori.id_kategori order by dilihat desc limit 3");
  $kategori = mysqli_query($koneksi, "select * from kategori order by id_kategori desc");
  $konten = mysqli_query($koneksi,"select judul, tanggal_berita, penulis, id_berita, isi_berita, gambar_berita, dilihat from berita where id_berita = $id ");
  while ($data = mysqli_fetch_array($konten)){

    if($data > 0){
      $statistik = $data['dilihat']+1;
      $tambah_dilihat = (mysqli_query($koneksi, 'UPDATE berita SET dilihat = "'.$statistik.'" WHERE id_berita = "'.$id.'"'));
    }
?>

<div class="content">
    <div class="row">
        <div class="col">
              <img class="foto" src="img/berita/<?php echo $data['gambar_berita']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card kartu mx-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col mx-4 mx-4 my-4 tengah">  
                            <p class="judul2"><?php echo $data['judul']; ?></p>
                            <div class="border-bottom mb-3"></div>
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill mb-1" viewBox="0 0 16 16">
                                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg> <?php echo $data['penulis']; ?> | 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
                                  <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zM2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"/>
                                </svg> <?php echo $data['tanggal_berita']; ?> |
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                </svg> <?php echo $data['dilihat']; ?>
                            </p>
                            <div class="border-bottom mb-3"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <br>
                              <p><?php echo $data['isi_berita']; ?></p>
                              <div class="border-bottom mb-3"></div>
                              <div class="comment">
                              <?php
                                    if (isset($_GET['komentar'])) {
                                      //Mengecek nilai variabel add yang telah di enskripsi dengan method md5()
                                      if ($_GET['komentar']=='berhasil'){
                                          echo"<div class='alert alert-success'>Komentar telah terkirim, menunggu persetujuan dari admin</div>";
                                      }else {
                                          echo"<div class='alert alert-danger'>Komentar gagal</div>";
                                      }   
                                  }
                              ?>
                                <form method="post" action="simpan-komentar.php">
                                    <label><h2>Tinggalkan Komentar</h2></label>
                                    <div class="form-group">
                                        <input class="form-control" type="hidden" name="id_berita" value="<?php echo $data['id_berita']; ?>">
                                        <input type="hidden" name="status" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama:</label>
                                        <input type="" name="nama" class="form-control" value="<?php if(!empty($_SESSION['nama'])): echo $_SESSION['nama']; else: echo ""; endif; ?>" required disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" value="<?php if(!empty($_SESSION['email'])): echo $_SESSION['email']; else: echo ""; endif; ?>" required disabled>
                                    </div>

                                    <div class="form-group">
                                        <label>Komentar:</label>
                                        <textarea class="form-control" name="komentar" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit"  name="form_komentar" class="btn btn-info" value="Kirim Komentar">
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <?php
                                    include 'koneksi.php';
                                    $sql="select * from komentar where id_berita=$id and status_komentar=1 order by id_komentar desc";
                                    $hasil=mysqli_query($koneksi,$sql);
                                    while ($komentar = mysqli_fetch_array($hasil)):
                                ?>
                                <div class="col-sm-12">
                                    <div class="caption">
                                        <h5><?php echo $komentar['nama'];?></h5>
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img src="img/bg/user.png" width="100%" alt="Cinque Terre">
                                            </div>
                                            <div class="col-sm-11">
                                                <?php echo $komentar['isi_komentar']; ?>
                                            </div> 
                                        </div>
                                        <br><br>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            </div>
                            <div class="col mt-2 ml-2 col-lg-4 col-md-12">
                            <div class="card">
                              <div class="card-body">
                                <div class="col">
                                  <h4>Kategori</h4>
                                <div class="border-bottom mb-3"></div>
                                <?php while ($kat = mysqli_fetch_array($kategori)){?>
                                  <a class="nav-item nav-link" href="halaman.php?id_kategori=<?php echo $kat['id_kategori'];?>"><p style="font-size: 18px;"><?php echo $kat['kategori']; ?></p></a>
                                <div class="border-bottom mb-3"></div>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                            <div class="row ml-2 mt-5">
                                <h4 class="mb-3" style="font-weight: bold;">Trending Topic</h4>
                              </div>
                                <?php while ($tr = mysqli_fetch_array($trend)){ ?> 
                                <div class="row ml-3 mr-5">
                                    <img src="img/berita/<?php echo $tr['gambar_berita'] ?>" style="height: 200px; width: 80%;">
                                </div>
                                <div class="row mt-1 ml-3">
                                    <a href="konten.php?id_berita=<?php echo $tr['id_berita'] ?>"><h5 style="font-weight: bold;"><?php echo $tr['judul'] ?></h5></a>
                                </div>
                                <div class="row ml-3">
                                    <p style="color:black; font-weight:bold;"> <?php echo $tr['kategori'] ?> </p> <p class="ml-2" style="color:black;"> <?php echo $tr['tanggal_berita'] ?> </p>
                                </div>
                            <?php } ?>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <?php include 'tata_letak/bawah.php'; ?>

      <script src="../js/jquery-3.6.0.min.js"></script>
      <script src="../js/bootstrap.js"></script>
</body>
</html>