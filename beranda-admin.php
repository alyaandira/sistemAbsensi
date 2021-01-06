<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Beranda - Administrator</title>
</head>

<body>
    <h1>Admin Panel</h1>
    <?php

    if (isset($_POST["ClassModal_Kode"])) {
        var_dump($_POST["ClassModal_Kode"]);
        var_dump($_POST["ClassModal_Nama"]);

        //include db-component untuk update
        //tengok SQL untuk update table
        //pasangkan template dashboard ke beranda-admin.php
    }elseif(isset($_POST["deleteClass"])){
        var_dump($_POST["deleteClass"]);
        //include db-component untuk delete kelas
        // ini advanced sikit soalnya harus delete semua record pertemuan, daftar murid
        // cemana kau assign murid ke kelas ? pikirin business logic flow nya
        // business logic ga code, logika, siapa bagaimana 
        // contoh, mhs yg pilih sendiri untuk daftar, atau ditambah kan dosen, atau admin
        // biasanya admin
        // klo admin berarti kau bisa select kelas nya, terus assign murid nya, susah co
        // ga susah, ribet aja, dibukak code tiap hari tq
        // kalo mhs yg assign?
        // kenak comment dosen, dimana logic nya, mhs yg daftar kelas tanpa verifikasi
        // makanya kubilang piker dan konfirmasi sendiri ama dosenmu, flow nya kau yg ngator, aku bantu nge code aja
        // soalnya kami elearning gitu, tp lebi bagus admin aja
        // konfirmasi sendiri ama dosenmu ga mau
        // yauda bebaswkwkkwkwkwkw canda lo
        // bandal
        // https://sweetalert2.github.io/
        // klo perlu
    }


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
            $nomor = $key + 1;
            echo "
            <tr>
                <td>$nomor</td>
                <td id='matkulNama_$key'>$value[matkul_nama]</td>
                <td id='matkulkode_$key'>$value[matkul_kode]</td>
                <td style='text-align:center;'>
                    <form method='POST'>
                        <button name='deleteClass' value='$value[matkul_kode]' class='btn btn-danger'>Delete</button>
                        <button onclick='fillupUpdateClassModal(&#39;$key&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#update_class_modal' type='button'>
                            Update
                        </button>
                    </form>
                    
                </td>
            </tr>";
        } //end of foreach
        echo "</table>";
    }

    ?>

</body>

<!-- Update Class Modal -->
<div class="modal fade" id="update_class_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" id="ClassModal_activeKey" value="0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='ClassModal_bodyForm'>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Kode Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_Kode" name="ClassModal_Kode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Nama Kelas:</label>
                        <input type="text" class="form-control" id="ClassModal_Nama" name="ClassModal_Nama">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button onclick="submitUpdateClassForm();" type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>

<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>

<script>
    function fillupUpdateClassModal(key) {

        //get value from the table row based on selected Key
        const namaKelas = document.getElementById("matkulNama_" + key).innerHTML;
        const kodeKelas = document.getElementById("matkulkode_" + key).innerHTML;

        //set the input value in the modal
        document.getElementById("ClassModal_activeKey").value = key;
        document.getElementById("ClassModal_Nama").value = namaKelas;
        document.getElementById("ClassModal_Kode").value = kodeKelas;

    }

    function submitUpdateClassForm() {

        const activeKey = document.getElementById("ClassModal_activeKey").value;

        // pakai innetHTML karena dia dialam table, didalam html tag
        const oldNamaKelas = document.getElementById("matkulNama_" + activeKey).innerHTML;
        const oldKodeKelas = document.getElementById("matkulkode_" + activeKey).innerHTML;

        // pakai value karena dia dialam <input>, kita ambil <input> dari value itu
        const newNamaKelas = document.getElementById("ClassModal_Nama").value;
        const newKodeKelas = document.getElementById("ClassModal_Kode").value;

        // console.log("old Kode kelas : " + oldKodeKelas);
        // console.log("old Nama kelas : " + oldNamaKelas);
        // console.log("new kode kelas : " + newKodeKelas);
        // console.log("new nama kelas : " + newNamaKelas);

        if (oldNamaKelas == newNamaKelas && oldKodeKelas == newKodeKelas) {
            window.alert("nothing changed, nothing to submit, pakai izzi toast")
        } else {
            document.getElementById("ClassModal_bodyForm").submit();
        }
    }
</script>