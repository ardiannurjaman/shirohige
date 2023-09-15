<?php
include 'header.php';
include 'koneksi/koneksi.php';
if ($_SESSION['hak_akses'] != 'admin') {
    echo "
    <script>
        alert('Tidak Memiliki Akses, DILARANG MASUK!');
        document.location.href='index.php';
    </script>
    ";
}
if (isset($_POST['simpan'])) {
    $id_negara = htmlspecialchars($_POST['id_negara']);
    $nama_negara = htmlspecialchars($_POST['nama_negara']);
    $tgl_update = date('Y-m-d');
    $user_update = htmlspecialchars($_POST['user_update']);
    $id_user = htmlspecialchars($_POST['id_user']);
    $query = "UPDATE kewarganegaraan SET
            id_negara='$id_negara',
            nama_negara='$nama_negara',
            tgl_update='$tgl_update',
            user_update='$user_update',
            id_user='$id_user'
            WHERE id_negara='$id_negara'
            ";
    // var_dump($query);
    // exit();
    mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        echo "
            <script>
                alert('Data Negara Berhasil DiUpdate');
                document.location.href='kewarganegaraan.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data Negara Gagal Update');
                document.location.href='kewarganegaraan.php';
            </script>
            ";
    }
}

$data = mysqli_query($conn, "SELECT *
FROM kewarganegaraan
LEFT JOIN user
ON kewarganegaraan.id_user = user.id_user WHERE id_negara='" . $_GET['id_negara'] . "'");
$edit = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Edit negara - Webskolah</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="sb-nav-fixed">
            <div id="layoutSidenav_content">
                <!-- Start Body Content -->
                <main>
                    <!-- Body Content -->
                    <div class="container mt-5">
                        <h3 class="text-secondary display-6">Form Edit Negara</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form Edit Negara</li>
                            </ol>
                        </nav>
                        <div class="card">
                            <div class="card-body">
                                <h4>Edit Negara</h4>
                                <hr>
                                
                                <form action="" method="POST">
                                    <input type="hidden" name="id_Negara" id="id_negara" value="<?= $edit['id_negara']; ?>">
                                    <div class="row">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="id_negara" class="form-control" id="id_negara" value="<?= $edit['id_negara'] ?>">
                                            <label class="mx-2" for="username">ID Negara</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nama_negara" class="form-control" id="nama_negara" value="<?= $edit['nama_negara'] ?>">
                                            <label class="mx-2" for="nm">Nama Negara</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" name="user_update" class="form-control" id="floatingInput" value="<?= $edit['user_update'] ?>">
                                            <label class="mx-2" for="floatingInput">User update</label>
                                        </div>
                                        <div>
                                        <select class="form-control" name="id_user" id="id_user">
                                    <option value="<?= $edit['id_user'] ?>"><?= $edit['hak_akses'] ?> (<?= $edit['nama'] ?>)</option>
                                    <?php
                                    $sql = mysqli_query($conn, "SELECT * FROM user WHERE hak_akses = '$status' AND id_user='$_SESSION[id_user];'");
                                    while ($data = mysqli_fetch_assoc($sql)) {
                                    ?>
                                        <option value="<?= $data['id_user'] ?>"><?= $data['hak_akses'] ?> (<?= $data['nama'] ?>)</option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                        </div>
                                        <br>
                                        <div class="col-6">
                                            <input class="btn btn-success btn-block w-100" type="submit" name="simpan" value="Simpan">
                                        </div>
                                        <div class="col-6">
                                            <input class="btn btn-danger btn-block w-100" type="reset">
                                        </div>   
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- End Body Content -->
            <?php include 'footer.php'; ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        
    </body>
</html>