<div class='container'>
    <h1>Tambah Data</h1>
    <form action="input-datadiri-tambah.php" method="POST">
    <label for="nis">Nomor Induk Siswa :</label><br>
    <input class='form-control' type="number" name="nis" placeholder="Ex. 12003102" /><br>

    <label for="nama">Nama Lengkap :</label><br>
    <input class='form-control' type="text" name="nama" placeholder="Ex. Farel Vandin" /><br>

    <label for="tanggal_lahir">Tanggal Lahir :</label><br>
    <input class='form-control' type="date" name="tanggal_lahir" /><br>

    <label for="nilai">Nilai : </label><br>
    <input class='form-control' type="number" name="nilai" placeholer="Ex. 80.56" /></br>

    <input class='btn btn-success btn-sm' type="submit" name="simpan" value="Simpan Data" />
    <a class='btn btn-secondary btn-sm' href="input-datadiri.php">Kembali</a>
    </form>
</div>

<?php
include ('./input-config.php');
if ($_SESSION["login"] != TRUE) {
    header('location:login.php');
}

if ($_SESSION["role"] != "siswa") {
    echo "
    <script>
         alert('Akses tidak diberikan, kamu bukan admin');
         window.location='input-datadiri.php';
         </script>
    ";
    }

 if(isset($_POST["simpan"])){
     $nis = $_POST["nis"];
     $nama = $_POST["nama"];
     $tanggal_lahir = $_POST["tanggal_lahir"];
     $nilai = $_POST["nilai"];

    /*echo $nis . "<br>";
    echo $nama . "<br>";
    echo $tanggal_lahir . "<br>";
    echo $nilai . "<br>";*/

    // CREATE - Menambahkan Data ke Database
    $query = "INSERT INTO transaksi VALUES ('$nis', '$nama', '$tanggal_lahir', '$nilai');";
    echo $query;
    $insert = mysqli_query($mysqli, $query);

    if ($insert){
        echo "
        <script>
         alert('Data berhasil ditambahkan');
         window.location='input-datadiri.php';
         </script>
        ";
    }
}
?>