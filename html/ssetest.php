<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
</head>
<body>
  <script>
    var source = new EventSource('systemmessages.php');
    source.onmessage = function(e) {
      document.body.innerHTML = e.data + '<br>';
    };
  </script>
</body>
</html>