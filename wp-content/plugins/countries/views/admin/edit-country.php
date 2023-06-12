<?php
global $wpdb;
$countryID = $_GET['id'] ?? 0;
$country = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'country_codes WHERE ID=%d', $countryID));
?>
<div class="wrap">
    <h2>Edit Country</h2>
    <?php if($country){
        ?>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th>
                        Country Name
                    </th>
                    <td>
                        <label>
                            <input type="text" value="<?php echo $country->country_name; ?>" name="country_name">
                        </label>
                    </td>
                </tr>
                <tr>
                    <th>
                        Country Code
                    </th>
                    <td>
                        <label>
                            <input type="text" value="<?php echo $country->country_code;?>" name="country_code">
                        </label>
                    </td>
                </tr>
                <tr>
                    <th>
                        Country Calling Code
                    </th>
                    <td>
                        <label>
                            <input type="text" value="<?php echo $country->calling_code; ?>" name="country_calling_code">
                        </label>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="edit_country" value="edit_country">
            <input type="hidden" name="country_id" value="<?php echo $country->id; ?>">
            <?php wp_nonce_field('edit_country_nonce', 'edit_country_nonce_field'); ?>
            <?php submit_button();?>
        </form>
    <?php
    }else{
        echo 'Error Occurred!';
    } ?>

</div>
<?php
