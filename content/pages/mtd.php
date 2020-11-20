<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/main/main.css">

    <link rel="stylesheet" href="../../assets/css/dt/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/css/dt/responsive.dataTables.min.css">

	<title> MTD | Sales Report </title>
</head>
<body>
	<div style="height: 100px;"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-0">
					<nav class="navbar navbar-light bg-light">
					</nav>
				  	<div class="card-body">
				  		<table id="tmtd" class="table table-striped responsive nowrap">
					        <thead>
					            <tr>
					            	<th></th>
					            	<th>DB No</th>
					                <th>Order Type</th>
					                <th>Order No</th>
					                <th>DSM</th>
					                <th>Item No</th>
					                <th>Category</th>
					                <th>Description</th>
					                <th>Customer</th>
					                <th>Invoice No</th>
					                <th>QO</th>
					                <th>QTS</th>
					                <th>UC</th>
					                <th>UP</th>
					                <th>Request Date</th>
					                <th>QBO</th>
					                <th>QRTS</th>
					                <th>UOM</th>
					                <th>TQO</th>
					                <th>TQS</th>
					                <th>Price Org</th>
					                <th>Last PO Date</th>
					                <th>UF1</th>
					                <th>UF2</th>
					                <th>UF3</th>
					                <th>UF4</th>
					                <th>UF5</th>
					            </tr>
					        </thead>
					        <tbody>
					        </tbody>
					        <tfoot>
					            <tr>
					            	<th></th>
					                <th>DB No</th>
					                <th>Order Type</th>
					                <th>Order No</th>
					                <th>DSM</th>
					                <th>Item No</th>
					                <th>Category</th>
					                <th>Description</th>
					                <th>Customer</th>
					                <th>Invoice No</th>
					                <th>QO</th>
					                <th>QTS</th>
					                <th>UC</th>
					                <th>UP</th>
					                <th>Request Date</th>
					                <th>QBO</th>
					                <th>QRTS</th>
					                <th>UOM</th>
					                <th>TQO</th>
					                <th>TQS</th>
					                <th>Price Org</th>
					                <th>Last PO Date</th>
					                <th>UF1</th>
					                <th>UF2</th>
					                <th>UF3</th>
					                <th>UF4</th>
					                <th>UF5</th>
					            </tr>
					        </tfoot>
					    </table>
				  	</div>
				</div>
			</div>
		</div>
	</div>


	<?php
	require '../parts/modal/mdlmtddata.php';

	?>

    <script src="../../assets/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../assets/js/popper/popper.min.js"></script>
    <script src="../../assets/js/bs/bootstrap.min.js"></script>

    <script src="../../assets/js/dt/jquery.dataTables.min.js"></script>
   	<script src="../../assets/js/dt/dataTables.bootstrap4.min.js"></script>
	<script src="../../assets/js/dt/dataTables.responsive.min.js"></script>

    <script src="../../assets/js/dt/dataTables.buttons.min.js"></script>   
    <script src="../../assets/js/dt/buttons.flash.min.js"></script>    
    <script src="../../assets/js/dt/buttons.html5.min.js"></script>    
    <script src="../../assets/js/dt/buttons.print.min.js"></script>
    <script src="../../assets/js/dt/jszip.min.js"></script>    
    <script src="../../assets/js/dt/pdfmake.min.js"></script>    
    <script src="../../assets/js/dt/vfs_fonts.js"></script> 

    <script src="../../assets/js/main/main.js?1"></script>

    

</body>
</html>