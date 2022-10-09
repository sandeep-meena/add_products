<?php
require("connection.php");
?>
<?php
$sql = "SELECT * FROM `products`";
$result  = mysqli_query($con,$sql);
$fetch = mysqli_fetch_all($result,MYSQLI_ASSOC);
$fetch_src = FETCH_SRC;
$i=1;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>add_product</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- add form -->
<div class="add" id="add">
     <form action="crud.php" method="post" enctype="multipart/form-data">
        <div class="form-heading">
            <h2>Add Product</h2> 
            <h3 onclick="closeForm()"> X </h3>
        </div>
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="price" placeholder="Price" required>
        <textarea type="text" name="description"  rows="5" placeholder="Description" style="resize:none;outline:none;padding:0.5em;width:100%"  required></textarea>
        <input type="file" name="image" value="File browser example" accept=".jpg, .png, .svg" required>
        <input type="submit" value="Add" name="addproduct">
    </form>
 </div>



 <!-- nav bar -->

    <header>
        <h1>Add Products</h1>
        <div class="btn">
            <button onclick="addForm()">+ Add Product</button>
        </div>
    </header>

    
    <?php
if(isset($_GET['success'])){
    if($_GET['success']=="added"){
        echo '
        <div class="success" id="success">Product added succusfully!!!!</div>';
    }
    if($_GET['success']=="removed"){
        echo '
        <div class="success" id="success">Product Removed succusfully!!!!</div>';
    }
    
     if($_GET['success']=="updated"){
        echo '
        <div class="success" id="success">Product Updated succusfully!!!!</div>';
    }
}

if(isset($_GET['alert'])){
    if($_GET['alert']=="add_failed"){
        echo '
        <div class="alert" id="success">Product add failed !!!!</div>';
    }
    if($_GET['alert']=="remove_failed"){
        echo '
        <div class="alert" id="sucesss">Product Remove failed!!!!</div>';
    }
    
     if($_GET['alert']=="update_failed"){
        echo '
        <div class="alert" id="success">Product Update Failed!!!!</div>';
    }
}

?>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Sr_no</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fetch as $items): ?>
                   <?php $image_display = $fetch_src.$items["image"];
                   echo '<tr>
                    <td>'.$i.'</td> 
                    <td><img src="'.$image_display.'"></td>
                    <td>'.$items["name"].'</td>
                    <td>₹'.$items["price"].'</td>
                    <td>'.$items["description"].'</td>
                    <td style=" white-space: nowrap; cursor:pointer">&nbsp;<a href="edit.php?edit='.$items["id"].'"><i class="fa fa-edit" style="font-size:25px;color:green"></i></a>
                   &nbsp;&nbsp;  <i onclick="delete_product('.$items["id"].')" class="fa fa-trash" style="color:red;font-size:25px"> </i>&nbsp;</td>
                </tr>'?>
                <?php $i ++; endforeach;?>
                
              
            </tbody>
        </table>
    </main>



 <script>

     function delete_product(id){
        if(confirm("Are you sure? you want to delete this item")){
            window.location.href = "crud.php?rem="+id;
        }
     }

     function editForm(data){    
         document.getElementById("add").style.display = "flex"; 
           
     }
    function addForm(){    
        document.getElementById("add").style.display = "flex";   
    }
    function closeForm(){
        document.getElementById("add").style.display = "none";
    }

    setTimeout(() => {
        document.getElementById('success').style.display = "none";
    }, 1500);
 </script>
</body>
</html>