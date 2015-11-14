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
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"text\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"\" $required />
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"text\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"<?php echo esc_attr( \$item->$field ); ?>\" $required />
                        </td>
                        </tr>\n";

                    break;

                case 'textarea':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <textarea name=\"$field\" id=\"$field\"  rows=\"5\" cols=\"30\" $required></textarea>
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <textarea name=\"$field\" id=\"$field\"  rows=\"5\" cols=\"30\" $required><?php echo esc_attr( \$item->$field ); ?></textarea>
                        </td>
                        </tr>\n";

                    break;

                case 'number':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"number\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"\" $required />
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"number\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"<?php echo esc_attr( \$item->$field ); ?>\" $required />
                        </td>
                        </tr>\n";

                    break;

                case 'email':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"email\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"\" $required />
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"email\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"<?php echo esc_attr( \$item->$field ); ?>\" $required />
                        </td>
                        </tr>\n";

                    break;

                case 'select':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <select name=\"$field\">
                            <option>Your Option</option>
                        </select>
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input name=\"users_can_register\" type=\"checkbox\" id=\"users_can_register\">
                        </td>
                        </tr>\n";

                    break;

                case 'checkbox':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <label for=\"$field\">
                        <input name=\"$field\" type=\"checkbox\" id=\"$field\" value=\"1\">
                        Confirm</label>
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <label for=\"$field\">
                        <input name=\"$field\" type=\"checkbox\" id=\"$field\" value=\"1\">
                        Confirm</label>
                        </td>
                        </tr>\n";

                    break;

                case 'radio':

                    $new_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <label for=\"$field\">
                        <input type=\"radio\" name=\"$field\" value=\"yes\">
                        <input type=\"radio\" name=\"$field\" value=\"no\">
                        Confirm</label>
                        </td>
                        </tr>\n";

                    $edit_view_form .=
                        "<tr class=\"row-$field\">
                        <th scope=\"row\">
                        <label for=\"$field\"><?php _e( '" . $field_label . "', '%%textdomain%%' ); ?></label>
                        </th>
                        <td>
                        <input type=\"text\" name=\"$field\" id=\"$field\" class=\"regular-text\" value=\"<?php echo esc_attr( \$item->$field ); ?>\" $required />
                        </td>
                        </tr>\n";

                    break;

            }

            $column_default .= "case '$field':\n";

            $columns .= "'$field'    => __( '$field_label', '%%textdomain%%' ),\n";

            $sortable_columns .= "'$field' => array( '$field', true ),\n";

            if ($field_type == 'textarea') {
                $form_submit_fields .= "\$$field       = isset( \$post_data['$field'] ) ? wp_kses_post( \$post_data['$field'] ) : '';";
                // Database schema generate
                $database_schema .= "$field text NOT NULL,\n";
            } else {
                $form_submit_fields .= "\$$field       = isset( \$post_data['$field'] ) ? sanitize_text_field( \$post_data['$field'] ) : '';";
                // Database schema generate
                $database_schema .= "$field varchar(255) DEFAULT '' NOT NULL,\n";
            }

            $form_fields .= "'$field'      => \$$field,\n";

            $form_single_default .= "'$field'      => '',\n";

            if (isset($post_data['fields_required'][$key])) {
                $form_validation .=
                    "if ( ! \$$field ) {
                    \$errors[] = __( 'Error: $field_label is required', '%%textdomain%%' );
                }";
            }

        }

    }

    if ($post_data['type_of_crud_generator'] == 'plugin') {

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
        $data['crud_singular'] = strtolower($post_data['crud_singular']);
        $data['crud_singular_cap'] = ucwords($data['crud_singular']);
        $data['crud_plural'] = $data['crud_singular'] . 's';
        $data['crud_plural_cap'] = ucwords($data['crud_plural']);
        $data['plugin_page'] = strtolower($data['plugin_name_dash']);
        $data['textdomain'] = $post_data['textdomain'];
        $data['prefix'] = $post_data['prefix'];

        // Deleting existing plugin or module files
        if (file_exists($data['plugin_name_dash'] . '.zip')) {
            unlink($data['plugin_name_dash'] . '.zip');
        }
        $dir = dirname(__FILE__) . '/plugins/';
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($ri as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }

        // Getting contents from stubs file
        $plugin_main_file = file_get_contents(dirname(__FILE__) . '/stubs/plugin-name.stub');
        $plugin_uninstall_file = file_get_contents(dirname(__FILE__) . '/stubs/uninstall.stub');

        $crud_admin_menu_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-admin-menu.stub');
        $crud_wp_list_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-list.stub');
        $crud_list_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-list.stub');
        $crud_new_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-new.stub');
        $crud_edit_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-edit.stub');
        $crud_single_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-single.stub');

        // Replacing database schema
        $plugin_main_file = str_replace("%%database_schema%%", $database_schema, $plugin_main_file);

        // Replacing wp_list_table file data
        $crud_wp_list_file = str_replace("%%column_default%%", $column_default, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%columns%%", $columns, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%sortable_columns%%", $sortable_columns, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_submit_fields%%", $form_submit_fields, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_fields%%", $form_fields, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_single_default%%", $form_single_default, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_validation%%", $form_validation, $crud_wp_list_file);

        // Repacing form html
        $crud_new_view_file = str_replace("%%new_view_form%%", $new_view_form, $crud_new_view_file);
        $crud_edit_view_file = str_replace("%%edit_view_form%%", $edit_view_form, $crud_edit_view_file);

        // Replacing user defined keyword
        foreach ($data as $key => $value) {
            $plugin_main_file = str_replace("%%$key%%", $value, $plugin_main_file);
            $plugin_uninstall_file = str_replace("%%$key%%", $value, $plugin_uninstall_file);
            $crud_admin_menu_file = str_replace("%%$key%%", $value, $crud_admin_menu_file);
            $crud_wp_list_file = str_replace("%%$key%%", $value, $crud_wp_list_file);
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

        $crud_dir = $plugin_dir . 'includes/' . $data['crud_singular'] . '/';
        if (!is_dir($crud_dir)) {
            mkdir($crud_dir, 0777);
        }

        file_put_contents($crud_dir . 'class-' . $data['crud_singular'] . '-admin-menu.php', $crud_admin_menu_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'class-' . $data['crud_plural'] . '-list.php', $crud_wp_list_file);

        if (!is_dir($crud_dir . 'views/')) {
            mkdir($crud_dir . 'views/', 0777);
        }
        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-list.php', $crud_list_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-new.php', $crud_new_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-edit.php', $crud_edit_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-single.php', $crud_single_view_file);

        zip_dir($plugin_dir, $data['plugin_name_dash'] . '.zip', $download);

    } else {
        $data['crud_singular'] = strtolower($post_data['crud_singular']);
        $data['crud_singular_cap'] = ucwords($data['crud_singular']);
        $data['crud_plural'] = $data['crud_singular'] . 's';
        $data['crud_plural_cap'] = ucwords($data['crud_plural']);

        $data['plugin_name_dash'] = str_replace(' ', '-', $data['crud_singular']);
        $data['plugin_name_cap'] = ucwords($data['crud_singular']);
        $data['plugin_page'] = strtolower($data['plugin_name_dash']);

        $data['textdomain'] = $post_data['textdomain'];
        $data['prefix'] = $post_data['prefix'];

        // Deleting existing plugin or module files
        if (file_exists($data['plugin_name_dash'] . '.zip')) {
            unlink($data['plugin_name_dash'] . '.zip');
        }
        $dir = dirname(__FILE__) . '/plugins/';
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($ri as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }

        // Getting contents from stubs file
        $crud_admin_menu_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-admin-menu.stub');
        $crud_wp_list_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-list.stub');
        $crud_list_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-list.stub');
        $crud_new_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-new.stub');
        $crud_edit_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-edit.stub');
        $crud_single_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-single.stub');

        // Replacing wp_list_table file data
        $crud_wp_list_file = str_replace("%%column_default%%", $column_default, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%columns%%", $columns, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%sortable_columns%%", $sortable_columns, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_submit_fields%%", $form_submit_fields, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_fields%%", $form_fields, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_single_default%%", $form_single_default, $crud_wp_list_file);
        $crud_wp_list_file = str_replace("%%form_validation%%", $form_validation, $crud_wp_list_file);

        // Repacing form html
        $crud_new_view_file = str_replace("%%new_view_form%%", $new_view_form, $crud_new_view_file);
        $crud_edit_view_file = str_replace("%%edit_view_form%%", $edit_view_form, $crud_edit_view_file);

        // Replacing user defined keyword
        foreach ($data as $key => $value) {
            $crud_admin_menu_file = str_replace("%%$key%%", $value, $crud_admin_menu_file);
            $crud_wp_list_file = str_replace("%%$key%%", $value, $crud_wp_list_file);
            $crud_list_view_file = str_replace("%%$key%%", $value, $crud_list_view_file);
            $crud_new_view_file = str_replace("%%$key%%", $value, $crud_new_view_file);
            $crud_edit_view_file = str_replace("%%$key%%", $value, $crud_edit_view_file);
            $crud_single_view_file = str_replace("%%$key%%", $value, $crud_single_view_file);
        }

        $crud_dir = dirname(__FILE__) . '/plugins/' . $data['crud_singular'] . '/';
        if (!is_dir($crud_dir)) {
            mkdir($crud_dir, 0777);
        }

        file_put_contents($crud_dir . 'class-' . $data['crud_singular'] . '-admin-menu.php', $crud_admin_menu_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'class-' . $data['crud_plural'] . '-list.php', $crud_wp_list_file);

        if (!is_dir($crud_dir . 'views/')) {
            mkdir($crud_dir . 'views/', 0777);
        }
        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-list.php', $crud_list_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-new.php', $crud_new_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-edit.php', $crud_edit_view_file);

        // Creating plugin main file
        file_put_contents($crud_dir . 'views/' . $data['crud_singular'] . '-single.php', $crud_single_view_file);

        zip_dir($crud_dir, $data['plugin_name_dash'] . '.zip', $download);

    }

    return true;

}

// For zip files
function zip_dir($source, $destination, $download = false)
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
