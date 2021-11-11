<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Daftar Buku</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: plum;
      }
    table {
      border: solid 1px #E6E6FA;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #E6E6FA;
        border: solid 1px #E6E6FA;
        color: putih;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #E6E6FA;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: plum;
          color: #FFFFFF;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    } 
    </style>
  </head>
  <body>
    <center><h1>Daftar Buku</h1><center>
    <center><a href="tambah_buku.php">+ &nbsp; Tambah Produk</a><center>
    <br/>
    <br/>
    <table>
      <thead>
        <tr>
          <th style=color:hitam;background-color:#E6E6FA;>No</th>
          <th style=color:hitam;background-color:#E6E6FA;>Judul Buku</th>
          <th style=color:hitam;background-color:#E6E6FA;>Pengarang</th>
          <th style=color:hitam;background-color:#E6E6FA;>Penerbit</th>
          <th style=color:hitam;background-color:#E6E6FA;>Persediaan</th>
          <th style=color:hitam;background-color:#E6E6FA;>Tahun</th>
          <th style=color:hitam;background-color:#E6E6FA;>Gambar</th>
          <th style=color:hitam;background-color:#E6E6FA;>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      


      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM buku ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }
      

      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['judul']; ?></td>
          <td><?php echo substr($row['pengarang'], 0, 20); ?>...</td>
          <td><?php echo substr($row['penerbit'], 0, 20); ?></td>
          <td><?php echo substr($row['persediaan'], 0, 20); ?></td>
          <td><?php echo $row['tahun']; ?></td>
          <td style="text-align: center;"><img src="../gambar<?php echo $row['gambar']; ?>" style="width: 120px;"></td>
          <td>
              <a href="edit_buku.php?id=<?php echo $row['id']; ?>">Edit</a> |
              <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus buku ini?')">Hapus</a>
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
  </body>
</html>