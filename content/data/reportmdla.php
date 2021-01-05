<?php
	require '../dbase/dbconfig.php';
	$sqldsm = "SELECT DSM_CODE, DSM_DESC, DBNO FROM dsm";
	$stmdsm = $con->prepare($sqldsm);
	$stmdsm->execute();
	$resultsdsm = $stmdsm->fetchAll(PDO::FETCH_ASSOC);
	foreach ($resultsdsm as $rowdsm) {
		$DSM_CODE = $rowdsm['DSM_CODE'];
		$DSM_DESC = $rowdsm['DSM_DESC'];
		echo $DBNO = $rowdsm['DBNO'];
        echo "$DSM_CODE - $DSM_DESC";
        echo "<br>";
        $sqlcat = "SELECT MAX(CATEGORY) AS MCAT FROM `product` WHERE CATEGORY <> '[null]' GROUP BY CATEGORY";
		$stmcat = $con->prepare($sqlcat);
		$stmcat->execute();
		$resultscat = $stmcat->fetchAll(PDO::FETCH_ASSOC);
		foreach ($resultscat as $rowcat) {
			$MCAT = $rowcat['MCAT'];
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "$MCAT";
	        echo "<br>";
	        $sqlitem = "SELECT DATABASE_NO,ORDER_TYPE,ORDER_NO,ITEM_NO,QTY_ORDERED,QTY_TO_SHIP,UNIT_PRICE,UNIT_COST,PRICE_ORG,ITEM_PROD_CAT,USER_FIELD_1,USER_FIELD_2,USER_FIELD_3,USER_FIELD_4,USER_FIELD_5,CUSTOMER,INVOICE_DATE FROM OELINHST WHERE DATABASE_NO = $DBNO AND INVOICE_NO < 80000000 AND USER_FIELD_5 = '' AND INVOICE_DATE BETWEEN 20201001 AND 20201010";
			$stmitem = $con->prepare($sqlitem);
			$stmitem->execute();
			$resultsitem = $stmitem->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultsitem as $rowitem) {
				$ITEM_NO = $rowitem['ITEM_NO'];
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				echo "ADASDAS $ITEM_NO";
		        echo "<br>";
			}
		}
	}

?>