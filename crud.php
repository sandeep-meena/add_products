<?php
require('connection.php');

function imageUpload($img){
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111,99999).$img['name'];

    $new_loc = UPLOAD_SRC.$new_name;

    if(!move_uploaded_file($tmp_loc,$new_loc)){
        header('Loaction: index.php?alert=img_upload');
        exit;
    }else{
        return $new_name;
    }
}

function imageRemove($img){

    if(!unlink(UPLOAD_SRC.$img)){
        header('Location: index.php?alert=img_rem_fail');
        exit;
    }

}

if(isset($_POST['addproduct'])){
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value);

    }
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img_path = imageUpload($_FILES['image']);
    $sql = " INSERT INTO `products`(`name`, `price`, `description`, `image`) 
    VALUES ('$name','$price','$description','$img_path')";
    $result = mysqli_query($con,$sql);
    if($result){
        header('Location: index.php?success=added ');
    }else{
        header('Location: index.php?alert=add_failed ');
        
    }
}

if(isset($_GET['rem'])) {
    $sql = "SELECT * FROM `products` WHERE `id` = '$_GET[rem]'";
    $result = mysqli_query($con,$sql);
    $fetch = mysqli_fetch_assoc($result);

    imageRemove($fetch['image']);

    $sql = "DELETE FROM `products` WHERE `id` = '$_GET[rem]'";
    if(mysqli_query($con,$sql)){
        header('Location: index.php?success=removed');
    }else{
        header('Location: index.php?alert=remove_failed');
    }
}

if(isset($_POST['editProduct'])){
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value);

    }
    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])){
        $sql = "SELECT * FROM `products` WHERE `id` = '$_POST[pid]'";
        $result = mysqli_query($con,$sql);
        $fetch = mysqli_fetch_assoc($result);

        imageRemove($fetch['image']);

        $img_path = imageUpload($_FILES['image']);

        $update = "UPDATE `products` SET `name`='$_POST[name]',`price`='$_POST[price]',
        `description`='$_POST[description]',`image`='$img_path' WHERE `id` = '$_POST[pid]'";

    }else{

        $update = "UPDATE `products` SET `name`='$_POST[name]',`price`='$_POST[price]',
        `description`='$_POST[description]' WHERE `id` = '$_POST[pid]'";

    }

    if(mysqli_query($con,$update)){
        header('Location: index.php?success=updated');
    }else{
        header('Location: index.php?alert=update_failed');
    }
}

?>
