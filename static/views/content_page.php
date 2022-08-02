<head><title>Content shop</title></head>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
</script>
<H2 style="color: crimson">Hello <?= $_COOKIE['name'] ?? '' ?></H2>
<div style="font-size: large">Some content...</div>
<br>
<form action="" method='post' id="exit_form">
    <button class="buttonSend">Exit</button>
    <script src="../javascript/exit.js"></script>
</form>
