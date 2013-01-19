<?php

?>
<head>
    <script src="http://platform.twitter.com/anywhere.js?id=YOUR_API_KEY&v=1" type="text/javascript"></script>
</head>
<body>
<span id="login"></span>
<script type="text/javascript">
 
  twttr.anywhere(function (T) {
    T("#login").connectButton();
  });
 
</script>
</body>