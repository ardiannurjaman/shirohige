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

    if (isset($_POST['regis'])) {
        $id_negara = htmlspecialchars($_POST['id_negara']);
        $nama_negara = htmlspecialchars($_POST['nama_negara']);
        $tgl_input = htmlspecialchars($_POST['tgl_input']);
        $user_input = htmlspecialchars($_POST['user_input']);
        $id_user = htmlspecialchars($_POST['id_user']);
    
        //cek id sudah terdaftar belum
        $result = mysqli_query($conn, "SELECT id_negara FROM Kewarganegaraan WHERE id_negara = '$id_negara'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('ID sudah terdaftar, silahkan ganti!');
                document.location.href='Kewarganegaraan.php';
            </script>
            ";
            return false;
        }
    
        mysqli_query($conn, "INSERT INTO Kewarganegaraan VALUES('$id_negara','$nama_negara','$tgl_input','$user_input','','','$id_user')");
    
        // var_dump($cek);
        // exit();
    
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Data Negara Berhasil dibuat');
                document.location.href='Kewarganegaraan.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Negara Gagal dibuat');
                document.location.href='form_negara.php';
            </script>
            ";
        }
    }
?>
        <!-- <div id="layoutAuthentication"> -->
            <!-- <div id="layoutAuthentication_content"> -->


            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Kewarganegaraan</h3></div>
                                    <div class="card-body">
                                        <form class ="" method = "POST">
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="id_negara" name="id_negara" type="text" placeholder="ID agama" />
                                                <label for="id_negara">ID negara</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="nama_negara" name ="nama_negara" type="text" placeholder="Nama agama" />
                                                        <label for="nama_negara">Nama negara</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="tgl_input" name="tgl_input" type="date" placeholder="tanggal" />
                                                <label for="tgl_input">Tanggal input</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="user_input" name="user_input" type="text" placeholder="input user" />
                                                <label for="user_input">user input</label>
                                            </div>
                                            <div class="mb-3">
                                                    <select class="form-select" name="id_user" id="id_user" aria-label="Default select example">
                                                        <option selected hidden disabled>-- Hak Akses --</option>
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
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <button type="submit" name="regis" class="btn btn-success btn-block w-100">Register</button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="reset" class="btn btn-danger btn-block w-100">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                     
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <!-- </div> -->
        <!-- </div> -->
    
<?php include 'footer.php';?>
