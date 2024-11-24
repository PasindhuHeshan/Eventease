
<?php

$itemData = $_SESSION['itemData'];

if ($itemData) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Item</title>
    <link rel="stylesheet" href="modify_item.css">
</head>
<body>
    <h2>Modify Item</h2>
    <form method="POST" action="modify_item.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($itemData['id']); ?>">

        <label for="item">Item</label>
        <input type="text" id="item" name="item" value="<?php echo htmlspecialchars($itemData['item']); ?>" required>

        <label for="inventory_no">Inventory No</label>
        <input type="text" id="inventory_no" name="inventory_no" value="<?php echo htmlspecialchars($itemData['inventory_no']); ?>" readonly>
        
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($itemData['quantity']); ?>" required>
        <h6 style="margin: 0px;"><?php echo $itemData['in_use']; ?> items in use.</h6>
        <br>
        <label for="inventory_type">Inventory Type</label>
        <select name="inventory_type" id="inventory_type">
            <option value="Appliances" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Appliances' ? 'selected' : ''; ?>>Appliances</option>
            <option value="Stationery" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Stationery' ? 'selected' : ''; ?>>Stationery</option>
            <option value="Furniture" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
            <option value="Electronics" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
        </select>
        <button type="submit">Update</button>
    </form>
</body>
</html>
<?php
} else {
    echo "Item not found.";
}
?>
