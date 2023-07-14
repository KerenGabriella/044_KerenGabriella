<?php
    if (isset($_POST['form_komentar'])) {
        //Include file koneksi, untuk koneksikan ke database
        include 'koneksi.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $id_berita=input($_POST["id_berita"]);
        $nama=input($_SESSION["nama"]);
        $email=input($_SESSION["email"]);
        $komentar=input($_POST["komentar"]);
        $status=input($_POST["status"]);

       
        if($nama != ""){
            //Query input menginput data kedalam tabel 
            $sql="insert into komentar (id_berita,nama,email,isi_komentar,status_komentar) values
            ('$id_berita','$nama','$email','$komentar','$status')";
            //Mengeksekusi/menjalankan query 
            $hasil=mysqli_query($koneksi,$sql);
            header ("Location:konten.php?id_berita=$id_berita&komentar=berhasil");
        }
        else {
            echo "<script>alert('Silahkan login terlebih dahulu agar dapat berkomentar.');window.location='user/login.php';</script>";

        }
        
    }
?>