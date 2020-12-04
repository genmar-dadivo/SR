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
				  		<table id="tmtd" class="table table-striped responsive nowrap">
					        <thead>
					            <tr>
					            	<th></th>
					            	<th>Order No</th>
					            	<th>DSM</th>
					            	<th>Inv No</th>
					            	<th>Item No</th>
					            	<th>QO</th>
					            	<th>QTS</th>
					            	<th>UP</th>
					            	<th>UC</th>
					            	<th>UP</th>
					            	<th>PO</th>
					            	<th>Customer</th>
					            </tr>
					        </thead>
					        <tbody>
					        </tbody>
					        <tfoot>
					            <tr>
					            	<th></th>
					            	<th>Order No</th>
					            	<th>DSM</th>
					            	<th>Inv No</th>
					            	<th>Item No</th>
					            	<th>QO</th>
					            	<th>QTS</th>
					            	<th>UP</th>
					            	<th>UC</th>
					            	<th>UP</th>
					            	<th>PO</th>
					            	<th>Customer</th>
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