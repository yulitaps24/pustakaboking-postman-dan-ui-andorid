<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "tabelpustaka";
$con = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" .   mysqli_connect_error());
mysqli_select_db($con, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($con));

@$operasi = $_GET['operasi'];

switch    ($operasi) {
case "view":
$query_tampil_anggota = mysqli_query($con,"SELECT * FROM anggota") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($query_tampil_anggota)) {
$data_array[]=$data;
}
echo json_encode($data_array);

break;

case "insert":
@$username= $_GET['username'];
@$no_anggota= $_GET['no_anggota'];
@$total_pinjam= $_GET['total_pinjam'];
$query_insert_data = mysqli_query($con, "INSERT INTO anggota (username,no_anggota,total_pinjam) VALUES('$username','$no_anggota','$total_pinjam')");
if ($query_insert_data) {
echo "Data Berhasil Disimpan";
}
else {
echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
}

break;

case "get_anggota_by_id":
@$id = $_GET['id'];
$query_tampil_anggota = mysqli_query($con, "SELECT * FROM anggota WHERE id='$id'") or die (mysqli_error($con));
$data_array = array();
$data_array = mysqli_fetch_assoc($query_tampil_anggota);
echo "[" . json_encode ($data_array) . "]";

break;

case "update":
@$username = $_GET['username'];
@$no_anggota = $_GET['no_anggota'];
@$total_pinjam = $_GET['total_pinjam'];
@$id = $_GET['id'];
$query_update_anggota= mysqli_query($con, "UPDATE anggota SET username='$username', no_anggota='$no_anggota', total_pinjam='$total_pinjam' WHERE id='$id'");
if ($query_update_anggota) {
echo "Update Data Berhasil";

}
else {
echo mysqli_error($con);
}

break;

case "delete":
@$id = $_GET['id'];
$query_delete_anggota = mysqli_query($con, "DELETE FROM anggota WHERE id='$id'");
if ($query_delete_anggota) {
echo "Data Berhasil Dihapus";
}
else {
echo mysqli_error($con);
}

break;

default:
break;
}
?>