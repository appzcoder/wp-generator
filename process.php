<?php
if (isset($_POST['generate'])) {
    unset($_POST['generate']);

    process($_POST);
}

function process($post_data, $download = true, $delete = true)
{
    $new_view_form = '';
    $edit_view_form = '';

    $column_default = '';
    $columns = '';
    $sortable_columns = '';
    $form_submit_fields = '';
    $form_fields = '';
    $form_single_default = '';
    $form_validation = '';

    $database_schema = '';

    foreach ($post_data['fields'] as $key => $field) {
        if (!empty($field)) {
            $field_label = ucwords(strtolower(str_replace('_', ' ', $field)));
            $field_type = $post_data['fields_type'][$key];
            $required = isset($post_data['fields_required'][$key]) ? "required=\"required\"" : "";

            switch ($field_type) {
                case 'text':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="$field" id="$field" class="regular-text" value="" $required />
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="$field" id="$field" class="regular-text" value="<?php echo esc_attr( \$item->$field ); ?>" $required />
                            </td>
                        </tr>
EOD;

                    break;

                case 'textarea':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <textarea name="$field" id="$field"  rows="5" cols="30" $required></textarea>
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <textarea name="$field" id="$field"  rows="5" cols="30x" $required><?php echo esc_attr( \$item->$field ); ?></textarea>
                            </td>
                        </tr>
EOD;

                    break;

                case 'number':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="number" name="$field" id="$field" class="regular-text" value="" $required />
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                            <input type="number" name="$field" id="$field" class="regular-text" value="<?php echo esc_attr( \$item->$field ); ?>" $required />
                            </td>
                        </tr>
EOD;

                    break;

                case 'email':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="email" name="$field" id="$field" class="regular-text" value="" $required />
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="email" name="$field" id="$field" class="regular-text" value="<?php echo esc_attr( \$item->$field ); ?>" $required />
                            </td>
                        </tr>
EOD;

                    break;

                case 'select':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <select name="$field">
                                    <option>Your Option</option>
                                </select>
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input name="users_can_register" type="checkbox" id="users_can_register">
                            </td>
                        </tr>
EOD;

                    break;

                case 'checkbox':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <label for="$field">
                                    <input name="$field" type="checkbox" id="$field" value="1">
                                    Confirm
                                </label>
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <label for="$field">
                                    <input name="$field" type="checkbox" id="$field" value="1">
                                    Confirm
                                </label>
                            </td>
                        </tr>
EOD;

                    break;

                case 'radio':

                    $new_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <label for="$field">
                                    <input type="radio" name="$field" value="yes">
                                    <input type="radio" name="$field" value="no">
                                    Confirm
                                </label>
                            </td>
                        </tr>
EOD;

                    $edit_view_form .=
                        <<<EOD
                        <tr class="row-$field">
                            <th scope="row">
                                <label for="$field"><?php _e( '$field_label', '%%textdomain%%' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="$field" id="$field" class="regular-text" value="<?php echo esc_attr( \$item->$field ); ?>" $required />
                            </td>
                        </tr>
EOD;

                    break;

            }

            $column_default .= "case '$field':\n";

            $columns .= "'$field' => __( '$field_label', '%%textdomain%%' ),\n";

            $sortable_columns .= "'$field' => array( '$field', true ),\n";

            if ($field_type == 'textarea') {
                $form_submit_fields .= "\$$field = isset( \$_POST['$field'] ) ? wp_kses_post( \$_POST['$field'] ) : '';\n";
                // Database schema generate
                $database_schema .= "$field text NOT NULL,\n";
            } else {
                $form_submit_fields .= "\$$field = isset( \$_POST['$field'] ) ? sanitize_text_field( \$_POST['$field'] ) : '';\n";
                // Database schema generate
                $database_schema .= "$field varchar(255) DEFAULT '' NOT NULL,\n";
            }

            $form_fields .= "'$field' => \$$field,\n";

            $form_single_default .= "'$field' => '',\n";

            if (isset($post_data['fields_required'][$key])) {
                $form_validation .=
                    "if ( ! \$$field ) {
                    \$errors[] = __( 'Error: $field_label is required', '%%textdomain%%' );
                }";
            }

        }

    }

    $data['plugin_name'] = strtolower($post_data['plugin_name']);
    $data['plugin_name_u'] = str_replace(' ', '_', $data['plugin_name']);
    $data['plugin_name_dash'] = str_replace(' ', '-', $data['plugin_name']);
    $data['plugin_name_cap'] = ucwords($data['plugin_name']);
    $data['plugin_name_cap_u'] = str_replace(' ', '_', $data['plugin_name_cap']);
    $data['plugin_url'] = $post_data['plugin_url'];
    $data['plugin_description'] = $post_data['plugin_description'];
    $data['plugin_version'] = $post_data['plugin_version'];
    $data['plugin_author'] = $post_data['plugin_author'];
    $data['plugin_author_url'] = $post_data['plugin_author_url'];
    $data['crud_name'] = strtolower($post_data['crud_name']);
    $data['crud_name_cap'] = ucwords($data['crud_name']);
    $data['crud_name_singular'] = singularize($data['crud_name']);
    $data['crud_name_singular_cap'] = ucwords($data['crud_name_singular']);
    $data['plugin_page'] = strtolower($data['plugin_name_dash']);
    $data['textdomain'] = $post_data['textdomain'];
    $data['prefix'] = $post_data['prefix'];

    // Getting contents from stubs file
    $plugin_main_file = file_get_contents(dirname(__FILE__) . '/stubs/plugin-name.stub');
    $plugin_uninstall_file = file_get_contents(dirname(__FILE__) . '/stubs/uninstall.stub');

    $crud_admin_menu_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-name-admin-menu.stub');
    $crud_functions_file = file_get_contents(dirname(__FILE__) . '/stubs/crud-name-functions.stub');
    $crud_wp_list_table_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-name-list-table.stub');
    $crud_list_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-name.stub');
    $crud_new_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-name-singular-new.stub');
    $crud_edit_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-name-singular-edit.stub');
    $crud_single_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-name-singular-single.stub');

    // Replacing database schema
    $plugin_main_file = str_replace("%%database_schema%%", $database_schema, $plugin_main_file);

    // Replacing wp_list_table file data
    $crud_wp_list_table_file = str_replace("%%column_default%%", $column_default, $crud_wp_list_table_file);
    $crud_wp_list_table_file = str_replace("%%columns%%", $columns, $crud_wp_list_table_file);
    $crud_wp_list_table_file = str_replace("%%sortable_columns%%", $sortable_columns, $crud_wp_list_table_file);
    $crud_wp_list_table_file = str_replace("%%form_submit_fields%%", $form_submit_fields, $crud_wp_list_table_file);
    $crud_wp_list_table_file = str_replace("%%form_fields%%", $form_fields, $crud_wp_list_table_file);
    $crud_functions_file = str_replace("%%form_single_default%%", $form_single_default, $crud_functions_file);
    $crud_wp_list_table_file = str_replace("%%form_validation%%", $form_validation, $crud_wp_list_table_file);

    // Repacing form html
    $crud_new_view_file = str_replace("%%new_view_form%%", $new_view_form, $crud_new_view_file);
    $crud_edit_view_file = str_replace("%%edit_view_form%%", $edit_view_form, $crud_edit_view_file);

    // Replacing user defined keyword
    foreach ($data as $key => $value) {
        $plugin_main_file = str_replace("%%$key%%", $value, $plugin_main_file);
        $plugin_uninstall_file = str_replace("%%$key%%", $value, $plugin_uninstall_file);
        $crud_functions_file = str_replace("%%$key%%", $value, $crud_functions_file);
        $crud_admin_menu_file = str_replace("%%$key%%", $value, $crud_admin_menu_file);
        $crud_wp_list_table_file = str_replace("%%$key%%", $value, $crud_wp_list_table_file);
        $crud_list_view_file = str_replace("%%$key%%", $value, $crud_list_view_file);
        $crud_new_view_file = str_replace("%%$key%%", $value, $crud_new_view_file);
        $crud_edit_view_file = str_replace("%%$key%%", $value, $crud_edit_view_file);
        $crud_single_view_file = str_replace("%%$key%%", $value, $crud_single_view_file);
    }

    // Checking/Creating plugin directory
    $plugin_dir = dirname(__FILE__) . '/plugins/' . $data['plugin_name_dash'] . '/';
    if (!is_dir($plugin_dir)) {
        mkdir($plugin_dir, 0777);
    }

    // Creating plugin main file
    file_put_contents($plugin_dir . $data['plugin_name_dash'] . '.php', $plugin_main_file);

    // Creating plugin uninstall file
    file_put_contents($plugin_dir . 'uninstall.php', $plugin_uninstall_file);
    // Creating plugin main file

    if (!is_dir($plugin_dir . 'includes/')) {
        mkdir($plugin_dir . 'includes/', 0777);
    }

    $crud_dir = $plugin_dir . 'includes/' . $data['crud_name'] . '/';
    if (!is_dir($crud_dir)) {
        mkdir($crud_dir, 0777);
    }

    // Creating admin menu file
    file_put_contents($crud_dir . 'class-' . $data['crud_name'] . '-admin-menu.php', $crud_admin_menu_file);

    // Creating functions file
    file_put_contents($crud_dir . $data['crud_name'] . '-functions.php', $crud_functions_file);

    // Creating plugin main file
    file_put_contents($crud_dir . 'class-' . $data['crud_name'] . '-list-table.php', $crud_wp_list_table_file);

    if (!is_dir($crud_dir . 'views/')) {
        mkdir($crud_dir . 'views/', 0777);
    }
    // Creating plugin main file
    file_put_contents($crud_dir . 'views/' . $data['crud_name'] . '.php', $crud_list_view_file);

    // Creating plugin main file
    file_put_contents($crud_dir . 'views/' . $data['crud_name_singular'] . '-new.php', $crud_new_view_file);

    // Creating plugin main file
    file_put_contents($crud_dir . 'views/' . $data['crud_name_singular'] . '-edit.php', $crud_edit_view_file);

    // Creating plugin main file
    file_put_contents($crud_dir . 'views/' . $data['crud_name_singular'] . '-single.php', $crud_single_view_file);

    zipDir($plugin_dir, $data['plugin_name_dash'] . '.zip', $download);

    // Deleting existing plugin or module files
    if (file_exists($data['plugin_name_dash'] . '.zip')) {
        unlink($data['plugin_name_dash'] . '.zip');
    }

    $dir = dirname(__FILE__) . '/plugins/';

    $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
    $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($ri as $file) {
        chmod($file, 777);
        $file->isDir() ? rmdir($file) : unlink($file);
    }

    return true;

}

