<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../shared/common.php");

  $tab = "circulation";
  $nav = "checkin";
  $restrictInDemo = true;
  require_once(REL(__FILE__, "../shared/logincheck.php"));

  require_once(REL(__FILE__, "../model/Copies.php"));
  require_once(REL(__FILE__, "../model/History.php"));
  require_once(REL(__FILE__, "../model/Collections.php"));
  require_once(REL(__FILE__, "../model/Holds.php"));
  require_once(REL(__FILE__, "../model/Bookings.php"));
  require_once(REL(__FILE__, "../classes/MemberAccountTransaction.php"));
  require_once(REL(__FILE__, "../classes/MemberAccountQuery.php"));
  require_once(REL(__FILE__, "../functions/errorFuncs.php"));
  require_once(REL(__FILE__, "../functions/formatFuncs.php"));


  #****************************************************************************
  #*  Checking for post vars.  Go back to form if none found.
  #****************************************************************************

  if (count($_POST) == 0) {
    header("Location: ../circ/checkin_form.php?reset=Y");
    exit();
  }

  function userError($msg) {
    global $loc;
    $pageErrors = array();
    $postVars = array();
    $pageErrors["barcodeNmbr"] = T($msg);
    $postVars["barcodeNmbr"] = $_POST["barcodeNmbr"];
    $_SESSION["postVars"] = $postVars;
    $_SESSION["pageErrors"] = $pageErrors;
    header("Location: ../circ/checkin_form.php");
    exit();
  }

  $barcode = $_POST["barcodeNmbr"];

  #****************************************************************************
  #*  Ready copy record
  #****************************************************************************
  $copies = new Copies;
  $copy = $copies->getByBarcode($barcode);

  if (!$copy) {
    userError(T("No copy with that barcode"));
  }

  $history = new History;
  $status = $history->getOne($copy['histid']);
  $bookings = new Bookings;
  $booking = $bookings->getByHistid($copy['histid']);	# May be null

  #**************************************************************************
  #*  Check hold list to see if someone has the copy on hold
  #**************************************************************************
  $holds = new Holds;
  $hold = $holds->getFirstHold($copy['copyid']);

  #**************************************************************************
  #*  Update copy status code
  #**************************************************************************
  if ($hold) {
    $newStatus = OBIB_STATUS_ON_HOLD;
  } else {
    $newStatus = OBIB_STATUS_SHELVING_CART;
  }
  $hist = array(
    'bibid'=>$copy['bibid'],
    'copyid'=>$copy['copyid'],
    'status_cd'=>$newStatus,
  );
  if ($booking) {
    $hist['bookingid'] = $booking['bookingid'];
  }
  $history->insert($hist);

  #**************************************************************************
  #*  Calc late fee if any
  #**************************************************************************
  if ($booking) {
    $daysLate = $bookings->getDaysLate($booking);
    $collections = new Collections;
    $coll = $collections->getByBibid($booking['bibid']);
    $dailyLateFee = $coll['daily_late_fee'];
    if (($daysLate > 0) and ($dailyLateFee > 0)) {
      $fee = $dailyLateFee * $daysLate;
      $trans = new MemberAccountTransaction();
      $trans->setMbrid($saveMbrid);
      $trans->setCreateUserid($_SESSION["userid"]);
      $trans->setTransactionTypeCd("+c");
      $trans->setAmount($fee);
      $trans->setDescription(T("Late fee (barcode=%barcode%)", array("barcode" => $barcode)));

      $transQ = new MemberAccountQuery();
      $transQ->connect();
      if ($transQ->errorOccurred()) {
        $transQ->close();
        displayErrorPage($transQ);
      }
      $trans = $transQ->insert($trans);
      if ($transQ->errorOccurred()) {
        $transQ->close();
        displayErrorPage($transQ);
      }
      $transQ->close();
    }
  }

  $msg = T("%barcode% added to shelving cart.", array('barcode'=>$barcode));
  if (!$booking) {
    $msg .= T(" THIS ITEM WAS NOT CHECKED OUT.");
  }
  #**************************************************************************
  #*  Go back to member view
  #**************************************************************************
  if ($hold) {
    header("Location: ../circ/hold_message.php?barcode=".U($barcode));
  } else {
    header("Location: ../circ/checkin_form.php?msg=".U($msg));
  }
