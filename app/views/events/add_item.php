<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
    <link rel="stylesheet" href="itemstyles.css">
</head>
<body>
    <h2>Add New Item</h2>
    <form method="POST" action="save_item.php">
        <label for="item">Item</label>
        <input type="text" name="item" id="item" required><br>

        <label for="inventory_no">Inventory No</label>
        <input type="text" name="inventory_no" id="inventory_no" required><br>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" required><br>

        <label for="inventory_type">Inventory Type</label>
        <select name="inventory_type" id="inventory_type" required>
                     <option value="Appliances">Appliances</option>
                    <option value="Stationery">Stationery</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Electronics">Electronics</option>
        </select><br>

        <button type="submit">Save</button>
    </form>
</body>
</html>
