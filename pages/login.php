<?php
include __DIR__ . '/../db.php';

$loginError = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    
    $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['owner'] = $user['owner'];
        header("Location: /home");
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            html, body {
                height: 100%;
            }
            .page-wrapper {
                min-height: 100%;
                position: relative;
                padding-bottom: 60px; /* height of the footer */
            }
            footer.footer {
                height: 60px;
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
    <body class="bg-light">

        <div class="page-wrapper d-flex flex-column justify-content-center align-items-center">
            <div class="container my-auto">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                        <div class="card shadow-sm">
                            <div class="card-body p-4">
                                <h2 class="text-center mb-4">Login</h2>

                                <?php if ($loginError): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $loginError; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form action="/login" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 mt-2">Login</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="/forgot-password" class="text-decoration-none">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include __DIR__ . '/../components/footer.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>