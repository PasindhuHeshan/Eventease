<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="userprofile.css">   
</head>
<body>
    
    <div class="container">

        <center><h2>Profile Details</h2></center>
        <div class="profile">
            <!-- Profile Image Section -->
            <div class="profile-image">
                <div class="image">
                    <img src="default-avatar.png" alt="Profile Picture">
                </div>
                
                <button>Change</button>
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
                    <button class="request-btn" onclick="redirectToRoleRequest()">Request Event Organizer Privileges</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToRoleRequest() {
            window.location.href = "RoleRequest.php";
        }
    </script>

</body>
</html>