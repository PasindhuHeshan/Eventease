<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="userprofile.css">   
</head>
<body>
    
    <div class="container">

        <center><h2>Profile Details</h2></center>
        <div class="profile">
            <div class="profile-image">
                <div class="image">
                    <img src="<?php if ($userData && $userData['profile_picture']) echo $userData['profile_picture']; else echo 'default-avatar.png'; ?>" alt="Profile Picture">
                </div>
                <form action="user_controller.php?url=uploadProfilePicture" method="post" enctype="multipart/form-data"> 
                    <button type="button" class="upload-btn" onclick="document.getElementById('profile_picture').click();">Add Image</button> 
                    <input type="file" id="profile_picture" name="profile_picture" style="display: none;" onchange="showFileName()"> 
                    <span id="file-name" class="file-name"></span> 
                    <button type="submit">Upload</button> 
                </form>
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
                <!--Changed the divs-->
                <div class="details">
                    <div class="labels">
                        <label for="name">Name:</label>
                        <label for="email">Email:</label>
                        <label for="phone">Phone:</label>
                        <label for="address">Address:</label>
                        <label for="city">City:</label>
                    </div>
                    <div class="inputs">
                        <input type="text" id="name" value="<?php if ($userData) echo $userData['username']; ?>">
                        <input type="email" id="email" value="<?php if ($userData) echo $userData['email']; ?>">
                        <input type="text" id="phone" value="<?php if ($userData) echo $userData['phone']; ?>">
                        <input type="text" id="address" value="<?php if ($userData) echo $userData['address']; ?>">
                        <input type="text" id="city" value="<?php if ($userData) echo $userData['city']; ?>">
                    </div>
                </div>  
                <!-- Buttons Section -->
                <div class="buttons">
                    <button class="save-btn">Save</button>
                    <button class="request-btn">Request Event Organizer Privileges</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>