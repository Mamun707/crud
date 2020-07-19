<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>CRUD</title>
</head>
<body>
<?php require_once("process.php"); ?>

<?php
    if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    
    </div>
<?php endif;?>

<div class="container">
<?php 
    $mysqli=new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result=$mysqli->query("SELECT * FROM data") or die($mysqli->error);
 ?>
    <div class="row justify-content-center">

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            
            </thead>
            <?php while($row= $result->fetch_assoc()):?>

                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['location'];?></td>
                    <td>
                    <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                
            <?php endwhile; ?>
        </table>

    
    </div>

 <?php
 
    function pre_r($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

?>

    <div class="row justify-content-center">
    
        <form action="" method="POST">

                <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter Your Name" class="form-control" onFocus="this.value=''">
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" value="<?php echo $location ?>" placeholder="Enter your location" class="form-control" onFocus="this.value=''">
            </div>

            <div class="form-group">
            <?php if($update==true):?>
            <button type="submit" name="update" class="btn btn-info">Update</button>

            <?php else:?>
                <button type="submit" name="save" class="btn btn-primary">Save</button>

            <?php endif;?>
            </div>

        </form>
        
    </div>

</div>
</body>
</html>