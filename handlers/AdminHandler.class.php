<?php

class AdminHandler {
    public function GET() {
        include_once ("templates/TheDataTank/header.php");
        echo '<h2>Admin</h2>';
        echo '<ul>';
        echo '<li><a href="/admin/modules/">Modules</a></li>';
        echo '<li><a href="/admin/resources/">Resources</a></li>';
        echo '</ul>';
        include_once ("templates/TheDataTank/footer.php");
    }
}

?>