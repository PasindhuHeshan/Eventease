<!DOCTYPE html>
<html lang="en">
<head>
    <title>Role Request Form</title>
    <link rel="stylesheet" type="text/css" href="./css/RoleRequest.css">     
    
</head>
<body>
    <div class="form-container">
        <h2>Role Request Form</h2>
        <form action="<?php echo 'index.php?url=processreq&' . (($roleData) ? 'type=update' : 'type=create') ?>" onsubmit="return confirmAction(event)" method="POST">
            <input type="hidden" name="No" value="<?php echo $userData['No']; ?>">
            <label for="organization">Organization</label>
            <select id="organization" name="organization" required>
                <?php foreach ($organization as $org) { ?>
                    <option value="<?php echo $org['orgno']; ?>" <?php if($roleData!= null && $roleData['organization']==$org['orgno']){ echo "selected";}?>><?php echo $org['orgname']; ?></option>
                <?php } ?>
            </select>

            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="3">Event Organizer</option>
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
                <center>
                    <?php if (!$roleData) { ?>
                        <button type="submit" name="submit">Submit</button>
                    <?php } else if ($roleData['status']==-1){ ?>
                        <button type="submit" name="update">Update</button>
                        <button type="submit" name="delete"><a>Delete</a></button>
                        <br><br>
                    <?php } ?>
                    <button type="button" name="cancel"><a href="userprofile.php" target="_self">Cancel</a></button>
                </center>
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