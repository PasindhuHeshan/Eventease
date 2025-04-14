<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Request Form</title>
    <style>
        .form-container {
            background-color: #d8f2f2;
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
            transition: background-color 0.4s ease, transform 0.4s ease;
            border-radius: 3px;
        }

        .form-container [type="submit"]:hover, .form-container [type="button"]:hover {
            background-color: #005f8b;
            transform: scale(1.05);
        }

    

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Role Request Form</h2>
        <form action="<?php echo 'index.php?url=processreq&' . (($roleData) ? 'type=update' : 'type=create') ?>" onsubmit="return confirmAction(event)" method="POST">
            <input type="hidden" name="No" value="<?php echo $userData['No']; ?>">
            <lable for="organization">Organization</label>
            <select id="organization" name="organization" required>
                <?php foreach ($organization as $org) { ?>
                    <option value="<?php echo $org['orgno']; ?>"><?php echo $org['orgname']; ?></option>
                <?php } ?>
            </select>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="organizer">Event Organizer</option>
            </select>

            <label for="reason">Reason for Request</label>
            <textarea id="reason" name="reason" rows="4" placeholder="Reason goes here" required><?php
                if ($roleData) {
                    echo $roleData['reason'];
                }
            ?></textarea>

            <?php if($roleData){ ?>
            <label for="status">Status</label>
            <div type="text" id="status" name="status" readonly style="color: <?php echo ($roleData && $roleData['status']==1) ? 'green' : 'red'; ?>">
                <?php
                if ($roleData && $roleData['status']==0){
                    echo 'Pending';
                }else if($roleData && $roleData['status']==1){
                    echo 'Approved';
                }else{
                    echo 'Rejected';
                }
                ?>
            </div><br><br>
              <?php }  ?>
            <?php
            
            if (!$roleData || !$roleData['status'] == 0 && !$roleData['status'] == 1) {
            ?>
                <center>
                    <?php if (!$roleData) { ?>
                        <button type="submit" name="submit">Submit</button>
                    <?php } else { ?>
                        <button type="submit" name="update">Update</button>
                        
                        <button type="submit" name="delete"><a>Delete</a></button>
                        <br><br>
                        
                    <?php } ?>
                    <button type="button" name="cancel"><a href="userprofile.php" target="_self">Cancel</a></button>
                </center>
            <?php
            } else {
            ?>
                <center>
                    <button type="button" name="cancel"><a href="userprofile.php" target="_self">Cancel</a></button>
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
        } else if (event.submitter.name === "update") {
            return confirm("Are you sure you want to update this Request?");
        }
        return true;
    }
</script>