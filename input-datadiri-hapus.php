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

if(isset($_GET["kodebarang"]) && $_SESSION["role"] == "siswa"){
    $nis = $_GET["kodebarang"];

    $query = "
     DELETE FROM transaksi
     WHERE kodebarang = '$kodebaranag';
    ";

    
    $update = mysqli_query($mysqli, $query);

    if($update){
        echo "
        <script>
        alert('Data berhasil dihapus');
        window.location='input-datadiri.php';
        </script>
        ";
    }
}
?>