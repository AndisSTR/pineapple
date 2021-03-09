<?php

    $hostname ="localhost";
    $db = "pineapple";
    $username = "root";
    $password = "";

    $mysqli = new mysqli($hostname,$username,$password,$db);

    if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

    if(isset($_POST['email'])) {
        $id=$_POST['id'];
        $email=$_POST['email'];

        $sql = "INSERT INTO user_emails (id, email, date_created)
        VALUES ('$id', '$email', CURRENT_TIMESTAMP)";
        mysqli_query($mysqli, $sql);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!-- Font Awesome CDN */ -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css" />
    <link rel="shortcut icon" type="image/jpg" href="assets/img/pineapple_logo.svg" />
    <title>Pineapple</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script><!-- jQuery */ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.0/vue.js"></script><!-- VueJS CDN */ -->
</head>
<body>
    <div id="pineapple" class="content">
        <div class="wrapper">
            <nav>
                <div class="nav_wrapper">
                    <div class="logo">
                        <img src="assets/img/pineapple_logo.svg" />
                        <img class="logo_text" src="assets/img/pineapple_logo_text.svg" />
                    </div>
                    <ul class="nav_items">
                        <li><a href="">About</a></li>
                        <li><a href="">How it works</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </div>
            </nav>
            <div class="newsletter">
                <div class="newsletter_wrapper">
                    <h1>Subscribe to newsletter</h1>
                    <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
                    <div class="email_form">
                        <form @submit.prevent="onSubmit" method="post">
                            <div class="input_wrapper">
                                <input type="email" v-model="form.email" id="email" name="email" placeholder="Type your email address here..." required ="true"/>
                                <img class="input_left_border" src="assets/img/input_left_border.svg" />
                                <a class="submit" type="submit" @click.prevent="submitForm" :class="{disabled: isDisabled}"></a>
                            </div>
                            <div class="message">
                                <div class="message_success">
                                    {{ success }}
                                </div>
                                <div v-if="errors.length" class="message_error">
                                    <ul>
                                        <li v-for="error in errors">{{ error }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="terms_of_service">
                                <div class="terms_wrapper">
                                    <label class="checkbox_container">
                                        I agree to <a href="#">terms of service</a>
                                        <input type="checkbox" v-model="form.terms" name="checkbox" />
                                        <span class="checkbox_mark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr />
                    <div class="icons">
                        <a class="fa fa-facebook" id="facebook_icon" href="#"></a>
                        <a class="fa fa-instagram" id="instagram_icon" href="#"></a>
                        <a class="fa fa-twitter"  id="twitter_icon" href="#"></a>
                        <a class="fa fa-youtube-play" id="youtube_icon" href="#"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>