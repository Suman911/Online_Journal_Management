<?php
$showAlert = "false";
$emailError = false;
$phoneError = false;
$passwordError = false;
$uname = "";
$email = "";
$phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('./loginsystem/connt_db.php');
    $uname = $_POST["uname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = "SELECT * FROM `userinfo` WHERE `address` = '$email'";
    $result = mysqli_query($conn, $existSql);
    $emailExistRows = mysqli_num_rows($result);
    $existSql = "SELECT * FROM `userinfo` WHERE `phn` = '$phone'";
    $result = mysqli_query($conn, $existSql);
    $phoneExistRows = mysqli_num_rows($result);
    if ($emailExistRows > 0) {
        $emailError = "Email Already Registered";
        if ($phoneExistRows > 0) {
            $phoneError = "Number Already Registered";
        }
        if ($password != $cpassword) {
            $passwordError = "Passwords do not match";
        }
    } elseif ($phoneExistRows > 0) {
        $phoneError = "Number Already Registered";
        if ($password != $cpassword) {
            $passwordError = "Passwords do not match";
        }
    } else {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userinfo` ( `name`, `address`, `phn`, `password`, `date`) VALUES ('$uname', '$email', '$phone', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sql = "Select * from `userinfo` where address='$email'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);

                include('./loginsystem/start_session.php');

                header("location: home.php");
            } else {
                $showAlert = "Registration Error!";
            }
        } else {
            $passwordError = "Passwords do not match";
        }
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
    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/login.css" rel="stylesheet">
    <link href="../style/top_footer.css" rel="stylesheet">
</head>

<body>

    <?php
    if (true)
        echo
            '<div id="registration_failed" class="overlay">
                <div class="popup">
                    <h2>' . $showAlert . '</h2>
                    <a class="close" href="#login_form">&times;</a>
                    <div class="content">
                        There are some error! please enter your information correctly, use valid email and phone number. Please try again.
                    </div>
                </div>
            </div>';
    ?>

    <?php require_once('./page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "login";
        require_once('./page_sections/nav.php');
        ?>

    </nav>

    <main>
        <div id="login">
            <div class="padding20_top_bottm section-title">
                <h3>Register</h3>
            </div>
            <form id="login_form" method="post">
                <div class="login_inputs padding20_top_bottm">
                    <b><label for="uname">Name:</label></b>
                    <input type="text" id="uname" placeholder="Enter Name" value=<?php echo '"' . $uname . '"' ?>
                        name="uname" required="">
                </div>

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
                    <b><label for="phone">Phone Number:</label></b>
                    <?php
                    if ($phoneError)
                        echo '<span class="error_msg">' . $phoneError . '</span>';
                    ?>
                    <input type="tel" id="phone" name="phone" placeholder="Enter Phone number" minlength="1" value=<?php echo '"' . $phone . '"' ?> required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <b> <label for="password">Choose Password:</label></b>
                    <?php
                    if ($passwordError)
                        echo '<span class="error_msg">' . $passwordError . '</span>';
                    ?>
                    <input type="password" id="password" placeholder="Enter password" name="password" minlength="1"
                        required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <b> <label for="cpassword">Enter Password Again:</label></b>
                    <?php
                    if ($passwordError)
                        echo '<span class="error_msg">' . $passwordError . '</span>';
                    ?>
                    <input type="password" id="cpassword" placeholder="Enter password Again" name="cpassword"
                        minlength="1" required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <button class="btn" type="submit">Register</button>
                </div>

                <div class="txt_center">
                    <p class="padding20_top_bottm"> Are you already register Please <a href="login.php"> Login Hare </a>
                    </p>
                </div>
            </form>
        </div>
    </main>

    <?php require_once('./page_sections/footer.php') ?>

</body>

</html>