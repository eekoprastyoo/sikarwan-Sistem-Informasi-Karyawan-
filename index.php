<?php
require("functions.php");
$conn = mysqli_connect("localhost","root","","sikarwan");

$data_karyawan = query("SELECT tb_karyawan.id_karyawan,tb_karyawan.nip,tb_karyawan.nama,tb_karyawan.gender,tb_karyawan.tgl_lahir, tb_karyawan.tgl_masuk,tb_karyawan.grade,tb_gaji.gaji FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.grade = tb_gaji.grade ORDER BY tb_karyawan.nip asc ;");
$grade_gaji = query("SELECT grade FROM tb_gaji");

if(isset($_POST["cari"])){
    $data_karyawan = cari($_POST["keyword"]);
}

if(isset($_POST["urut"])){
    $awal = $_POST["awal"];
    $newawal = date("Y-m-d", strtotime($awal));
    $akhir = $_POST["akhir"];
    $newakhir = date("Y-m-d", strtotime($akhir));
    $data_karyawan = urut($newawal,$newakhir);
}

if(isset($_POST["submit"])){
    $nip        = $_POST["nip"];
    $nama       = $_POST["nama"];
    $gender     = $_POST["gender"];
    $tgl_lahir  = $_POST["tgl_lahir"];
    $newtgllahir = date("Y-m-d", strtotime($tgl_lahir));
    $tgl_masuk  = $_POST["tgl_masuk"];
    $newtglmasuk = date("Y-m-d", strtotime($tgl_masuk));
    $grade      = $_POST["grade"];
    
    $query = "INSERT INTO tb_karyawan (nip,nama,gender,tgl_lahir,tgl_masuk,grade) VALUES ('$nip','$nama','$gender','$newtgllahir','$newtglmasuk','$grade')";
    mysqli_query($conn,$query);

    if (mysqli_affected_rows($conn) > 0){
        echo "
            <script>
                alert('data berhasil ditambahkan'); 
                document.location.href = 'index.php';
            </script>";
    }else{
        echo "
            <script>
                alert('data gagal ditambahkan'); 
                document.location.href = 'index.php';
            </script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sikarwan</title>
  </head>
  <body>

  <!-- Modal tambah -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nip">Nip</label>
                    <input type="number" class="form-control" id="nip" name="nip" placeholder="nip" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="js-example-basic-single form-control" name="gender" id="gender" required>
                        <option value="">--Pilih Gender--</option>
                        <option value="F">F</option>
                        <option value="M">M</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
                </div>
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <select class="js-example-basic-single form-control" name="grade" id="grade" required>
                        <option value="">--Pilih Grade--</option>
                        <?php foreach($grade_gaji as $grade): ?>
                        <option value="<?= $grade['grade'];?>"><?= $grade['grade'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
            </form>
        </div>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="card-body">
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah</button>
        <button class="btn btn-success btn-sm">Report</button>
        <br>
        <br>
        <form action="" method="post">
            <input type="text" name="keyword" autofocus placeholder="Masukan keyword" autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <br>
        <label for="tgl_masuk">Tanggal Masuk :</label>
        <form action="" method="post">
            <input type="date" name="awal" placeholder="tanggal awal">
            <input type="date" name="akhir" placeholder="tanggal akhir">
            <button type="submit" name="urut">Sorting</button>
        </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
        <div class="table-responsive text-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Nip</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">Tgl Masuk</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Gaji</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_karyawan as $karyawan): ?>
                    <tr>
                        <td><?php echo $karyawan["nip"]; ?></td>
                        <td><?php echo $karyawan["nama"]; ?></td>
                        <td><?php echo $karyawan["gender"]; ?></td>
                        <?php $newlahir = date("m-d-Y", strtotime($karyawan["tgl_lahir"]));?>
                        <td><?php echo $newlahir ?></td>
                        <?php $newmasuk = date("m-d-Y", strtotime($karyawan["tgl_masuk"]));?>
                        <td><?php echo $newmasuk; ?></td>
                        <td><?php echo $karyawan["grade"]; ?></td>
                        <td><?php echo $karyawan["gaji"]; ?></td>
                        <td>
                            <a href="hapus.php?id_karyawan=<?php echo $karyawan["id_karyawan"]; ?>" onclick="return confirm('Yakin hapus ?');">
                            <button class="btn btn-danger btn-sm">Delete</button>
                            </a>
                            <a href="ubah.php?id_karyawan=<?php echo $karyawan["id_karyawan"]; ?>">
                            <button class="btn btn-primary btn-sm">Edit</button>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>