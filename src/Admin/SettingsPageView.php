<div class="wrap">
    <h1>API2PDF Plugin settings</h1>

    <form method="post" action="options.php">
        <?php settings_fields( Hyperion\API2pdf\Admin\Settings::SETTINGS_GROUP ); ?>
        <?php do_settings_sections( Hyperion\API2pdf\Admin\Settings::SETTINGS_GROUP ); ?>
        <table class="form-table">
            <tr>
                <th scope="row">API2PDF api key</th>
                <td><input type="text" name="<?php echo \Hyperion\Api2pdf\Plugin::API2PDF_APIKEY_OPTION; ?>" value="<?php echo esc_attr( get_option(\Hyperion\Api2pdf\Plugin::API2PDF_APIKEY_OPTION) ); ?>" /></td>
            </tr>
        </table>

        <?php submit_button(); ?>

    </form>
</div>