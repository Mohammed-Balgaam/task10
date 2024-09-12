<?php include './nav.php';
require_once './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{


    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    $imgTem = $_FILES['image']['tmp_name'];
    $imgName = $_FILES['image']['name'];
    
    $nameArr = explode( '.' , $imgName);

    $ext = end($nameArr);

    $newPath = './image/' . time() . '.' . $ext;

    move_uploaded_file($imgTem, $newPath);
    
    $sql = "INSERT INTO students (first_name, last_name, phone, image_src) VALUES ('$firstName' ,'$lastName' ,'$phone' ,'$newPath')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    if ($result)
    {
        header('Location: index.php');
        exit();
    }
}


?>


<h1 class="Display-1 text-center">Add New Student</h1>

<div class="container mt-5">
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
</div>


</body>
</html>