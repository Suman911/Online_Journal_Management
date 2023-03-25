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

    <?php require_once('page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "login";
        require_once('page_sections/nav.php')
            ?>

    </nav>

    <main>
        <div id="login">
            <div class="padding20_top_bottm section-title">
                <h3>Forget Password</h3>
            </div>
            <div>
                <div>
                    <form id="login_form">
                        <div class="padding20_top_bottm">
                            <b><label for="email">Email:</label></b>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="uname"
                                required="">
                            <div id="email_valid">Valid.</div>
                            <div id="email_notvalid">Please fill out this field.</div>
                        </div>

                        <div class="padding20_top_bottm">
                            <button class="btn" type="submit">Forget Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </main>

    <?php require_once('page_sections/footer.php') ?>

</body>

</html>