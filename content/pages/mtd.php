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

    <link rel="icon" href="../../assets/img/logo/logo.png" type="image/gif" sizes="30x30">

	<title> MTD | Sales Report </title>
</head>
<body>
	<div id="overlay">
	</div>
	<div style="height: 100px;"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="card border-0">
					<nav class="navbar navbar-light bg-light">
					</nav>
				  	<div class="card-body">
				  		<table id="tmtd" class="table table-striped responsive nowrap" width="100%">
					        <thead>
					            <tr>
					            	<th></th>
					            	<th>DBNO</th>
					            	<th>SALESMAN</th>
					            	<th>DSM</th>
					            	<th>DSMSORT</th>
					            	<th>BRANCH</th>
					            	<th>OT</th>
					            	<th>ORDER NO</th>
					            	<th>SEQUENCE NO</th>
					            	<th>ITEM NO</th>
					            	<th>PROD CAT</th>
					            	<th>ITEM CAT</th>
					            	<th>SKU</th>
					            	<th>LOCATION</th>
					            	<th>QTY ORDERED</th>
					            	<th>QTY TOSHIP</th>
					            	<th>UNIT PRICE</th>
					            	<th>REQUEST DATE</th>
					            	<th>QBO</th>
					            	<th>QRTS</th>
					            	<th>UOM</th>
					            	<th>UNIT COST</th>
					            	<th>TQO</th>
					            	<th>TQS</th>
					            	<th>PRICE ORIG</th>
					            	<th>LPD</th>
					            	<th>IPC</th>
					            	<th>UF1</th>
					            	<th>UF2</th>
					            	<th>UF3</th>
					            	<th>UF4</th>
					            	<th>UF5</th>
					            	<th>CUSTOMER</th>
					            	<th>ADDRESS</th>
					            	<th>CUST TIN</th>
					            	<th>CUST TYPE</th>
					            	<th>PROVINCIAL</th>
					            	<th>REGIONS</th>
					            	<th>INVOICE NO</th>
					            	<th>INVOICE DATE</th>
					            	<th>GROSS</th>
					            	<th>NET</th>
					            </tr>
					        </thead>
					        <tbody>
					        </tbody>
					        <tfoot>
					            <tr>
					            	<th></th>
					            	<th>DBNO</th>
					            	<th>SALESMAN</th>
					            	<th>DSM</th>
					            	<th>DSMSORT</th>
					            	<th>BRANCH</th>
					            	<th>OT</th>
					            	<th>ORDER NO</th>
					            	<th>SEQUENCE NO</th>
					            	<th>ITEM NO</th>
					            	<th>ITEM CAT</th>
					            	<th>PROD CAT</th>
					            	<th>SKU</th>
					            	<th>LOCATION</th>
					            	<th>QTY ORDERED</th>
					            	<th>QTY TOSHIP</th>
					            	<th>UNIT PRICE</th>
					            	<th>REQUEST DATE</th>
					            	<th>QBO</th>
					            	<th>QRTS</th>
					            	<th>UOM</th>
					            	<th>UNIT COST</th>
					            	<th>TQO</th>
					            	<th>TQS</th>
					            	<th>PRICE ORIG</th>
					            	<th>LPD</th>
					            	<th>IPC</th>
					            	<th>UF1</th>
					            	<th>UF2</th>
					            	<th>UF3</th>
					            	<th>UF4</th>
					            	<th>UF5</th>
					            	<th>CUSTOMER</th>
					            	<th>ADDRESS</th>
					            	<th>CUST TIN</th>
					            	<th>CUST TYPE</th>
					            	<th>PROVINCIAL</th>
					            	<th>REGIONS</th>
					            	<th>INVOICE NO</th>
					            	<th>INVOICE DATE</th>
					            	<th>GROSS</th>
					            	<th>NET</th>
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