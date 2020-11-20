<?php
	require "../dbase/dbconfig.php";
	$type = $_GET['type'];
	$id = $_GET['id'];

	if ($type == 1) {
		$id = preg_replace("/[^0-9]/", "", $id);
		$sql = "SELECT * FROM oehdrhst WHERE ID = '$id' LIMIT 1";
		$stm = $con->prepare($sql);
		$stm->execute();
		$row = $stm->fetch();

		$ID = $row['ID'];
		$DATABASE_NO = $row['DATABASE_NO'];
		$OEHH_TYPE = $row['OEHH_TYPE'];
		$OE_NO = $row['OE_NO'];
		$STATUS = $row['STATUS'];
		$DATE_ENTERED = $row['DATE_ENTERED'];
		$OEHH_DATE = $row['OEHH_DATE'];
		$APPLY_TO_NO = $row['APPLY_TO_NO'];
		$CUSTOMER_NO = $row['CUSTOMER_NO'];
		$SHIPPING_DATE = $row['SHIPPING_DATE'];
		$SHIP_VIA_CODE = $row['SHIP_VIA_CODE'];
		$TERMS_CODE = $row['TERMS_CODE'];
		$SALESMAN_NO1 = $row['SALESMAN_NO1'];
		$TAX_CODE_1 = $row['TAX_CODE_1'];
		$MFGING_LOCATION = $row['MFGING_LOCATION'];
		$TOTAL_SALE_AMOUNT = $row['TOTAL_SALE_AMOUNT'];
		$TOTAL_TAXABLE_AMOUNT = $row['TOTAL_TAXABLE_AMOUNT'];
		$DATE_PICKED = $row['DATE_PICKED'];
		$DATE_BILLED = $row['DATE_BILLED'];
		$INVOICE_NO = $row['INVOICE_NO'];
		$INVOICE_DATE = $row['INVOICE_DATE'];
		$POSTED_DATE = $row['POSTED_DATE'];
		$ORIG_ORDER_TYPE = $row['ORIG_ORDER_TYPE'];
		$ORIG_ORDER_DATE = $row['ORIG_ORDER_DATE'];
		$ORIG_ORDER_NO = $row['ORIG_ORDER_NO'];
		$OE_CASH_KEY = $row['OE_CASH_KEY'];
		$USER_FIELD_1 = $row['USER_FIELD_1'];
		$USER_FIELD_2 = $row['USER_FIELD_2'];
		$USER_FIELD_3 = $row['USER_FIELD_3'];
		$USER_FIELD_4 = $row['USER_FIELD_4'];
		$USER_FIELD_5 = $row['USER_FIELD_5'];
		$DATE_SHIPPED = $row['DATE_SHIPPED'];
		$OE_PO_NO = $row['OE_PO_NO'];

		?>

		<div class="container">
			<div class="row">
				<div class="col">
					<div class="form-group">
					    <input readonly type="text" class="form-control" value="<?php echo "Database No: $DATABASE_NO"; ?>" placeholder="Database No">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
					    <input readonly type="text" class="form-control" value="<?php echo "OEHH Type: $OEHH_TYPE"; ?>" placeholder="OEHH Type">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "OE No: $OE_NO"; ?>" placeholder="OE Number">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Status: $STATUS"; ?>" placeholder="Status">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Date Entered: $DATE_ENTERED"; ?>" placeholder="Date Entered">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "OEHH Date: $OEHH_DATE"; ?>" placeholder="OEHH Date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Apply To No: $APPLY_TO_NO"; ?>" placeholder="Apply To No">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Customer No: $CUSTOMER_NO"; ?>" placeholder="Customer No">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Shipping Date: $SHIPPING_DATE"; ?>" placeholder="Shipping Date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Ship Via Code: $SHIP_VIA_CODE"; ?>" placeholder="Ship Via Code">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo  "Terms Code: $TERMS_CODE"; ?>" placeholder="Terms Code">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Sales Man: $SALESMAN_NO1"; ?>" placeholder="Sales Man">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Tax Code: $TAX_CODE_1"; ?>" placeholder="Tax Code">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "MFGING Location: $MFGING_LOCATION"; ?>" placeholder="MFGING Location">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Total Sale Amount: $TOTAL_SALE_AMOUNT"; ?>" placeholder="Total Sale Amount">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Total Taxable Amount: $TOTAL_TAXABLE_AMOUNT"; ?>" placeholder="Total Taxable Amount">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Date Picked: $DATE_PICKED"; ?>" placeholder="Date Picked">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Date Billed: $DATE_BILLED"; ?>" placeholder="Date Billed">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Invoice No: $INVOICE_NO"; ?>" placeholder="Invoice No">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Invoice Date: $INVOICE_DATE"; ?>" placeholder="Invoice Date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Posted Date: $POSTED_DATE"; ?>" placeholder="Posted Date">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Orig Order Type: $ORIG_ORDER_TYPE"; ?>" placeholder="Original Order Type">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Orig Order Date: $ORIG_ORDER_DATE"; ?>" placeholder="Original Order Date">
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "Orig Order No: $ORIG_ORDER_NO"; ?>" placeholder="Original Order No">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "OE Cash Key: $OE_CASH_KEY"; ?>" placeholder="OE Cash Key">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "USER_FIELD_1: $USER_FIELD_1"; ?>" placeholder="User Field 1">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "USER_FIELD_2: $USER_FIELD_2"; ?>" placeholder="User Field 2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "USER_FIELD_3: $USER_FIELD_3"; ?>" placeholder="User Field 3">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "USER_FIELD_4: $USER_FIELD_4"; ?>" placeholder="User Field 4">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "USER_FIELD_5: $USER_FIELD_5"; ?>" placeholder="User Field 5">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<input readonly type="text" class="form-control" value="<?php echo "DATE_SHIPPED: $DATE_SHIPPED"; ?>" placeholder="Date Shipped">
					</div>
				</div>
			</div>

		</div>




		<?php
	}
	elseif ($type == 2) { echo "Unavailable"; }
	elseif ($type == 3) { echo "Unavailable"; }

?>