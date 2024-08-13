<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IJIRD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/profile.css" rel="stylesheet">
    <link href="style/top_footer.css" rel="stylesheet">
</head>

<body>

    <?php require_once('page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "profile";
        require_once('page_sections/nav.php')
            ?>

    </nav>

    <main>
        <section>
            <div class="outer-box">
                <div id="logout_btn">
                    <a class="btn" href="logout.php">Log out</a>
                </div>
                <div class="user_details">
                    <div>
                        <?php echo 'User name '.$_SESSION['first_name'].' '.$_SESSION['last_name'] ?>
                    </div>
                    <div>
                        <?php echo 'Contact email '.$_SESSION['email'] ?>
                    </div>
                    <div>
                        <?php echo 'User phone number '.$_SESSION['phone'] ?>
                    </div>
                    <div>
                        <?php echo 'User registration date '.$_SESSION['registration_date'] ?>
                    </div>
                    <div>
                        <?php echo 'Session ends in '.round(($_SESSION['end']-$_SESSION['start'])/60.0 , 2).' min' ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php require_once('page_sections/footer.php') ?>

</body>

</html>