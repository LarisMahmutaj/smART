<?php
include("error-utils.php");
function saveUpload($name) {
  try {
    if (
      !isset($_FILES[$name]['error']) ||
      is_array($_FILES[$name]['error'])
    ) {
      throw new RuntimeException('Invalid parameters.');
    }

    switch ($_FILES[$name]['error']) {
      case UPLOAD_ERR_OK:
        break;
      case UPLOAD_ERR_NO_FILE:
        throw new RuntimeException('No file sent.');
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        throw new RuntimeException('Exceeded filesize limit.');
      default:
        throw new RuntimeException('Unknown errors.');
    }

    if ($_FILES[$name]['size'] > 10000000) {
      throw new RuntimeException('Exceeded filesize limit.');
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
      $finfo->file($_FILES[$name]['tmp_name']),
      array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'pdf' => 'application/pdf',
        'PDF' => 'application/pdf'
      ),
      true
    )) {
      throw new RuntimeException('Invalid file format.');
    }

    $finalName = sha1_file($_FILES[$name]['tmp_name']) . '.' . $ext;
    $path = __DIR__ . '/uploads/' . $finalName;
    if (!move_uploaded_file($_FILES[$name]['tmp_name'], $path)) {
      throw new RuntimeException('Failed to move uploaded file.');
    }

    return $finalName;
  } catch (RuntimeException $e) {
    logError($e->getMessage());
    return null;
  }
}
