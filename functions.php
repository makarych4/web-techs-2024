<?php

function log_page_request() {
    if (!is_dir('logs')) {
        mkdir('logs');
    }

    $current_log_file = 'logs/log.txt';
    $log_entry = date('Y-m-d H:i:s') . PHP_EOL;

    if (file_exists($current_log_file) && count(file($current_log_file)) >= 10) {
        $archive_files_count = count(glob('logs/log*.txt'));
        $archive_file_name = 'logs/log' . ($archive_files_count - 1) . '.txt';
        rename($current_log_file, $archive_file_name);
    }

    file_put_contents($current_log_file, $log_entry, FILE_APPEND);
}

function get_gallery_images() {
    if (!is_dir('images/full')) mkdir('images/full', 0777, true);
    if (!is_dir('images/thumbnail')) mkdir('images/thumbnail', 0777, true);

    $images = [];
    $image_files = array_diff(scandir('images/full'), ['.', '..']);

    foreach ($image_files as $file) {
        if (file_exists('images/thumbnail/' . $file)) {
            $images[] = [
                'full' => 'images/full/' . $file,
                'thumbnail' => 'images/thumbnail/' . $file,
                'name' => $file
            ];
        }
    }
    return $images;
}

function create_thumbnail($source_path, $destination_path) {
    $source_image = imagecreatefromjpeg($source_path);
    if ($source_image === false) {
        return false;
    }

    $thumbnail = imagescale($source_image, 200);
    $success = imagejpeg($thumbnail, $destination_path);

    return $success;
}

function handle_file_upload($file_upload_data) {
    $upload_dir = 'images/full/';
    $target_file = $upload_dir . basename($file_upload_data['name']);
    $image_info = getimagesize($file_upload_data['tmp_name']);

    if (file_exists($target_file)) {
        return 'error';
    }
    if ($file_upload_data['size'] > 1024 * 1024 * 5) {
        return 'error';
    }
    if ($image_info['mime'] != 'image/jpeg') {
        return 'error';
    }

    if (move_uploaded_file($file_upload_data['tmp_name'], $target_file)) {
        $thumbnail_path = 'images/thumbnail/' . basename($file_upload_data['name']);
        if (create_thumbnail($target_file, $thumbnail_path)) {
            return 'ok';
        }
    }

    return 'error';
}