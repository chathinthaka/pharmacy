<html>  
    <head>  
        <title>PHP Ajax Crud using JQuery UI Dialog Box</title>  
		<link rel="stylesheet" href="../../css/jquery-ui.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" />
		<script src="../../js/jquery.min.js"></script>  
		<script src="../../js/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			<div align="right" style="margin-bottom:5px;">
			<button type="button" name="add" id="add" class="btn btn-success btn-xs">Add</button>
			</div>
			<div class="table-responsive" id="user_data">
				
			</div>
			<br />
		</div>
		
		<div id="user_dialog" title="Add Data">
			<form method="post" id="user_form">
				<div class="form-group">
					<label>Enter Customer Name</label>
					<input type="text" name="customer_name" id="customer_name" class="form-control" />
					<span id="error_customer_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Product Name</label>
					<input type="text" name="product_name" id="product_name" class="form-control" />
					<span id="error_product_name" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Quantity</label>
					<input type="text" name="quantity" id="quantity" class="form-control" />
					<span id="error_quantity" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Unit Price</label>
					<input type="text" name="unit_price" id="unit_price" class="form-control" />
					<span id="error_unit_price" class="text-danger"></span>
				</div>
				<div class="form-group">
					<label>Enter Staus</label>
					<input type="text" name="status" id="status" class="form-control" />
					<span id="error_status" class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="action" id="action" value="insert" />
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="submit" name="form_action" id="form_action" class="btn btn-info" value="Insert" />
				</div>
			</form>
		</div>
		
		<div id="action_alert" title="Action">
			
		</div>
		
		<div id="delete_confirmation" title="Confirmation">
		<p>Are you sure you want to Delete this data?</p>
		</div>
		
    </body>  
</html>  




<script>  
$(document).ready(function(){  

	load_data();
    
	function load_data()
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			success:function(data)
			{
				$('#user_data').html(data);
			}
		});
	}
	
	$("#user_dialog").dialog({
		autoOpen:false,
		width:400
	});
	
	$('#add').click(function(){
		$('#user_dialog').attr('title', 'Add Data');
		$('#action').val('insert');
		$('#form_action').val('Insert');
		$('#user_form')[0].reset();
		$('#form_action').attr('disabled', false);
		$("#user_dialog").dialog('open');
	});
	
	$('#user_form').on('submit', function(event){
		event.preventDefault();
		var error_customer_name = '';
		var error_product_name = '';
		var error_quantity = '';
		var error_unit_price = '';
		var error_status = '';

		if($('#customer_name').val() == '')
		{
			error_customer_name = 'Customer Name is required';
			$('#error_customer_name').text(error_customer_name);
			$('#customer_name').css('border-color', '#cc0000');
		}
		else
		{
			error_customer_name = '';
			$('#error_customer_name').text(error_customer_name);
			$('#customer_name').css('border-color', '');
		}

		if($('#product_name').val() == '')
		{
			error_product_name = 'Customer number is required';
			$('#error_product_name').text(error_product_name);
			$('#product_name').css('border-color', '#cc0000');
		}
		else
		{
			error_product_name = '';
			$('#error_product_name').text(error_product_name);
			$('#product_name').css('border-color', '');
		}

		if($('#quantity').val() == '')
		{
			error_quantity = 'Password is required';
			$('#error_quantity').text(error_quantity);
			$('#quantity').css('border-color', '#cc0000');
		}
		else
		{
			error_quantity = '';
			$('#error_quantity').text(error_quantity);
			$('#quantity').css('border-color', '');
		}

		if($('#unit_price').val() == '')
		{
			error_unit_price = 'Password is required';
			$('#error_unit_price').text(error_unit_price);
			$('#unit_price').css('border-color', '#cc0000');
		}
		else
		{
			error_unit_price = '';
			$('#error_unit_price').text(error_unit_price);
			$('#unit_price').css('border-color', '');
		}

		if($('#status').val() == '')
		{
			error_status = 'Status is required';
			$('#error_status').text(error_status);
			$('#status').css('border-color', '#cc0000');
		}
		else
		{
			error_status = '';
			$('#error_status').text(error_status);
			$('#status').css('border-color', '');
		}
		
		if(error_customer_name != '' || error_product_name != '' || error_quantity != '' || error_unit_price != '' || error_status != '')
		{
			return false;
		}
		else
		{
			$('#form_action').attr('disabled', 'disabled');
			var form_data = $(this).serialize();
			$.ajax({
				url:"action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					$('#user_dialog').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
					$('#form_action').attr('disabled', false);
				}
			});
		}
		
	});
	
	$('#action_alert').dialog({
		autoOpen:false
	});
	
	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#customer_name').val(data.customer_name);
				$('#product_name').val(data.product_name);
				$('#quantity').val(data.quantity);
				$('#unit_price').val(data.unit_price);
				$('#status').val(data.status);
				$('#user_dialog').attr('title', 'Edit Data');
				$('#action').val('update');
				$('#hidden_id').val(id);
				$('#form_action').val('Update');
				$('#user_dialog').dialog('open');
			}
		});
	});
	
	$('#delete_confirmation').dialog({
		autoOpen:false,
		modal: true,
		buttons:{
			Ok : function(){
				var id = $(this).data('id');
				var action = 'delete';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					success:function(data)
					{
						$('#delete_confirmation').dialog('close');
						$('#action_alert').html(data);
						$('#action_alert').dialog('open');
						load_data();
					}
				});
			},
			Cancel : function(){
				$(this).dialog('close');
			}
		}	
	});
	
	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});
	
});  
</script>