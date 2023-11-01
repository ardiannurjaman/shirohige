<?php
include 'header.php';
include 'koneksi/koneksi.php';

if (isset($_POST['simpan'])) {
    $nis = htmlspecialchars($_POST['nis']);
    $nama_siswa = htmlspecialchars($_POST['nama_siswa']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jk = htmlspecialchars($_POST['jk']);
    $tmp_lahir = htmlspecialchars($_POST['tmp_lahir']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $status = htmlspecialchars($_POST['status']);
    $negara = htmlspecialchars($_POST['negara']);
    $agama = htmlspecialchars($_POST['agama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);
    $id_user = htmlspecialchars($_POST['id_user']);

    //cek id sudah terdaftar belum
    $result = mysqli_query($conn, "SELECT nis FROM pendaftaran WHERE nis = '$nis'");
    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('ID sudah terdaftar, silahkan ganti!');
            document.location.href='data_pendaftaran.php';
        </script>
        ";
        return false;
    }


    mysqli_query($conn, "INSERT INTO pendaftaran VALUES('$nis','$nama_siswa','$alamat','$jk','$tmp_lahir','$tgl_lahir','$status','$negara','$agama','$kelas','$tgl_input','$user_input','','','$id_user')");

    // var_dump($cek);
    // exit();

    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
            alert('Data Pendaftaran Berhasil dibuat');
            document.location.href='data_pendaftaran.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Pendaftaran Gagal dibuat');
            document.location.href='pendaftaran.php';
        </script>
        ";
    }
}
?>        <!-- <div id="layoutAuthentication"> -->
            <!-- <div id="layoutAuthentication_content"> -->


            <div id="layoutSidenav_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pendaftaran</h3></div>
                                    <div class="card-body">
                                        <form class ="" method = "POST">
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="nis" name="nis" type="number" placeholder="NIS" />
                                                <label for="form3Example1cg">NIS</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputName" name ="nama_siswa" type="text" placeholder="Enter your first name" />
                                                        <label for="inputName">Nama siswa</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                            <div>
                                                 <div class="form-floating mb-3 mb-md-0">
                                                    <textarea class="form-control" id="inputAlamat" name="alamat" rows="4" placeholder="Enter your address"></textarea>
                                                     <label for="inputAlamat">Alamat</label>
                                                 </div>
                                                </div>
                                            </div>
                                            <div class="from-outline mb-4">
                                                <label class="from-label font weight-bold" for="gender">Jenis Kelamin</label><br>
                                                <div class="col-md-6 col-sm-6 ">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="jk1" name="jk" class="custom-control-input" value="Laki-laki" checked>
                                    <label class="custom-control-label" for="jk">Laki - Laki</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="jk2" name="jk" class="custom-control-input" value="Perempuan">
                                    <label class="custom-control-label" for="jk2">Perempuan</label>
                                </div>
                            </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputName" name ="tmp_lahir" type="text" placeholder="Tempat lahir" />
                                                        <label for="inputName">Tempat lahir</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="tgl_lahir" name="tgl_lahir" type="date" placeholder="tanggal" />
                                                <label for="tgl_input">Tanggal lahir</label>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-select" name="status" aria-label="Default select example">
                                                <option selected>Status</option>
                                                <option value="admin">Pindahan</option>
                                                <option value="user">Baru</option>
                                                </select>
                                            </div><br>
                                            <div class="form-group">
                                                <select class="form-select" name="negara" aria-label="Default select example">
                                                <option selected>Negara</option>
                                                <option value="admin">Indonesia</option>
                                                <option value="user">Malaysia</option>
                                                <option value="user">Zimbabwe</option>
                                                <option value="user">kenya</option>
                                                </select>
                                            </div><br>
                                            <div class="form-group">
                                                <select class="form-select" name="agama" aria-label="Default select example">
                                                <option selected>Agama</option>
                                                <option value="admin">Islam</option>
                                                <option value="user">Kristen</option>
                                                <option value="user">budha</option>
                                                <option value="user">Hindu</option>
                                                </select>
                                            </div><br>
                                            <div class="form-group">
                                                <select class="form-select" name="kelas" aria-label="Default select example">
                                                <option selected>Kelas</option>
                                                <option value="admin">X</option>
                                                <option value="user">XI</option>
                                                <option value="user">XII</option>
                                                </select>
                                            </div><br>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="tgl_input" name="tgl_input" type="date" placeholder="tanggal" />
                                                <label for="tgl_input">Tanggal Input</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputName" name ="user_input" type="text" placeholder="Enter your first name" />
                                                        <label for="inputName">User input</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-select" name="akses" aria-label="Default select example">
                                                <option selected>Hak Akses</option>
                                                    <?php if ($_SESSION['hak_akses']=='user') :?>
                                                <option value="admin">Admin</option>
                                                    <?php endif;?>
                                                <option value="user">User</option>
                                                    <?php if ($_SESSION['hak_akses']=='admin') :?>
                                                    <?php endif;?>
                                                </select>
                                            </div><br>
                                           
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <button type="submit" name="simpan" class="btn btn-success btn-block w-100">Daftar</button>
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