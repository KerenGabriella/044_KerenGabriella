<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
$host     = "localhost";    // Server database
$username = "root";         // Username database
$password = "";             // Password database
$database = "final_project"; // Nama database

// Koneksi ke database.
$conn = new mysqli($host, $username, $password, $database);

// Deklarasi variable keyword buah.
$judul = $_GET['term'];

// Query ke database.
$query  = $conn->query("SELECT * FROM berita WHERE judul LIKE '".$judul."%' ORDER BY dilihat DESC LIMIT 5");

$content = array();
    if($query ->num_rows > 0){
        while($row = $query -> fetch_assoc()){
            $data['id'] = $row['id_berita'];
            $data['value'] = $row['judul'];
            array_push($content,$data);
        }
    }

echo json_encode($content);