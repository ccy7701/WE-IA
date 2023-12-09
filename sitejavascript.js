// external JavaScript document (sitejavascript.js)

function adjustTopnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    }
    else {
        x.className = "topnav";
    }
}

function redirect(target) {
	window.location.href = target;
}

function popup(message, target) {
	let text = message;
	alert(text);
	redirect(target);
}

function addToTable() {
    // Get all form values
	var yr = document.forms["myForm"]["year"].value;
	var ch = document.forms["myForm"]["challenge"].value;
	var pl = document.forms["myForm"]["plan"].value;
	var re = document.forms["myForm"]["remark"].value;
	var table = document.getElementById("projectable");

    // Validate if year is in the format of YYYY/YYYY
    var yearPattern = /^\d{4}\/\d{4}$/;
    if (!yearPattern.test(yr)) {
        return;
    }

    //Get current number of rows in table by id=projectable
	var numRows = table.rows.length;
			
	//Validate if year, challenge, and plan are empty
	if(yr == "" || ch == "" || pl == ""){
		alert("Required field must be filled out");
	}
	else {
	    //Show confirm box to ask if form values will be 
		//added to the table id=projectable
		if(confirm("Add to table?")==true){
			// Find a <table> element with id="projectable":
			var table = document.getElementById("projectable");

			// Create an empty <tr> element and add it to the
			// 1st position of the table:
			var row = table.insertRow();		

			// Insert new cells (<td> elements) at the 1st 
			// and 2nd position of the "new" <tr> element:
			var cell1 = row.insertCell(0);
			var cell2 = row.insertCell(1);
			var cell3 = row.insertCell(2);
			var cell4 = row.insertCell(3);
			var cell5 = row.insertCell(4);

			// Add values to the new cells:
			cell1.innerHTML = numRows;
			cell2.innerHTML = yr;
			cell3.innerHTML = ch;
			cell4.innerHTML = pl;
			//Remark is optional, so if empty then add white
			//space to the cell
			if(re=="") cell5.innerHTML = "&nbsp;";
				else cell5.innerHTML = re;
		    }
        }
}