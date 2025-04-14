<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./css/userprofile.css">
    <style>
        /* Hide increment arrows in number inputs */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
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
                        </script>
                    </div>
                </div>

                <div class="profile-details">
                    <form id="profileForm" action="index.php?url=updateProfile.php" method="post">
                        <table>
                            <tr>
                                <th><label for="fname">First Name</label></th>
                                <td><input type="text" id="fname" name="fname" value="<?php if ($userData) echo $userData['fname']; ?>" oninput="showSaveButton()" required></td>
                            </tr>
                            <tr>
                                <th><label for="lname">Last Name</label></th>
                                <td><input type="text" id="lname" name="lname" value="<?php if ($userData) echo $userData['lname']; ?>" oninput="showSaveButton()" required></td>
                            </tr>
                            <tr>
                                <th><label for="email">Email</label></th>
                                <td><input type="email" id="email" name="email" value="<?php if ($userData) echo $userData['email']; ?>" oninput="showSaveButton()" readonly></td>
                            </tr>
                            <tr>
                                <th><label for="address">Address</label></th>
                                <td><input type="text" id="address" name="address" value="<?php if ($userData) echo $userData['address']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <th><label for="city">City</label></th>
                                <td><input type="text" id="city" name="city" value="<?php if ($userData) echo $userData['city']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <th><label for="contactno1">Primary Contact No</label></th>
                                <td><input type="number" id="contactno1" name="contactno1" value="<?php if ($userData && isset($userData['contact_numbers'][0])) echo $userData['contact_numbers'][0]; ?>" oninput="showSaveButton()" required></td>
                            </tr>
                            <tr>
                                <th><label for="contactno2">Secondary Contact No</label></th>
                                <td><input type="number" id="contactno2" name="contactno2" value="<?php if ($userData && isset($userData['contact_numbers'][1])) echo $userData['contact_numbers'][1]; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <?php if ($userData && $userData['role_name'] !== 'Guest') : ?>
                                <tr>
                                    <th><label for="id">University ID</label></th>
                                    <td><input type="text" id="id" name="id" value="<?php echo $userData['id']; ?>" readonly></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($userData && $userData['role_name'] == 'Guest') : ?>
                                <tr>
                                    <th><label for="id">NIC</label></th>
                                    <td><input type="text" id="id" name="id" value="<?php echo $userData['id']; ?>" readonly></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><label for="usertype">User Type</label></th>
                                <td><input type="text" id="usertype" name="usertype" value="<?php if ($userData) echo $userData['role_name']; ?>" readonly></td>
                            </tr>
                        </table>

                        <div class="buttons">
                            <button type="submit" class="save-btn" id="save-button" style="display: none;">Save Changes</button>
                            <button type="button" class="delete-btn" onclick="confirmDelete()">Delete Account</button>

                            <?php if ($userData && $userData['role_name'] !== 'Guest' && $userData['role_name'] !== 'Academic' && $userData['role_name'] !== 'Organizer') : ?>
                                <div class="request-section">  <?php if (!$roleData) : ?>
                                        <p class="request-para">Want to become an Event Organizer?</p>
                                        <button type="button" class="request-btn" onclick="redirectToRoleRequest()">Request Privilege</button>
                                    <?php else : ?>
                                        <p class="request-para">Role Request Submitted. Update?</p>
                                        <button type="button" class="request-btn" onclick="redirectToRoleRequest()">Update Request</button>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
            function showSaveButton() {
                document.getElementById('save-button').style.display = 'block';
            }

            function redirectToRoleRequest() {
                window.location.href = "RoleRequest.php";
            }
            function confirmDelete() {
                // Display a confirmation dialog
                var result = confirm("Are you sure you want to delete this account?");
                
                // If the user clicks 'OK', return true to allow the form submission
                if (result) {
                    return true;
                }
                // If the user clicks 'Cancel', prevent the form submission
                else {
                    return false;
                }
            }
            
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.inputs input');
                const saveButton = document.querySelector('.save-btn');
                saveButton.style.display = 'none';

                inputs.forEach(input => {
                    input.addEventListener('input', function() {
                        saveButton.style.display = 'block';
                    });
                });
            });
    </script>
</body>
</html>