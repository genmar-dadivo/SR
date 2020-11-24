<?php
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
    $time = time();
	require '../dbase/dbconfig.php';
	include ('dumper.php');

	$database = $_POST['database'];
	if ($database == 1) {
		$rawdata = str_replace(' ', '', $_POST['rawdata']);
		$rawdata = str_replace("'", '', $rawdata);

		$rowdata = explode('~', $rawdata);
		$itemdivider = substr_count($rawdata, "~");
		$runner = 0;

		while ($runner < $itemdivider) {
			$data = explode(',', $rowdata[$runner]);
			$commacount = substr_count($rawdata, ",");

			$sql = "INSERT INTO noah(DBNO, BRANCHNAME, DSM, SALESMAN_CODE, TAON, BUWAN, ARAW, SELLING_TYPE, CUSTOMERS, ADDRESS, TIN, CUSTOMERS_TYPE, PROVINCIAL, REGIONS, ACCOUNTS, CATEGORY, PRODUCT_CATEGORY, SKU, UOM, QTY, AMOUNT, NET_AMOUNT, TRANSDATE, NOAH_INV_NO, MANUAL_INV_NO, DATE_CONFIRMED) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]')";
			$stm = $con->prepare($sql);
			$stm->execute();


			if ($stm->rowCount() == 1) { $runner++; }
			else { echo "Error occured."; }
		}
		echo $runner . "(s) NOAH Data inserted";
	}
	elseif ($database == 2) {
		$choice = $_POST['choice'];
		if ($choice == 1) {
			$rawdata = str_replace(' ', '', $_POST['rawdata']);
			$rawdata = str_replace("'", '', $rawdata);

			$rowdata = explode('~', $rawdata);
			$itemdivider = substr_count($rawdata, "~");
			$runner = 0;

			while ($runner < $itemdivider) {
				$data = explode(',', $rowdata[$runner]);
				$commacount = substr_count($rawdata, ",");

				$sql = "INSERT INTO oehdrhst(DATABASE_NO, OEHH_TYPE, OE_NO, STATUS, DATE_ENTERED, OEHH_DATE, APPLY_TO_NO, CUSTOMER_NO, SHIPPING_DATE, SHIP_VIA_CODE, TERMS_CODE, SALESMAN_NO1, TAX_CODE_1, MFGING_LOCATION, TOTAL_SALE_AMOUNT, TOTAL_TAXABLE_AMOUNT, DATE_PICKED, DATE_BILLED, INVOICE_NO, INVOICE_DATE, POSTED_DATE, ORIG_ORDER_TYPE, ORIG_ORDER_DATE, ORIG_ORDER_NO, OE_CASH_KEY, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, DATE_SHIPPED) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]','$data[26]','$data[27]','$data[28]','$data[29]','$data[30]') ON DUPLICATE KEY UPDATE OE_NO = CONCAT(OE_NO, 'ERROR', '$time');";
				$stm = $con->prepare($sql);
				$stm->execute();
				$last_id = $con->lastInsertId();
				//echo $rowdata[$runner];
				// echo $itemdivider . " ";
				// echo $runner . "\n";

				if ($stm->rowCount() == 1) { $runner++; }
				if ($stm->rowCount() == 2) { echo "Duplicate entry. ID: " . $last_id . "\n"; }
				//else { echo "Error occured."; }
				//$runner++;
			}
			echo $runner . "(s) Header Data inserted";
		}
		elseif ($choice == 2) {
			$rawdata = str_replace(' ', '', $_POST['rawdata']);
			$rawdata = str_replace("'", '', $rawdata);

			$rowdata = explode('~', $rawdata);
			$itemdivider = substr_count($rawdata, "~");
			$runner = 0;

			while ($runner < $itemdivider) {
				$data = explode(',', $rowdata[$runner]);
				$commacount = substr_count($rawdata, ",");

				$sql = "INSERT INTO oelinhst(DATABASE_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, QTY_BACK_ORDERED, QTY_RETURN_TO_STOCK, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, LAST_POST_DATE, ITEM_PROD_CAT, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, CUSTOMER, INVOICE_NO) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]','$data[25]') ON DUPLICATE KEY UPDATE ORDER_NO = CONCAT(ORDER_NO, 'ERROR', '$time'); ";
				$stm = $con->prepare($sql);
				$stm->execute();
				$last_id = $con->lastInsertId();
				//echo $rowdata[$runner];
				// echo $itemdivider . " ";
				// echo $runner . "\n";

				if ($stm->rowCount() == 1) { $runner++; }
				if ($stm->rowCount() == 2) { echo "Duplicate entry. ID: " . $last_id . "\n"; }
				//else { echo "Error occured."; }
				//$runner++;
			}
			echo $runner . "(s) Item Data inserted";
		}
		else { echo "Error Occured"; }
			// if ($stm->rowCount() == 1) { echo "Record updated."; }
			// else {
			// 	//echo "Error occured.";
			// 	echo $sql;
			// }
	}
	else { echo "Error Occured"; }


?>