<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bs/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main/main.css">

	<title> Sales Report </title>
</head>
<body>
	<div class="row">
		<div class="container">
			<div style="height: 100px;"></div>
			<div>
				<form method="POST" id="rawdataprocess">
					<div class="row">
						<div class="col">
							<select class="form-control" name="database" required>
								<option disabled selected value=""> Database </option>
								<option value="1" disabled>Noah</option>
								<option value="2">Macola</option>
							</select>
						</div>
						<div class="col">
							<select class="form-control" name="choice" required>
								<option disabled selected value=""> Data Type </option>
								<option value="1">Header</option>
								<option value="2">Items</option>
							</select>
						</div>
					</div>

					<br>

					<div class="row">
						<div class="col">
							<textarea name="rawdata" id="rawdata" class="form-control scroll-wrapper" rows="10" autocomplete="off" required style="resize: none;"></textarea> <br>
							<button type="submit" class="btn btn-primary btn-lg btn-block" id="btnSubmit"> Submit </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper/popper.min.js"></script>
    <script src="assets/js/bs/bootstrap.min.js"></script>
    <script src="assets/js/main/main.js?1"></script>

</body>
</html>