<?php
session_start();
include './nav.php';
require_once './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' ) 
{

    $edit_id = $_GET['id'];
    $_SESSION['edit_id'] = $edit_id;
    $query = 'SELECT * FROM students WHERE id = ' . $edit_id;
    $result_edit = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result_edit);
    
}

//   echo  $edit_id = $_SESSION['edit_id'];

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // echo $_SESSION['edit_id'];
    $edit_id = $_SESSION['edit_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) 
    {
        $imgTem = $_FILES['image']['tmp_name'];
        $imgName = $_FILES['image']['name'];
    
        $nameArr = explode( '.' , $imgName);

        $ext = end($nameArr);

        $newPath = './image/' . time() . '.' . $ext;

        move_uploaded_file($imgTem, $newPath);
    }
     else 
    {
        $newPath = $row['image_src'];  
    }
    

    
    
    $sql = "UPDATE students SET first_name = '$firstName' , last_name = '$lastName' , phone = '$phone' , image_src = '$newPath' WHERE id = '$edit_id' ";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    if ($result)
    {
        header('Location: index.php');
        exit();
    }
}


?>


<h1 class="Display-1 text-center">Edit Student</h1>

<div class="container mt-5">
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image:</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="mb-3">
            <img src=<?php echo $row['image_src']; ?> alt="">
        </div>
        
        <button type="submit" class="btn btn-primary">Save Student</button>
    </form>
</div>


</body>
</html>