<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="./css/mngeventstyles.css">

</head>
<body>
  
    <h2>Events</h2>
  
        <label for="event_type">Event type</label>
        <select name="event_type" id="event_type" class=inventory_type>
            <option value="1">event1</option>
            <option value="2">event2</option>
        </select>
    </form><br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>View</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Art Exhibition</td>
                <td>
                    <form action="approvedeventview.php".html>
                        <button type="submit">View</button>
                    </form>
                </td>
                <td><button>approve</button> <button>delete</button></td>
            </tr>

            <tr>
                <td>2</td>
                <td>Music Festival</td>
               <td>
                <form action="approvedeventview.php".html>
                    <button type="submit">View</button>
                </form>

               </td>
                <td><button>approve</button> <button>delete</button></td>
            </tr>

            <tr>
                <td>3</td>
                <td>Tech Conference</td>
                <td>
                    <form action="approvedeventview.php".html>
                        <button type="submit">View</button>
                    </form>
                </td>
                
                
                <td><button>approve</button> <button>delete</button></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
