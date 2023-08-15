<h3 class="text-center text-success">Vsa naročila</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">

    <?php
        $getOrder="SELECT * FROM `Narocila`";
        $result=mysqli_query($con,$getOrder);
        $row_count=mysqli_num_rows($result);

        if($row_count==0){
            echo "<h2 class='text-danger text-center mt-5'>Ni naročil</h2>";

        }else{
            echo "
            <tr>
                <th>Št naročila</th>
                <th>Znesek</th>
                <th>Št produktov</th>
                <th>Št računa</th>
                <th>Id uporabnika</th>
                <th>Datum naročila</th>
                <th>Status naročila</th>
                <th>Izbriši</th>
            </tr>
            </thead>
            
            <tbody class='bg-secondary text-light'>";
            $number=0;
            while($rowData=mysqli_fetch_assoc($result)){
                $orderId=$rowData['Id_narocila'];
                $orderPay=$rowData['Znesek'];
                $orderName=$rowData['St_racuna'];
                $orderProdNum=$rowData['St_produktov'];
                $orderDate=$rowData['Datum_narocila'];
                $orderStatus=$rowData['Status_narocila'];
                $orderUser=$rowData['Up_id'];
                $number++;
                
                echo "
                <tr>
                    <td>$number</td>
                    <td>$orderPay</td>
                    <td>$orderProdNum</td>
                    <td>$orderName</td>
                    <td>$orderUser</td>
                    <td>$orderDate</td>
                    <td>$orderStatus</td>
                    <td><a href='index.php?deleteOrder=$orderId' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
            } 
        }   
        
    ?>
        </tbody>
</table>