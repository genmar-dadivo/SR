<?php

    require "../dbase/dbconfig.php";
    $sql = "SELECT ID, DBNO, CUS_NO FROM v_customer_info WHERE DBNO > 0 AND CUS_NO > 0 AND ID BETWEEN 1000 AND 5000";
    $stm = $con->prepare($sql);
    $stm->execute();
    $results = $stm->fetchAll(PDO::FETCH_ASSOC);
    $counter = 0;
    foreach ($results as $row) {
        $ID = $row['ID'];
        $DBNO = $row['DBNO'];
        $CUS_NO = $row['CUS_NO'];

        $sqlcounter = "SELECT DBNO, CUS_NO FROM v_customer_info WHERE DBNO = $DBNO AND CUS_NO = $CUS_NO ";
        $stmcounter = $con->prepare($sqlcounter);
        $stmcounter->execute();
        $resultscounter = $stmcounter->fetchAll(PDO::FETCH_ASSOC);
        if ($stmcounter->rowCount() > 1) {
            echo $ID . " MERON <br>";
        }
        else {
            echo "Wala <br>";
        }

        $counter++;
    }

?>