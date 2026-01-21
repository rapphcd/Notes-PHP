<?php

include 'includes/database.php';

global $db;


if(isset($_POST["type"]) && isset($_POST["value"]) && isset($_POST['id'])){
    if($_POST["type"] == "title"){
        $save = $db->prepare("UPDATE notes SET title = :title WHERE id = :id");
        $save->execute([
            'title'=> $_POST['value'],
            'id' => $_POST['id']
        ]);
    }

    if($_POST["type"] == "description"){
        $save = $db->prepare("UPDATE notes SET description = :description WHERE id = :id");
        $save->execute([
            'description'=> $_POST['value'],
            'id' => $_POST['id']
        ]);
    }
}

?>
