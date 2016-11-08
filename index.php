<?php

include "header.php";
?>
<div class="button-group">
    <a href="logout.php" class="btn pull-right" style="margin: 10px">Atsijungti</a>
</div>

<div class="button-group"><a href="edit.php" class="btn btn-primary" style="margin: 10px">Pridėti</a></div>
<?php

$sql = "SELECT *, DATE_ADD(date_purchased, INTERVAL warranty MONTH) AS expiration_date, TIMESTAMPDIFF(DAY, NOW(), DATE_ADD(date_purchased, INTERVAL warranty MONTH)) AS days_left FROM items WHERE is_deleted = 0";

if(isset($_GET['order'])) {
    switch ($_GET['order']) {
        case "item" :
            $sql .= ' ORDER BY name';
            break;
        case "shop" :
            $sql .= ' ORDER BY shop';
            break;
        case "purchased" :
            $sql .= ' ORDER BY date_purchased';
            break;
        case "warranty" :
            $sql .= ' ORDER BY warranty';
            break;
        case "warranty_until" :
            $sql .= ' ORDER BY expiration_date';
            break;
        default :
            $sql .= ' ORDER BY days_left';
    }
}
$items = $db->query($sql);

echo '<table class="table table-condensed table-hover">';
echo '<tr><th><a href="?order=item">Prekė</a></th>
      <th><a href="?order=shop">Parduotuvė</a></th>
      <th><a href="?order=purchased">Pirkimo data</a></th>
      <th><a href="?order=warranty">Garantija</a></th>
      <th><a href="?order=warranty_until">Garantija iki</a></th>
      <th><a href="?order=warranty_left">Liko</a></th><th></th></tr>';
if($items->rowCount() > 0) {
    foreach ($items as $item) {
        echo "<tr><td>". $item["name"]."</td>
              <td>". $item["shop"]."</td>
              <td>". $item["date_purchased"]."</td>
              <td>". $item["warranty"]."</td>
              <td>". $item["expiration_date"]."</td>
              <td>". $item["days_left"]."</td>
              <td><a href=edit.php?id=".$item["id"]." type=\"button\" class=\"btn btn-warning\" aria-label=\"Left Align\"><span class=\"glyphicon glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></button></td></tr>";
    }
} else {
    echo "<tr><td colspan='7'>Nothing found.</td></tr>";
}
echo '</table>';
