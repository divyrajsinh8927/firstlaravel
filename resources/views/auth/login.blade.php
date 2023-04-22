<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('admin/assets/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/login_signup.css') }}">
</head>

<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('media/signin-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ url('register') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="your_email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required />
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Your Password"
                                    required />
                            </div>
                            <div class="form-group">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red;" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <input type="checkbox" name="remember" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                    me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit"
                                    value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="{{ route('phone.login') }}"><i class="display-flex-center zmdi zmdi-phone" style="background-color: rgb(62, 62, 62)"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- JS -->
        <script src="{{ asset('admin/assets/js/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/main.js') }}"></script>
        <script type="module">
            // Import the functions you need from the SDKs you need
            import { initializeApp } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
            import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-analytics.js";
            // TODO: Add SDKs for Firebase products that you want to use
            // https://firebase.google.com/docs/web/setup#available-libraries

            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            const firebaseConfig = {
              apiKey: "AIzaSyD-diidBNa6h64kY9GBfC9S9Ucf0ups4Hc",
              authDomain: "fashon-4dcea.firebaseapp.com",
              projectId: "fashon-4dcea",
              storageBucket: "fashon-4dcea.appspot.com",
              messagingSenderId: "94436826526",
              appId: "1:94436826526:web:ae2f44e2513d68e9530a8f",
              measurementId: "G-9LPMV1S7WS"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);
          </script>
        <script type="text/javascript">
            window.onload = function() {
                render();
            };

            function render() {
                window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
                recaptchaVerifier.render();
            }

            function sendOTP() {
                var number = $("#number").val();
                firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    console.log(coderesult);
                    $("#successAuth").text("Message sent");
                    $("#successAuth").show();
                }).catch(function(error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });
            }

            function verify() {
                var code = $("#verification").val();
                coderesult.confirm(code).then(function(result) {
                    var user = result.user;


                }).catch(function(error) {
                    $("#error").text(error.message);
                    $("#error").show();
                });
            }
        </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
