<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Form</title>
    <link rel="stylesheet" href="useraddstyles.css">
</head>
<body>
    <div class="container">
        <form action="#" method="post">
            <h2>New User</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="user-type">User Type</label>
                <select id="user-type" name="user-type" required>
                    <option value="">Select User Type</option>
                    <option value="staff">Staff member</option>
                    <option value="organizer">Event Organizer</option>
                    
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</body>
</html>

