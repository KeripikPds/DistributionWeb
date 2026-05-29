<?php
require "Services/loginRegis.php";


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="Css/login.css" />
  </head>

  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">Login</div>
        <div class="title signup">Registrasi</div>
      </div>

      <?php if (isset($error)): ?>
          <div class="error-message">
            <p style="color:red; font-style:italic;">Email atau password salah!</p>
          </div>
        <?php endif; ?>

      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked />
          <input type="radio" name="slide" id="signup" />

          <label for="login" class="tab login">Login</label>
          <label for="signup" class="tab signup">Registrasi</label>

          <div class="slider-tab"></div>
        </div>

        <div class="form-inner">
          <form action="" method="POST" class="login">
            <div class="field">
              <input type="email" name="email" placeholder="Masukkan Email" required />
            </div>

            <div class="field">
              <input type="password" name="pass" placeholder="Masukkan Password" required />
            </div>

            <div class="pass-link">
              <a href="#">Lupa Password?</a>
            </div>

            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Login" name="Login" />
            </div>

            <div class="signup-link">Belum punya akun? <a href="#">Daftar Sekarang</a></div>
          </form>

          <form action="" method="POST" class="signup">
            <div class="field">
              <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required />
            </div>

            <div class="field">
              <input type="email" name="email" placeholder="Masukkan Email" required />
            </div>

            <div class="field">
              <input type="password" name="pass" placeholder="Masukkan Password" required />
            </div>

            <div class="field">
              <input type="password" name="confirm_pass" placeholder="Verifikasi Password" required />
            </div>

            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Registrasi" name="regis" />
            </div>

            <div class="signup-link">Saya sudah punya akun? <a href="#">Masuk Sekarang</a></div>
          </form>
        </div>
      </div>
    </div>

    <script src="JavaScript/js_login.js"></script>
  </body>
</html>


