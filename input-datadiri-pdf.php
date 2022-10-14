<?php
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    include('./input-config.php');
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
        <td>".$row["kodebarang"]."</td>
        <td>".$row["tanggal"]."</td>
        <td>".$row["pembeli"]."</td>
        <td>".$row["namabarang"]."</td>
        <td>".$row["qty"]."</td>
        <td>".$row["hargabeli"]."</td>
        <td>".$row["hargajual"]."</td>
        
        <td>".$total_hargabeli."</td>
        <td>".$total_hargajual."</td>
        <td>".$laba."</td>
        </tr>
        ";
        $no++;
     }
    
        $tanggal_cetak = date('d M Y - H:i:s');
        $table = "
            <h1>Laporan Data Diri Kelas</h1>
            <h6>Waktu Cetak : $tanggal_cetak</h6>
            <table width='100%' cellpadding=5 border=1 cellspacing=0>
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


                
                </tr>
                $tabledata
            </table>
        ";

    $mpdf->WriteHTML($table);
    $mpdf->Output();
?>