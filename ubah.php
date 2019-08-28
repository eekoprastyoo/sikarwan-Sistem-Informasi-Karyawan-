<?php
require("functions.php");

$id = $_GET['id_karyawan'];

$data_ubah = query("SELECT * FROM tb_karyawan WHERE id_karyawan=$id");
$grade_gaji = query("SELECT grade FROM tb_gaji");

if(isset($_POST["submit"])){

    if (ubah($id) > 0){
        echo "
            <script>
                alert('data berhasil diubah'); 
                document.location.href = 'index.php';
            </script>";
    }else{
        echo "
            <script>
                alert('data gagal diubah'); 
                document.location.href = 'index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="card-body">
<?php foreach($data_ubah as $data): ?>
<form action="" method="post">
                <div class="form-group">
                    <label for="nip">Nip</label>
                    <input type="number" value="<?php echo $data['nip'] ?>" class="form-control" id="nip" name="nip" placeholder="nip" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" value="<?php echo $data['nama'] ?>" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="js-example-basic-single form-control" name="gender" id="gender" required>
                        <option value="<?php echo $data['gender'] ?>"><?php echo $data['gender'] ?></option>
                        <option value="F">F</option>
                        <option value="M">M</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date"  value="<?php echo $data['tgl_lahir'] ?>" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date"  value="<?php echo $data['tgl_masuk'] ?>" class="form-control" id="tgl_masuk" name="tgl_masuk" required>
                </div>
                <div class="form-group">
                    <label for="grade">Grade</label>
                    <select class="js-example-basic-single form-control" name="grade" id="grade" required>
                        <option  value="<?php echo $data['grade'] ?>"><?php echo $data['grade'] ?></option>
                        <?php foreach($grade_gaji as $grade): ?>
                        <option value="<?= $grade['grade'];?>"><?= $grade['grade'];?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="submit">Submit</button>
 </form>
<?php endforeach;?>
</div>
</body>
</html>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>