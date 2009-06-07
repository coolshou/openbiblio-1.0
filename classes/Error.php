<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/* Non-fatal errors
 *
 * This generic class allows errors to be reported to the user.
 * If an error is to be caught and handled by other code, derive a
 * class from this so that the code can detect the error with is_a().
 *
 * toStr() is intended for end-user consumption.
 *
 * By convention all functions returning error objects have names
 * ending in '_e'.  Those returning a list of error objects have names
 * ending in '_el'.
 */
class Error {
  function Error($msg) {
    $this->msg = $msg;
  }
  function toStr() {
    return $this->msg;
  }
  /* static */
  function listToStr($errors) {
    $l = array();
    foreach ($errors as $e) {
      $l[] = $e->toStr();
    }
    return implode('; ', $l);
  }
}

/* For when an error applies to a particular form or DB field */
class FieldError extends Error {
  /* public */
  var $field;
  function FieldError($field, $msg) {
    parent::Error($msg);
    $this->field = $field;
  }
  function listExtract($errors) {
    $msgs = array();
    $l = array();
    foreach ($errors as $e) {
      if (isset($e->field)) {
        $l[$e->field][] = $e->toStr();
      } else {
        $msgs[] = $e->toStr();
      }
    }
    $msg = implode(' ', $msgs);
    foreach ($l as $k=>$v) {
      $l[$k] = implode(' ', $v);
    }
    return array($msg, $l);
  }
  function backToForm($url, $errors) {
    list($msg, $fielderrs) = FieldError::listExtract($errors);
    $_SESSION["postVars"] = mkPostVars();
    $_SESSION["pageErrors"] = $fielderrs;
    if(strchr($url, '?')) {
      header("Location: ".$url."&msg=".U($msg));
    } else {
      header("Location: ".$url."?msg=".U($msg));
    }
    exit();
  }
}

/* Most DB errors are fatal, but we sometimes have to catch them. */
class DbError extends Error {
  /* The attributes here are public. */
  var $sql;
  var $msg;
  var $dberror;
  function DbError($sql, $msg, $dberror) {
    $this->sql = $sql;
    $this->msg = $msg;
    $this->dberror = $dberror;
  }
  function toStr() {
    $s = $this->msg.': '.$this->dberror;
    if ($this->sql) {
      $s .= ' -- FULL SQL: '.$this->sql;
    }
    return $s;
  }
}

/* These may be errors, but a user with proper privilege can force
 * them to be ignored.
 */
class IgnorableError extends Error {
}
class IgnorableFieldError extends IgnorableError {
  /* public */
  var $field;
  function IgnorableFieldError($field, $msg) {
    parent::Error($msg);
    $this->field = $field;
  }
}

/* FIXME - TEMPORARY - We need to replace all assert() calls with Fatal::*() calls. */
  function obibAssertHandler($file, $line, $code) {
    echo "<h1>Assertion Failure - You've Probably Found a Bug</h1>\n";
    echo "<p>Please give all the information on this page to your support personnel.</p>\n";
    echo "<p>".H('Assertion '.$code.' is FALSE at '.$file.':'.$line)."</p>\n";
    if (function_exists('debug_backtrace')) {
      echo "<h2>Debug Backtrace (most recent call first):</h2>\n";
      echo '<pre>';
      foreach(array_slice(debug_backtrace(), 1) as $frame) {
        echo H($frame['file'].':'.$frame['line'].' ');
        if (isset($frame['class'])) {
          echo H($frame['class'].$frame['type']);
        }
        if (isset($frame['function'])) {
          echo H($frame['function'].'(');
          if (is_array($frame['args'])) {
            $args = array();
            foreach ($frame['args'] as $a) {
              array_push($args, var_export($a, true));
            }
            echo H(implode($args, ', '));
          }
          echo ')';
        }
        echo "\n";
      }
      echo '</pre>';
    }
    exit(1);
  }
  assert_options(ASSERT_CALLBACK, "obibAssertHandler");

