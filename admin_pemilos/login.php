<?php
include 'control.php';

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    header('Location:index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Login Admin</title>
</head>

<body>

    <!-- card Login -->

    <section class="">
        <div class="container px-4">
            <div class="row vh-100 d-flex justify-content-center align-content-center">
                <div class="col-md-6 ">
                    <div class=" py-4">
                        <div class="">
                            <h4 class="text-start mb-3">Login Admin</h4>
                            <p class="text-muted">Login Admin untuk memantau Pemilos</p>
                            <form action="" method="POST">
                                <?php if ($error) : ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <p><?= $error; ?></p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control border-0 py-3 bg-light" id="username" aria-describedby="username" name="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group bg-light">
                                        <input type="password" class="form-control border-0 py-3 bg-light" id="password" name="password">
                                        <span class="input-group-text border-0 bg-light" onclick="password_show_hide();">
                                            <i class="bi bi-eye  text-dark" id="show_eye"></i>
                                            <i class="bi bi-eye-slash text-dark d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                    <div class="form-text my-3">We'll never share your Password with anyone else.</div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-warning pt-2 pb-2" type="submit" name="login" value="masuk">
                                        Login Admin
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Akhir card login -->
    <script type="text/javascript">
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>