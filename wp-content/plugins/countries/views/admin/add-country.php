<div class="wrap">
    <h2>Add Country</h2>
    <form method="post">
        <table class="form-table">
            <tr>
                <th>
                   Country Name
                </th>
                <td>
                    <label>
                        <input type="text" value="" name="country_name">
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    Country Code
                </th>
                <td>
                    <label>
                        <input type="text" value="" name="country_code">
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    Country Calling Code
                </th>
                <td>
                    <label>
                        <input type="text" value="" name="country_calling_code">
                    </label>
                </td>
            </tr>
        </table>
        <input type="hidden" name="add_country" value="add_country">
        <?php submit_button();?>
    </form>
</div>
<?php
