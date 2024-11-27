<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="userprofile.css">
</head>
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
<body>
    <div class="box">
        <div class="container">
            <center><h2>Profile Details</h2></center>
            <div class="profile">
                <div class="profile-image">
                    <div class="image">
                        <img src="<?php if ($userData && $userData['profile_picture']) echo $userData['profile_picture']; else echo 'adminlogo.png'; ?>" alt="Profile Picture">
                    </div>
                    <div class="imgbuttons">
                        <form action="user_controller.php?url=uploadProfilePicture" method="post" enctype="multipart/form-data">
                            <button type="button" class="upload-btn" onclick="document.getElementById('profile_picture').click();">Add Image</button>
                            <input type="file" id="profile_picture" name="profile_picture" style="display: none;" onchange="showFileName()">
                            <span id="file-name" class="file-name"></span>
                            <button type="submit">Upload</button>
                        </form>
                    </div>
                    <script>
                    function showFileName() {
                        const input = document.getElementById('profile_picture');
                        const fileNameDisplay = document.getElementById('file-name');
                        fileNameDisplay.textContent = input.files[0].name;
                    }
                    </script>
                </div>

                <!-- Profile Details Section -->
                <div class="profile-details">
                    <form id="profileForm" action="index.php?url=updateProfile.php" method="post">
                        <table>
                            <tr>
                                <td><label for="fname">First Name</label></td>
                                <td><input type="text" id="fname" name="fname" value="<?php if ($userData) echo $userData['fname']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <td><label for="lname">Last Name</label></td>
                                <td><input type="text" id="lname" name="lname" value="<?php if ($userData) echo $userData['lname']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <td><label for="email">Email</label></td>
                                <td><input type="email" id="email" name="email" value="<?php if ($userData) echo $userData['email']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <td><label for="address">Address</label></td>
                                <td><input type="text" id="address" name="address" value="<?php if ($userData) echo $userData['address']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <td><label for="city">City</label></td>
                                <td><input type="text" id="city" name="city" value="<?php if ($userData) echo $userData['city']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr> 
                                <td><label for="contactno1">Primary Contact Number</label></td> 
                                <td><input type="number" id="contactno1" name="contactno1" value="<?php if ($userData) echo $userData['contactno1']; ?>" oninput="showSaveButton()"></td> 
                            </tr> 
                            <tr> 
                                <td><label for="contactno2">Secondary Contact Number</label></td> 
                                <td><input type="number" id="contactno2" name="contactno2" value="<?php if ($userData && $userData['contactno2']) echo $userData['contactno2']; ?>" oninput="showSaveButton()"></td>
                            </tr>
                            <tr>
                                <td><label for="universityid">University ID</label></td>
                                <td><input type="text" id="universityid" name="universityid" value="<?php if ($userData) echo $userData['universityid']; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td><label for="universityregno">University Registration No</label></td>
                                <td><input type="text" id="universityregno" name="universityregno" value="<?php if ($userData) echo $userData['universityregno']; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td><label for="usertype">User Type</label></td>
                                <td><input type="text" id="usertype" name="usertype" value="<?php if ($userData) echo $userData['usertype']; ?>" readonly style="border:none"></td>
                            </tr>
                        </table>
                        <!-- Buttons Section -->
                        <div class="buttons">
                            <div class="button-div">
                                <button type="submit" class="save-btn" id="save-button" style="display: none;">Save</button>
                                <button type="submit" class="delete-btn" id="delete-button" onclick="confirmDelete()">Delete Account</button>
                            </div>
                            <p class="request-para">Do you want to Request Event Organizer Privilege?</p>
                            <button type="button" class="request-btn" onclick="redirectToRoleRequest()">Request</button>
                        </div>
                    </form>
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
        </script>
    </div>
</body>
</html>
