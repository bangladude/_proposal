<?php ?>
<head>
    <script src="http://platform.twitter.com/anywhere.js?id=zBfOplU5kFTbdSLMmX4VGA&v=1" type="text/javascript"></script>
</head>
<body>
    <script type="text/javascript">
        function authTwt() {
            neww = window.open("./redirect.php", "Connect To Twitter", "height=800,width=600");
            neww.focus();

        }
    </script>
    <input type="button" value="Authorize Twitter" onclick="authTwt()">

</body>