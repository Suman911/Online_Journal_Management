<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IJIRD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/submit-paper.css" rel="stylesheet">
    <link href="../style/top_footer.css" rel="stylesheet">
</head>

<body>

    <?php require_once('page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "submit-paper";
        require_once('page_sections/nav.php')
            ?>

    </nav>

    <?php

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
        header("location: login.php");
        exit();
    }

    $journal_titleExist = "";
    $file_Error = "";
    $showAlert = "";

    $manu = "";
    $journal_title = "";
    $abstracts = "";
    $key_words = "";
    $UserID = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $phone = $_SESSION['phone'];
    $address = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('./loginsystem/connt_db.php');

        $manu = $_POST["manu"];
        $journal_title = $_POST["journal_title"];
        $abstracts = $_POST["abstracts"];
        $key_words = $_POST["key_words"];
        $address = $_POST["address"];

        $target_dir = "../uploads/";
        $file_name = basename($_FILES["file"]["name"], ".pdf");
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $tem_file_location = $_FILES["file"]["tmp_name"];

        $existSql = "SELECT * FROM `journals` WHERE `journal_title` = '$journal_title'";
        $result = mysqli_query($conn, $existSql);
        $journal_titleExistRows = mysqli_num_rows($result);

        $existSql = "SELECT * FROM `journals` WHERE `file_name` = '$file_name'";
        $result = mysqli_query($conn, $existSql);
        $file_nameExistRows = mysqli_num_rows($result);

        if ($journal_titleExistRows > 0) {
            $journal_titleExist = "Journal Title Exists";
            if ($file_nameExistRows > 0) {
                $file_nameExist = "Change The Filename";
            }
        } elseif ($file_nameExistRows > 0) {
            $file_Error = "Change The Filename";
        } else {
            $sql = "INSERT INTO `journals` (`UserID`, `first_name`, `last_name`, `phone`, `address`, `manu`, `journal_title`, `abstracts`, `key_words`, `file_name`) VALUES ('$UserID', '$first_name', '$last_name', '$phone', '$address', '$manu', '$journal_title', '$abstracts', '$key_words', '$file_name');";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                if (move_uploaded_file($tem_file_location, $target_file)) {
                    $showAlert = "The file " . $file_name . " has been uploaded.";
                } else {
                    $showAlert = "Sorry, there was an error uploading your file.";
                }
                header("location: home.php");
            } else {
                $showAlert = "Server Error! Try Again";
            }
        }
    }

    ?>


    <?php
    if ($showAlert)
        echo '<div class="alart">' . $showAlert . '</div>';
    ?>

    <main>

        <section class="outer-box">
            <div id="article_info">
                <form method="post" enctype="multipart/form-data">
                    <div id="enter" class="width-limit">
                        <div class="section-title page_title">
                            <h3>SELECT THE TYPE OF ARTICLE FROM THE BELOW AND ENTER THE REQUIRED INFORMATION</h3>
                        </div>

                        <div class="put_input">
                            <h3>ARTICLE TYPE :</h3>
                            <div id="article_type" class="flex f-column">
                                <label for="radio1">
                                    <input type="radio" id="radio1" name="manu" value="Recherché paper"
                                        required="">Recherché paper
                                </label>
                                <label for="radio2">
                                    <input type="radio" id="radio2" name="manu" value="Review article"
                                        required="">Review article
                                </label>
                                <label for="radio3">
                                    <input type="radio" id="radio3" name="manu" value="Correspondence"
                                        required="">Correspondence
                                </label>
                                <label for="radio4">
                                    <input type="radio" id="radio4" name="manu" value="Discussion"
                                        required="">Discussion
                                </label>
                            </div>
                        </div>

                        <div class="put_input">
                            <div class="info">
                                <div>
                                    <h3>FULL TITLE :</h3>
                                    <?php
                                    if ($journal_titleExist)
                                        echo '<span class="error_msg">' . $journal_titleExist . '</span>';
                                    ?>
                                    <input type="text" placeholder="Enter Journal Title" name="journal_title"
                                        value="<?php echo $journal_title ?>" required="">
                                </div>
                                <div>
                                    <h3>ABSTRACTS :</h3>
                                    <input type="text" placeholder="Enter Abstracts" name="abstracts"
                                        value="<?php echo $abstracts ?>" required="">
                                </div>
                                <div>
                                    <h3>KEYWORDS (KEYWORDS SHOULD BE SEPARATED BY SEMI COLON) :</h3>
                                    <input type="text" placeholder="Enter Keywords" name="key_words"
                                        value="<?php echo $key_words ?>" required="">
                                </div>
                            </div>
                        </div>
                        <div class="put_input">
                            <h3>AUTHOR DETAILS</h3>
                            <div class="info user">
                                <div class="flex username">
                                    <h4>Name</h4>
                                    <input type="text" placeholder="First Name" name="first_name"
                                        value="<?php echo $first_name ?>" disabled>
                                    <input type="text" placeholder="Last Name" name="last_name"
                                        value="<?php echo $last_name ?>" disabled>
                                </div>
                                <div class="flex">
                                    <h4>Telephone</h4>
                                    <input type="text" placeholder="Enter Number" name="phone"
                                        value="<?php echo $phone ?>" disabled>
                                </div>
                                <div>
                                    <h4>Address:</h4>
                                    <textarea placeholder="Enter Your Address" name="address"
                                        rows="5"><?php echo $address ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="put_input" id="UploadFile">
                        <h3>UPLOAD FILE(S)</h3>
                        <div>
                            <p>
                                PLEASE UPLOAD YOUR FILE. FOR YOUR INITIAL SUBMISSION, PLEASE UPLOAD A
                                SINGLE PDF FILE CONTAINING YOUR MANUSCRIPTS ALL FIGURES. ALL OTHER FILES
                                ARE OPTIONAL, INCLUDING A COVER LETTER.
                                PLEASE USE TO MENU TO NAVIGATE THE SUBMISSION SYSTEM WHILE SUBMITTING YOUR
                                MANUSCRIPT, USING BACK AND NEXT BUTTON COULD INFORMATION YOU HAVE ENTER.
                            </p>
                        </div>
                        <div>
                            <div id="uplod_field">
                                <?php
                                if ($file_Error)
                                    echo '<span class="error_msg">' . $file_Error . '</span>';
                                ?>
                                <label class="btn flex wrap even_space" for="file">
                                    <span>Choose a file:</span>
                                    <input type="file" id="file" name="file" accept="application/pdf">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex center">
                        <button type="submit" class="btn" id="next">NEXT</button>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <?php require_once('page_sections/footer.php') ?>

</body>

</html>