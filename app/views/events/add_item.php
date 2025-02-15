<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
    <link rel="stylesheet" href="./css/itemstyles.css">
</head>
<body>
    <h2>Add New Item</h2>
    <form method="POST" action="save_item.php" id="addItemForm" enctype="multipart/form-data">
        <label for="item">Item</label>
        <input type="text" name="item" id="item" placeholder="Desk"><br>

        <label for="inventory_no">Inventory No</label>
        <input type="text" name="inventory_no" id="inventory_no" placeholder="INV-001">
        <?php if (isset($_SESSION['error'])) { ?>
            <p class="error"><?php echo $_SESSION['error']; ?></p>
        <?php } ?>
        <?php unset($_SESSION['error']); ?>
        <br>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" placeholder="25"><br>

        <label for="inventory_type">Inventory Type</label>
        <select name="inventory_type" id="inventory_type">
            <option value="Appliances">Appliances</option>
            <option value="Stationery">Stationery</option>
            <option value="Furniture" selected>Furniture</option>
            <option value="Electronics">Electronics</option>
        </select><br>

        <div class="button-container">
            <button type="submit" name="submit">Save</button>
            <button type="submit" name="back">Back</button>
        </div>
    </form>

    <h2>Import Items from Excel</h2>
    <form method="POST" action="import_excel.php" id="importExcelForm" enctype="multipart/form-data">
        <label for="excel_file">Excel File</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls"><br>
        <button type="submit" name="import">Import Excel</button>
    </form>

    <script>
        document.getElementById('addItemForm').addEventListener('input', function() {
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
