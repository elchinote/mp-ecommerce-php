<?php 
function redirect_post($url, array $data)
{
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script type="text/javascript">
            function cerrar() {
                document.forms["redirectpost"].submit();
            }
        </script>
    </head>
    <body onload="cerrar();">
    <form name="redirectpost" method="post" action="<?PHP echo $url; ?>">
        <?php
        if ( !is_null($data) ) {
            foreach ($data as $k => $v) {
                echo '<input type="hidden" name="' . $k . '" value="' . $v . '"> ';
            }
        }
        ?>
    </form>
    </body>
    </html>
    <?php
    exit;
}

redirect_post($_POST["back_url"], $_POST);
?>