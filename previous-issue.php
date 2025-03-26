<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IJIRD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="style/style.css" rel="stylesheet">
    <link href="style/previous-issue.css" rel="stylesheet">
    <link href="style/top_footer.css" rel="stylesheet">
</head>

<body>

    <?php require_once('page_sections/top_section.php') ?>

    <nav>

        <?php
        $current_page = "previous-issue";
        require_once('page_sections/nav.php')
            ?>

    </nav>

    <main>

        <section id="articales">
            <div class="width-limit">
                <div class="section-title">
                    <h3>Our Previous Published</h3>
                </div>
                <div class="flex center wrap">
                    <?php
                    require_once './loginsystem/connt_db.php';

                    // Get latest 8 visible publications
                    $query = "SELECT * FROM published WHERE visible = 1 ORDER BY date DESC";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $formatted_date = date('F Y', strtotime($row['date']));
                            echo '
                    <div class="prev-published">
                        <div class="prev-p-box">
                            <div class="book-image">
                                <img src="' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">
                            </div>
                            <div class="book-download">
                                <p class="flex wrap space_btwn">' . $formatted_date . '
                                    <a href="' . htmlspecialchars($row['path']) . '" download>
                                        <button class="btn">DOWNLOAD</button>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>';
                        }
                    } else {
                        echo '<p>No publications found</p>';
                    }
                    ?>
                </div>
                <div class="flex center">
                    <a href="#">
                        <button class="btn">VIEW ALL ARTICLES</button>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <?php require_once('page_sections/footer.php') ?>

</body>

</html>