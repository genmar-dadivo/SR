<?php
	date_default_timezone_set("Asia/Manila");
	$Ynow = date('Y');
    $MDnow = date('md');
    $time = time();
	require '../dbase/dbconfig.php';
	if (isset($_POST['rawdata'])) {
		// cleaners
		$rawdata = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $_POST['rawdata']);
		$rawdata = str_replace(["'","UPDATE","OR ","INSERT","INTO","VALUES", "MATCHING","DATABASE_NO,ORDER_NO,SEQUENCE_NO","DATABASE_NO, OE_NO, CUSTOMER_NO","(", ")", ";"], "",$rawdata);
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
				$INVOICE_DATE = $data[26];
				// checker
				$sqlchecker = "SELECT ID, ORDER_NO, ITEM_NO FROM oelinhst WHERE DATABASE_NO = $DATABASE_NO AND ORDER_NO = '$ORDER_NO' AND ITEM_NO = '$ITEM_NO' AND UNIT_PRICE = '$UNIT_PRICE' " ;
				$stmchecker = $con->prepare($sqlchecker);
				$stmchecker->execute();
				if ($stmchecker->rowCount() > 0) { $DATABASE_NO = "D" . $DATABASE_NO; }
				$sqlinsert = "INSERT INTO oelinhst (DATABASE_NO, ORDER_TYPE, ORDER_NO, SEQUENCE_NO, ITEM_NO, LOCATION, QTY_ORDERED, QTY_TO_SHIP, UNIT_PRICE, REQUEST_DATE, QTY_BACK_ORDERED, QTY_RETURN_TO_STOCK, UNIT_OF_MEASURE, UNIT_COST, TOTAL_QTY_ORDERED, TOTAL_QTY_SHIPPED, PRICE_ORG, LAST_POST_DATE, ITEM_PROD_CAT, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, CUSTOMER, INVOICE_NO, INVOICE_DATE) VALUES ('$DATABASE_NO', '$ORDER_TYPE', '$ORDER_NO', '$SEQUENCE_NO', '$ITEM_NO', '$LOCATION', '$QTY_ORDERED', '$QTY_TO_SHIP', '$UNIT_PRICE', '$REQUEST_DATE', '$QTY_BACK_ORDERED', '$QTY_RETURN_TO_STOCK', '$UNIT_OF_MEASURE', '$UNIT_COST', '$TOTAL_QTY_ORDERED', '$TOTAL_QTY_SHIPPED', '$PRICE_ORG', '$LAST_POST_DATE', '$ITEM_PROD_CAT', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$CUSTOMER', '$INVOICE_NO', '$INVOICE_DATE')";
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				$runner++;
			}
			// duplicate checker
			$sqldupchecker = "SELECT DATABASE_NO FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
			$stmdupchecker = $con->prepare($sqldupchecker);
			$stmdupchecker->execute();
			$duplicounter = $stmdupchecker->rowCount();
			echo "$duplicounter duplicate entry. \n";
			echo date('h:i A') . "\n";
			echo "$runner(s) records inserted";
			// delete duplicate
			$sqldupdelete = "DELETE FROM `oelinhst` WHERE DATABASE_NO LIKE '%D%' ";
			$stmdupdelete = $con->prepare($sqldupdelete);
			$stmdupdelete->execute();
		}
		// head mecha
		elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') !== false) {
			$rowdata = explode('oehdrhst', $rawdata);
		    $autodivide = substr_count($rawdata, "oehdrhst");
		    $runner = 0;
		    while ($runner < $autodivide) {
		    	$datarunner = $runner + 1;
		    	$data = explode(',', $rowdata[$datarunner]);
		    	$DATABASE_NO = $data[0];
				$OEHH_TYPE = $data[1];
				$OE_NO = $data[2];
				$STATUS = $data[3];
				$DATE_ENTERED = $data[4];
				$OEHH_DATE = $data[5];
				$APPLY_TO_NO = $data[6];
				$CUSTOMER_NO = $data[7];
				$SHIPPING_DATE = $data[8];
				$SHIP_VIA_CODE = $data[9];
				$TERMS_CODE = $data[10];
				$SALESMAN_NO1 = $data[11];
				$TAX_CODE_1 = $data[12];
				$MFGING_LOCATION = $data[13];
				$TOTAL_SALE_AMOUNT = $data[14];
				$TOTAL_TAXABLE_AMOUNT = $data[15];
				$DATE_PICKED = $data[16];
				$DATE_BILLED = $data[17];
				$INVOICE_NO = $data[18];
				$INVOICE_DATE = $data[19];
				$POSTED_DATE = $data[20];
				$ORIG_ORDER_TYPE = $data[21];
				$ORIG_ORDER_DATE = $data[22];
				$ORIG_ORDER_NO = $data[23];
				$OE_CASH_KEY = $data[24];
				$USER_FIELD_1 = $data[25];
				$USER_FIELD_2 = $data[26];
				$USER_FIELD_3 = $data[27];
				$USER_FIELD_4 = $data[28];
				$USER_FIELD_5 = $data[29];
				$DATE_SHIPPED = $data[30];
				$OE_PO_NO = $data[31];
				// checker
				$sqlchecker = "SELECT ID, OE_NO, SALESMAN_NO1 FROM oehdrhst WHERE DATABASE_NO = '$DATABASE_NO' AND OE_NO = '$OE_NO' AND SALESMAN_NO1 = '$SALESMAN_NO1' AND ORIG_ORDER_TYPE = '$ORIG_ORDER_TYPE' ";
				$stmchecker = $con->prepare($sqlchecker);
				$stmchecker->execute();
				if ($stmchecker->rowCount() > 0) { $DATABASE_NO = "D" . $DATABASE_NO; }
				$sqlinsert = "INSERT INTO oehdrhst (DATABASE_NO, OEHH_TYPE, OE_NO, STATUS, DATE_ENTERED, OEHH_DATE, APPLY_TO_NO, CUSTOMER_NO, SHIPPING_DATE, SHIP_VIA_CODE, TERMS_CODE, SALESMAN_NO1, TAX_CODE_1, MFGING_LOCATION, TOTAL_SALE_AMOUNT, TOTAL_TAXABLE_AMOUNT, DATE_PICKED, DATE_BILLED, INVOICE_NO, INVOICE_DATE, POSTED_DATE, ORIG_ORDER_TYPE, ORIG_ORDER_DATE, ORIG_ORDER_NO, OE_CASH_KEY, USER_FIELD_1, USER_FIELD_2, USER_FIELD_3, USER_FIELD_4, USER_FIELD_5, DATE_SHIPPED, OE_PO_NO) VALUES ('$DATABASE_NO', '$OEHH_TYPE', '$OE_NO', '$STATUS', '$DATE_ENTERED', '$OEHH_DATE', '$APPLY_TO_NO', '$CUSTOMER_NO', '$SHIPPING_DATE', '$SHIP_VIA_CODE', '$TERMS_CODE', '$SALESMAN_NO1', '$TAX_CODE_1', '$MFGING_LOCATION', '$TOTAL_SALE_AMOUNT', '$TOTAL_TAXABLE_AMOUNT', '$DATE_PICKED', '$DATE_BILLED', '$INVOICE_NO', '$INVOICE_DATE', '$POSTED_DATE', '$ORIG_ORDER_TYPE', '$ORIG_ORDER_DATE', '$ORIG_ORDER_NO', '$OE_CASH_KEY', '$USER_FIELD_1', '$USER_FIELD_2', '$USER_FIELD_3', '$USER_FIELD_4', '$USER_FIELD_5', '$DATE_SHIPPED', '$OE_PO_NO')";
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				$runner++;
			}
			// duplicate checker
			$sqldupchecker = "SELECT DATABASE_NO FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
			$stmdupchecker = $con->prepare($sqldupchecker);
			$stmdupchecker->execute();
			$duplicounter = $stmdupchecker->rowCount();
			echo "$duplicounter duplicate entry. \n";
			echo date('h:i A') . "\n";
			echo "$runner(s) records inserted.";
			// delete duplicate
			$sqldupdelete = "DELETE FROM `oehdrhst` WHERE DATABASE_NO LIKE '%D%' ";
			$stmdupdelete = $con->prepare($sqldupdelete);
			$stmdupdelete->execute();
		}
		// item mecha
		elseif (strpos($rawdata, 'oelinhst') === false AND strpos($rawdata, 'oehdrhst') === false AND strpos($rawdata, 'product') !== false) {
			$rowdata = explode('product', $rawdata);
		    $autodivide = substr_count($rawdata, "product");
		    $runner = 0;
		 	while ($runner < $autodivide) {
			 	$datarunner = $runner + 1;
			 	$data = explode(',', $rowdata[$datarunner]);
				$CATEGORY = $data[0];
				$SKU = $data[1];
				$ITEM_NO = $data[2];
				// checker
				$sqlchecker = "SELECT ITEM_NO FROM product WHERE ITEM_NO = '$ITEM_NO' ";
				$stmchecker = $con->prepare($sqlchecker);
				$stmchecker->execute();
				if ($stmchecker->rowCount() > 0) { $ITEM_NO = "D" . $ITEM_NO; }
				$sqlinsert = "INSERT INTO product (CATEGORY, SKU, ITEM_NO) VALUES ('$CATEGORY', '$SKU', '$ITEM_NO')";
				$stminsert = $con->prepare($sqlinsert);
				$stminsert->execute();
				$runner++;
			}
			// duplicate checker
			$sqldupchecker = "SELECT ITEM_NO FROM `product` WHERE ITEM_NO LIKE '%D%' ";
			$stmdupchecker = $con->prepare($sqldupchecker);
			$stmdupchecker->execute();
			$duplicounter = $stmdupchecker->rowCount();
			echo "$duplicounter duplicate entry. \n";
			echo date('h:i A') . "\n";
			echo "$runner(s) records inserted.";
			// delete duplicate
			$sqldupdelete = "DELETE FROM `product` WHERE ITEM_NO LIKE '%D%' ";
			$stmdupdelete = $con->prepare($sqldupdelete);
			$stmdupdelete->execute();
		}
		else { echo "Error"; }
	}
?>