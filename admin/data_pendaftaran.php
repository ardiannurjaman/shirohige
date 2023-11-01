<?php
include 'header.php';
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pendaftaran</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Pendaftaran</li>
                        </ol>
                        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
                        <div class="text-muted font-12 m-b-30 mb-2">
                            <a href="pendaftaran.php" type="button" class="btn btn-round btn-success ml-2"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pendaftaran Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                   
                                    
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama siswa</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'koneksi/koneksi.php';
                                    $no = 1;
                                    if ($status == 'admin') {
                                        $query = "SELECT pendaftaran.nis,pendaftaran.nama_siswa,pendaftaran.alamat,pendaftaran.jenis_kelamin,pendaftaran.tempat_lahir,pendaftaran.tgl_lahir,pendaftaran.status,kewarganegaraan.id_negara,kewarganegaraan.nama_negara,agama.id_agama,agama.nama_agama,jurusan.id_jurusan, CONCAT(jenjang.nama_jenjang,' ',jurusan.nama_jurusan) as kelas, pendaftaran.tgl_input,pendaftaran.user_input,pendaftaran.tgl_update,pendaftaran.user_update,CONCAT(user.hak_akses,' (',user.nama,')') as akses FROM pendaftaran INNER JOIN kewarganegaraan ON pendaftaran.id_negara = kewarganegaraan.id_negara JOIN user ON pendaftaran.id_user = user.id_user JOIN agama ON pendaftaran.id_agama = agama.id_agama JOIN jurusan ON pendaftaran.id_jurusan = jurusan.id_jurusan JOIN jenjang ON jurusan.id_jenjang = jenjang.id_jenjang";
                                    } else {
                                        $query = "SELECT pendaftaran.nis,pendaftaran.nama_siswa,pendaftaran.alamat,pendaftaran.jenis_kelamin,pendaftaran.tempat_lahir,pendaftaran.tgl_lahir,pendaftaran.status,kewarganegaraan.id_negara,kewarganegaraan.nama_negara,agama.id_agama,agama.nama_agama,jurusan.id_jurusan, CONCAT(jenjang.nama_jenjang,' ',jurusan.nama_jurusan) as kelas, pendaftaran.tgl_input,pendaftaran.user_input,pendaftaran.tgl_update,pendaftaran.user_update,CONCAT(user.hak_akses,' (',user.nama,')') as akses FROM pendaftaran INNER JOIN kewarganegaraan ON pendaftaran.id_negara = kewarganegaraan.id_negara JOIN user ON pendaftaran.id_user = user.id_user JOIN agama ON pendaftaran.id_agama = agama.id_agama JOIN jurusan ON pendaftaran.id_jurusan = jurusan.id_jurusan JOIN jenjang ON jurusan.id_jenjang = jenjang.id_jenjang WHERE user.hak_akses = '$status' AND user.id_user='$_SESSION[id_user];'";
                                    }
                                      // var_dump($query);
                                        // exit;
                                    $sql = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nis']; ?></td>
                                        <td><?= $row['nama_siswa']; ?></td>
                                        <td><?= $row['kelas']; ?></td>
                                        <td><?= $row['alamat']; ?></td>
                                        <td><?= $row['jenis_kelamin']; ?></td>
                                        <td><a data-bs-toggle="modal" data-bs-target="#detailDaftar" data-id="<?= $data['nis']; ?>" type="submit" class="btn btn-success btn-sm Detail_Pendaftaran">view</a></td>
                                        <td><a class="btn btn-warning btn-sm" type="button" href="edit_negara.php?id_negara=<?= $data['id_negara']; ?>"><i class="fa-solid fa-pen-to-square"></i></a><br>
                                        </td>
                                        <td align="center"><a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus_pendaftaran.php?nis=<?= $data['nis']; ?>"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                <?php
                                    }
                                ?>

                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                 <!-- Modal -->
<div class="modal fade" id="detailDaftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="#" method="post">
                        <div class="form-group row">
                            <label for="nis" class="col-md-2 col-form-label col-form-label-sm">NIS</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="nis" id="nis" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_siswa" class="col-md-2 col-form-label col-form-label-sm">Nama Siswa</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="nama_siswa" id="nama_siswa" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-form-label col-form-label-sm">Alamat</label>
                            <div class="col-md-9 mb-2">
                                <textarea type="text" class="form-control form-control-sm" name="alamat" id="alamat" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-md-2 col-form-label col-form-label-sm">Jenis Kelamin</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="jenis_kelamin" id="jenis_kelamin" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-md-2 col-form-label col-form-label-sm">Tempat Lahir</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tempat_lahir" id="tempat_lahir" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-md-2 col-form-label col-form-label-sm">Tanggal Lahir</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tgl_lahir" id="tgl_lahir" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label col-form-label-sm">Agama</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="agama" id="agama" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label col-form-label-sm">Status</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="status" id="status" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_negara" class="col-md-2 col-form-label col-form-label-sm">Nama Negara</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="nama_negara" id="nama_negara" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kelas" class="col-md-2 col-form-label col-form-label-sm">Kelas</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="kelas" id="kelas" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_input" class="col-md-2 col-form-label col-form-label-sm">Tanggal Input</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tgl_input" id="tgl_input" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_input" class="col-md-2 col-form-label col-form-label-sm">User Input</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="user_input" id="user_input" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_update" class="col-md-2 col-form-label col-form-label-sm">Tanggal Update</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="tgl_update" id="tgl_update" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_update" class="col-md-2 col-form-label col-form-label-sm">Tanggal Update</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="user_update" id="user_update" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="akses" class="col-md-2 col-form-label col-form-label-sm">Akses</label>
                            <div class="col-md-9 mb-2">
                                <input type="text" class="form-control form-control-sm" name="akses" id="akses" readonly>
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!-- ----- -->
        <script>
    $(function() {
        // $('.tambahKelas').on('click', function() {
        //     $('#judulKelas').html('Tambah Data Kelas');
        //     $('.modal-footer button[type=submit]').html('Simpan');
        //     $('#jenjang').val("--Pilih Jenjang--");
        //     $('#jurusan').val("--Pilih Jurusan--");
        //     $('#jmlh').val("");
        //     $('#nis').val("");
        // });

        $('.Detai_Pendaftaran').on('click', function() {
            // $('#judulKelas').html('Edit Data Kelas');
            // $('.modal-footer button[type=submit]').html('Edit');
            // $('.modal-body form').attr('action', 'edit_kelas.php');
            const nis = $(this).data('id');
            // console.log(id);

            $.ajax({
                url: 'proses_detail.php',
                data: {
                    id: nis
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    $('#nis').val(data.nis);
                    $('#nama_siswa').val(data.nama_siswa);
                    $('#alamat').val(data.alamat);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').val(data.tgl_lahir);
                    $('#agama').val(data.nama_agama);
                    $('#status').val(data.status);
                    $('#nama_negara').val(data.nama_negara);
                    $('#kelas').val(data.kelas);
                    $('#tgl_input').val(data.tgl_input);
                    $('#user_input').val(data.user_input);
                    $('#tgl_update').val(data.tgl_update);
                    $('#user_update').val(data.user_update);
                    $('#akses').val(data.akses);

                }
            });
        });

    });
</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
