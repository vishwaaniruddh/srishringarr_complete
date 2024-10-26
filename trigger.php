<?php

$con = mysqli_connect("localhost", "srishrin_juser", "juser123","srishrin_jewels");
$con3=mysqli_connect("localhost", "sarmicro_pos", "Mypos1234","sarmicro_srishringarr");

// // Server A connection details
// $serverA_host = 'server_a_host';
$serverA_db = 'sarmicro_srishringarr';
// $serverA_user = 'server_a_username';
// $serverA_pass = 'server_a_password';

// // Server B connection details
// $serverB_host = 'server_b_host';
$serverB_db = 'srishrin_jewels';
// $serverB_user = 'server_b_username';
// $serverB_pass = 'server_b_password';

// // Connect to server A
// $serverA_conn = new mysqli($serverA_host, $serverA_user, $serverA_pass, $serverA_db);

// // Connect to server B
// $serverB_conn = new mysqli($serverB_host, $serverB_user, $serverB_pass, $serverB_db);

// // Check server A connection
// if ($serverA_conn->connect_error) {
//     die("Server A Connection failed: " . $serverA_conn->connect_error);
// }

// Check server B connection
// if ($serverB_conn->connect_error) {
//     die("Server B Connection failed: " . $serverB_conn->connect_error);
// }

// Create trigger on server A for INSERT
$con3->query("
    CREATE TRIGGER replicate_to_server_b_insert
    AFTER INSERT ON phppos_items
    FOR EACH ROW
    BEGIN
        -- Insert the new row into the corresponding table on server B
        INSERT INTO $serverB_db.phppos_items (name, category, supplier_id, item_number, description, cost_price, unit_price, quantity, reorder_level, item_id, allow_alt_description, is_serialized, img, srno, pd_id, showing, is_deleted, deleted_at, updated_at)
        VALUES (NEW.name, NEW.category, NEW.supplier_id, NEW.item_number, NEW.description, NEW.cost_price, NEW.unit_price, NEW.quantity, NEW.reorder_level, NEW.item_id, NEW.allow_alt_description, NEW.is_serialized, NEW.img, NEW.srno, NEW.pd_id, NEW.showing, NEW.is_deleted, NEW.deleted_at, NEW.updated_at);
    END;
");

// Create trigger on server A for UPDATE
$con3->query("
    CREATE TRIGGER replicate_to_server_b_update
    AFTER UPDATE ON phppos_items
    FOR EACH ROW
    BEGIN
        -- Update the corresponding row on server B
        UPDATE $serverB_db.phppos_items
        SET name = NEW.name, category = NEW.category, supplier_id = NEW.supplier_id, item_number = NEW.item_number, description = NEW.description, cost_price = NEW.cost_price, unit_price = NEW.unit_price, quantity = NEW.quantity, reorder_level = NEW.reorder_level, item_id = NEW.item_id, allow_alt_description = NEW.allow_alt_description, is_serialized = NEW.is_serialized, img = NEW.img, srno = NEW.srno, pd_id = NEW.pd_id, showing = NEW.showing, is_deleted = NEW.is_deleted, deleted_at = NEW.deleted_at, updated_at = NEW.updated_at
        WHERE item_id = NEW.item_id;
    END;
");

// Create trigger on server A for DELETE
$con3->query("
    CREATE TRIGGER replicate_to_server_b_delete
    AFTER DELETE ON phppos_items
    FOR EACH ROW
    BEGIN
        -- Delete the corresponding row on server B
        DELETE FROM $serverB_db.phppos_items WHERE item_id = OLD.item_id;
    END;
");

echo "Triggers created successfully.";

// Close connections
$con3->close();
$con->close();
?>