/* Fatal Errors */
class Fatal {
  /* Override default behaviour, e.g. for suppressing errors, unit testing, etc. */
  function setHandler(&$obj) {
    global $_Error_FatalHandler;
    $old =& $_Error_FatalHandler;
    $_Error_FatalHandler = $class;
    return $old;
  }
  /* "Can't happen" states */
  function internalError($msg) {
    global $_Error_FatalHandler;
    if (method_exists($_Error_FatalHandler, 'internalError')) {
      $_Error_FatalHandler->internalError($msg);
    } else {
      Fatal::error(T("Internal Error: %msg%", array('msg'=>$msg)));
    }
  }
  /* Query errors */
  function dbError($sql, $msg, $dberror) {
    global $_Error_FatalHandler;
    if (method_exists($_Error_FatalHandler, 'dbError')) {
      $_Error_FatalHandler->dbError($sql, $msg, $dberror);
    } else {
      Fatal::error(T('ErrorDatabase', array('msg'=>$msg, 'sql'=>$sql, 'dberror'=>$dberror)));
    }
  }
  /* Need a lock and can't get it */
  function cantLock() {
    global $_Error_FatalHandler;
    if (method_exists($_Error_FatalHandler, 'cantLock')) {
      $_Error_FatalHandler->cantLock();
    } else {
      Fatal::error(T("Cannot get database lock"));
    }
  }
  /* Generic */
  function error($msg) {
    global $_Error_FatalHandler;
    if (method_exists($_Error_FatalHandler, 'error')) {
      $_Error_FatalHandler->error($msg);
    } else {
      die($msg);
    }
  }
}

/* error is the only required method */
class FatalHandler {
  /* FIXME - Internationalize this stuff */
  function internalError($msg) {
    echo "<h1>".T('ErrorInternalFoundBug')."</h1>\n";
    echo "<p>".T('ErrorInfoToSupport')."</p>\n";
    echo "<p>".H($msg)."</p>\n";
    $this->printBackTrace();
    exit(1);
  }
  function dbError($sql, $msg, $dberror) {
    echo "<h1>".T('ErrorDbQuery')."</h1>\n";
    echo "<h2>".H($msg)."</h2>\n";
    echo "<p>".T('ErrorInfoToSupport')."</p>\n";
    echo "<p>".T('ErrorQueryFailed', array('query'=>H($sql)))."</p>\n";
    echo "<pre>".H($dberror)."</pre>";
    $this->printBackTrace();
    exit(1);
  }
  function cantLock() {
    # FIXME - This should return to the previous page, preserving form values.
    include(REL(__FILE__, '../shared/lock_fatal.php'));
    exit(0);
  }
  function error($msg) {
    echo "<h1>".T("Fatal Error")."</h1>\n";
    echo "<h2>".H($msg)."</h2>\n";
    $this->printBackTrace();
    exit(1);
  }
  function printBackTrace() {
    if (function_exists('debug_backtrace')) {
      echo "<h2>".T('ErrorDebugBacktrace')."</h2>\n";
      echo '<pre>';
      foreach(debug_backtrace() as $frame) {
        # As usual, PHP makes things more complicated.  This time by
        # deciding that all elements of the stack frame are optional.  Sigh.
        if (isset($frame['file'])) {
          echo H($frame['file'].':');
        } else {
          echo '?file?:';
        }
        if (isset($frame['line'])) {
          echo H($frame['line'].' ');
        } else {
          echo '?line? ';
        }
        if (isset($frame['class']) and isset($frame['type'])) {
          echo H($frame['class'].$frame['type']);
        }
        if (isset($frame['function'])) {
          echo H($frame['function'].'(');
          if (isset($frame['args'])) {
            $args = array();
            foreach ($frame['args'] as $a) {
              array_push($args, var_export($a, true));
            }
            echo H(implode($args, ', '));
          } else {
            echo '???';
          }
          echo ')';
        }
        echo "\n";
      }
      echo '</pre>';
    }
  }
}

$_Error_FatalHandler = new FatalHandler;