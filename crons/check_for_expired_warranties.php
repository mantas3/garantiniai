<?php

include (__DIR__.'/../dbconn.php');
    $items = $db->query("SELECT * FROM items WHERE is_deleted = 0");
    if($items->rowCount() > 0) {
        $items = $items->fetchAll(PDO::FETCH_ASSOC);
        foreach ($items as $item) {
            $days_left = (int)((strtotime($item["date_purchased"]."+".$item['warranty']." months") -  time()) / 86400);
            if($days_left <= 0) {
                $db->query("UPDATE items set is_deleted = 1 WHERE id = ".$item['id']);
                mail($email['recipient'], "Warranty expired", "Warranty expired on ".$item['name'], "From: $email[sender]");
            }
        }
    }

