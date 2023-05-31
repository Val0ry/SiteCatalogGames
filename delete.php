<?php
session_start();
// var_dump($_GET['id']);
if (isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    $id = strip_tags($_GET['id']);
    $sql = "SELECT * FROM intervention WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    if(!$result){
        header('Location: index.php');
    }
    $sql = "DELETE FROM intervention WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $_SESSION["del"] = [
        "is_del" => "Oui"
    ];

    header('Location: list.php');

} else{
    header('Location: index.php');
}

?>