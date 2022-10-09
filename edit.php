<?php 
require('connection.php');
?>
<!-- edit form -->
 <div class="edit" id="edit">
     <form  style="display:flex;flex-direction:column;width:200px" action="crud.php" method="POST" enctype="multipart/form-data">
        <div class="form-heading">
            <h2>Edit Product</h2> 
        </div>
        <input type="hidden" id="pid" name="pid">
        <input type="text" id="name" name="name" placeholder="Product Name">
        <input type="text" id="price" name="price" placeholder="Price">
        <textarea type="text" id="description" name="description"  rows="5" cols="30"
        placeholder="Description" style="resize:none;outline:none;padding:0.5em;" ></textarea>
        <img src="" id="image_preview" alt="">
        <input type="file" id="image" name="image" value="File browser example" accept=".jpg, .png, .svg" >
        <input type="submit" value="Update" name="editProduct">
    </form>
 </div>

 <?php 
if(isset($_GET['edit'])){

    $sql = "SELECT * FROM `products` WHERE `id` = '$_GET[edit]'";
    $result = mysqli_query($con,$sql);
    $fetch = mysqli_fetch_assoc($result);
    $path = FETCH_SRC;
    echo "<script>
        document.getElementById('pid').value = `$fetch[id]`;
        document.getElementById('name').value = `$fetch[name]`;
        document.getElementById('price').value = `$fetch[price]`;
        document.getElementById('description').value = `$fetch[description]`;
        document.getElementById('image_preview').src = `$path$fetch[image]`;
    </script>";
}
?>
