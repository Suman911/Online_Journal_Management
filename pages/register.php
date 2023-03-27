<?php
$showAlert = "false";
$emailError = false;
$phoneError = false;
$passwordError = false;
$first_name = "";
$last_name = "";
$email = "";
$phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('./loginsystem/connt_db.php');
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = "SELECT * FROM `userinfo` WHERE `email` = '$email'";
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
            $sql = "INSERT INTO `userinfo` ( `first_name`, `last_name`, `email`, `phn`, `password`, `date`) VALUES ('$first_name', '$last_name', '$email', '$phone', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $sql = "Select * from `userinfo` where email='$email'";
                $result = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);

                include('./loginsystem/start_session.php');

                header("location: home.php");
            } else {
                $showAlert = "Server Error! Try Again";
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

    <?php require_once('./page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "login";
        require_once('./page_sections/nav.php');
        ?>

    </nav>

    <?php
    if ($showAlert)
        echo '<div class="alart">' . $showAlert . '</div>';
    ?>

    <main>
        <div id="login">
            <div class="padding20_top_bottm section-title">
                <h3>Register</h3>
            </div>
            <form id="login_form" method="post">
                <div class="login_inputs padding20_top_bottm">
                    <b><label>Name:</label></b>
                    <input type="text" id="first_name" placeholder="First Name" value="<?php echo $first_name ?>"
                        name="first_name" required="">
                    <input type="text" id="last_name" placeholder="Last Name" value="<?php echo $last_name ?>"
                        name="last_name" required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <b><label for="email">Email:</label></b>
                    <?php
                    if ($emailError)
                        echo '<span class="error_msg">' . $emailError . '</span>';
                    ?>
                    <input type="email" id=" email" placeholder="Enter Email" value="<?php echo $email ?>" name="email"
                        required="">
                </div>

                <div class="login_inputs padding20_top_bottm">
                    <b><label for="phone">Phone Number:</label></b>
                    <?php
                    if ($phoneError)
                        echo '<span class="error_msg">' . $phoneError . '</span>';
                    ?>
                    <input type="tel" id="phone" name="phone" placeholder="Enter Phone number" minlength="1"
                        value="<?php echo $phone ?>" required="">
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