// For zip files
function zipDir($source, $destination, $download = false)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if (in_array(substr($file, strrpos($file, '/') + 1), array('.', '..'))) {
                continue;
            }

            $file = realpath($file);

            if (is_dir($file) === true) {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            } elseif (is_file($file) === true) {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    } elseif (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    $zip->close();

    if ($download == true) {
        ///Then download the zipped file.
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $destination);
        header('Content-Length: ' . filesize($destination));
        readfile($destination);
    }

    return true;
}

/**
 * Singularize a string.
 * Converts a word to english singular form.
 *
 * Usage example:
 * {singularize "people"} # person
 */
function singularize($params)
{
    if (is_string($params)) {
        $word = $params;
    } else if (!$word = $params['word']) {
        return false;
    }

    $singular = array(
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\\1ix',
        '/(vert|ind)ices$/i' => '\\1ex',
        '/^(ox)en/i' => '\\1',
        '/(alias|status)es$/i' => '\\1',
        '/([octop|vir])i$/i' => '\\1us',
        '/(cris|ax|test)es$/i' => '\\1is',
        '/(shoe)s$/i' => '\\1',
        '/(o)es$/i' => '\\1',
        '/(bus)es$/i' => '\\1',
        '/([m|l])ice$/i' => '\\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\\1',
        '/(m)ovies$/i' => '\\1ovie',
        '/(s)eries$/i' => '\\1eries',
        '/([^aeiouy]|qu)ies$/i' => '\\1y',
        '/([lr])ves$/i' => '\\1f',
        '/(tive)s$/i' => '\\1',
        '/(hive)s$/i' => '\\1',
        '/([^f])ves$/i' => '\\1fe',
        '/(^analy)ses$/i' => '\\1sis',
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\\1\\2sis',
        '/([ti])a$/i' => '\\1um',
        '/(n)ews$/i' => '\\1ews',
        '/s$/i' => '',
    );

    $irregular = array(
        'person' => 'people',
        'man' => 'men',
        'child' => 'children',
        'sex' => 'sexes',
        'move' => 'moves',
    );

    $ignore = array(
        'equipment',
        'information',
        'rice',
        'money',
        'species',
        'series',
        'fish',
        'sheep',
        'press',
        'sms',
    );

    $lower_word = strtolower($word);
    foreach ($ignore as $ignore_word) {
        if (substr($lower_word, (-1 * strlen($ignore_word))) == $ignore_word) {
            return $word;
        }
    }

    foreach ($irregular as $singular_word => $plural_word) {
        if (preg_match('/(' . $plural_word . ')$/i', $word, $arr)) {
            return preg_replace('/(' . $plural_word . ')$/i', substr($arr[0], 0, 1) . substr($singular_word, 1), $word);
        }
    }

    foreach ($singular as $rule => $replacement) {
        if (preg_match($rule, $word)) {
            return preg_replace($rule, $replacement, $word);
        }
    }

    return $word;
}
