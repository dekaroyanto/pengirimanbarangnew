<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('loginform/style.css') }}" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="/loginproses" method="post" autocomplete="off" class="sign-in-form">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('loginform/img/logo.png') }}" alt="easyclass" />
                            <h4>CV Firmos</h4>
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="email" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Login" class="sign-btn" />
                        </div>
                    </form>
                </div>

                <div class="rightpict">
                    <div class="images-wrapper">
                        <img src="{{ asset('loginform/img/image1.png') }}" class="image img-1 show" alt="" />
                    </div>
                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Login untuk melanjutkan</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->

    <script src="{{ asset('loginform/app.js') }}"></script>
</body>

</html>