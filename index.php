<?php
require_once './connect.php';
include './nav.php';
?>

    <h1 class="Display-1 text-center">Student Management System</h1>
    <section class="container">
        <table class="table table-bordered table-striped w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $query = 'SELECT * FROM students';
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo$row['id']; ?></td>
                            <td><?php echo$row['first_name']; ?></td>
                            <td><?php echo$row['last_name']; ?></td>
                            <td><?php echo$row['phone']; ?></td>
                            <td><img src=<?php echo $row['image_src']; ?> alt="student" style="width: 100px; height: auto;"></td>
                            <td>
                                <a class="btn btn-success" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                    <?php mysqli_close($conn);
                }?>
                
            </tbody>

        </table>
        <a class="btn btn-primary" href="insert.php">Add New Student</a>
    </section>

</body>
</html>