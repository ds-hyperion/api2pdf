<?php
    if(isset($_POST['api2pdf_apikey'])) {
        // Sauvegarde dans les options
        update_option(\Hyperion\Api2pdf\Plugin::API2PDF_APIKEY_OPTION, $_POST['api2pdf_apikey']);
    }
?>

<div class="wrap">
    <form action="">
        <label for="api2pdf_apikey">API2Pdf api key : </label>
        <input type="text" id="api2pdf_apikey">
        <input type="submit" value="Sauvegarder">
    </form>
</div>
