<?php
	date_default_timezone_set("Asia/Manila");
	// limit counter
	$counter = 0;
	$limit = 1000;

	require "../dbase/dbconfig.php";
	$sql = "SELECT ID, DATABASE_NO, OE_NO FROM oelinhst R where R.INVOICE_DATE = '' ";
	$stm = $con->prepare($sql);
	$stm->execute();
	$results = $stm->fetchAll(PDO::FETCH_ASSOC);
	foreach ($results as $row) {
		if ($counter <= $limit) {
			$ID = $row['ID'];
			$DATABASE_NO = $row['DATABASE_NO'];
			$OE_NO = $row['OE_NO'];
			// get header mecha
			$sqlgetheader = "SELECT INVOICE_DATE FROM oehdrhst WHERE DATABASE_NO = '$DATABASE_NO' AND ORDER_NO = '$OE_NO' "
			$stmgetheader = $con->prepare($sqlgetheader);
			$stmgetheader->execute();
			$rowgetheader = $stmgetheader->fetch();
			$INVOICE_DATE = $rowgetheader['INVOICE_DATE'];
			// attach invoice date mecha
			$sqlhd = "UPDATE oelinhst SET INVOICE_DATE = '$INVOICE_DATE' WHERE ID = '$ID' ";
			$stmhd = $con->prepare($sqlhd);
			$stmhd->execute();
			$counter ++;
		}
		else { break; }
	}
?>