<?php
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
    $time = time();
	require '../dbase/dbconfig.php';
	
	if (isset($_POST['rawdata'])) {
		// cleaners
		$rawdata = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $_POST['rawdata']);
		$rawdata = str_replace(["UPDATE OR INSERT INTO","VALUES", "MATCHING (DATABASE_NO,ORDER_NO,SEQUENCE_NO);", "(", ")", "'"], "",$rawdata);
		$rawdata = strtolower($rawdata);

		// line mecha
		if (strpos($rawdata, 'oelinhst') !== false AND strpos($rawdata, 'oehdrhst') === false) {

		    $rowdata = explode('oelinhst', $rawdata);
		    $autodivide = substr_count($rawdata, "oelinhst");
		    $runner = 0;
		    while ($runner < $autodivide) {
		    	$datarunner = $runner + 1;
		    	$data = explode(',', $rowdata[$datarunner]);
		    	$DATABASE_NO = $data[0];
				$ORDER_TYPE = $data[1];
				$ORDER_NO = $data[2];
				$SEQUENCE_NO = $data[3];
				$ITEM_NO = $data[4];
				$LOCATION = $data[5];
				$QTY_ORDERED = $data[6];
				$QTY_TO_SHIP = $data[7];
				$UNIT_PRICE = $data[8];
				$REQUEST_DATE = $data[9];
				$QTY_BACK_ORDERED = $data[10];
				$QTY_RETURN_TO_STOCK = $data[11];
				$UNIT_OF_MEASURE = $data[12];
				$UNIT_COST = $data[13];
				$TOTAL_QTY_ORDERED = $data[14];
				$TOTAL_QTY_SHIPPED = $data[15];
				$PRICE_ORG = $data[16];
				$LAST_POST_DATE = $data[17];
				$ITEM_PROD_CAT = $data[18];
				$USER_FIELD_1 = $data[19];
				$USER_FIELD_2 = $data[20];
				$USER_FIELD_3 = $data[21];
				$USER_FIELD_4 = $data[22];
				$USER_FIELD_5 = $data[23];
				$CUSTOMER = $data[24];
				$INVOICE_NO = $data[25];

				// checker
				$sqlchecker = "SELECT ID, ORDER_NO, ITEM_NO FROM oelinhst WHERE DATABASE_NO = '$DATABASE_NO' AND ORDER_NO = '$ORDER_NO' AND ITEM_NO = '$ITEM_NO'" ;
				$stmchecker = $con->prepare($sqlchecker);
				$stmchecker->execute();
				if ($stmchecker->rowCount() == 0) {
					$sqlinsert = "INSERT INTO oelinhst (DATABASE_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, QTY_BACK_ORDERED, QTY_RETURN_TO_STOCK, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, LAST_POST_DATE, ITEM_PROD_CAT, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, CUSTOMER, INVOICE_NO) VALUES ('$DATABASE_NO', '$ORDER_TYPE', '$ORDER_NO', '$SEQUENCE_NO', '$ITEM_NO', '$LOCATION', '$QTY_ORDERED', '$QTY_TO_SHIP', '$UNIT_PRICE', '$REQUEST_DATE', '$QTY_BACK_ORDERED', '$QTY_RETURN_TO_STOCK', '$UNIT_OF_MEASURE', '$UNIT_COST', '$TOTAL_QTY_ORDERED', '$TOTAL_QTY_SHIPPED', '$PRICE_ORG', '$LAST_POST_DATE', '$ITEM_PROD_CAT', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$CUSTOMER', '$INVOICE_NO')";
					$stminsert = $con->prepare($sqlinsert);
					$stminsert->execute();
					//$last_id = $con->lastInsertId();
				}
				else {
					$DATABASE_NO = "DUPLICATE" . $DATABASE_NO;
					$sqlinsert = "INSERT INTO oelinhst (DATABASE_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, QTY_BACK_ORDERED, QTY_RETURN_TO_STOCK, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, LAST_POST_DATE, ITEM_PROD_CAT, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, CUSTOMER, INVOICE_NO) VALUES ('$DATABASE_NO', '$ORDER_TYPE', '$ORDER_NO', '$SEQUENCE_NO', '$ITEM_NO', '$LOCATION', '$QTY_ORDERED', '$QTY_TO_SHIP', '$UNIT_PRICE', '$REQUEST_DATE', '$QTY_BACK_ORDERED', '$QTY_RETURN_TO_STOCK', '$UNIT_OF_MEASURE', '$UNIT_COST', '$TOTAL_QTY_ORDERED', '$TOTAL_QTY_SHIPPED', '$PRICE_ORG', '$LAST_POST_DATE', '$ITEM_PROD_CAT', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$CUSTOMER', '$INVOICE_NO')";
				}
				$runner++;
			}
			echo "$runner(s) records inserted";
		}
		elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') !== false) {
			echo "oehdrhst";
		}
		else { echo "Error"; }
	}


?>