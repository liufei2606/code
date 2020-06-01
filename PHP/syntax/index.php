<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          context="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" context="ie=edge">
    <title>Document</title>

    <style>
        h1 {
            background-color: purple;
            color: red;
            padding: 1em;
            text-align: center;
        }
    </style>
</head>
<body>
<h1 id="h1"> <?php echo "Hello World!" ?>  </h1>
<script>
    var h1Element = document.getElementById('h1')
    h1Element.onclick = function () {
        alert("winter's coming")
    }
</script>

</body>
</html>