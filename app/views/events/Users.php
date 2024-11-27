<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}
        table {
            /* width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            margin-bottom: 20px; */
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        button {
            /* padding: 5px 10px;
            background-color: #ff5722;
            color: #fff;
            border: none;
            cursor: pointer; */
            
            padding: 5px 10px;
            width:80px;
            border-radius: 10px;
            background-color: white;
            cursor: pointer;
  
        }

        button:hover {
            /* background-color: #e64a19; */
            background-color: skyblue;
            color: white;
        }
    </style>
</head>
<body>
  <form>
        <label for="user_type">User type</label>
        <select name="user_type" id="user_type">
            <option value="1">staff member</option>
            <option value="2">event organizer</option>
        </select>
        <button type="submit">Filter</button>
    </form><br>
    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
        <tr>
            <td>1</td>
            <td>user1</td>
            <td>user1@example.com</td>
            <td><button>Delete</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>user2</td>
            <td>user2@example.com</td>
            <td><button>Delete</button></td>
        </tr>
        
    </table>

    <a href="useradd.php">
      <button type="submit">Add New</button>
  
    </a>
</body>
</html>
