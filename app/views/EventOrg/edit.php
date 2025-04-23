<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" type="text/css" href="./css/global.css">
    <link rel="stylesheet" type="text/css" href="./css/editstyles.css">
    <style>
        .staff-fields-hidden,
        .inventory-fields-hidden {
            display: none;
        }
    </style>
</head>

<body>
    <h2 id="special">Edit Event</h2>
    <div class="page">
        <div class="sidebar">
            <ul>
                <li data-target="general-details">General Details</li>
                <li data-target="management-staff-details">Management Staff Details</li>
                <li data-target="notification-management">Notification Management</li>
                <li data-target="inventory-management">Inventory Management</li>
            </ul>
        </div>
        <div class="content">
            <div class="event">
                <!-- General Details Form -->
                <form action="processEvent" method="post" enctype="multipart/form-data" id="generalDetailsForm">
                    <div id="general-details" class="content-section active">
                        <h3>General Details</h3>
                        <input type="hidden" name="eventno" value="<?php echo isset($eventData['no']) ? $eventData['no'] : ''; ?>">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="<?php echo isset($eventData['name']) ? $eventData['name'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="<?php echo isset($eventData['date']) ? $eventData['date'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="time">Starting Time</label>
                            <input type="time" name="time" id="time" class="form-control"
                                value="<?php echo isset($eventData['time']) ? $eventData['time'] : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="finish_time">Finishing Time</label>
                            <input type="time" name="finish_time" id="finish_time" class="form-control"
                                value="<?php echo isset($eventData['finish_time']) ? $eventData['finish_time'] : ''; ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="venue">Venue</label>
                            <input type="text" name="location" id="venue" class="form-control"
                                value="<?php echo isset($eventData['location']) ? $eventData['location'] : ''; ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="event_type">Type</label>
                            <select name="event_type" id="event_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="Social"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Social') ? 'selected' : ''; ?>>
                                    Social</option>
                                <option value="Educational"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Educational') ? 'selected' : ''; ?>>
                                    Educational</option>
                                <option value="Entertainment"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Entertainment') ? 'selected' : ''; ?>>
                                    Entertainment</option>
                                <option value="Culture"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Culture') ? 'selected' : ''; ?>>
                                    Culture</option>
                                <option value="Charity"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Charity') ? 'selected' : ''; ?>>
                                    Charity</option>
                                <option value="Music"
                                    <?php echo (isset($eventData['event_type']) && $eventData['event_type'] == 'Music') ? 'selected' : ''; ?>>
                                    Music</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="long_dis">Description</label>
                            <textarea rows="5" name="long_dis" id="long_dis" class="form-control"
                                required><?php echo isset($eventData['long_dis']) ? $eventData['long_dis'] : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="participant_cap">Participant Cap</label>
                            <input type="number" name="people_limit" id="participant_cap" class="form-control"
                                value="<?php echo isset($eventData['people_limit']) ? $eventData['people_limit'] : ''; ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="target_audience">Target Audience</label>
                            <select name="flag" id="target_audience" class="form-select" required>
                                <option value="0"
                                    <?php echo (isset($eventData['flag']) && $eventData['flag'] == '0') ? 'selected' : ''; ?>>
                                    Students</option>
                                <option value="1"
                                    <?php echo (isset($eventData['flag']) && $eventData['flag'] == '1') ? 'selected' : ''; ?>>
                                    All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="event_banner">Event Banner</label>
                            <input type="file" name="event_banner" id="event_banner" class="form-control">
                        </div>
                        <?php if (isset($eventData['event_banner'])): ?>
                            <input type="hidden" name="existing_event_banner"
                                value="<?php echo $eventData['event_banner']; ?>">
                            <p>Current Event Banner -
                                <?php echo basename($eventData['event_banner']); ?></p>
                        <?php endif; ?>
                        <input type="hidden" name="supervisor" value="<?php echo isset($eventData['supervisor']) ? $eventData['supervisor'] : ''; ?>">
                        <button type="submit" name="update_details" class="btn primary">Update</button>
                    </div>
                </form>

                <form action="processEvent" method="post" id="managementStaffForm">
                    <div id="management-staff-details" class="content-section">
                        <h3>Management Staff Details</h3>
                            <div id="staff-container">
                                <div class="form-group" id="staff_owner">
                                    <label for="role_owner">Role</label>
                                    <input type="text" id="role_owner" class="form-control" value="Owner" readonly>
                                    <label for="name_owner">Name (Owner)</label>
                                    <input type="text" id="name_owner" class="form-control"
                                        value="<?php echo $userData['fname'] . ' ' . $userData['lname']; ?>"
                                        readonly>
                                    <input type="hidden" name="staff_id_owner" value="<?php echo $userData['No']; ?>">
                                </div>
                            
                                <?php if (!empty($geteventstaffmembers)): ?>
                                    <?php foreach ($geteventstaffmembers as $index => $staff): ?>
                                        <div class="form-group" id="staff_<?php echo $index + 1; ?>">
                                            <label for="role_<?php echo $index + 1; ?>">Role</label>
                                            <input type="text" id="role_<?php echo $index + 1; ?>" class="form-control" 
                                                value="<?php echo $staff['event_role']; ?>" readonly>
                                            <label for="name_<?php echo $index + 1; ?>">Name</label>
                                            <input type="text" id="name_<?php echo $index + 1; ?>" class="form-control" 
                                                value="<?php echo $staff['fname']." ".$staff['lname']; ?>" readonly>
                                            <input type="hidden" name="staff_id_<?php echo $index + 1; ?>" 
                                                value="<?php echo $staff['member_id']; ?>">
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            <div class="form-group staff-fields-hidden" id="staff_1">
                                <label for="role_1">Role</label>
                                <select name="role_1" id="role_1" class="form-control" required>
                                    <option value="Coordinator">Coordinator</option>
                                    <option value="Volunteer">Volunteer</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Treasurer">Treasurer</option>
                                </select>
                                <label for="name_1">Name</label>
                                <div class="management-staff-search-container">
                                    <input type="text" id="userSearch_1" class="form-control"
                                        placeholder="Search Staff..." autocomplete="off">
                                    <input type="hidden" name="staff_id_1" id="selectedStaffId_1">
                                    <div id="staffResults_1" class="management-staff-results"></div>
                                </div>
                            </div>

                            <?php for ($i = 2; $i <= 10; $i++): ?>
                                <div class="form-group staff-fields-hidden" id="staff_<?php echo $i; ?>">
                                    <label for="role_<?php echo $i; ?>">Role</label>
                                    <select name="role_<?php echo $i; ?>" id="role_<?php echo $i; ?>"
                                            class="form-control">
                                        <option value="">Select Role</option>
                                        <option value="Coordinator">Coordinator</option>
                                                    <button type="button" class="btn secondary" id="addStaffBtn">Add Staff</button>
                                                    <script>
                                                        document.getElementById('addStaffBtn').addEventListener('click', function () {
                                                            const staffContainer = document.getElementById('staff-container');
                                                            const newStaffIndex = staffContainer.children.length + 1;
                                                            if (newStaffIndex > 10) {
                                                                alert('You can only add up to 10 staff members.');
                                                                return;
                                                            }
                                                    
                                                            const newStaffDiv = document.createElement('div');
                                                            newStaffDiv.className = 'form-group';
                                                            newStaffDiv.id = `staff_${newStaffIndex}`;
                                                            newStaffDiv.innerHTML = `
                                                                <label for="role_${newStaffIndex}">Role</label>
                                                                <select name="role_${newStaffIndex}" id="role_${newStaffIndex}" class="form-control">
                                                                    <option value="">Select Role</option>
                                                                    <option value="Coordinator">Coordinator</option>
                                                                    <option value="Volunteer">Volunteer</option>
                                                                    <option value="Manager">Manager</option>
                                                                    <option value="Treasurer">Treasurer</option>
                                                                </select>
                                                                <label for="name_${newStaffIndex}">Name</label>
                                                                <input type="text" id="name_${newStaffIndex}" class="form-control" placeholder="Enter Name">
                                                                <input type="hidden" name="staff_id_${newStaffIndex}" id="staff_id_${newStaffIndex}">
                                                            `;
                                                            staffContainer.appendChild(newStaffDiv);
                                                        });
                                                    </script>
                                        <option value="Manager">Manager</option>
                                        <option value="Treasurer">Treasurer</option>
                                    </select>
                                    <label for="name_<?php echo $i; ?>">Name</label>
                                    <div class="management-staff-search-container">
                                        <input type="text" id="userSearch_<?php echo $i; ?>" class="form-control"
                                            placeholder="Search Staff..." autocomplete="off">
                                        <input type="hidden" name="staff_id_<?php echo $i; ?>" id="selectedStaffId_<?php echo $i; ?>">
                                        <div id="staffResults_<?php echo $i; ?>" class="management-staff-results"></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="button-row">
                            <button type="button" class="btn secondary" id="addStaffBtn">Add Staff</button>
                            <button type="submit" name="update_staff" class="btn primary">Update</button>
                        </div>
                    </div>
                </form>

                <!-- Notification Management Form -->
                <form action="processEvent" method="post" id="notificationManagementForm">
                    <div id="notification-management" class="content-section">
                        <h3>Notification Management</h3>
                        <div class="form-group">
                            <label for="notification_title">Title</label>
                            <input type="text" name="notification_title" id="notification_title" class="form-control"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="notification_description">Description</label>
                            <textarea name="notification_description" id="notification_description" class="form-control"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="notification_receivers">Receivers</label>
                            <input type="text" name="notification_receivers" id="notification_receivers"
                                class="form-control" required>
                        </div>
                        <button type="submit" name="send_notification" class="btn primary">Send
                            Notification</button>
                    </div>
                </form>

                <form action="processEvent" method="post" id="inventoryManagementForm">
                <div id="inventory-management" class="content-section">
                    <h3>Inventory Management</h3>
                    <div id="inventory-container">
                        <?php if (!empty($getthiseventinventory)): ?>
                            <?php foreach ($getthiseventinventory as $index => $inventory): ?>
                                <div class="form-group inventory-item" id="inventory_<?php echo $index + 1; ?>">
                                    <label for="inventory_item_<?php echo $index + 1; ?>">Item</label>
                                    <select name="inventory_item_<?php echo $index + 1; ?>" id="inventory_item_<?php echo $index + 1; ?>" 
                                            class="form-control" required>
                                        <?php foreach ($eventsinventory as $eventInventory): ?>
                                            <option value="<?php echo $eventInventory['item']; ?>" 
                                                    data-id="<?php echo $eventInventory['id']; ?>" 
                                                    data-available="<?php echo $eventInventory['available_quantity']; ?>"
                                                    <?php echo ($eventInventory['item'] === $inventory['item']) ? 'selected' : ''; ?>>
                                                <?php echo $eventInventory['item']; ?> (Available: <?php echo $eventInventory['available_quantity']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="inventory_quantity_<?php echo $index + 1; ?>">Quantity</label>
                                    <input type="number" name="inventory_quantity_<?php echo $index + 1; ?>" id="inventory_quantity_<?php echo $index + 1; ?>" 
                                        class="form-control" value="<?php echo $inventory['quantity']; ?>" min="1" required>
                                    <input type="hidden" name="inventory_id_<?php echo $index + 1; ?>" value="<?php echo $inventory['id']; ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Add new inventory items -->
                        <div class="form-group inventory-item" id="inventory_1">
                            <label for="inventory_item_1">Select Item</label>
                            <select name="inventory_item_1" id="inventory_item_1" class="form-control" required>
                                <option value="">Select Item</option>
                                <?php foreach ($eventsinventory as $inventory): ?>
                                    <option value="<?php echo $inventory['item']; ?>" data-id="<?php echo $inventory['id']; ?>" data-available="<?php echo $inventory['available_quantity']; ?>">
                                        <?php echo $inventory['item']; ?> (Available: <?php echo $inventory['available_quantity']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="inventory_quantity_1">Quantity</label>
                            <input type="number" name="inventory_quantity_1" id="inventory_quantity_1" class="form-control" min="1" required>
                            <input type="hidden" name="inventory_id_1" id="inventory_id_1" value="">
                        </div>
                    </div>

                    <input type="hidden" name="request_inventory" value="1">

                    <div class="button-row">
                        <button type="button" class="btn secondary" id="addInventoryBtn">Add Item</button>
                        <input type="hidden" name="eventno" value="<?php echo isset($eventData['no']) ? $eventData['no'] : ''; ?>">
                        <button type="submit" class="btn primary">Request</button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarItems = document.querySelectorAll(".sidebar li");
        const sections = document.querySelectorAll(".content-section");
        const staffContainer = document.getElementById("staff-container");
        let staffCount = 1; // Start count from 1 (only the first add staff row visible initially)
        const maxStaff = 10;
        const staffFields = document.querySelectorAll(".staff-fields-hidden");
        const addStaffBtn = document.getElementById("addStaffBtn");
    
        // Inventory Management
        const inventoryContainer = document.getElementById("inventory-container");
        const addInventoryBtn = document.getElementById("addInventoryBtn");
        let inventoryCount = 1; // Start count for inventory items
        const maxInventory = 10;
    
        if (addInventoryBtn) {
            addInventoryBtn.addEventListener("click", function () {
                if (inventoryCount >= maxInventory) {
                    alert("You can only add up to 10 inventory items.");
                    return;
                }
                inventoryCount++;
                const newInventoryDiv = document.createElement("div");
                newInventoryDiv.className = "form-group inventory-item";
                newInventoryDiv.id = `inventory_${inventoryCount}`;
                newInventoryDiv.innerHTML = `
                    <label for="inventory_item_${inventoryCount}">Select Item</label>
                    <select name="inventory_item_${inventoryCount}" id="inventory_item_${inventoryCount}" class="form-control" required>
                        <option value="">Select Item</option>
                        <?php foreach ($eventsinventory as $inventory): ?>
                            <option value="<?php echo $inventory['item']; ?>" data-id="<?php echo $inventory['id']; ?>" data-available="<?php echo $inventory['available_quantity']; ?>">
                                <?php echo $inventory['item']; ?> (Available: <?php echo $inventory['available_quantity']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="inventory_quantity_${inventoryCount}">Quantity</label>
                    <input type="number" name="inventory_quantity_${inventoryCount}" id="inventory_quantity_${inventoryCount}" class="form-control" min="1" required>
                    <input type="hidden" name="inventory_id_${inventoryCount}" id="inventory_id_${inventoryCount}" value="">
                `;
                
                document.getElementById(`inventory_item_${inventoryCount}`).addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];
                    const inventoryIdField = document.getElementById(`inventory_id_${inventoryCount}`);
                    inventoryIdField.value = selectedOption.getAttribute('data-id');
                });
                inventoryContainer.appendChild(newInventoryDiv);
            });
        }

    // Sample staff data (replace with your actual PHP data)
    const staffMembers = [
        <?php foreach ($staffMembers as $staff): ?> {
            id: "<?php echo $staff['No']; ?>",
            name: "<?php echo $staff['fname'] . ' ' . $staff['lname']; ?>",
        },
        <?php endforeach; ?>
    ];

    function showSection(id) {
        sections.forEach(section => {
            section.classList.remove("active");
            if (section.id === id) {
                section.classList.add("active");
            }
        });
    }

    sidebarItems.forEach(item => {
        item.addEventListener("click", () => {
            const targetId = item.getAttribute("data-target");
            showSection(targetId);
        });
    });

    // Function to initialize search for a staff member
    function initStaffSearch(index) {
        const userSearch = document.getElementById(`userSearch_${index}`);
        const staffResults = document.getElementById(`staffResults_${index}`);
        const selectedStaffId = document.getElementById(`selectedStaffId_${index}`);

        function searchStaff(query) {
            staffResults.innerHTML = '';

            if (query.length < 2) {
                staffResults.style.display = 'none';
                return;
            }

            const filtered = staffMembers.filter(staff =>
                staff.name.toLowerCase().includes(query.toLowerCase())
            );

            if (filtered.length === 0) {
                const noResults = document.createElement('div');
                noResults.className = 'management-staff-result-item';
                noResults.textContent = 'No staff members found';
                staffResults.appendChild(noResults);
            } else {
                filtered.forEach(staff => {
                    const item = document.createElement('div');
                    item.className = 'management-staff-result-item';
                    item.textContent = staff.name;
                    item.dataset.id = staff.id;
                    item.addEventListener('click', function () {
                        userSearch.value = staff.name;
                        selectedStaffId.value = staff.id;
                        staffResults.style.display = 'none';
                    });
                    staffResults.appendChild(item);
                });
            }

            staffResults.style.display = 'block';
        }

        userSearch.addEventListener('input', function () {
            searchStaff(this.value);
        });

        document.addEventListener('click', function (e) {
            if (!userSearch.contains(e.target) && !staffResults.contains(e.target)) {
                staffResults.style.display = 'none';
            }
        });
    }

    // Show only the first "Add Staff" row by default (index 1)
    const firstStaffField = document.getElementById(`staff_1`);
    if (firstStaffField) {
        firstStaffField.classList.remove('staff-fields-hidden');
        initStaffSearch(1); // Initialize search for the visible row
    }

    if (addStaffBtn) {
        addStaffBtn.addEventListener('click', function () {
            if (staffCount >= maxStaff) {
                alert("You can only add up to 10 staff members.");
                return;
            }
            staffCount++;
            const nextStaffField = document.getElementById(`staff_${staffCount}`);
            if (nextStaffField) {
                nextStaffField.classList.remove('staff-fields-hidden');
                initStaffSearch(staffCount); // Initialize search for the new row
            }
        });
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const inventoryContainer = document.getElementById("inventory-container");
    const addInventoryBtn = document.getElementById("addInventoryBtn");
    let inventoryCount = 1;
    const maxInventory = 10;

    addInventoryBtn.addEventListener("click", function () {
        if (inventoryCount >= maxInventory) {
            alert("You can only add up to 10 inventory items.");
            return;
        }

        inventoryCount++;
        const newInventoryDiv = document.createElement("div");
        newInventoryDiv.className = "form-group inventory-item";
        newInventoryDiv.id = `inventory_${inventoryCount}`;
        newInventoryDiv.innerHTML = `
            <label for="inventory_item_${inventoryCount}">Select Item</label>
            <select name="inventory_item_${inventoryCount}" id="inventory_item_${inventoryCount}" class="form-control" required>
                <option value="">Select Item</option>
                <?php foreach ($eventsinventory as $inventory): ?>
                    <option value="<?php echo $inventory['item']; ?>" data-id="<?php echo $inventory['id']; ?>" data-available="<?php echo $inventory['available_quantity']; ?>">
                        <?php echo $inventory['item']; ?> (Available: <?php echo $inventory['available_quantity']; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="inventory_quantity_${inventoryCount}">Quantity</label>
            <input type="number" name="inventory_quantity_${inventoryCount}" id="inventory_quantity_${inventoryCount}" class="form-control" min="1" required>
            <input type="hidden" name="inventory_id_${inventoryCount}" id="inventory_id_${inventoryCount}" value="">
        `;
        inventoryContainer.appendChild(newInventoryDiv);

        // Attach event listener for the new select field
        const newSelect = document.getElementById(`inventory_item_${inventoryCount}`);
        const newHiddenId = document.getElementById(`inventory_id_${inventoryCount}`);
        newSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            newHiddenId.value = selectedOption.getAttribute('data-id');
        });
    });

    // Set ID on first inventory field
    const firstInventorySelect = document.getElementById("inventory_item_1");
    const firstInventoryId = document.getElementById("inventory_id_1");
    if (firstInventorySelect && firstInventoryId) {
        firstInventorySelect.addEventListener("change", function () {
            const selectedOption = this.options[this.selectedIndex];
            firstInventoryId.value = selectedOption.getAttribute("data-id");
        });
    }
});
</script>


</body>

</html>