<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Requests</title>
    <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
             table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        button {
            padding: 5px 10px;
            width:80px;
            border-radius: 10px;
            background-color: white;
            cursor: pointer;
  
        }

        button:hover {
            background-color: skyblue;
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Requested Role</th>
            <th>Approve</th>
            <th>Delete</th>
        </tr>
        <tr>
            <td>1</td>
            <td>user1</td>
            <td>user1@example.com</td>
            <td>Event Organizer</td>
            <td><button>Accept</button></td>
            <td><button>Delete</button></td>
        </tr>
        <tr>
            <td>2</td>
            <td>user2</td>
            <td>user2@example.com</td>
            <td>Event organizer</td>
            <td><button>Accept</button></td>
            <td><button>Delete</button></td>
        </tr>
    </table>
</body>
</html>
