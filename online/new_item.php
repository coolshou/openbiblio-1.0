<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

  require_once("../shared/common.php");

  session_cache_limiter(null);

	$tab = "cataloging";
	$nav = "newItem";
  $focus_form_name = "lookupForm";
  $focus_form_field = "lookupVal";

	$isbnTxt    = T("ISBN");
	$issnTxt    = T("ISSN");
	$lccnTxt    = T("LCCN");
	$titleTxt   = T("Title");
	$authorTxt  = T("Author");
	$keywordTxt = T("Keyword");
	$pubDateTxt = T("Publication Date");
	$pubNameTxt = T("Publisher");
	$pubLocTxt  = T("Publication Location");
		
  require_once(REL(__FILE__, "../functions/inputFuncs.php"));
  require_once(REL(__FILE__, "../shared/logincheck.php"));
  
 	require_once(REL(__FILE__, "../model/MediaTypes.php"));
	require_once(REL(__FILE__, "../model/Collections.php"));
	
	$defBarcodeDigits = $_SESSION[item_barcode_width];
	Page::header(array('nav'=>$tab.'/'.$nav, 'title'=>''));
?>
<style>
h4 {
	margin: 0; padding: 0; text-align: left; color: blue;
	}
h5 {
	margin: 0; padding: 0; text-align: left; color: blue;
	}
h5#updateMsg {
	color: red;
	}
p#errMsgTxt {
	color: red; text-align: center;
	}
table#showList tr {
	height: 1.3em;
	}
th.colHead {
  white-space: nowrap;
	}
td.lblFld {
  white-space: nowrap;
	}
td.inptFld {
  vertical-align: top;
	}
td.btnFld {
  text-align: center;
	}
.editBtn {
	margin: 0; padding: 0; height: 1.5em; text-align:center;
	}
