<?php
$showAlert = "";
$emailError = "";
$passwordError = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('./loginsystem/connt_db.php');
    $email = $_POST["email"];
    $password = $_POST["password"];


    $sql = "Select * from `userinfo` where email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            include('./loginsystem/start_session.php');

            header("location: index.php");
        } else {
            $passwordError = "Wrong Password";
        }
    } else {
        $emailError = "Invalid Credentials";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IJIRD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/login.css" rel="stylesheet">
    <link href="style/top_footer.css" rel="stylesheet">
</head>

<body>

    <?php require_once('./page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "login";
        require_once('./page_sections/nav.php')
            ?>

    </nav>

    <?php
    if ($showAlert)
        echo '<div class="alart">' . $showAlert . '</div>';
    ?>

    <main>
        <div id="login">
            <div class="padding20_top_bottm section-title">
                <h3>Log In</h3>
            </div>
            <form id="login_form" method="post">
                <div class="login_inputs padding20_top_bottm">
                    <b><label for="email">Email:</label></b>
                    <?php
                    if ($emailError)
                        echo '<span class="error_msg">' . $emailError . '</span>';
                    ?>
                    <input type="email" id=" email" placeholder="Enter Email" value=<?php echo '"' . $email . '"' ?>
                        name="email" required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <b> <label for="password">Password:</label></b>
                    <?php
                    if ($passwordError)
                        echo '<span class="error_msg">' . $passwordError . '</span>';
                    ?>
                    <input type="password" id="password" placeholder="Enter password" name="password" minlength="1"
                        required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <button class="btn" type="submit">Log In</button>
                </div>

                <div class="txt_center">
                    <p class="padding20_top_bottm"> Forget Password <a href="forget-password.php"> click here</a>
                    </p>
                    <p class="padding20_top_bottm"> Dont have an account <a href="register.php"> Create New </a>
                    </p>
                </div>
            </form>
        </div>
    </main>

    <?php require_once('./page_sections/footer.php') ?>

</body>

</html>