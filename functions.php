<?php
$conn = mysqli_connect("localhost","root","","sikarwan");

function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row; 
    }

    return $rows;
}

function hapus($id){
    global $conn;
    $query = "DELETE FROM tb_karyawan WHERE id_karyawan = $id";
    $result = mysqli_query($conn,$query);
    return $result;
}

function ubah($id){
    global $conn;
    $nip        = $_POST["nip"];
    $nama       = $_POST["nama"];
    $gender     = $_POST["gender"];
    $tgl_lahir  = $_POST["tgl_lahir"];
    $newtgllahir = date("Y-m-d", strtotime($tgl_lahir));
    $tgl_masuk  = $_POST["tgl_masuk"];
    $newtglmasuk = date("Y-m-d", strtotime($tgl_masuk));
    $grade      = $_POST["grade"];
    
    $query = "UPDATE tb_karyawan SET nip='$nip',nama='$nama',gender='$gender',tgl_lahir='$newtgllahir',tgl_masuk='$newtglmasuk',grade='$grade' WHERE id_karyawan='$id'";
    $ubah = mysqli_query($conn,$query);

    return $ubah;
}

function cari($keyword){
    global $conn;
    $query = "SELECT tb_karyawan.id_karyawan,tb_karyawan.nip,tb_karyawan.nama,tb_karyawan.gender,tb_karyawan.tgl_lahir, tb_karyawan.tgl_masuk,tb_karyawan.grade,tb_gaji.gaji FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.grade = tb_gaji.grade 
    WHERE tb_karyawan.nip LIKE '%$keyword%' OR tb_karyawan.nama LIKE '%$keyword%'  OR tb_karyawan.gender LIKE '%$keyword%'  OR tb_karyawan.tgl_lahir LIKE '%$keyword%'  OR tb_karyawan.tgl_masuk LIKE '%$keyword%'  OR tb_karyawan.grade LIKE '%$keyword%'
    OR tb_gaji.gaji LIKE '%$keyword%'";
    $result = mysqli_query($conn,$query);
    return $result;
}

function urut($awal,$akhir){
    global $conn;
    $query = "SELECT tb_karyawan.id_karyawan,tb_karyawan.nip,tb_karyawan.nama,tb_karyawan.gender,tb_karyawan.tgl_lahir, tb_karyawan.tgl_masuk,tb_karyawan.grade,tb_gaji.gaji 
    FROM tb_karyawan INNER JOIN tb_gaji ON tb_karyawan.grade = tb_gaji.grade 
    WHERE tb_karyawan.tgl_masuk BETWEEN '$awal' AND '$akhir'";
    $result = mysqli_query($conn,$query);
    return $result;
}
?>