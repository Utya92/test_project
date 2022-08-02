<head>
    <meta charset="UTF-8">
    <title>Authorization form</title>
    <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
    </script>
</head>
<body>
<h2>Log in</h2>
<form action="" method='post' id="log_form">
    Login <input type='text' class="login" name='login'>
    <br>
    <br>
    Password <input type='password' class="password" name='password'>
    <br>
    <br>
    <button class="buttonSend">Send</button>
    <div style="font-size: medium ">
        <br>
        <a href="registration_form.php">Registration</a>
    </div>
    <p class="log_err" style="color:red"></p>

    <script src="../javascript/log_in.js"></script>
</form>
