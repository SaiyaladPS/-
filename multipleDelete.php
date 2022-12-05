<?php
        require('dbconnect.php');

        // ຮັບຄ່າຈາກແບບຟ້ອນ 
        $idarray = $_POST['idcheckbox'];
        
        //ແປງອາເລໃຫ້ເປັນສະຕິງ
        $arrtostr = implode(",",$idarray);

        // ຄຳລັ່ງລົບ ຂໍ້ມູນໃນຕາຕະລາງ
        $sql = "DELETE FROM employees WHERE id in ($arrtostr)";

        // ຄຳສ່ັງລັບ ຄຳສັ່ງ sql
        $result = mysqli_query($con,$sql);

        if($result) {
            header("location: showdata_table.php");
        } else {
            echo "ເກີດຂໍ້ຜິດພາດ";
        }
?>