</style>

	<h3><?php echo T('Add New Item'); ?></h3>

	<div id="searchDiv">
	  <input type="button" id="manualBtn" value="Manual Entry" />
	  <br />
		<form id="lookupForm" name="lookupForm" action="" >
		<fieldset>
		<legend>On-Line Search</legend>
		<table>
		<thead>
		<tr>
		  <th class="colLbl">What to search for:</th>
		  <th class="colLbl">Which is a:</th>
		</tr>
		</thead>
		<tbody>
		<tr id="fldset1">
		  <td class="inptFld"><input id="lookupVal" name="lookupVal" type="text" class="criteria"></td>
		  <td class="inptFld">
		  	<select id="srchBy" name="srchBy" class="criteria">
		  		<option value="7" selected><?php echo $isbnTxt; ?></option>
		  		<option value="8"><?php echo $issnTxt; ?></option>
		  		<option value="9"><?php echo $lccnTxt; ?></option>
		  		<option value="4"><?php echo $titleTxt; ?></option>
		  		<!--option value="1016"\>$isbnTxt; ?></option-->
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo T("And");?></td>
		</tr>
		<tr id="fldset2">
		  <td class="inptFld"><input id="lookupVal2" name="lookupVal2" type="text" class="criteria"></td>
		  <td class="inptFld">
		  	<select id="srchBy2" name="srchBy2" class="criteria">
		  		<option value="0"></option>
		  		<option value="1004"><?php echo $authorTxt; ?></option>
		  		<option value="1018"><?php echo $pubNameTxt; ?></option>
		  		<option value="59"><?php echo $pubLocTxt; ?></option>
		  		<option value="31"><?php echo $pubDateTxt; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo T("And");?></td>
		</tr>
		<tr id="fldset3">
		  <td class="inptFld"><input id="lookupVal3" name="lookupVal3" type="text" class="criteria"></td>
		  <td class="inptFld">
		  	<select id="srchBy3" name="srchBy3" class="criteria">
		  		<option value="0"></option>
		  		<option value="1018"><?php echo $pubNameTxt; ?></option>
		  		<option value="59"><?php echo $pubLocTxt; ?></option>
		  		<option value="31"><?php echo $pubDateTxt; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo T("And");?></td>
		</tr>
		<tr id="fldset4">
		  <td class="inptFld"><input id="lookupVal4" name="lookupVal4" type="text" class="criteria"></td>
		  <td class="inptFld">
		  	<select id="srchBy4" name="srchBy4" class="criteria">
		  		<option value="0"></option>
		  		<option value="59"><?php echo $pubLocTxt; ?></option>
		  		<option value="1018"><?php echo $pubNameTxt; ?></option>
		  		<option value="31"><?php echo $pubDateTxt; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo T("And");?></td>
		</tr>
		<tr id="fldset5">
		  <td class="inptFld"><input id="lookupVal5" name="lookupVal5" type="text" class="criteria"></td>
		  <td class="inptFld">
		  	<select id="srchBy5" name="srchBy5" class="criteria">
		  		<option value="0"></option>
		  		<option value="31"><?php echo $pubDateTxt; ?></option>
		  		<option value="1018"><?php echo $pubNameTxt; ?></option>
		  		<option value="59"><?php echo $pubLocTxt; ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input type="hidden" id="mode" name="mode" value="search" />
			</td>
		</tr>
		</tbody>

		<tfoot>
		<tr>
		  <td colspan="2" class="btnFld" >
				<input type="submit" id="srchBtn" name="srchBtn"
							 value="<?php echo T("Search");?>" />
			</td>
		</tr>
		</tfoot>
		</table>
		</fieldset>
		<p id="errMsgTxt"></p>
		</form>
	</div>
	
	<div id="waitDiv">
		<table>
		<tr>
			<th colspan="1"><?php echo T("lookup_patience");?></th>
		</tr>
		<tr>
		  <td colspan="1"><span id="waitText"></span></td>
		</tr>
		<tr>
	    <td align="center" colspan="1">
	      <fieldset><?php echo T("lookup_resetInstr");?></fieldset>
			</td>
		</tr>
		</table>
	</div>

	<div id="retryDiv">
	  <form action="">
	  <fieldset>
	  <legend id="retryHead"></legend>
		<table>
		<tr>
			<th colspan="3" ></th>
		</tr>
		<tr>
			<td colspan="3" id="retryMsg"></td>
		</tr>
		<tr>
	    <td colspan="3" class="btnFld">
				<input id="retryBtn" type="submit" value="<?php echo T("Go Back");?>" />
			</td>
		</tr>
		</table>
		</fieldset>
		</form>
	</div>

	<div id="choiceDiv">
		<input id="choiceBtn1" type="button" class="btnFld"value="<?php echo T("Go Back");?>" />
		<span id="hitInfo">
			<?php echo T("Success!")." "; ?><span id="ttlHits"></span><?php echo " ".T("hits found"); ?>
		</span>
	  <div id="choiceSpace">
			Search Results go here
		</div>
		<input id="choiceBtn2" type="button" class="button btnFld" value="<?php echo T("Go Back");?>" />
	</div>

	<div id="divTest">
		<form id="frmTest">
		</form>
	</div>

	<div id="selectionDiv">
  	<!-- submit action handled by javascript code -->
   	<form id="newbiblioform" name="newbiblioform" action="" >
			<p class="note"><?php echo T("Fields marked are required"); ?></p>
			<input type="button" class="button itemGobkBtn" value="<?php echo T('Go Back'); ?>" />
			<?php
				include(REL(__FILE__,"../catalog/item_editor.php"));
			?>
			<input type="submit" id="itemSubmitBtn" value="<?php echo T("Submit"); ?>" />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" value="<?php echo T("Go Back"); ?>" class="itemGobkBtn" />
		</form>
	</div>

	<div id="copyEditorDiv">
		<?php include_once(REL(__FILE__,"../catalog/biblio_copy_editor.php"));?>
	</div>

<?php
	require_once("../themes/".Settings::get('theme_dir_url')."/footer.php");
	
	require_once(REL(__FILE__, "new_ItemJs.php"));
?>	
