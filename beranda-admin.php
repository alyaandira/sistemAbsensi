<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Administrator</title>
</head>

<body>
    <h1></h1>
    <?php
    include '././db-component/GetAllClass.php';

    if (empty($FetchedClassList)) {
        echo "<p>No class has been registered</p>";
    } else {

        echo "
        <table style='width:100%'>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Kode</th>
            <th>Action</th>
        </tr>";

        //belajar tentang foreach
        foreach ($FetchedClassList as $key => $value) {
            $nomor = $key+1;
            echo "
            <tr>
                <td>$nomor</td>
                <td>$value[matkul_nama]</td>
                <td>$value[matkul_kode]</td>
                <td>
                    <button>Delete</button>
                    <button>Update</button>
                </td>
            </tr>";
        }//end of foreach
    echo "</table>";
        
       
    }

    ?>

</body>

</html>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>