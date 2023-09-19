<?php 
    include 'header.php';
    include 'koneksi/koneksi.php';

    if (isset($_POST['regis'])) {
        $id_jenjang = htmlspecialchars($_POST['id_jenjang']);
        $nama_jenjang = htmlspecialchars($_POST['nama_jenjang']);
        $tgl_input = htmlspecialchars($_POST['tgl_input']);
        $user_input = htmlspecialchars($_POST['user_input']);
        $id_user = htmlspecialchars($_POST['id_user']);
    
        //cek id sudah terdaftar belum
        $result = mysqli_query($conn, "SELECT id_jenjang FROM jenjang WHERE id_jenjang = '$id_jenjang'");
        if (mysqli_fetch_assoc($result)) {
            echo "
            <script>
                alert('ID sudah terdaftar, silahkan ganti!');
                document.location.href='jenjang.php';
            </script>
            ";
            return false;
        }
    
        mysqli_query($conn, "INSERT INTO jenjang VALUES('$id_jenjang','$nama_jenjang','$tgl_input','$user_input','','')");
    
        // var_dump($cek);
        // exit();
    
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Data Negara Berhasil dibuat');
                document.location.href='jenjang.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Negara Gagal dibuat');
                document.location.href='form_jenjang.php';
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Jenjang</h3></div>
                                    <div class="card-body">
                                        <form class ="" method = "POST">
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="id_jenjang" name="id_jenjang" type="text" placeholder="ID agama" />
                                                <label for="id_jenjang">ID Jenjang</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="nama_jenjang" name ="nama_jenjang" type="text" placeholder="Nama agama" />
                                                        <label for="nama_jenjang">Nama Jenjang</label>
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
