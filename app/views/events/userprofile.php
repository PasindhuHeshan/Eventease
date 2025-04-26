<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/userprofile.css">
</head>
<body>
    <div class="box">
        <div class="container">
            <h2>Profile Details</h2>
            <div class="profile">
                <div class="profile-image">
                    <div class="image">
                        <img src="<?php if ($userData && $userData['profile_picture']) echo $userData['profile_picture']; else echo './images/profiles/adminlogo.png'; ?>" alt="Profile Picture">
                    </div>
                    <div class="imgbuttons">
                        <form action="user_controller.php?url=uploadProfilePicture" method="post" enctype="multipart/form-data">
                            <button type="button" class="upload-btn" onclick="document.getElementById('profile_picture').click();">Change Image</button>
                            <input type="file" id="profile_picture" name="profile_picture" style="display: none;" onchange="showFileName()">
                            <span id="file-name" class="file-name"></span>
                            <button type="submit" id="upload-button" style="display: none;">Upload</button>
                        </form>
                        <script>
                            document.getElementById('profile_picture').addEventListener('change', function(event) {
                                const file = event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const img = new Image();
                                        img.src = e.target.result;
                                        img.onload = function() {
                                            const canvas = document.createElement('canvas');
                                            const ctx = canvas.getContext('2d');
                                            const size = Math.min(img.width, img.height);
                                            canvas.width = size;
                                            canvas.height = size;
                                            ctx.drawImage(img, (img.width - size) / 2, (img.height - size) / 2, size, size, 0, 0, size, size);
                                            canvas.toBlob(function(blob) {
                                                const newFile = new File([blob], file.name, { type: file.type });
                                                const dataTransfer = new DataTransfer();
                                                dataTransfer.items.add(newFile);
                                                document.getElementById('profile_picture').files = dataTransfer.files;
                                                showFileName();
                                            }, file.type);
                                        };
                                    };
                                    reader.readAsDataURL(file);
                                }
                            });

                            function showFileName() {
                                const input = document.getElementById('profile_picture');
                                const fileNameDisplay = document.getElementById('file-name');
                                const uploadButton = document.getElementById('upload-button');
                                if (input.files.length > 0) {
                                    fileNameDisplay.textContent = input.files[0].name;
                                    uploadButton.style.display = 'block';
                                } else {
                                    fileNameDisplay.textContent = '';
                                    uploadButton.style.display = 'none';
                                }
                            }
                            function openchat(){
                                window.location.href = "chat.php";
                            }

                            function redirectToRoleRequest() {
                                window.location.href = "RoleRequest.php";
                            }
                            function confirmDelete() {
                                var result = confirm("Are you sure you want to delete this account?");
                                if (result) {
                                    window.location.href = "deleteAccount";
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        </script>
                    </div>
                </div>

                <div class="profile-details">
                    <form id="profileForm" action="index.php?url=updateProfile.php" method="post">
                        <table>
                            <tr class="name-row">
                                <th><label for="fname">First Name</label></th>
                                <td>
                                    <input type="text" id="fname" name="fname" value="<?php if ($userData) echo $userData['fname']; ?>" oninput="showSaveButton()" required>
                                    <span id="fname-error" class="error-message"></span>
                                </td>
                                <th><label for="lname">Last Name</label></th>
                                <td>
                                    <input type="text" id="lname" name="lname" value="<?php if ($userData) echo $userData['lname']; ?>" oninput="showSaveButton()" required>
                                    <span id="lname-error" class="error-message"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="email">Email</label></th>
                                <td colspan="3"><input type="email" id="email" name="email" value="<?php if ($userData) echo $userData['email']; ?>" oninput="showSaveButton()" readonly></td>
                            </tr>
                            <tr>
                                <th><label for="address">Address</label></th>
                                <td colspan="3">
                                    <input type="text" id="address" name="address" value="<?php if ($userData) echo $userData['address']; ?>" oninput="showSaveButton()">
                                    <span id="address-error" class="error-message"></span>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="city">City</label></th>
                                <td colspan="3"><input type="text" id="city" name="city" value="<?php if ($userData) echo $userData['city']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <th><label for="contactno1">Primary Contact No</label></th>
                                <td>
                                    <input type="number" id="contactno1" name="contactno1" value="<?php if ($userData && isset($userData['contact_numbers'][0])) echo $userData['contact_numbers'][0]; ?>" oninput="showSaveButton()" required>
                                    <span id="contactno1-error" class="error-message"></span>
                                </td>
                                <th><label for="contactno2">Secondary Contact No</label></th>
                                <td>
                                    <input type="number" id="contactno2" name="contactno2" value="<?php if ($userData && isset($userData['contact_numbers'][1])) echo $userData['contact_numbers'][1]; ?>" oninput="showSaveButton()">
                                    <span id="contactno2-error" class="error-message"></span>
                                </td>
                            </tr>
                            <?php if ($userData && $userData['role_name'] !== 'Guest') : ?>
                                <tr>
                                    <th><label for="id">University ID</label></th>
                                    <td colspan="3"><input type="text" id="id" name="id" value="<?php echo $userData['id']; ?>" readonly></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($userData && $userData['role_name'] == 'Guest') : ?>
                                <tr>
                                    <th><label for="id">NIC</label></th>
                                    <td colspan="3"><input type="text" id="id" name="id" value="<?php echo $userData['id']; ?>" readonly></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><label for="usertype">User Type</label></th>
                                <td colspan="3"><input type="text" id="usertype" name="usertype" value="<?php if ($userData) echo $userData['role_name']; ?>" readonly></td>
                            </tr>
                        </table>

                        <div class="buttons">
                            <button type="submit" class="save-btn" id="save-button" style="display: none;">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="buttons">
                <button type="button" class="chat-btn" onclick="openchat()">Chats</button>
                <?php if($userData['usertype']=='1'):?>
                    <button type="button" class="request-role-btn" onclick="redirectToRoleRequest()">Request Role</button>
                <?php endif;?>
                <button type="button" class="delete-account-btn" onclick="confirmDelete()">Delete Account</button>
            </div>
        </div>
    </div>

    <div id="deleteAccountModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteModal">&times;</span>
            <p id="delete-modal-message">Are you sure you want to permanently delete your account?</p>
            <div class="modal-buttons">
                <button id="confirm-delete-button" class="button delete-account-btn">Confirm Delete</button>
                <button id="cancel-delete-button" class="button">Cancel</button>
            </div>
        </div>
    </div>

    <script>
    function validateAndSubmit() {
        const contactNo1 = document.getElementById('contactno1').value.trim();
        const contactNo2 = document.getElementById('contactno2').value.trim();
        const address = document.getElementById('address').value.trim();
        const contactNumberRegex = /^[0-9]{10}$/;

        let isValid = true;

        // Clear previous error messages
        document.getElementById('contactno1-error').textContent = '';
        document.getElementById('contactno2-error').textContent = '';
        document.getElementById('address-error').textContent = '';

        if (!contactNumberRegex.test(contactNo1)) {
            document.getElementById('contactno1-error').textContent = 'Please enter a valid 10-digit primary contact number.';
            isValid = false;
        }

        if (contactNo2 && !contactNumberRegex.test(contactNo2)) {
            document.getElementById('contactno2-error').textContent = 'Please enter a valid 10-digit secondary contact number.';
            isValid = false;
        }

        if (address.length < 10) {
            document.getElementById('address-error').textContent = 'Address must be at least 10 characters long.';
            isValid = false;
        }

        // If all validations pass, submit the form
        if (isValid) {
            document.getElementById('profileForm').submit();
        }

        return isValid; // Return validation status
    }

    function showSaveButton() {
        document.getElementById('save-button').style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.profile-details input');
        const saveButton = document.querySelector('.save-btn');
        saveButton.style.display = 'none';

        inputs.forEach(input => {
            input.addEventListener('input', function() {
                showSaveButton();
            });
        });

        // Modify the Save Changes button to call the validation function
        saveButton.addEventListener('click', function(event) {
            if (!validateAndSubmit()) {
                event.preventDefault(); // Prevent default form submission if validation fails
            }
        });
    });

    </script>
</body>
</html>