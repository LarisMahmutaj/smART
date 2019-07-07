<?php
function get_caller_info() {
  $c = '';
  $file = '';
  $func = '';
  $class = '';
  $trace = debug_backtrace();
  if (isset($trace[2])) {
    $file = $trace[1]['file'];
    $func = $trace[2]['function'];
    if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
      $func = '';
    }
  } else if (isset($trace[1])) {
    $file = $trace[1]['file'];
    $func = '';
  }

  if (isset($trace[3]['class'])) {
    $class = $trace[3]['class'];
    $func = $trace[3]['function'];
    $file = $trace[2]['file'];
  } else if (isset($trace[2]['class'])) {
    $class = $trace[2]['class'];
    $func = $trace[2]['function'];
    $file = $trace[1]['file'];
  }

  if ($file != '') {
    $file = basename($file);
  }

  $c = $file . ': ';
  $c .= $class != '' ? $class . '->' : '';
  $c .= $func != '' ? $func . '()' : '';
  return $c;
}

function writeLog($txt = "") {
  file_put_contents(__DIR__ . '/../log.txt', $txt . PHP_EOL, FILE_APPEND | LOCK_EX);
}

function logError($msg = '') {
  writeLog(date('H:i:s') . ' [Error@' . $_SERVER['PHP_SELF'] . '] ' . get_caller_info() . ': ' . $msg);
}
