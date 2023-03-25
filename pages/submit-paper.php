<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>IJIRD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="../style/style.css" rel="stylesheet">
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
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['start'] > $_SESSION['end']) {
        session_unset();
        session_destroy();

        header("location: login.php");
        exit();
    }
    ?>

    <main>

        <section id="enter">
            <div>
                <h3>SELECT THE TYPE OF ARTICLE FROM THE BELOW AND ENTER
                    THE
                    REQUIRED INFORMATION</h3>
                <h6>ARTICLE TYPE :</h6>
                <div>
                    <div>
                        <button type="button">
                            <div>
                                <label>
                                    <input type="radio"name="manu"
                                        value="Recherché paper">Recherché paper
                                </label>
                            </div>
                        </button>

                        <button type="button">
                            <div>
                                <label>
                                    <input type="radio" name="manu"
                                        value="Review article">Review article
                                </label>
                            </div>
                        </button>

                        <button type="button">
                            <div>
                                <label>
                                    <input type="radio" name="manu"
                                        value="Correspondence">Correspondence
                                </label>
                            </div>
                        </button>

                        <button type="button">
                            <div>
                                <label>
                                    <input type="radio" name="manu"
                                        value="Discussion">Discussion
                                </label>
                            </div>
                        </button>
                    </div>
                </div>
                <div>
                    <form>
                        <div>
                            <h6>FULL TITLE :</h6>
                            <input type="text">
                        </div>
                        <div>
                            <h6>ABSTRACTS :</h6>
                            <input type="text">
                        </div>
                        <div>
                            <h6>KEYWORDS (KEYWORDS SHOULD BE SEPARATED BY SEMI COLON) :</h6>
                            <input type="text">
                        </div>
                    </form>
                </div>
                <div>
                    <h3>AUTHOR DETAILS</h3>
                    <div>
                        <div>
                            <h6>Author #1</h6>
                            <div>
                                <div>
                                    <span>Person</span>
                                </div>
                                <input type="text" placeholder="First Name">
                                <input type="text" placeholder="Last Name">
                            </div>
                            <div>
                                <div>
                                    <span>Telephone</span>
                                </div>
                                <input type="text">
                            </div>
                            <div>
                                <label for="">Address:</label>
                                <textarea rows="5"></textarea>
                                </div=>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn">ADD AUTHOR</button>
                            <button type="button" class="btn">REMOVE AUTHOR</button>
                        </div>
                    </div>
                </div>
        </section>
        <section id="UploadFile">
            <div>
                <h3>UPLOAD FILE(S)</h3>
                <p>
                    PLEASE UPLOAD YOUR FILE. FOR YOUR INITIAL SUBMISSION, PLEASE UPLOAD A
                    SINGLE PDF FILE CONTAINING YOUR MANUSCRIPTS ALL FIGURES. ALL OTHER FILES
                    ARE OPTIONAL, INCLUDING A COVER LETTER.
                    PLEASE USE TO MENU TO NAVIGATE THE SUBMISSION SYSTEM WHILE SUBMITTING YOUR
                    MANUSCRIPT, USING BACK AND NEXT BUTTON COULD INFORMATION YOU HAVE ENTER.</p>
                <div>
                    <form action="">
                        <div>
                            <input type="file" name="files" multiple="multiple">
                        </div>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div>
                    <h5><span>Uploaded File(s)</span></h5>
                    <div>
                        <p>No file uploaded</p>
                    </div>
                </div>
                </divlass=>
        </section>
        <section id="Provide">
            <div>
                <span>
                    <b>
                        <h5>Provide additional information</h5>
                    </b>
                </span>
                <p>
                    <label>
                        <input type="checkbox" />
                        <span>Acknowledgement</span>
                    </label>
                </p>
            </div>
        </section>
        <section id="Review">
            <div>
                <span>
                    <b>
                        <h5>Review & submit</h5>
                    </b>
                </span>
                <h6>Article type: <span></span></h6>
                <div>
                    <form>
                        <div>
                            <h6>FULL TITLE :</h6>
                            <input type="text" disabled>
                        </div>
                        <div>
                            <h6>ABSTRACTS :</h6>
                            <input type="text" disabled>
                        </div>
                        <div>
                            <h6>KEYWORDS (KEYWORDS SHOULD BE SEPARATED BY SEMI COLON) :</h6>
                            <input type="text" disabled>
                        </div>
                    </form>
                </div>
                <h5><span>Author Details</span></h5>
                <div>
                    <div>
                        <div>
                            <h6>Author #1</h6>
                            <div>
                                <i>account_circle</i>
                                <input disabled value="" type="text">
                                <label for="">First Name</label>
                            </div>
                            <div>
                                <i>account_circle</i>
                                <input disabled value="" type="text">
                                <label for="">Last Name</label>
                            </div>
                            <div>
                                <i>phone</i>
                                <input disabled type="tel">
                                <label for="">Telephone</label>
                            </div>
                            <div>
                                <i>room</i>
                                <textarea disabled rows="5"></textarea>
                                <label for="">Address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <h5><span>Uploaded File(s)</span></h5>
                <div>
                    <p>No file uploaded</p>
                </div>
                <b>
                    <h5>Additional information</h5>
                </b>
                <p>
                    <label>
                        <input type="checkbox" checked="checked" disabled="disabled" />
                        <span>Acknowledgement</span>
                    </label>
                </p>
            </div>
        </section>

    </main>

    <?php require_once('page_sections/footer.php') ?>

</body>

</html>