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
    <link rel="stylesheet" href="./css/itemstyles.css">
</head>
<body>
    <h2>Modify Item</h2>
    <form method="POST" action="modify_item.php" id="modifyItemForm">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($itemData['id']); ?>">

        <label for="item">Item</label>
        <input type="text" id="item" name="item" value="<?php echo htmlspecialchars($itemData['item']); ?>" placeholder="Desk"><br>

        <label for="inventory_no">Inventory No</label>
        <input type="text" id="inventory_no" name="inventory_no" value="<?php echo htmlspecialchars($itemData['inventory_no']); ?>" readonly><br>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message" style="color: red; font-size: small;"><?php echo $_SESSION['error']; ?></div>
        <?php endif; ?>
        <?php unset($_SESSION['error']); ?>
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($itemData['quantity']); ?>" placeholder="25" min="1"><br>
        <h6 style="margin: 0px;"><?php echo $itemData['in_use']; ?> items in USE.</h6>
        <input type="hidden" id="in_use" name="in_use" value="<?php echo htmlspecialchars($itemData['in_use']); ?>" readonly><br>

        <br>
        <label for="inventory_type">Inventory Type</label>
        <select name="inventory_type" id="inventory_type">
            <option value="Appliances" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Appliances' ? 'selected' : ''; ?>>Appliances</option>
            <option value="Stationery" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Stationery' ? 'selected' : ''; ?>>Stationery</option>
            <option value="Furniture" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Furniture' ? 'selected' : ''; ?>>Furniture</option>
            <option value="Electronics" <?php echo htmlspecialchars($itemData['inventory_type']) == 'Electronics' ? 'selected' : ''; ?>>Electronics</option>
        </select><br>

        <div class="button-container">
            <button type="submit" name="submit">Update</button>
            <button type="submit" name="back">Back</button>
        </div>
    </form>

    <script>
        document.getElementById('modifyItemForm').addEventListener('input', function() {
            var inputs = this.querySelectorAll('input, select');
            var hasValue = false;

            inputs.forEach(function(input) {
                if (input.value.trim() !== '') {
                    hasValue = true;
                }
            });

            inputs.forEach(function(input) {
                if (hasValue) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                }
            });
        });
    </script>
</body>
</html>
<?php
} else {
    echo "Item not found.";
}
?>
