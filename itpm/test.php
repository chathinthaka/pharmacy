<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/test.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
</head>
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				<h1>logo</h1>
			</div>
			<div class="bread-crumb">
				<h3>ORDER MANAGEMENT &nbsp;>&nbsp; ORDER MANAGE</h3>
			</div>
		</div>
		<div class="content">
			<div class="menu-sidebar">
				<div class="menu-item" id="toggle">Menu Item 1</div>
				<div class="menu-item" id="third">Menu Item 2</div>
				<div class="menu-item">Menu Item 3</div>
			</div>
			<div class="table-area">
				<form>
					<input type="text" name="search" placeholder="Search">
					<button>Search</button>					
				</form>
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Customer Name</th>
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Status</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				<button>Add Order</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		const targetDiv = document.getElementById("third");
		const btn = document.getElementById("toggle");
		btn.onclick = function () {
		  if (targetDiv.style.display !== "none") {
		    targetDiv.style.display = "none";
		  } else {
		    targetDiv.style.display = "block";
		  }
		};

		$(document).ready(function(){

			var dataTable = $('#sample_data').DataTable({
				"processing" : true,
				"serverSide" : true,
				"order" : [],
				"ajax" : {
				url:"fetch.php",
				type:"POST"
				}
			});

			$('#sample_data').on('draw.dt', function(){
				$('#sample_data').Tabledit({
					url:'action.php',
					dataType:'json',
					columns:{
						identifier : [0, 'id'],
						editable:[[1, 'first_name'], [2, 'last_name'], [3, 'gender', '{"1":"Male","2":"Female"}']]
					},
					restoreButton:false,
					onSuccess:function(data, textStatus, jqXHR)
					{
						if(data.action == 'delete')
						{
							 $('#' + data.id).remove();
							 $('#sample_data').DataTable().ajax.reload();
						}
					}
				});
			});

		}); 
	</script>
</body>
</html>