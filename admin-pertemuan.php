<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Alya Andira Lubis">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
    <title>Sistem Absensi - Pertemuan</title>

    <!-- Custom CSS -->
    <link href="./dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/beranda-adminstyle.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Izi Toast -->
    <script src="src\izitoast\dist\js\iziToast.js" type="text/javascript"></script>
    <link rel="stylesheet" href="src\izitoast\dist\css\iziToast.css">
</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- floating action button -->
    <div class="adminActions" id="adminButton">
        <input type="checkbox" name="adminToggle" class="adminToggle" />
        <a class="adminButton" href="#!">+</a>
    </div>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <?php
        include '././ui-component/topbar-admin.php';
        include '././ui-component/sidebar-admin.php';
        ?>

        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <h1>Meeting Management</h1>

            <?php
            // add class
            if (isset($_POST["PertemuanModal_ActionType"])) {

                if ($_POST["PertemuanModal_ActionType"] == "Add") {
                    include '././db-component/admin-pertemuan-add.php';
                } else if ($_POST["PertemuanModal_ActionType"] == "Update") {
                    include '././db-component/admin-pertemuan-update.php';
                }
            }

            // delete class
            if (isset($_POST["delete_pertemuan_action"])) {
                include '././db-component/pertemuan-delete.php';
            } 

            include '././db-component/GetAllPertemuan.php';
            include '././db-component/GetAllClass.php';
            include '././db-component/GetAllDosen.php';

            if (empty($FetchedPertemuanList)) {
                echo "<p>No class has been registered</p>";
            } else {

                echo "
            <div class='table-responsive'>
                 <table class='table table-sm table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>No</th>
                            <th>Kode Pertemuan</th>
                            <th>Kode Mata Kuliah</th>
                            <th>ID Kelas</th>
                            <th>NIP Dosen</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Akhir</th>
                            <th>Batas Waktu</th>
                            <th>Action</th>
                         </tr>
                    </thead>
                <tbody>";


                foreach ($FetchedPertemuanList as $primaryKey => $value) {
                    $nomor = $primaryKey + 1;
                    $pertemuanKode = $value["pert_kode"];
                    // $selectedNIP = $value["dosen_nip"];
                    // var_dump ($selectedNIP);
                    echo "
                    <tr>
                        <td>$nomor</td>
                        <td id='pertkode_$primaryKey'>$value[pert_kode]</td>
                        <td id='matkulkode_$primaryKey'>$value[matkul_kode]</td>
                        <td id='kelasID_$primaryKey'>$value[kelas_id]</td>
                        <td id='dosenNIP_$primaryKey'>$value[dosen_nip]</td>
                        <td id='waktuMulai_$primaryKey'>$value[waktuMulai]</td>
                        <td id='waktuAkhir_$primaryKey'>$value[waktuAkhir]</td>
                        <td id='batasWaktu_$primaryKey'>$value[batasWaktu]</td>
                        <td style='text-align:center;'>
                            <form method='POST'>
                                <button type='submit' value='$pertemuanKode' name='delete_pertemuan_action' class='btn btn-danger'>Delete</button>
                                <button onclick='initializeUpdatePertemuanModal(&#39;$primaryKey&#39;);' class='btn btn-warning' data-toggle='modal' data-target='#pertemuan_manage_modal' type='button'>
                                    Update
                                </button>
                            </form>
                            
                        </td>
                    </tr>";
                } //end of foreach
                echo "
                </table>
            </div>";
            }
            ?>
        </div>
    </div>        
</body>

