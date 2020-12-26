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
$query_tampil_admin = mysqli_query($con,"SELECT * FROM admin") or die (mysqli_error($con));
$data_array = array();
while ($data = mysqli_fetch_assoc($query_tampil_admin)) {
$data_array[]=$data;
}
echo json_encode($data_array);

break;

case "insert":
@$username= $_GET['username'];
@$password= $_GET['password'];
$query_insert_data = mysqli_query($con, "INSERT INTO admin (username,password) VALUES('$username','$password')");
if ($query_insert_data) {
echo "Data Berhasil Disimpan";
}
else {
echo "Maaf Insert Ke Dalam Database Error" . mysqli_error($con);
}

break;

case "get_admin_by_id":
@$id = $_GET['id'];
$query_tampil_admin = mysqli_query($con, "SELECT * FROM admin WHERE id='$id'") or die (mysqli_error($con));
$data_array = array();
$data_array = mysqli_fetch_assoc($query_tampil_admin);
echo "[" . json_encode ($data_array) . "]";

break;

case "update":
@$username = $_GET['username'];
@$id = $_GET['id'];
$query_update_admin= mysqli_query($con, "UPDATE admin SET username='$username' WHERE id='$id'");
if ($query_update_admin) {
echo "Update Data Berhasil";

}
else {
echo mysqli_error($con);
}

break;

case "delete":
@$id = $_GET['id'];
$query_delete_admin = mysqli_query($con, "DELETE FROM admin WHERE id='$id'");
if ($query_delete_admin) {
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