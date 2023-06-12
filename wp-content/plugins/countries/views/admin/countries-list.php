<?php
global $wpdb;
$countries = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'country_codes');
?>
<div class="wrap">
    <h3>Countries</h3>
    <a href="?page=countries&action=add" class="page-title-action">Add New</a>
    <table>
        <thead>
        <tr>
            <th>Country Name</th>
            <th>Country Code</th>
            <th>Country Calling Code</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($countries as $country) {
            ?>
            <tr>
                <td><?php echo $country->country_name; ?></td>
                <td><?php echo $country->country_code; ?></td>
                <td><?php echo $country->calling_code; ?></td>
                <td><a href="?page=countries&action=edit&id=<?php echo $country->id; ?>">Edit</a> |
                    <a href="?page=countries&action=edit&id=<?php echo $country->id; ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
