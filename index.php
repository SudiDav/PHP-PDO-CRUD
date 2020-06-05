<?php

    include'dbconnect.php';   
    
    //Save to db
    if (isset($_POST['btnsave'])) {
        
        $productname = $_POST['txtname'];
        $productprice = $_POST['txtprice'];

        if (!empty($productname && $productprice)) {
            $insert = $pdo -> prepare("insert into tbl_product(productname,productprice) values(:name,:price)");

            $insert -> bindParam(':name',$productname);
            $insert -> bindParam(':price',$productprice);

            $insert -> execute();

            if ($insert ->  rowCount()) {

                echo 'Inserted Successfully!';

            } else {
                # code...
                echo 'Insertion Failed!';
            }
            
        } else {
            # code...
            echo 'Fields are empty!';
        }
        
    }
    //Update data from db
    if (isset($_POST['btnUpdate'])) {
        # code...
        $productname = $_POST['txtname'];
        $productprice = $_POST['txtprice'];
        $prodId = $_POST['txtprodId'];

        if (!empty($productname && $productprice)) {
            # code...
            $update = $pdo -> prepare('update tbl_product set 
                productname=:pname,productprice=:pprice where prodId='.$prodId);

                $update -> bindParam(':pname',$productname);
                $update -> bindParam(':pprice',$productprice);
    
                $update -> execute();
    
                if ($update ->  rowCount()) {
    
                    echo 'Updated Successfully!';
    
                } else {
                    # code...
                    echo 'Update Failed!';
                }

        } else {
            # code...
            echo 'Please give me valid values!';
        }
        

    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD | PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>PHP PDO CRUD OPERATIONS</h2>

    <form class="main" action="" method="post">
        <?php
            # Edit 
            if (isset($_POST['btnEdit'])) 
            {
                $select = $pdo->prepare("select * from tbl_product where prodId=".$_POST['btnEdit']);

                $select->execute();
                if ($select) {
                    # code...
                    $row = $select->fetch(PDO::FETCH_OBJ);
                    //print_r($row);
                    //Update text filed below
                    echo '
                    
                    <p><input type="text" name="txtname" value="'.$row->productname.'" class="field"></p>
                    <p><input type="text" name="txtprice" value="'.$row->productprice.'" class="field"></p>
                    <p><input type="hidden" name="txtprodId" value="'.$row->prodId.'"></p>
                    <button type="submit" name="btnUpdate" class="btnUpdate">Update</button>    
                    <button type="submit" name="btnCancel" class="btnCancel">Cancel</button>  
                    ';

                }
                //get all the records from the db
                
            }
            else {
                # code...
             echo '
                
             <p><input type="text" name="txtname" 
             placeholder="Product Name" 
             class="field"></p>
            <p><input type="text" name="txtprice" 
                        placeholder="Product Price" 
                        class="field"></p>
            <input type="submit" name="btnsave" value="Save" class="btn">
             
             ';
            }
        
        ?>
       
        <br>
        <br>
        
        <table id="producttable" border="1">
            <thead>
                <th>ID </th>
                <th>Product Name </th>
                <th>Product Price </th>
                <th>Edit </th>
                <th>Delete</th>
            </thead>
            <tbody>
            <?php

                $select = $pdo->prepare("select * from tbl_product");

                $select->execute();
                //get all the records from the db
                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                echo'
                
                    <tr>
                    <td>'.$row->prodId.'</td>
                    <td>'.$row->productname.'</td>
                    <td>$'.$row->productprice.'</td>
                    <td><button type="submit" value="'.$row->prodId.'" 
                        name="btnEdit">EDIT</button></td>
                    <td><button type="submit" value="'.$row->prodId.'" 
                        name="btnDelete">DELETE</button></td>                   
                    </tr>   
                
                ';  
                }

                ?>
            </tbody>       
        </table>
    </form>
</body>
</html>
<hr>
