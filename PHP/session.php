<?php

# session1.php

session_start();
?>

    <html>
    <body>
    <?php
    $_SESSION["user"] = "Maxsu";
    echo "Session information are set successfully.<br/>";
    ?>
    <a href="session2.php">Visit next page</a>
    </body>
    </html>

    # session2.php
<?php
session_start();
?>
    <html>
    <body>
    <?php
    echo "User is: ".$_SESSION["user"];
    ?>
    </body>
    </html>

<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}
echo("Page Views: ".$_SESSION['counter']);