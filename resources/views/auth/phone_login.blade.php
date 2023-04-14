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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                        <form method="POST" class="register-form" id="login-form" action="#">
                            @csrf
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-phone"></i></label>
                                <input type="text" name="number" id="number" class="form-control"
                                    placeholder="+91 ********" required>
                                <div id="recaptcha-container"></div>
                            </div>
                            <div class="form-group" id="btnSendOtpdiv">
                                <button type="button" id="btnSendOtp" class="form-submit">Send
                                    OTP</button>
                            </div>
                            <div class="form-group" style="display: none;" id="otpdiv">
                                <label for="your_pass"><i class="zmdi zmdi-key"></i></label>
                                <input type="text" id="verification" class="form-control"
                                    placeholder="Verification code" required>
                            </div>
                            <div class="form-group form-button" style="display: none;" id="loginbtndiv">
                                <input type="button" name="signin" id="signin" class="form-submit"
                                    value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
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
        <script src="{{ asset('admin/assets/js/vendor/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="module">
            import {
                initializeApp
            } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
            import {
                getAnalytics
            } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-analytics.js";

            import { getAuth, signInWithPhoneNumber,RecaptchaVerifier  } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-auth.js";
            window.addEventListener("DOMContentLoaded", function(event) {
            const firebaseConfig = {
                apiKey: "AIzaSyD-diidBNa6h64kY9GBfC9S9Ucf0ups4Hc",
                authDomain: "fashon-4dcea.firebaseapp.com",
                projectId: "fashon-4dcea",
                storageBucket: "fashon-4dcea.appspot.com",
                messagingSenderId: "94436826526",
                appId: "1:94436826526:web:ae2f44e2513d68e9530a8f",
                measurementId: "G-9LPMV1S7WS"
            };

            const app = initializeApp(firebaseConfig);
            const analytics = getAnalytics(app);

            window.addEventListener("load", (event) => {
                render();
            });


            function render()
            {
                const auth = getAuth();
                window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
                    'size': 'invisible',
                    'callback': (response) => {
                },
                }, auth);

                recaptchaVerifier.render().then((widgetId) => {
                     window.recaptchaWidgetId = widgetId;
                });
            }
            $(document).on('click', '#btnSendOtp', function() {
                var number = document.getElementById('number').value
                $.ajax({
                    type: 'POST',
                    method: 'POST',
                    url: "{{ route('phone.verify') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        number: number,
                    },
                    success: function(data) {
                        if (data == true) {
                            sendOTP();
                        } else {
                            Swal.fire(
                                'Not User!',
                                'Wrong Mobile Number.',
                                'error'
                            )
                        }
                    }
                });
            });

            function sendOTP() {
                var number = "+91" + document.getElementById('number').value
                var firebaseAuth = getAuth();
                signInWithPhoneNumber(firebaseAuth,number, window.recaptchaVerifier).then(function(confirmationResult) {
                    window.confirmationResult = confirmationResult;
                    var coderesult = confirmationResult;
                    console.log(coderesult);
                    Swal.fire(
                        'Sent!',
                        'Otp Has Been Sent.',
                        'success'
                    ).then(function() {
                        var btnsendotpdiv = document.getElementById("btnSendOtpdiv");
                        var txtotpdiv = document.getElementById("otpdiv");
                        var btnlogindiv = document.getElementById("loginbtndiv");
                        btnsendotpdiv.style.display = "none";
                        txtotpdiv.style.display = "block";
                        btnlogindiv.style.display = "block";
                    })
                }).catch(function(error) {
                    Swal.fire(
                        'Not Sent!',
                        'Something Wrong Otp Has Been Not Sent.',
                        'error'
                    )
                });
            }

            $(document).on('click', '#signin', function() {
                var number = document.getElementById('number').value
                var code = $("#verification").val();
                confirmationResult.confirm(code).then((result) => {
                const user = result.user;
                var url = "verifyUser/" + number;
                    window.location.href = url;
                }).catch((error) => {
                    Swal.fire(
                        'Not Sent!',
                        'Something Wrong Otp Has Been Not Sent.',
                        'error'
                    )
                });

            });

            });

        </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
