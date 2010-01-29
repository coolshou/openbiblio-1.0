<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
 	require_once(REL(__FILE__, "../model/BiblioCopyFields.php"));
	require_once(REL(__FILE__, "../model/Copies.php"));	
?>
<p class="note"><?php echo T("Fields marked are required"); ?></p>

<form id="copyForm" name="copyForm" >
<p id="editRsltMsg" class="error"></p>
<fieldset>
<legend><?php echo T("Add New Copy"); ?></legend>
<table id="copyTbl" class="primary">
	<tbody class="unstriped">
	<tr>
		<td nowrap="true" class="primary" valign="top">
			<label for="barcode_nmbr"><sup>*</sup><?php echo T('Barcode Number'); ?></label>
		</td>
		<td valign="top" class="primary">
			<?php echo inputfield('text','barcode_nmbr',NULL,array('size'=>'20',maxLength=>'20','class'=>'required')); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary" valign="top">
			<label for="autobarco"><?php echo T('Auto Barcode'); ?></label>
		</td>
		<td valign="top" class="primary">
			<?php echo inputfield("checkbox","autobarco",'Y',NULL,$_SESSION['item_autoBarcode_flg']); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary" valign="top">
			<label for="copy_desc"><?php echo T("Description"); ?></label>
		</td>
		<td valign="top" class="primary">
			<?php echo inputfield("text", "copy_desc", NULL, array("size"=>40,"max"=>40)); ?>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary" valign="top">
			<label for="copy_site"><?php echo T("Location"); ?></label>
		</td>
		<td valign="top" class="primary">
    	<select id="copy_site" name="copy_site">to be filled in by server</span>
		</td>
	</tr>
	<tr>
		<td nowrap="true" class="primary" valign="top">
			<label for="status_cd"><?php echo T("Status:");?></label></td>
		<td valign="top" class="primary">
			</select>
			<?php echo inputfield("select", "status_cd", "in", NULL,array(
			                      "na" =>"",
                            "in" =>T("IN"),
														"out"=>T("OUT"),
														"ln" =>T("LOAN"),
														"ord"=>T("ON_ORDER"),
														"crt"=>T("SHELVING_CART"),
														"hld"=>T("ON_HOLD"),
														));
			?>
		</td>
	</tr>
	<!-- Custom fields /-->
	<?php
		$BCQ = new BiblioCopyFields;
		$rows = $BCQ->getAll();
			
		while ($row = $rows->next()) {
			echo "<tr>";
			echo "<td nowrap=\"true\" class=\"primary\" valign=\"top\"><label for=\"custom_". $row["code"] . "\">" . T($row["description"]) . "</td>";
			echo "<td valign=\"top\" class=\"primary\">" . inputfield('text', 'custom_'.$row["code"], "",NULL) . "</td>";
			echo "</tr>";
		}					
	?>
	</tr>
	</tbody>
	
	<tfoot>
	<tr>
		<td align="center" colspan="2" class="primary">
			<!--input type="submit" id="copySubmitBtn" value="<?php echo T("Submit"); ?>" class="button" /-->
			<input type="button" id="copySubmitBtn" value="<?php echo T("Submit"); ?>" class="button" />
			<input type="button" id="copyCancelBtn" value="<?php echo T("Cancel"); ?>" class="button" />
		</td>
	</tr>
	</tfoot>
</table>
<input type="hidden" name="bibid" value="<?php echo $bibid;?>" />
</fieldset>
</form>