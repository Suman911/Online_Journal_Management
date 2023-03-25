<div class="width-limit">
    <i id="nav-icon"></i>
    <ul id="nav" class="flex even_space">
        <li <?php if ($current_page == "home") {
            echo 'class="active"';
        }
        ?>><a href="./home.php">Home</a></li>

        <li <?php if ($current_page == "about") {
            echo 'class="active"';
        }
        ?>><a href="./about.php">About</a></li>

        <li <?php if ($current_page == "editorial-board") {
            echo 'class="active"';
        }
        ?>><a href="./editorial-board.php">Editorial Board</a></li>

        <li><a href="#"><span>For Authors</span></a>
            <ul>
                <li <?php if ($current_page == "") {
                    echo 'class="active"';
                }
                ?>><a href="./legality-of-manuscript-submission.php"> Legality of Manuscript submission </a></li>

                <li <?php if ($current_page == "") {
                    echo 'class="active"';
                }
                ?>><a href="./online-paper-submission.php">
                        Online paper submission </a></li>

                <li <?php if ($current_page == "") {
                    echo 'class="active"';
                }
                ?>><a href="./preparation-of-manuscript-for-submission.php"> Preparation of manuscript for submission
                    </a></li>

                <li <?php if ($current_page == "") {
                    echo 'class="active"';
                }
                ?>><a href="./publication-fee.php">
                        Publication Fee </a></li>
            </ul>
        </li>

        <li <?php if ($current_page == "submit-paper") {
            echo 'class="active"';
        }
        ?>><a href="./submit-paper.php"> Submit
                Paper </a></li>

        <li <?php if ($current_page == "previous-issue") {
            echo 'class="active"';
        }
        ?>><a href="./previous-issue.php">
                Previous Issue </a></li>

        <li><a href="./home.php#our-contact"> Contact </a></li>

        <?php
        session_start();

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if ($_SESSION['start'] > $_SESSION['end'] + 0.5) {
                header("location: logout.php");
            } else {
                $_SESSION['start'] = time();
            }
            if ($current_page == "profile")
                echo '<li class="active"><a href="./profile.php">' . $_SESSION['uname'] . '</a></li>';
            else
                echo '<li><a href="./profile.php"> Profile </a></li>';
        } else {
            if ($current_page == "login")
                echo '<li class="active"><a href="./login.php"> Login / Register </a></li>';
            else
                echo '<li><a href="./login.php"> Login / Register </a></li>';
        }
        ?>
    </ul>
</div>