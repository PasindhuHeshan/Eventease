<?php
namespace App\Views\Events;

use App\Models\UserModel;
use App\Database;

if(isset($userData['username']) ){
    $username = $userData['username'];

    $database = new Database();

    $userModel = new UserModel();
    $roleData = $userModel->getRoleRequest($database, $username);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Request Form</title>
    <style>
        
        .form-container {
            background-color:#d8f2f2;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 50px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        

        
        .form-container [type="submit"], .form-container [type="button"] {
            background-color: #008CBA;
            color: white;
            cursor: pointer;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            transition: background-color 0.4s ease, transform 0.4s ease; /* Smooth transition */
        }

        .form-container [type="submit"]:hover,.form-container [type="button"]:hover {
            background-color: #005f8b; /* Darker shade for hover effect */
            transform: scale(1.05); /* Slight zoom effect */
        }

        .delete-btn{
            margin-top: 20px;
        }

        a{
            color: white;
        }


       
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Role Request Form</h2>
        <form action="<?php echo 'index.php?url=processreq&' . (($roleData) ? 'type=update' : 'type=create') ?>" onsubmit="return confirmAction(event)" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="name" value="<?php echo isset($userData['username']) ? $userData['username'] : ''; ?>" readonly>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" readonly>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Event Organizer" <?php if($roleData && $roleData['role'] == "Event Organizer") echo "selected"?>>Event Organizer</option>
                <option value="Support staff" <?php if($roleData && $roleData['role'] == "Support staff") echo "selected"?>>Support staff</option>
            </select>

            <label for="reason">Reason for Request:</label>
            <textarea id="reason" name="reason" rows="4" placeholder="Reason goes here"><?php
                if($roleData){echo $roleData['reason'];}
            ?></textarea>

            <label for="status">Status:</label>
            <div type="text" id="status" name="status" readonly>
                <?php
                    if($roleData){echo $roleData['status'] ? 'Approved' : 'Pending';}
                ?>
            </div><br><br>
            <?php
                if(!$roleData){
            ?>
            <center>
            <button type="submit" name="submit">Submit</button>
            <button type="button" name="cancel"><a href="userprofile.php" target="_self">Cancel</a></button>
            </center>
            <?php
                }else{
            ?>
            <center>
            <button type="submit" name="update">Update</button>
            <button type="button" name="cancel"><a href="userprofile.php" target="_self">Cancel</a></button>
            </center>
            <center class="delete-btn">
            <button type="submit" name="delete"><a>Delete</a></button>
            </center>
            <?php
                }
            ?>
        </form>
    </div>
</body>
</html>

<script>
    function confirmAction(event) {
        if (event.submitter.name === "delete") {
            return confirm("Are you sure you want to delete this Request?");
        } else if (event.submitter.name === "submit") {
            return confirm("Are you sure you want to submit this Request?");
        }
        else if (event.submitter.name === "update") {
            return confirm("Are you sure you want to update this Request?");
        }
        return true; // Allow other buttons to proceed without confirmation

    }
</script>