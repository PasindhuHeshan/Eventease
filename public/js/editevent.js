document.addEventListener("DOMContentLoaded", function () {
    const sidebarItems = document.querySelectorAll(".sidebar li");
    const sections = document.querySelectorAll(".content-section");
    const staffContainer = document.getElementById("staff-container");
    const inventoryContainer = document.getElementById("inventory-container");
    const addStaffBtn = document.getElementById("addStaffBtn");
    const addInventoryBtn = document.getElementById("addInventoryBtn");
    let staffCount = 1; // Initial staff member
    let inventoryCount = 1; // Initial inventory item
    const maxStaff = 10; // Maximum staff members allowed
    const maxInventory = 10; // Maximum inventory items allowed

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

    window.addStaff = function () {
        if (staffCount >= maxStaff) {
            alert("You can only add up to 10 staff members.");
            return;
        }
        staffCount++;
        const staffHtml = `
            <div class="form-group" id="staff_${staffCount}">
                <label for="role_${staffCount}">Role</label>
                <select name="role_${staffCount}" id="role_${staffCount}" class="form-control" required>
                    <option value="Coordinator">Coordinator</option>
                    <option value="Volunteer">Volunteer</option>
                    <option value="Manager">Manager</option>
                    <option value="Treasurer">Treasurer</option>
                </select>
                <label for="name_${staffCount}">Name</label>
                <div class="management-staff-search-container">
                    <input type="text" id="userSearch_${staffCount}" class="form-control" placeholder="Search Staff..." autocomplete="off">
                    <input type="hidden" name="staff_id_${staffCount}" id="selectedStaffId_${staffCount}">
                    <div id="staffResults_${staffCount}" class="management-staff-results"></div>
                </div>
                <button type="button" class="btn danger" onclick="removeStaff(${staffCount})">Remove</button>
            </div>
        `;
        staffContainer.insertAdjacentHTML("beforeend", staffHtml);
        // Initialize search for the new staff member
        initStaffSearch(staffCount);
    };

    window.removeStaff = function (id) {
        const staffElement = document.getElementById(`staff_${id}`);
        if (staffElement) {
            staffElement.remove();
            staffCount--;
        }
    };

    window.addInventory = function () {
        if (inventoryCount >= maxInventory) {
            alert("You can only add up to 10 inventory items.");
            return;
        }
        inventoryCount++;
        const inventoryHtml = `
            <div class="form-group" id="inventory_${inventoryCount}">
                <label for="inventory_name_${inventoryCount}">Item Type</label>
                <select name="inventory_name_${inventoryCount}" id="inventory_name_${inventoryCount}" class="form-control" required>
                    <option value="Electronics">Electronics</option>
                    <option value="Appliances">Appliances</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Stationery">Stationery</option>
                </select>
                <label for="inventory_quantity_${inventoryCount}">Quantity</label>
                <input type="number" name="inventory_quantity_${inventoryCount}" id="inventory_quantity_${inventoryCount}" class="form-control" required>
                <button type="button" class="btn danger" onclick="removeInventory(${inventoryCount})">Remove</button>
            </div>
        `;
        inventoryContainer.insertAdjacentHTML("beforeend", inventoryHtml);
    };

    window.removeInventory = function (id) {
        const inventoryElement = document.getElementById(`inventory_${id}`);
        if (inventoryElement) {
            inventoryElement.remove();
            inventoryCount--;
        }
    };

    // Initialize search for the first staff member
    initStaffSearch(1);

    // Event listeners for the "Add Staff" and "Add Item" buttons
    if (addStaffBtn) {
        addStaffBtn.addEventListener('click', window.addStaff);
    }
    if (addInventoryBtn) {
        addInventoryBtn.addEventListener('click', window.addInventory);
    }
});
