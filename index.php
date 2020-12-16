<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main/main.css">

    <link rel="icon" href="assets/img/logo/logo.png" type="image/gif" sizes="30x30">

	<title> Sales Report </title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col mx-auto">
				<div style="height: 100px;"></div>
				<form method="POST" id="rawdataprocess">
					<div class="row">
						<div class="col">
							<textarea name="rawdata" id="rawdata" class="form-control scroll-wrapper" rows="10" autocomplete="off" required style="resize: none;"></textarea> <br>
							<button type="submit" class="btn btn-primary" id="btnSubmit"> Submit </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper/popper.min.js"></script>
    <script src="assets/js/bs-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/bs/bootstrap.min.js"></script>
    <script src="assets/js/main/main.js?1"></script>

</body>
</html>