<?php
include 'header.php';
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data kewarganegaraan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Kewarganegaraan</li>
                        </ol>
                        <div class="text-muted font-12 m-b-30 mb-2">
                            <a href="form_negara.php" type="button" class="btn btn-round btn-success ml-2"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data</a>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data kewarganegaraan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                   
                                    
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Negara</th>
                                    <th scope="col">Tanggal input</th>
                                    <th scope="col">User input</th>
                                    <th scope="col">Tanggal update</th>
                                    <th scope="col">User update</th>
                                    <th scope="col">Akses</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    include 'koneksi/koneksi.php';
                                    $no = 1;
                                    $query = "SELECT *
                                    FROM kewarganegaraan 
                                    INNER JOIN user
                                    ON kewarganegaraan.id_user = user.id_user";
                                    $sql = mysqli_query($conn, $query);
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['nama_negara']; ?></td>
                                        <td><?= $data['tgl_input']; ?></td>
                                        <td><?= $data['user_input']; ?></td>
                                        <td><?= $data['tgl_update']; ?></td>
                                        <td><?= $data['user_update']; ?></td>
                                        <td><?= $data['hak_akses']; ?> (<?= $data['nama']; ?>)</td>
                                        <td>
                                        <a class="btn btn-warning btn-sm" type="button" href="edit_negara.php?id_negara=<?= $data['id_negara']; ?>"><i class="fa-solid fa-pen-to-square"></i></a><br>
                                        </td>
                                        <td><a class="btn btn-danger btn-sm" type="button" onclick="return confirm('Data akan di Hapus?')" href="hapus_negara.php?id_negara=<?= $data['id_negara']; ?>"><i class="fa-solid fa-trash"></i></a></td>
                                    </tr>
                                <?php
                                    }
                                ?>

                            </tbody>
                                </table>
                                <script>
                                    $(document).ready(function(){
                                        new DataTable('#example');
                                    })
                                </script>
                            </div>
                        </div>
                </main>
               <?php
               include 'footer.php';
               ?>