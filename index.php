<?php

include "views/header.php";

include 'views/home.php';

include 'views/footer.php';

if (isset($_SESSION['return'])) {
?>
    <div class="alerta <?= $_SESSION['return']['class']?>" >
        <?=
        $_SESSION['return']['msg'];
        ?>

    </div>

<?php
    unset($_SESSION['return']);
}
?>