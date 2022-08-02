<head>
    <meta charset="UTF-8">
    <title>Registration form</title>
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossOrigin="anonymous">
    </script>
    <script
            src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js">
    </script>
</head>
<body>
<h2>Register</h2>
<form action="" method='post' id="reg_form">
    Login <input type='text' class="login" name='login'">
    <br>
    <br>
    Password <input type='password' class="password" name='password'>
    <br>
    <br>
    Confirm password <input type='password' class="confirm_password" name='confirm_password'>
    <br>
    <br>
    Email <input type='text' class="email" name='email'>
    <br>
    <br>
    Name <input type='text' class="name" name='name'>
    <br>
    <br>
    <button type="submit" class="buttonSend">Register</button>
    <br><br>
    <a href="start_page.php">Return to main page</a>
    <p class="err" style="color:red"></p>
    <script src="../javascript/validation_for_registration.js"></script>
    <script src="../javascript/send_valid_form.js"></script>
</form>
</body>

