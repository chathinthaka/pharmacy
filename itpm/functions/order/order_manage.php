<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="../../css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body>

<div class="sidenav">
	<a href="#inventory">Inventory</a>
	<a href="#customer">Customer</a>
	<a href="#order">Order</a>
	<a href="#supplier">Supplier</a>
</div>

<!--===================================================================-->

<div class="main">
	<h3 style="padding: 20px; margin: 0px; color: white; background-color: #111;" align="center">Order Management</h3>

	<button class="tablink" onclick="openPage('Home', this, 'gray')" id="defaultOpen">Manage</button>
	<button class="tablink" onclick="openPage('report', this, 'gray')">Report</button>

	<div id="Home" class="tabcontent">
		<?php
			include 'table.php';
		?>
	</div>
	<div id="report" class="tabcontent">
		<h3>report</h3>
		<p>This page is for the report!!</p>
	</div>
</div>

<script>
	function openPage(pageName,elmnt,color) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < tablinks.length; i++) {
		tablinks[i].style.backgroundColor = "";
		}
		document.getElementById(pageName).style.display = "block";
		elmnt.style.backgroundColor = color;
	}

	document.getElementById("defaultOpen").click();
</script>
   
</body>
</html> 
