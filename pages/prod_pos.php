<?php
include'../includes/connection.php';

  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];          
  }
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$aaa = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $aaa .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$aaa .= "</select>";

$sql2 = "SELECT DISTINCT SUPPLIER_ID, COMPANY_NAME FROM supplier order by COMPANY_NAME asc";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");

$sup = "<select class='form-control' name='supplier' required>
        <option disabled selected hidden>Select Supplier</option>";
  while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['SUPPLIER_ID']."'>".$row['COMPANY_NAME']."</option>";
  }

$sup .= "</select>";
?>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Product Code</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th>Category</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, PRICE, CNAME, DATE_STOCK_IN FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID GROUP BY PRODUCT_CODE';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) { ?>
                                 
                <tr>
                  <td> <?PHP echo $row['PRODUCT_CODE']; ?> </td>
                  <td> <?PHP echo $row['NAME']; ?> </td>
                  <td> <?PHP echo $row['PRICE']; ?> </td>
                  <td> <?PHP echo $row['CNAME']; ?> </td>
                  <form method="post" action="pos.php?action=add&id=<?php echo $row['PRODUCT_ID']; ?>">
                    <td><input type="text" name="quantity" class="form-control" value="1" /></td>
                    <input type="hidden" name="name" value="<?php echo $row['NAME']; ?>" />
                    <input type="hidden" name="price" value="<?php echo $row['PRICE']; ?>" />
                    <td><input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info" value="Add" /></td>
                  </form>
                </tr>
                      <?php  }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>