<?php

// ====== All PHP variables regarding database configuration are listed down here ======
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "sistem_absensi";

// Tabel Absensi
$absensi_table = "absensi";
$absensi_id = "absensi_id";
$absensi_status = "absensi_status";
$absensi_mhs_nim = "mhs_nim";
$absensi_pert_kode = "pert_kode";

// Tabel Admin
$admin_table = "admin";
$admin_username = "admin_username";
$admin_pass = "admin_pass";


// Tabel Daftar
$daftar_table = "daftar";
$daftar_id = "daftar_id";
$daftar_matkul_kode = "matkul_kode";
$daftar_mhs_nim = "mhs_nim";


// Tabel Dosen
$dosen_table = "dosen";
$dosen_nip = "dosen_nip";
$dosen_nama = "dosen_nama";
$dosen_password = "dosen_password";
$dosen_email= "dosen_email";
$dosen_fakultas = "dosen_fakultas";
$dosen_jurusan = "dosen_jurusan";


// Tabel Mhs
$mhs_table = "mahasiswa";
$mhs_nim = "mhs_nim";
$mhs_nama = "mhs_nama";
$mhs_password = "mhs_password";
$mhs_email= "mhs_email";
$mhs_fakultas = "mhs_fakultas";
$mhs_jurusan = "mhs_jurusan";


// Tabel Matkul
$matkul_table = "mata_kuliah";
$matkul_kode = "matkul_kode";
$matkul_nama = "matkul_nama";


// Tabel Mengajar
$mengajar_table = "mengajar";
$mengajar_id = "mengajar_id";
$mengajar_matkul_kode = "matkul_kode";
$mengajar_dosen_nip = "dosen_nip";


// Tabel Pertemuan
$pert_table = "pertemuan";
$pert_kode = "pert_kode";
$pert_matkul_kode = "matkul_kode";
$pert_kelas_id = "kelas_id";
$pert_dosen_nip = "dosen_nip";
$pert_waktu_mulai = "waktuMulai";
$pert_waktu_akhir = "waktuAkhir";
$pert_batas_waktu = "batasWaktu";


// Tabel RKelas
$ruangkelas_table = "ruang_kelas";
$ruangkelas_id = "kelas_id";
$ruangkelas_nama = "kelas_nama";