<?php
if (isset($_POST['generate'])) {

    $data['plugin_name'] = strtolower($_POST['plugin_name']);
    $data['plugin_name_u'] = str_replace(' ', '_', $data['plugin_name']);
    $data['plugin_name_dash'] = str_replace(' ', '-', $data['plugin_name']);
    $data['plugin_name_cap'] = ucwords($data['plugin_name']);
    $data['plugin_name_cap_u'] = str_replace(' ', '_', $data['plugin_name_cap']);
    $data['plugin_url'] = $_POST['plugin_url'];
    $data['plugin_description'] = $_POST['plugin_description'];
    $data['plugin_version'] = $_POST['plugin_version'];
    $data['plugin_author'] = $_POST['plugin_author'];
    $data['plugin_author_url'] = $_POST['plugin_author_url'];

    $data['crud_singular'] = strtolower($_POST['crud_singular']);
    $data['crud_singular_cap'] = ucwords($data['crud_singular']);
    $data['crud_plural'] = $data['crud_singular'] . 's';
    $data['crud_plural_cap'] = ucwords($data['crud_plural']);
    $data['plugin_page'] = strtolower($data['plugin_name_dash']);
    $data['textdomain'] = $_POST['textdomain'];
    $data['prefix'] = $_POST['prefix'];

    // Getting contents from stubs file
    $plugin_main_file = file_get_contents(dirname(__FILE__) . '/stubs/plugin-name.stub');
    $plugin_uninstall_file = file_get_contents(dirname(__FILE__) . '/stubs/uninstall.stub');
    $crud_admin_menu_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-admin-menu.stub');
    $crud_wp_list_file = file_get_contents(dirname(__FILE__) . '/stubs/class-crud-list.stub');
    $crud_list_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-list.stub');
    $crud_new_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-new.stub');
    $crud_edit_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-edit.stub');
    $crud_single_view_file = file_get_contents(dirname(__FILE__) . '/stubs/views/crud-single.stub');

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
    $plugin_dir = dirname(__FILE__) . '/plugin/' . $data['plugin_name_dash'] . '/';
    if (!is_dir($plugin_dir)) {
        mkdir($plugin_dir, 0777);
    }

    // Creating plugin main file
    file_put_contents($plugin_dir . $data['plugin_name_u'] . '.php', $plugin_main_file);

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

    $is_zipped = zip_dir($plugin_dir, $data['plugin_name_dash'] . '.zip', true);

    if ($is_zipped) {
        unlink($data['plugin_name_dash'] . '.zip');
        $dir = dirname(__FILE__) . '/plugin/';
        $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
        $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($ri as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }
    }
}

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
