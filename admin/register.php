<?php include 'header.php';

include 'panel/koneksi/koneksi.php';
if (isset($_POST['regis'])){
    $username = strtolower(stripslashes($_POST['username']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $akses = htmlspecialchars($_POST['akses']);

    //cek username sudah terdaftar belum
    $result = mysql_query($conn, "SELECT username FROM user WHERE username ='$username'");
    if (mysql_fetch_assoc($result)){
        echo "
        <script>
        alert('username sudah terdaftar nih,ganti dong');
        document.location.href='register.php';
        </script>
        ";
        return false;
    }

    //cek konfrimasi password
    if ($password !== $password2){
        echo "
        <script>
        alert('konfirmasi password salah');
        document.location.href='register.php';
        </script>
        ";
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //simpan data ke database
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$passwrod','$nama','$email','$akses')");
    if (mysqli_affected_rows($conn)){
        echo "
        <script>
            alert('username baru berhasil dibuat nihh asikkk');
            document.location.href='register.php';
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Registasi user</h3></div>
                                    <div class="card-body">
                                        <form class ="" method = "post">
                                             <div class="form-floating mb-3">
                                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" />
                                                <label for="form3Example1cg">username</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputName" name="name" type="text" placeholder="Enter your first name" />
                                                        <label for="inputName">Name user</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="password2"  placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-select" name="akses" aria-label="Default select example">
                                                <option selected>Hak Akses</option>
                                                <option value="1">Admin</option>
                                                <option value="2">User</option>
                                                </select>
                                            </div><br>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <button type="button" name="regis" class="btn btn-success btn-block w-100">Register</button>
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
