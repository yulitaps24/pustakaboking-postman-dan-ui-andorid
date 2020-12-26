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
$query_tampil_buku = mysqli_query($con,"SELECT * FROM buku") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($query_tampil_buku)) {
$data_array[]=$data;
}
echo json_encode($data_array);

break;

case "insert":
@$username= $_GET['username'];
@$buku= $_GET['buku'];
@$pinjam= $_GET['pinjam'];
$query_insert_data = mysqli_query($con, "INSERT INTO buku (username,buku,pinjam) VALUES('$username','$buku','$pinjam')");
if ($query_insert_data) {
echo "Data Berhasil Disimpan";
}
else {
echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
}

break;

case "get_buku_by_id":
@$id = $_GET['id'];
$query_tampil_buku = mysqli_query($con, "SELECT * FROM buku WHERE id='$id'") or die (mysqli_error($con));
$data_array = array();
$data_array = mysqli_fetch_assoc($query_tampil_buku);
echo "[" . json_encode ($data_array) . "]";

break;

case "update":
@$pinjam = $_GET['pinjam'];
@$buku = $_GET['buku'];
@$username = $_GET['username'];
@$id = $_GET['id'];
$query_update_buku= mysqli_query($con, "UPDATE buku SET username='$username', buku='$buku', pinjam='$pinjam'   WHERE id='$id'");
if ($query_update_buku) {
echo "Update Data Berhasil";

}
else {
echo mysqli_error($con);
}

break;

case "delete":
@$id = $_GET['id'];
$query_delete_buku= mysqli_query($con, "DELETE FROM buku WHERE id='$id'");
if ($query_delete_buku) {
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