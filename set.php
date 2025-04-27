<!-- manage users -->
make table and  colomns for year and no,add
 filter for year in dropdown
    <th>year</th>
    <td>" . htmlspecialchars($row['year'] ?? '') . "</td>
    <label for="statusFilter1">year</label>
    <select id="statusFilter1" class="user_type" onchange="filterUsers()">
        <option value="all" default>All</option>
        <option value="1">1 year</option>
        <option value="2">2 year</option>
    </select>

    <!-- Dashboard.php -->
    <th>year</th>
    echo "<td>" . htmlspecialchars($row['year'] ?? '') . "</td>";
<label for="statusFilter1">year</label>
                <select id="statusFilter1" class="user_type" onchange="filterUsers()">
                    <option value="all" default>All</option>
                    <option value="1">1 year</option>
                    <option value="2">2 year</option>
                </select>
<th>year</th>
echo "<td>" . htmlspecialchars($row['year'] ?? '') . "</td>";

<script>
filter
var statusFilter1 = document.getElementById('statusFilter1').value;
if (statusFilter1 === 'all' || city === statusFilter1) && 
save
var statusFilter1 = document.getElementById('statusFilter1').value;
localStorage.setItem('statusFilter1', statusFilter1);
load
var statusFilter1 = localStorage.getItem('statusFilter1');
if (statusFilter1) {
                        document.getElementById('statusFilter1').value = statusFilter1;
                    }
                    </script>

Dashboard.php->
$sql = "SELECT users.No, year.age, users.fname, users.lname, users.email, users.usertype, users.status FROM users JOIN year ON users.NO= year.no ";
 $sql = "SELECT No, fname, lname, email,usertype, status FROM users";



<!-- disableacc.php -->
 when click send button status change and it shows as email thread created.

<button onclick="openPopup(<?php echo htmlspecialchars($row['no']); ?>, '<?php echo htmlspecialchars($row['fname']); ?>', '<?php echo htmlspecialchars($row['email']); ?>','<?php echo $row['row_id']; ?>')">Send</button>

 Popup Form
  <input type="text" name="row_id" value="<?php echo ($row['row_id']); ?>" hidden> 
  
 <script>
  function openPopup(no, fname, email,row_id)
   document.querySelector('input[name="row_id"]').value = row_id;      
   </script> 

AdminLoginController->
public function processSendEmail() 
// $row_id = $_POST['row_id'];

purpose== null
// $userModel = new UserModel();
// $database = new Database();
// $userModel->changedisableaccstatus($row_id,$database);


UserModel-> 
 public function changedisableaccstatus($row_id,Database $database){
         $conn = $database->getConnection();
         $sql = "UPDATE admin_support SET email_status = 1 WHERE row_id =?"; 
         $stmt = $conn->prepare($sql); 
         $stmt->bind_param("i", $row_id); 
         $stmt->execute(); 
        $stmt->close();
     }

create reject button and row delete

    // case 'rejectcomplaint':
    //     $hcontroller->render();
    //     $alcontroller->rejectcomplaint();
    //     break;

    disableacc.php->
     <form method="POST" action="rejectcomplaint">
                                <input type="hidden" name="row_id" value="<?php echo $row['row_id']; ?>">
                                <button type="submit" name="reject">Reject</button>
                            </form>

    AdminLoginController-> 
    // public function rejectcomplaint(){
    //     $database = new Database();
    //     $usermodel = new UserModel();
    //     $adminData = $usermodel->getUserData($_SESSION['username'], $database);

    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $row_id = $_POST['row_id'] ?? null;
    //         $usermodel->deleterejectComplaint($row_id, $database);
    //         $this->disableacc();
    //     }
    // }

    
UserModel->
// public function deleterejectComplaint($row_id, Database $database) {
    //     $conn = $database->getConnection();
    //     $sql = "DELETE FROM admin_support WHERE row_id = $row_id";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    //     $stmt->close();
    //     return true;
    // }

    
 <!-- Userprivilagerequest -->

 search by organization
 role_requests.php->
 <div>  <label for="nameSearch">Search by Email</label>
        <input type="text" id="nameSearch" class="user_type" onkeyup="filterUsers()" placeholder="Search for organization..">
    </div>


    echo "<tr data-organization='" . htmlspecialchars($row['orgname'] ?? '') . "' >
    <script>
    
                function filterUsers() {
                    var search = document.getElementById('nameSearch').value.toLowerCase();
                    var rows = document.querySelectorAll('table tr[data-organization]');
                    rows.forEach(function(row) {
                        var organization = row.getAttribute('data-organization').toLowerCase();
                        if (
                            (organization.includes(search))  
                            ) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    var addNewButton = document.getElementById('addNewButton');
                    if (userTypeFilter === '5') {
                        addNewButton.style.display = 'block';
                    } else {
                        addNewButton.style.display = 'none';
                    }
                }

                function saveFilterState() {
                    var search = document.getElementById('nameSearch').value;
                   
                    localStorage.setItem('nameSearch', search);
                    
                }

                function loadFilterState() {
                    
                    var search = localStorage.getItem('nameSearch');
                    
                    if (search) {
                        document.getElementById('nameSearch').value = search;
                    }
                    
                    filterUsers();
                }

                window.onload = loadFilterState;
            </script>

 <!-- feedback.php -->

 add NIC colomn for contact_support table,display in feedback.php
 
    feedback.php->
     <th>NIC</th>
     <td>" . htmlspecialchars($row["nic"]) . "</td>

 <th>NIC</th>
 <td>" . htmlspecialchars($row["nic"]) . "</td>

 AdminLoginController-> 
 same
 UserModel->
 
 $sql = "SELECT *,a.nic  FROM contact_support AS a JOIN contact_support_data AS b ON a.no = b.no WHERE email NOT LIKE ?";
 $sql = "SELECT *,a.nic  FROM contact_support AS a WHERE email LIKE ?";
 