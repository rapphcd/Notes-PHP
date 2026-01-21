<?php session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/database.php';
global $db;

if (isset($_POST['submit']) && !empty($_POST['id'])) {
    $delRequest = $db->prepare("DELETE FROM notes WHERE id = :id AND user = :user");
    $delRequest->execute([
            "id" => $_POST['id'],
            "user" => $_SESSION['id']
    ]);
    header('Location: index.php');
    exit;
}

if (isset($_POST['addnote'])) {
    $addrequest = $db->prepare("INSERT INTO `notes`(`user`, `title`, `description`) VALUES (:userid,'New Note','...')");
    $addrequest->execute([
            "userid" => $_SESSION['id']
    ]);
    header('Location: index.php');
    exit;
}

if (isset($_POST['save']) && !empty($_POST['id'])) {
    $save = $db->prepare("UPDATE `notes` SET `title`= :title,`description`= :description WHERE id = :id");
    $save->execute([
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "description" => $_POST['description'],
    ]);
    header("Refresh:0");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css"/>
    <title>index</title>
</head>

<body>
<?php include "includes/navbar.php"; ?>
<section id="notes">
    <div class="notes-container">
        <div class="note-list">
            <div class="content">
                <?php
                if (!empty($_SESSION['id'])) {
                    $q = $db->query("SELECT * FROM notes WHERE user = " . $_SESSION["id"] . " ORDER BY createdat ASC");
                    while ($note = $q->fetch()) { ?>
                        <div class="note-element" id="<?= $note['id'] ?>" data-desc="<?= $note['description'] ?>" data-tit="<?= $note['title'] ?>"
                             onclick="selectNote(this)">
                            <div class="note-infos">
                                <h2> <?= $note["title"] ?></h2>
                            </div>
                            <div class="note-actions">
                                <form id="del" method="post">
                                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                                    <button class="del-note" type="submit" name="submit" id="submit">DEL</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <form id="addnote" method="post" class="add-note-container">
                        <button type="submit" name="addnote" id="addnote" class="addnote">ADD</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="preview">
        <form id="previewform" method="post" class="hidden">
            <div class="preview-content">
                <input type="text" name="title" id="title" class="preview-title" autocomplete="off"/>
                <textarea name="description" id="description" autocomplete="off" class="preview-description">

                </textarea>
            </div>
        </form>
    </div>
</section>
<script src="/js/script.js"></script>
</body>

</html>