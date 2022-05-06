<?php

include'../includes/connection.php';
session_start();

  $query = 'SELECT *, FIRST_NAME, LAST_NAME, PHONE_NUMBER, EMPLOYEE, ROLE
              FROM transaction T
              JOIN customer C ON T.`CUST_ID`=C.`CUST_ID`
              JOIN transaction_details tt ON tt.`TRANS_D_ID`=T.`TRANS_D_ID`
              ORDER BY TRANS_ID DESC LIMIT 1';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $fname = $row['FIRST_NAME'];
          $lname = $row['LAST_NAME'];
          $pn = $row['PHONE_NUMBER'];
          $date = $row['DATE'];
          $tid = $row['TRANS_D_ID'];
          $cash = $row['CASH'];
          $sub = $row['SUBTOTAL'];
          $less = $row['LESSVAT'];
          $net = $row['NETVAT'];
          $add = $row['ADDVAT'];
          $grand = $row['GRANDTOTAL'];
          $role = $row['EMPLOYEE'];
          $roles = $row['ROLE'];
        }
?>


<script>
        function printDiv() {
            var divContents = document.getElementById("GFG").innerHTML;
            var a = window.open('', '', 'height=550, width=550');
            a.document.write(divContents);
            a.document.close();
            a.print();
        }
    </script>
            
          <div style="padding-left: 1px; padding-right: 1px; margin: 0px;" id="GFG">
            <h4 style="text-align: center;">Urgent Pharmacy</h4>
            <h6>Date: <?php echo $date; ?><br>Transaction #<?php echo $tid; ?></h6>
              <h6>Customer Name: <?php echo $fname; ?> <?php echo $lname; ?> <br>   
              Customer Mobile: <?php echo $pn; ?> <br>
              Sales Person: <?php echo $role; ?> <br></h6>

          <table class="table table-bordered" width="100%" cellspacing="0" style="border-collapse: collapse;margin-top: 10px; text-align: center; width: 95vw; font-size: 10px;">
            <thead>
              <tr style="border-bottom: 1px solid black;">
                <th>Product Name</th>
                <th width="8%">Qty</th>
                <th width="20%">Unit Price</th>
                <th width="20%">Subtotal</th>
              </tr>
            </thead>
            <tbody>
<?php  
           $query = 'SELECT *
                     FROM transaction_details
                     WHERE TRANS_D_ID ='.$tid;
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              $Sub =  $row['QTY'] * $row['PRICE'];
                echo '<tr>';
                echo '<td>'. $row['PRODUCTS'].'</td>';
                echo '<td>'. $row['QTY'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                echo '<td>'. $Sub.'</td>';
                echo '</tr> ';
                        }
?>
            </tbody>
          </table>
                  <h6 style="text-align: right;">Cash Amount: LKR <?php echo number_format($cash, 2); ?></h6>
                  <table width="100%" style="text-align: right; font-size: 10px;">
                    <tr>
                      <td class="font-weight-bold">Subtotal : LKR <?php echo $sub; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">Total : LKR <?php echo $grand; ?></td>
                    </tr>
                  </table>
                </div>

                