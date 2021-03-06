<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main/main.css">
    <link rel="icon" href="assets/img/logo/logo.png" type="image/gif" sizes="30x30">
	<title> Uploading | SR </title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col mx-auto">
				<div style="height: 100px;"></div>
				<form method="POST" id="rawdataprocess">
					<div class="row">
						<div class="col">
							<div class="form-floating">
								<textarea class="form-control" autocomplete="off" placeholder="Raw Data" id="rawdata" name="rawdata" style="resize: none;height: 250px"></textarea>
							  	<label for="rawdata">Raw Data</label>
							</div>
							<br>
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
    <script src="assets/js/bs/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main/main.js?1"></script>
    <script src="assets/js/push/push.min.js"></script>
</body>
</html>