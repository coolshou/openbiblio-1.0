<script language="JavaScript" >
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
// JavaScript Document
"use strict";

class Sit extends Admin {
    constructor () {
    	var url = '../admin/adminSrvr.php',
    		form = $('#editForm'),
    		dbAlias = 'sites';
    	var hdrs = {'listHdr':<?php echo '"'.T("List of Sites").'"'; ?>,
    				'editHdr':<?php echo '"'.T("Edit Site").'"'; ?>,
    				'newHdr':<?php echo '"'.T("Add New Site").'"'; ?>,
    				};
    	var listFlds = {'name': 'text',
    					'code': 'text',
    					'city':'text',
    				   };
    	var opts = { 'focusFld':'name', 'keyFld':'siteid' };

	    super( url, form, dbAlias, hdrs, listFlds, opts );

    	this.noshows = [];
	    this.fetchStates();
	    this.fetchCalendars();

        $('#country').val('xxxx');
    };

    fetchStates () {
        list.getPullDownList('State', $('#state'));
    };

    fetchCalendars () {
        list.getPullDownList('Calendar', $('#calendar'));
    };

    doNewFields (e) {
        var localeCntry = navigator.language.slice(-2);
        //console.log("country is "+localeCntry);

        super.doNewFields.apply(this);
        //console.log('got here');
        $('#country').val(localeCntry);
    	$('#editDiv').show();
    }
}

$(document).ready(function () {
	var xxxx = new Sit();
});

</script>
