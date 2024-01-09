<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo '<div class="alert">';
            echo "Login gagal! nik dan password Anda salah!";
            echo '</div>';
        } else if ($_GET['pesan'] == "logout") {
            echo '<div class="alert">';
            echo "Anda telah berhasil logout";
            echo '</div>';
        } else if ($_GET['pesan'] == "belum_login") {
            echo '<div class="alert">';
            echo "Anda harus login untuk mengakses halaman admin";
            echo '</div>';
        }
    }
?>

<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
        <form action="auth.php" method="POST">
            <div class="input-group mb-3">
                <label for="nik" class="d-block input-label-content-3-5">NIK</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="nik" name="nik" id="nik" required autocomplete="off">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <label for="password" class="d-block input-label-content-3-5">Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" id="password" placeholder="password" name="password" id="password" required autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <span class="fas fa-eye" id="toggleIcon"></span>
                    </button>
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" name="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
<script>
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePasswordButton.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        toggleIcon.classList.toggle('fa-eye');
        toggleIcon.classList.toggle('fa-eye-slash');
    });
</script>
<!-- JavaScript to handle "Remember Me" functionality -->
<<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const storedNik = localStorage.getItem('storedNik');
    const storedPassword = localStorage.getItem('storedPassword');
    const rememberCheckbox = document.getElementById('remember');
    const nikInput = document.getElementById('nik');
    const passwordInput = document.getElementById('password');

    if (rememberCheckbox.checked && storedNik && storedPassword) {
      nikInput.value = storedNik;
      passwordInput.value = storedPassword;
    }

    rememberCheckbox.addEventListener('change', function () {
      if (this.checked) {
        localStorage.setItem('storedNik', nikInput.value);
        localStorage.setItem('storedPassword', passwordInput.value);
      } else {
        localStorage.removeItem('storedNik');
        localStorage.removeItem('storedPassword');
      }
    });
  });
</script>
</body>
</html>
