<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include "./config.php";

$data = json_decode(file_get_contents("php://input"));

if (empty($data->selectedDosenNIP)) {

  // set response code - 400 bad request
  http_response_code(400);
  
  // tell the user
  echo json_encode(array("message" => "Expected Dosen NIP."));
  return;
}

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$selectedDosenNIP = $data->selectedDosenNIP;

$SQL_query = "SELECT mata_kuliah.matkul_nama, mata_kuliah.matkul_kode, mengajar.dosen_nip, `$mengajar_id` FROM $mengajar_table " .
  "LEFT JOIN $matkul_table " .
  "ON mengajar.matkul_kode = mata_kuliah.matkul_kode " .
  "HAVING `$dosen_nip` = '$selectedDosenNIP' ";

$result = mysqli_query($conn, $SQL_query);

if ($result) {
  $row_count = $result->num_rows;
  $matkulTerdaftarList = [];

  if ($row_count > 0) {
    $matkulTerdaftarList = $result->fetch_all(MYSQLI_ASSOC);

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($matkulTerdaftarList);
  }else{
    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode([]);
  }
} else {
  $error_message = $conn->error;
  echo ("Error is = " . $error_message);
  echo
  "<script>
        iziToast.error({
            title: 'Error',
            message: 'SQL error',
        });
    </script>";
}
