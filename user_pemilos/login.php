<?php
include 'control.php';

if (isset($_SESSION['no_induk']) && isset($_SESSION['password'])) {
    header('Location:home.php');
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
    <link href="css/pemilos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Login Siswa</title>
</head>
<style>

</style>

<body>
    <!-- card Login -->

    <section>
        <div class="container px-4">
            <div class="row vh-100 d-flex justify-content-center align-content-center">

                <div class="col-md-6">
                    <i class="bi bi-pin-angle-fill fs-1 text-warning pb-4"></i>
                    <div class="border-0">
                        <div class="py-3">

                            <h2 class="text-start mb-3 fw-bold">Hey,<br>Masuk Sekarang</h2>
                            <p class="text-muted mb-5">Masukan Inisial anda untuk dapat melakukan Voting</p>
                            <form action="" method="POST">
                                <?php if ($error) : ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <p><?= $error; ?></p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="no_induk" class="form-label">No.Induk</label>
                                    <input type="number" class="form-control bg-light border-0 py-3 no-focus" placeholder="NIS" id="no_induk" aria-describedby="no_induk" name="no_induk">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group ">
                                        <input id="password" type="password" class="form-control border-0 py-3 no-focus bg-light" placeholder="Password" id="password" name="password">
                                        <span class="input-group-text border-0 bg-light" onclick="password_show_hide();">
                                            <i class="bi bi-eye  text-dark" id="show_eye"></i>
                                            <i class="bi bi-eye-slash text-dark d-none" id="hide_eye"></i>
                                        </span>
                                    </div>
                                    <div class="form-text my-3">We'll never share your Password with anyone else.</div>
                                </div>
                                <div class="d-grid gap-2 mt-5">
                                    <button class="btn btn-warning py-3 fs-6" type="submit" name="login" value="masuk">
                                        Masuk
                                    </button>
                                    <div class="form-text text-center">Masuk Sekarang</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <!-- Akhir card login -->

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>