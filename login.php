<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title> Login </title>
    <link rel="stylesheet" href="css/student_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <div class="cover">
        <div class="front">
            <div class="text">
                <img src="images/UniKL_Logo.png" alt="">
                <span class="text-2">Where the Knowledge is Applied</span>
            </div>
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <form action="includes/process_login.php" method="POST">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET['error'])) {
                    echo "<div class='error'>Invalid email or password</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
