<?php

    include'dbconnect.php';   
    

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
        <p><input type="text" name="txtname" 
                  placeholder="Product Name" 
                  class="field"></p>
        <p><input type="text" name="txtprice" 
                  placeholder="Product Price" 
                  class="field"></p>
        <input type="submit" name="btnsave" value="Save" class="btn">
    </form>
    
</body>
</html>
<hr>
<?php

    $select = $pdo->prepare("select * from tbl_product");

    $select->execute();
    echo "<pre>";

    while ($row = $select->fetch()) {
        print_r($row);
    }

    
    

?>