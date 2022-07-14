<?php require './engine/conn.php';

$notes_cek_sql = $conn->prepare("SELECT * FROM notes ORDER BY notes_id DESC");
$notes_cek_sql->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Notes</title>
</head>
<body style="font-family: 'Courier New', Courier, monospace;">

    <a href="index.php"><button>Go to Main Page</button></a>

        <table style="text-align: left; margin-left: 20px; margin-top: 20px; font-size: large;">
            
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Link</th>
                
            </tr>
            
            
            <?php while ($notes_cek = $notes_cek_sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <th><?php echo mb_strimwidth($notes_cek["notes_name"], 0, 30, "...") ?>&nbsp;&nbsp;</th>
                    <th><?php echo mb_strimwidth($notes_cek["notes_creator"], 0, 30,"...") ?>&nbsp;&nbsp;</th>
                    <th><a href="./?id=<?php echo $notes_cek["notes_md5"] ?>">Read Note</a>&nbsp;&nbsp;</th>
                </tr>
                <?php 
            } ?>
            
        </table>
    
</body>
</html>