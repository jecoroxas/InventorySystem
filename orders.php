<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} else if($_GET['o'] == 'returnOrd') { 
	echo "<div class='div-request div-hide'>returnOrd</div>";
} // /else manage order


?>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>
   <?php echo ($_GET['o'] == 'returnOrd') ? "Return" : "Request"; ?>
  </li> 
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Request
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Request
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Request";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Request";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Request";
	}else if($_GET['o'] == 'returnOrd') { 
		echo "Return";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Request
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Request
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Request
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php">
			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Request Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Borrowers Name" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="studentNumber" class="col-sm-2 control-label">Student Number</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="studentNumber" name="studentNumber" placeholder="Students Number" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
			    <label for="college" class="col-sm-2 control-label">College</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="college" name="college" placeholder="college" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
			    <label for="course" class="col-sm-2 control-label">Course</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="course" name="course" placeholder="course" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->			  
			  <div class="form-group">
			    <label for="yearLevel" class="col-sm-2 control-label">Year Level</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="yearLevel" name="yearLevel" placeholder="Year Level" autocomplete="off" required />
			    </div>
			  </div> <!--/form-group-->			  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Size</th>
			  			<th style="width:10%;">Available Quantity</th>
			  			<th style="width:15%;">Quantity <br><small>(Enter to update)</small></th>			  			
			  			<th style="width:25%;">Total items left</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				 <!-- Display the categories here -->
       
      </td>
      <td style="padding-left:20px;">
        <div class="form-group">
		<div class="col-sm-8">
				      <select class="form-control" id="size" name="size[]" required>
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
        <input type="hidden" name="categoryId[]" id="categoryId<?php echo $x; ?>" autocomplete="off" class="form-control" />
        </div>
      </td>
	  
							<td style="padding-left:20px;">
			  					<div class="form-group">
									<p id="available_quantity<?php echo $x; ?>"></p>
									<input type="hidden" id="available_quantityValue<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />

			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control quantity-input" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-danger" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table table-hover table-striped table-bordered" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Date</th>
						<th>Name</th>
						<th>Student Number</th>
						<th>Total Borrowed Item</th>
						<th>Status</th>
						<th>Options</th>
					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.student_Number,  orders.payment_status FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Request Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="studentNumber" class="col-sm-2 control-label">Student Number</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="studentNumber" name="studentNumber" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> <!--/form-group-->			  

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Equipment</th>
			  			<th style="width:20%;">Category</th>
			  			<th style="width:15%;">Available Quantity</th>			  			
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total Items Left</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.brand, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
								
			  				</td>
							  <!-- categories -->
							  <td style="padding-left:20px;">
        <!-- Display the categories here -->
        <input type="text" name="categories[]" id="categories<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />
        <input type="hidden" name="categoriesValue[]" id="categorieValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
      </td>
      <td style="padding-left:20px;">
        <div class="form-group">
          <!-- Display the available categories_id here -->
          <p id="available_categories<?php echo $x; ?>"></p>
        </div>
      </td>
							<!-- categories -->

							<td style="padding-left:20px;">
			  					<div class="form-group">
									<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) { 
			  									echo "<p id='available_quantity".$row['product_id']."'>".$row['quantity']."</p>";
											}
			  								 else {
			  									$selected = "";
			  								}

			  								//echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
									
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			 </div> 


			<?php
			
		} else if($_GET['o'] == 'returnOrd') {
		?>

<div class="success-messages"></div> <!--/success-messages-->


	<?php $orderId = $_GET['i'];

	$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.student_Number,  orders.payment_status FROM orders 	
		  WHERE orders.order_id = {$orderId}";

	  $result = $connect->query($sql);
	  $data = $result->fetch_row();
	?>

	Client Name: <?php echo $data[2]; ?>

	<form action="php_action/returnOrder.php" method="POST">
		<input type="hidden" name="orderId" value="<?php echo $orderId; ?>" />
		
		<?php
			$orderItemSql = "SELECT 
								order_item.order_item_id, 
								order_item.order_id, 
								order_item.product_id, 
								order_item.quantity, 
								order_item.brand, 
								order_item.total,
								product.product_name
							FROM 
								order_item
							LEFT JOIN 
								product ON order_item.product_id = product.product_id
							WHERE 
								order_item.order_id = {$orderId} AND order_item.isReturned = 0";

			$orderItemResult = $connect->query($orderItemSql);
			
			while ($orderItemData = $orderItemResult->fetch_array()) {
				?>
				<div>
					<label>
					<?php echo $orderItemData['product_name']; ?>
					</label>
					<input type="checkbox" name="selected_items[]" value="<?php echo $orderItemData['order_item_id']; ?>">
				</div>
				<?php
			} // /while
			?>

			<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	
   </div> 

		<?php
		}
			// get order
		?>


	</div> 	
</div> 					  				   
      	        
      </div> <!--/modal-body-->
      <!-- <div class="modal-footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>            -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Request</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	