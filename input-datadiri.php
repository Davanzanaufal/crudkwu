<?php
    include('./input-config.php');
    if ($_SESSION["login"] != TRUE) {
        header('location:login.php');
    }

    echo "<div class='container'>";
    
        echo "Selamat Datang, " . $_SESSION["username"] . "<br>";
        echo "Anda sebagai : " . $_SESSION["role"];
        echo " - ";
        echo "<a class='btn btn-secondary btn-sm' href='logout.php'>Logout</a>";
        echo " <hr>";
        echo "<a class='btn btn-primary btn-sm' href='input-datadiri-tambah.php'>Tambah Data</a>";
        echo "&nbsp;-&nbsp;";
        echo "<a class='btn btn-warning btn-sm' href='input-datadiri-pdf.php'>Download PDF</a>";
        echo "<hr>";
        // READ - Menampilkan data dari database
        $no = 1;
        $tabledata = "";
        $data = mysqli_query($mysqli, "SELECT * FROM transaksi ");
        while($row =mysqli_fetch_array($data)){
            $total_hargabeli = ( 
                $row["qty"] * 
                $row["hargabeli"]  );
    
            $total_hargajual = ( 
                    $row["qty"] * 
                    $row["hargajual"]  );
            $laba = ($total_hargajual - $total_hargabeli);
            $tabledata .= "
            <tr>
            <td>".$row["kode_barang"]."</td>
            <td>".$row["tanggal"]."</td>
            <td>".$row["pembeli"]."</td>
            <td>".$row["namabarang"]."</td>
            <td>".$row["qty"]."</td>
            <td>".$row["hargabeli"]."</td>
            <td>".$row["hargajual"]."</td>
            
            <td>".$total_hargabeli."</td>
            <td>".$total_hargajual."</td>
            <td>".$laba."</td>
                <td>
                    <a class='btn btn-success btn-sm' href='input-datadiri-edit.php?nis=".$row["kode_barang"]."' >Edit</a>
                    &nbsp;-&nbsp;
                    <a class='btn btn-danger btn-sm' href='input-datadiri-hapus.php?nis=".$row["kode_barang"]."' 
                    onclick='return confirm(\"Yakin Dek ?\");'>Hapus</a>
                </td>
            </tr>
            ";
            $no++;
        }
        
            echo "
            <table class='table table-Info table-bordered table-striped'>
            <tr>
            <th>Kode Barang</th>
            <th>Tanggal</th>
            <th>Pembeli</th>
            <th>Nama Barang</th>
            <th>QTY</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Total Harga Beli</th>
            <th>Total Harga Jual</th>
            <th>Laba</th>


            <th>Aksi</th>

            </tr>
            $tabledata
            </table>
            ";
    echo"</div>";
?>    