<?php include "header.php "; 

include "koneksi/koneksi.php";
if ($_SESSION['hak_akses'] != 'admin') {
    echo "
    <script>
        alert('Tidak Memiliki Akses, DILARANG MASUK!');
        document.location.href='index.php';
    </script>
    ";
}

if (isset($_POST['regis'])) {
    $id_jurusan = htmlspecialchars($_POST['id_jurusan']);
    $nama_jurusan = htmlspecialchars($_POST['nama_jurusan']);
    $id_jenjang = htmlspecialchars($_POST['id_jenjang']);
    $tgl_input = htmlspecialchars($_POST['tgl_input']);
    $user_input = htmlspecialchars($_POST['user_input']);
    $id_user = htmlspecialchars($_POST['id_user']);
    
  //cek id agama
  $result = mysqli_query($conn, "SELECT id_jurusan FROM jurusan WHERE id_jurusan = '$id_jurusan'");
  if (mysqli_fetch_assoc($result)) {
      echo "
      <script>
          alert('Username sudah terdaftar, silahkan ganti!!');
          document.location.href='form_jurusan.php';
          </script>";
      return false;
  }


  //simpan data ke database
  mysqli_query($conn, "INSERT INTO jurusan VALUES('$id_jurusan','$nama_jurusan','$id_jenjang','$tgl_input','$user_input','','','$id_user')");
  
  if (mysqli_affected_rows($conn) > 0) {
    echo "
    <script>
        alert('Data Jurusan Berhasil dibuat');
        document.location.href='jurusan.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data Jurusan Gagal dibuat');
        document.location.href='form_jurusan.php';
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Jurusan</h3></div>
                                    <div class="card-body">
                                        <form class ="" method = "POST">
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="id_jurusan" name="id_jurusan" type="text" placeholder="ID agama" />
                                                <label for="id_jurusan">ID Jurusan</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="nama_jurusan" name ="nama_jurusan" type="text" placeholder="Nama agama" />
                                                        <label for="nama_jurusan">Nama Jurusan</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                    <select class="form-select" name="id_jenjang" id="id_jenjang" aria-label="Default select example">
                                                        <option selected hidden disabled>Jenjang</option>
                                                         <?php
                                                         

                                                            $sql = mysqli_query($conn, "SELECT * FROM jenjang");
                                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                            ?>
                                                                <option value="<?= $data['id_jenjang'] ?>"><?= $data['nama_jenjang'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                    </select>
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
