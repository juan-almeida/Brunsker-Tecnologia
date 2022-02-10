<?php

session_start();

include "views/header.php";

include 'views/home.php';

include 'views/footer.php';

if (isset($_SESSION['return'])) {
?>
    <div class="<?= $_SESSION['return']['class']?>">
        <?=
        $_SESSION['return']['msg'];
        ?>

    </div>

<?php
    unset($_SESSION['return']);
}
?>