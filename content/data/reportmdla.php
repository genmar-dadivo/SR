<?php
	require '../dbase/dbconfig.php';
	$sql = "SELECT DATABASE_NO,ORDER_TYPE,ORDER_NO,ITEM_NO,QTY_ORDERED,QTY_TO_SHIP,UNIT_PRICE,UNIT_COST,PRICE_ORG,ITEM_PROD_CAT,USER_FIELD_1,USER_FIELD_2,USER_FIELD_3,USER_FIELD_4,USER_FIELD_5,CUSTOMER,INVOICE_DATE FROM OELINHST WHERE DATABASE_NO = 3 AND INVOICE_NO < 80000000 AND USER_FIELD_5 = '' AND INVOICE_DATE BETWEEN 20201101 AND 20201105";
	$stm = $con->prepare($sql);
	$stm->execute();
	$results = $stm->fetchAll(PDO::FETCH_ASSOC);
	foreach ($results as $row) {
		$DATABASE_NO = $row['DATABASE_NO'];
        $ORDER_TYPE = $row['ORDER_TYPE'];
        $ORDER_NO = $row['ORDER_NO'];
        // get dsm mecha
        $sqlheader = "SELECT SALESMAN_NO1 FROM oehdrhst WHERE DATABASE_NO = $DATABASE_NO AND OE_NO = $ORDER_NO";
        $stmheader = $con->prepare($sqlheader);
        $stmheader->execute();
        $rowheader = $stmheader->fetch();
        if ($stmheader->rowCount() == 1) {
            $SALESMAN_NO1 = str_replace(' ', '', $rowheader['SALESMAN_NO1']);
            $SALESMAN_NO1 = $SALESMAN_NO1;
            $sqlPSR = "SELECT psr_code, dsm_code FROM psr WHERE psr_code = '$SALESMAN_NO1'";
            $stmPSR = $con->prepare($sqlPSR);
            $stmPSR->execute();
            $rowPSR = $stmPSR->fetch();
            $psr_code = str_replace(' ', '', $rowPSR['psr_code']);
            $dsm_coderaw = str_replace(' ', '', $rowPSR['dsm_code']);
            if ($stmheader->rowCount() == 1) {
                $sqlDSM = "SELECT dsm_code, dsm_desc FROM dsm WHERE dsm_code = '$dsm_coderaw'";
                $stmDSM = $con->prepare($sqlDSM);
                $stmDSM->execute();
                $rowDSM = $stmDSM->fetch();
                $dsm_code = strtoupper($rowDSM['dsm_code']);
                $dsm_desc = strtoupper($rowDSM['dsm_desc']);
                if ($dsm_code == "" OR $dsm_desc == "") { $dsmname = $sqlPSR; }
                else { $dsmname = "$dsm_code-$dsm_desc"; }
            }
            else {}
        }
        else { $dsmname = $sqlheader . " " . $stmheader->rowCount(); }
        $ITEM_NO = $row['ITEM_NO'];
        // get item desc mecha
        $sqitem = "SELECT SKU, CATEGORY FROM product WHERE ITEM_NO = $ITEM_NO";
        $stmitem = $con->prepare($sqitem);
        $stmitem->execute();
        $rowitem = $stmitem->fetch();
        if ($stmitem->rowCount() == 1) {
            $itemname = ucwords(strtolower($rowitem['SKU']));
            $itemcat = strtoupper($rowitem['CATEGORY']);
        }
        else {
            $itemname = $sqitem . " " . $stmitem->rowCount();
            $itemcat = $sqitem . " " . $stmitem->rowCount();
        }

        $QTY_ORDERED = $row['QTY_ORDERED'];
        $QTY_TO_SHIP = $row['QTY_TO_SHIP'];
        $UNIT_PRICE = $row['UNIT_PRICE'];
        $UNIT_COST = $row['UNIT_COST'];
        $PRICE_ORG = $row['PRICE_ORG'];
        $ITEM_PROD_CAT = $row['ITEM_PROD_CAT'];
        $USER_FIELD_1 = $row['USER_FIELD_1'];
        $USER_FIELD_2 = $row['USER_FIELD_2'];
        $USER_FIELD_3 = $row['USER_FIELD_3'];
        $USER_FIELD_4 = $row['USER_FIELD_4'];
        $USER_FIELD_5 = $row['USER_FIELD_5'];
        $CUSTOMER = $row['CUSTOMER'];
        $INVOICE_DATE = $row['INVOICE_DATE'];


        echo "$dsmname";
        echo "<br>";
	}

?>