<!-- Class Modal -->
<div class="modal fade" id="pertemuan_manage_modal" tabindex="-1" aria-labelledby="pertemuan_manage_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Detail Pertemuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id='PertemuanModal_bodyForm'>

                    <input type="hidden" class="form-control" id="PertemuanModal_ActionType" name="PertemuanModal_ActionType">
                    <input type="hidden" class="form-control" id="PertemuanModal_PrimaryKey" name="PertemuanModal_PrimaryKey">
                    <input type="hidden" class="form-control" id="PertemuanModal_Kode" name="PertemuanModal_Kode">

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">NIP Dosen:</label>
                        <!-- <input type="text" class="form-control" id="DosenModal_NIP" name="DosenModal_NIP"> -->
                        <select class="form-control" name="DosenModal_NIP" id="DosenModal_NIP">
                            <?php
                            foreach ($FetchedDosenList as $dosen) {
                                $pertemuan_dosenNIP = $dosen["dosen_nip"];
                                $pertemuan_dosenNama = $dosen["dosen_nama"];
                                $displayDosen = $pertemuan_dosenNIP . " - " . $pertemuan_dosenNama;

                                echo '<option value="' . $pertemuan_dosenNIP . '">' . $displayDosen . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Kode Mata Kuliah:</label>
                        <select class="form-control" id="MatkulModal_Kode" name="MatkulModal_Kode" disabled>

                        </select>

                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ID Kelas:</label>
                        <select class="form-control" id="ClassModal_ID" name="ClassModal_ID" disabled>
                            <?php
                            foreach ($AllClassList as $class) {
                                $pertemuan_classID = $class["kelas_id"];
                                $pertemuan_classNama = $class["kelas_nama"];
                                $value_to_display = $pertemuan_classID . " - " . $pertemuan_classNama;

                                echo '<option value="' . $pertemuan_classID . '">' . $value_to_display . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu Mulai:</label>
                        <input disabled type="datetime-local" class="form-control" id="PertemuanModal_StartTime" name="PertemuanModal_StartTime">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Waktu Akhir:</label>
                        <input disabled type="datetime-local" class="form-control" id="PertemuanModal_EndTime" name="PertemuanModal_EndTime">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Batas Waktu:</label>
                        <input disabled class="form-control" id="PertemuanModal_LimitTime" name="PertemuanModal_LimitTime">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button disabled onclick="submitModal();" id="PertemuanModal_submitButton" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php
include '././ui-component/dependenciesImport.php';
?>

</html>

<script>
    document.getElementById("adminButton").addEventListener("click", initializeAddPertemuanModal);

    function initializeUpdatePertemuanModal(primaryKey) {

        //get value from the table row based on selected Key
        // mengambil data dari table berdasarkan primary Key yang kita pegang
        const kodePertemuan = document.getElementById("pertkode_" + primaryKey).innerHTML;
        const kodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;
        const IDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
        const NIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
        const waktuMulaiPertemuan = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
        const waktuAkhirPertemuan = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
        const batasWaktuPertemuan = document.getElementById("batasWaktu_" + primaryKey).innerHTML;

        getUpdatedMatkulListByMengajar(NIPdosen)
        
        $("#MatkulModal_Kode").prop('disabled', false);
        $("#ClassModal_ID").prop('disabled', false);
        $("#PertemuanModal_StartTime").prop('disabled', false);
        $("#PertemuanModal_EndTime").prop('disabled', false);
        $("#PertemuanModal_LimitTime").prop('disabled', false);
        $("#PertemuanModal_submitButton").prop('disabled', false);

        // get timezone offset
        var tzoffset = (new Date()).getTimezoneOffset() * 60000;

        // //set the input value in the modal
        // memasukkan data kedalam modal
        document.getElementById("PertemuanModal_ActionType").value = "Update";
        document.getElementById("PertemuanModal_PrimaryKey").value = primaryKey;
        document.getElementById("PertemuanModal_Kode").value = kodePertemuan;
        document.getElementById("MatkulModal_Kode").value = kodeKelas;
        document.getElementById("ClassModal_ID").value = IDKelas;
        document.getElementById("DosenModal_NIP").value = NIPdosen;
        document.getElementById("PertemuanModal_StartTime").value = new Date(new Date(waktuMulaiPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_EndTime").value = new Date(new Date(waktuAkhirPertemuan) - tzoffset).toISOString().slice(0, 16);
        document.getElementById("PertemuanModal_LimitTime").value = batasWaktuPertemuan;
    }

    function initializeAddPertemuanModal() {

        // to disable all input when open the modal
        $("#MatkulModal_Kode").prop('disabled', true);
        $("#ClassModal_ID").prop('disabled', true);
        $("#PertemuanModal_StartTime").prop('disabled', true);
        $("#PertemuanModal_EndTime").prop('disabled', true);
        $("#PertemuanModal_LimitTime").prop('disabled', true);
        $("#PertemuanModal_submitButton").prop('disabled', true);
        cleanModalInput()
        document.getElementById("PertemuanModal_ActionType").value = "Add";

        $('#pertemuan_manage_modal').modal('toggle')
        // //set all the field to empty, because it is a frehs new modal
    }

    function getMatkulListByMengajar(NIPDosen) {

        //HTTP Request to API
        $.ajax({
            contentType: 'application/json',
            data: JSON.stringify({
                "selectedDosenNIP": NIPDosen
            }),
            dataType: 'json',
            success: function(data) {
                console.log("device control succeeded");
                // console.log(data);   

                var select = document.getElementById('MatkulModal_Kode');
                select.innerHTML = '';

                for (var i = 0; i < data.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = data[i].matkul_kode;
                    opt.innerHTML = data[i].matkul_kode;
                    select.appendChild(opt);
                }

                $("#MatkulModal_Kode").prop('disabled', false);
                $("#ClassModal_ID").prop('disabled', false);
                $("#PertemuanModal_StartTime").prop('disabled', false);
                $("#PertemuanModal_EndTime").prop('disabled', false);
                $("#PertemuanModal_LimitTime").prop('disabled', false);
                $("#PertemuanModal_submitButton").prop('disabled', false);
                document.getElementById("MatkulModal_Kode").value = "";
                document.getElementById("ClassModal_ID").value = "";
                document.getElementById("PertemuanModal_StartTime").value = "";
                document.getElementById("PertemuanModal_EndTime").value = "";
                document.getElementById("PertemuanModal_LimitTime").value = "";
            },
            error: function(data) {
                console.log("Device control failed");
                console.log(data);

                $("#MatkulModal_Kode").prop('disabled', true);
                $("#ClassModal_ID").prop('disabled', true);
                $("#PertemuanModal_StartTime").prop('disabled', true);
                $("#PertemuanModal_EndTime").prop('disabled', true);
                $("#PertemuanModal_LimitTime").prop('disabled', true);
                $("#PertemuanModal_submitButton").prop('disabled', true);
                cleanModalInput()
                // TODO: add izitoast or whatever to tell the user something wrong 
                // might be data empty or connection error or API URL error 
                // (change from local server to live server or to ngrok tunneling)
            },
            processData: false,
            type: 'POST',
            //TODO: tukar URL kalau tukar HTTP (ngrok or anything that could lead to change of the base URL)
            url: 'http://localhost/GitHub/sistemAbsensi/db-component/admin-GetMatkulByMengajarAPI.php'
        });

    }

    function getUpdatedMatkulListByMengajar(NIPDosen) {

        //HTTP Request to API
        $.ajax({
            contentType: 'application/json',
            data: JSON.stringify({
                "selectedDosenNIP": NIPDosen
            }),
            dataType: 'json',
            success: function(data) {
                console.log("device control succeeded");
                // console.log(data);

                var select = document.getElementById('MatkulModal_Kode');
                select.innerHTML = '';

                for (var i = 0; i < data.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = data[i].matkul_kode;
                    opt.innerHTML = data[i].matkul_kode;
                    select.appendChild(opt);
                }
            },
            error: function(data) {
                console.log("Device control failed");
                console.log(data);

                $("#MatkulModal_Kode").prop('disabled', true);
                $("#ClassModal_ID").prop('disabled', true);
                $("#PertemuanModal_StartTime").prop('disabled', true);
                $("#PertemuanModal_EndTime").prop('disabled', true);
                $("#PertemuanModal_LimitTime").prop('disabled', true);
                $("#PertemuanModal_submitButton").prop('disabled', true);
                cleanModalInput()
                // TODO: add izitoast or whatever to tell the user something wrong 
                // might be data empty or connection error or API URL error 
                // (change from local server to live server or to ngrok tunneling)
            },
            processData: false,
            type: 'POST',
            //TODO: tukar URL kalau tukar HTTP (ngrok or anything that could lead to change of the base URL)
            url: 'http://localhost/GitHub/sistemAbsensi/db-component/admin-GetMatkulByMengajarAPI.php'
        });

    }

    function cleanModalInput() {
        document.getElementById("PertemuanModal_PrimaryKey").value = "";
        document.getElementById("PertemuanModal_Kode").value = "";
        document.getElementById("MatkulModal_Kode").value = "";
        document.getElementById("ClassModal_ID").value = "";
        document.getElementById("DosenModal_NIP").value = "";
        document.getElementById("PertemuanModal_StartTime").value = "";
        document.getElementById("PertemuanModal_EndTime").value = "";
        document.getElementById("PertemuanModal_LimitTime").value = "";
    }

    $(document).ready(function() {
        $('#DosenModal_NIP').on('change', function() {
            getMatkulListByMengajar(this.value)
        });
    });

    function submitModal() {
        const modalType = document.getElementById("PertemuanModal_ActionType").value;
        const newKodePertemuan = document.getElementById("PertemuanModal_Kode").value;
        const newKodeKelas = document.getElementById("MatkulModal_Kode").value;
        const newIDKelas = document.getElementById("ClassModal_ID").value;
        const newNIPdosen = document.getElementById("DosenModal_NIP").value;
        const newWaktuMulai = document.getElementById("PertemuanModal_StartTime").value;
        const newWaktuAkhir = document.getElementById("PertemuanModal_EndTime").value;
        const newBatasWaktu = document.getElementById("PertemuanModal_LimitTime").value;
        console.log(modalType)
        console.log(newKodeKelas)
        console.log(newIDKelas)
        console.log(newNIPdosen)
        console.log(newWaktuMulai)
        console.log(newWaktuAkhir)
        console.log(newBatasWaktu)

        if (modalType == "Add") {

            if (newKodeKelas == "" || newIDKelas == "" || newNIPdosen == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                window.alert("Fill up the field!")
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }

        } else if (modalType == "Update") {

            // dapatin primary key
            const primaryKey = document.getElementById("PertemuanModal_PrimaryKey").value;

            // // pakai innetHTML karena dia dialam table, didalam html tag, di select berdasarkan primary key
            const oldKodePertemuan = document.getElementById("pertkode_" + primaryKey).innerHTML;
            const oldKodeKelas = document.getElementById("matkulkode_" + primaryKey).innerHTML;
            const oldIDKelas = document.getElementById("kelasID_" + primaryKey).innerHTML;
            const oldNIPdosen = document.getElementById("dosenNIP_" + primaryKey).innerHTML;
            const oldWaktuMulai = document.getElementById("waktuMulai_" + primaryKey).innerHTML;
            const oldWaktuAkhir = document.getElementById("waktuAkhir_" + primaryKey).innerHTML;
            const oldBatasWaktu = document.getElementById("batasWaktu_" + primaryKey).innerHTML;

            if (oldKodePertemuan == newKodePertemuan && oldKodeKelas == newKodeKelas && oldIDKelas == newIDKelas && oldNIPdosen == newNIPdosen && oldWaktuMulai == newWaktuMulai && oldWaktuAkhir == newWaktuAkhir && oldBatasWaktu == newBatasWaktu ||
                newKodePertemuan == "" || newKodeKelas == "" || newIDKelas == "" || newNIPdosen == "" || newWaktuMulai == "" || newWaktuAkhir == "" || newBatasWaktu == "") {
                window.alert("nothing changed, nothing to submit")
            } else {
                document.getElementById("PertemuanModal_bodyForm").submit();
            }

        }
    }
</script>
<script>

</script>
<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>

<style>
    body {
        background-color: #f5f5f5;
    }

    .adminActions {
        position: fixed;
        bottom: 45px;
        right: 55px;
        z-index: 10;
    }

    .adminButton {
        background-color: rgba(67, 83, 143);
        border-radius: 50%;
        display: block;
        color: #fff;
        text-align: center;
        position: relative;
        text-decoration: none;
        padding: 25px 30px;
    }

    .adminButton i {
        font-size: 22px;
    }

    .adminToggle {
        -webkit-appearance: none;
        position: absolute;
        border-radius: 50%;
        top: 0;
        left: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background-color: transparent;
        border: none;
        outline: none;
        z-index: 2;
        transition: box-shadow 0.2s ease-in-out;
        box-shadow: 0 3px 5px 1px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:hover {
        box-shadow: 0 3px 6px 2px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:checked~.adminButtons a {
        opacity: 1;
        visibility: visible;
    }
</style>