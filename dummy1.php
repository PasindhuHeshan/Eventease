
<!-- disableacc.php -->

<button onclick="openPopup(<?php echo htmlspecialchars($row['no']); ?>, '<?php echo htmlspecialchars($row['fname']); ?>', '<?php echo htmlspecialchars($row['email']); ?>','<?php echo $row['row_id']; ?>')">Send</button>

 Popup Form
  <input type="text" name="row_id" value="<?php echo ($row['row_id']); ?>" hidden> 
  
  script->
  function openPopup(no, fname, email,row_id)
   document.querySelector('input[name="row_id"]').value = row_id;       

AdminLoginController->
public function processSendEmail() 
// $row_id = $_POST['row_id'];

// $userModel = new UserModel();
// $database = new Database();
// $userModel->changedisableaccstatus($row_id,$database);


UserModel-> 
// public function changedisableaccstatus($row_id,Database $database){
    //     $conn = $database->getConnection();
    //     $sql = "UPDATE admin_support SET email_status = 1 WHERE row_id =?"; 
    //     $stmt = $conn->prepare($sql); 
    //     $stmt->bind_param("i", $row_id); 
    //     $stmt->execute(); 
    //     $stmt->close();
    // }




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

    