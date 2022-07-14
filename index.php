<?php require './engine/conn.php';
session_start();

$notes_id_cek_sql = $conn->prepare("SELECT * FROM notes ORDER BY notes_id DESC");
$notes_id_cek_sql->execute();
$notes_id_cek = $notes_id_cek_sql->fetch(PDO::FETCH_ASSOC);
if ($notes_id_cek) {
    $notes_id = $notes_id_cek["notes_id"];
    $notes_id++;
}else {
    $notes_id = 1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotePad!</title> 
</head>

<body style="font-family: 'Courier New', Courier, monospace;">
    <?php if(isset($_GET["id"]) && !empty($_GET["id"])){

        $notes_cek_sql = $conn->prepare("SELECT * FROM notes WHERE notes_md5=:notes_md5");
        $notes_cek_sql->execute([
            'notes_md5' => $_GET['id']
        ]);
        $notes_cek = $notes_cek_sql->fetch(PDO::FETCH_ASSOC);
        ?>
        
        <?php if ($notes_cek) {
            ?>
           <a href="index.php"> <button>Go To Main Page</button></a>
            <br>
            <h1 style="text-align: center;"><?php echo $notes_cek["notes_name"] ?></h1>
            <center>
                <p style="margin-left: 10%; margin-right: 10%;">
                    <?php echo $notes_cek["notes_body"]?>
                </p>
                <br>
                <p>Create Date: <?php echo $notes_cek["notes_tarih"] ?></p>
            </center>
            <?php 
        }else{ 
            header("Location:index.php");
            exit;
        } ?>
        
        
        <?php 
    }else{
        ?>
        <?php if (!empty($_SESSION['user_name'])) {
            ?>
            Welcome <b><?php echo $_SESSION["user_name"]. "!" ?></b><br><br>
            <?php 
        } ?>
        <a href="list.php"><button>See notes created by others!</button></a>
        <a href="./user/register.php"><button>Register</button></a>
        <?php if (empty($_SESSION['user_name'])) {
            ?>
            <a href="./user/login.php"><button>Login</button></a>
            <?php 
        } ?>
        <?php if (!empty($_SESSION['user_name'])) {
            ?>
            <a href="./user/logout.php"><button>Logout</button></a>
            <?php 
        } ?>
        
            <h1 style="text-align: center;">Create A Note!</h1>
            <form style="text-align: center;" action="./engine/islem.php" method="POST">
                <input name="notes_name" type="text" placeholder="Enter Title..." required><br><br>
                <textarea name="notes_body" cols="30" rows="10" required></textarea><br><br>
                <input type="hidden" name="notes_id" value="<?php echo $notes_id ?>">
                <input type="submit" name="notes_create" value="Create Note!">
            </form>

        <?php 
    } ?>
    
</body>
</html>
