<?php

require "header.php";

$item = null;
if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $result = $db->query("SELECT * FROM items WHERE ID = ".$_GET["id"]);
    if($result->rowCount() > 0) {
        $item = $result->fetch(PDO::FETCH_ASSOC);
    }
}

if(isset($_POST['name']) && isset($_POST['shop']) && isset($_POST['date_purchased']) && isset($_POST['warranty'])) {
    $item['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $item['shop'] = filter_var($_POST['shop'], FILTER_SANITIZE_STRING);
    $item['date_purchased'] = filter_var($_POST['date_purchased'], FILTER_SANITIZE_STRING);
    $item['warranty'] = filter_var($_POST['warranty'], FILTER_SANITIZE_NUMBER_INT);
    if($item['name'] != "" && $item['shop'] != "" && $item['date_purchased'] != "" && $item['warranty'] != "") {
        if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $db->query("UPDATE items SET name =\"".$item['name']."\", shop =\"".$item['shop']."\", date_purchased = \"".$item['date_purchased']."\", warranty=".$item['warranty']." where id = ".$_GET['id']);
            echo '<p class="bg-success" style="margin: 10px; padding: 10px;">Record updated</p>';
        } else {
            $db->query("INSERT INTO items (name, shop, date_purchased, warranty) VALUES (\"".$item['name']."\", \"".$item['shop']."\", \"".$item['date_purchased']."\", ".$item['warranty'].")");
            echo '<p class="bg-success" style="margin: 10px; padding: 10px;">Record created</p>';
        }
    }
}

?>

<div class="button-group"><a href="logout.php" class="btn pull-right" style="margin: 10px">Atsijungti</a></div>
<div class="button-group"><a href="index.php" class="btn btn-primary" style="margin: 10px">Grįžti</a></div>
<form method="post">
    <div class="form-group">
        <label for="name">Prekė</label>
        <input type="text" class="form-control" name="name" required="required" placeholder="Cooler Master Hyper 212 Evo" value="<?php echo $item["name"]?>">
    </div>
    <div class="form-group">
        <label for="shop">Parduotuvė</label>
        <input type="text" class="form-control" name="shop" required="required" placeholder="skytech.lt" value="<?php echo $item["shop"]?>">
    </div>
    <div class="form-group">
        <label for="date_purchased">Pirkimo data</label>
        <input type="date" class="form-control" name="date_purchased" required="required" value="<?php echo $date = !isset($item['date_purchased']) ? date("Y-m-d", time()): $item['date_purchased']; ?>">
    </div>
    <div class="form-group">
        <label for="name">Garantija</label>
        <input type="number" class="form-control" name="warranty" required="required" placeholder="24" value="<?php echo $item["warranty"]?>">
    </div>
    <button type="submit" class="btn btn-default">Išsaugoti</button>
</form>