<?php

namespace App\Models;

use App\Database;

class UserModel {
    private $conn;

    // public function __construct($conn) {
    //     $this->conn = $conn;
    // }

    public function validateUser($username, $password, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createUser(
        $username, $hashedPassword, $fname, $lname, $email, 
        $usertype, $id, $address, $city, $profile_picture, $status,
        $database
    ) {
        $conn = $database->getConnection();
        // // Check if the user is a guest
        // if ($usertype === 'guest') {
        //     $universityid = null;
        //     $universityregno = null;
        // }
    
        $sql = "INSERT INTO users (
                    username, password, fname, lname, email,
                    usertype, id, address, city, profile_picture, status, created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssss", 
            $username, $hashedPassword, $fname, $lname, $email, 
            $usertype, $id, $address, $city, $profile_picture, $status
        );
        return $stmt->execute();
    }
    
    public function createContactNumber($userId, $contactNumber, $database) {
        $conn = $database->getConnection();
        $query = "INSERT INTO contact_numbers (Cnt_no, Cnt_num) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $userId, $contactNumber);
        $stmt->execute();
        $stmt->close();
    }

    public function updateUserProfile($username,$password, $fname, $lname, $email,$id, $address, $city, $status, $database) 
    {
        $conn = $database->getConnection();
        if($password==null&&$id==null){
        $sql = "UPDATE users SET fname = ?, lname = ?, email = ?, address = ?, city = ?, status =? WHERE username = ?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("sssssss", $fname, $lname, $email, $address, $city,$status, $username);
        $stmt->execute();
        $stmt->close();
        }else{
        $sql = "UPDATE users SET username = ?, password = ?, fname = ?, lname = ?, email = ?,id=?, address = ?, city = ?, status =? WHERE email = ?";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $username, $password, $fname, $lname, $email,$id, $address, $city,$status, $email);
        $stmt->execute();
        $stmt->close();
        }
        return true;

    }

    public function updateContactNumber($userId, $contactno1, $contactno2, $database) {
        $conn = $database->getConnection();

        $deleteSql = "DELETE FROM contact_numbers WHERE Cnt_no = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $userId);
        $deleteStmt->execute();
        $deleteStmt->close();

        if ($contactno1) {
            $this->createContactNumber($userId, $contactno1, $database);
        }
        if ($contactno2) {
            $this->createContactNumber($userId, $contactno2, $database);
        }

        return true;
    }

    public function checkUser($username, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser2($username, Database $database) {
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT COUNT(*) AS count FROM users WHERE username = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }    

    public function getUserData($username, Database $database) {
        $conn = $database->getConnection();
    
        $sql = "SELECT u.*, r.role_name, c.Cnt_num, os.*, o.*,em.*
                FROM users u
                JOIN roles r ON u.usertype = r.role_id
                LEFT JOIN contact_numbers c ON u.No = c.Cnt_no
                LEFT JOIN organizer_society as os ON u.No=os.organizer_no
                LEFT JOIN organizations as o ON os.organization_no=o.orgno
                Left join event_members as em ON u.No=em.member_id
                WHERE u.username = ?";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $userData = null;
        $contactNumbers = [];
    
        while ($row = $result->fetch_assoc()) {
            if (!$userData) {
                $userData = $row;
                unset($userData['Cnt_num']); // Remove the contact number from the user data
            }
            if ($row['Cnt_num']) {
                $contactNumbers[] = $row['Cnt_num'];
            }
        }
    
        if ($userData) {
            $userData['contact_numbers'] = $contactNumbers;
            return $userData; // Returns user data with role_name and contact numbers
        } else {
            return null;
        }
    }

    public function getUserDatabyemail($email,Database $database){
        $conn = $database->getConnection();
        $sql = "SELECT u.* FROM users u WHERE u.email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = null;
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
        }
        return $userData;
    }
    

    public function fpcheck($username, $email, Database $database) {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM users WHERE username = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fpchange($username, $password, Database $database) {
        $conn = $database->getConnection();

        $sql = "UPDATE users set password=? where username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $password, $username);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function insertRoleRequest($no, $role,$organization, $reason, $status, Database $database) {
        $conn = $database->getConnection();
        $sql = "INSERT INTO rolereq (no, role, organization, reason, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            die("Error preparing SQL: " . $conn->error);
        }
    
        $stmt->bind_param("sssss", $no, $role, $organization, $reason, $status);
    
        if($stmt->execute() == true){
            return true;
        } else {
            return false;
        }
    }

    public function getRoleRequest(Database $database, $no){
        $conn = $database->getConnection();
        $sql = "SELECT * FROM rolereq WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $no);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    //admin function
    public function getRoleRequests(Database $database){
        $conn = $database->getConnection();
        $sql = "SELECT rolereq.* , users.*, organizations.* FROM rolereq INNER JOIN users ON rolereq.no = users.No INNER JOIN organizations ON rolereq.organization = organizations.orgno WHERE rolereq.status = 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    //admin function
    public function admin_updateRoleRequests($no,$orgno,$new_role,$reply, Database $database) {
        $conn = $database->getConnection();
        
        
        $sql = "SELECT * FROM rolereq WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $no);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $role = $row['role'];

            if ($new_role === 'rejected') {
                
                $updateRolereq = "UPDATE rolereq SET status = -1, reply = ? WHERE no = ?";
                $stmt2 = $conn->prepare($updateRolereq);
                $stmt2->bind_param("si", $reply, $no);
                $stmt2->execute();

                // Update the user's role in the 'users' table to 'student'
                // $updateUser = "UPDATE users SET usertype = 'student' WHERE email = ?";
                // $stmt3 = $conn->prepare($updateUser);
                // $stmt3->bind_param("s", $email);
                // $stmt3->execute();
            } else {
                
                $updateRolereq = "UPDATE rolereq SET status = 1 WHERE no = ?";
                $stmt2 = $conn->prepare($updateRolereq);
                $stmt2->bind_param("i", $no);
                $stmt2->execute();

                
                $updateUser = "UPDATE users SET usertype = ? WHERE no=?";
                $stmt3 = $conn->prepare($updateUser);
                $stmt3->bind_param("ss", $role, $no);
                $stmt3->execute();

                $assignUser = "INSERT INTO organizer_society VALUES (?, ?)";
                $stmt4 = $conn->prepare($assignUser);
                $stmt4->bind_param("ss", $no, $orgno);
                $stmt4->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    //normal user function
    public function updateRoleRequest($no, $role, $organization, $reason, $status,Database $database) {
        $conn = $database->getConnection();
        $sql = "UPDATE rolereq set role=?, organization=?,reason=?, status=? where no=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $role,$organization, $reason, $status, $no);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function updateProfilePicture($username, $profilePicturePath, Database $database) { 
        $conn = $database->getConnection();
        
        $sql = "UPDATE users SET profile_picture = ? WHERE username = ?"; 
        $stmt = $conn->prepare($sql); 
        $stmt->bind_param("ss", $profilePicturePath, $username); 
        $stmt->execute(); 
        $stmt->close();
    }

    public function deleteRoleRequest($no, Database $database) {
        $conn = $database->getConnection();
        $sql = "DELETE FROM rolereq WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $no);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function usernameExists($username, Database $database) {
        $conn = $database->getConnection();
    
        $sql = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }

    public function getorganizations(Database $database){
        $conn= $database->getConnection();
        $sql = "SELECT * FROM organizations";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $organizations = [];
        while ($row = $result->fetch_assoc()) {
            $organizations[] = $row;
        }
        return $organizations;
    }
    
    public function getdisableaccComplaints(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT a.*, u.*, a.status as a_status FROM admin_support AS a JOIN users AS u ON a.no = u.No WHERE a.id = 2; ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    public function deleteComplaint($no, Database $database) {
        $conn = $database->getConnection();
        $sql = "DELETE FROM admin_support WHERE no = $no";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
        return true;
    }


    public function getfeedbacks(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT * FROM admin_support AS a JOIN users AS u ON a.no = u.No WHERE a.id = 1; ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    public function getnormalfeedbacks(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT * FROM contact_support AS a JOIN contact_support_data AS b ON a.no = b.no WHERE email NOT LIKE ?";
        $stmt = $conn->prepare($sql);
        $emailDomain = '%@stu.ucsc.cmb.ac.lk';
        $stmt->bind_param("s", $emailDomain);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    public function getregfeedbacks(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT * FROM contact_support AS a WHERE email LIKE ?";
        $stmt = $conn->prepare($sql);
        $emailDomain = '%@stu.ucsc.cmb.ac.lk';
        $stmt->bind_param("s", $emailDomain);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return [];
        }
    }

    public function feedbackdone($row_id, Database $database) {
        $conn = $database->getConnection();
        $sql = "DELETE FROM contact_support WHERE no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $row_id);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function deleteUser($username, Database $database) {
        $conn = $database->getConnection();
        $sql = "UPDATE users SET status = -1 where username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function getusernames(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT username FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $usernames = [];
            while ($row = $result->fetch_assoc()) {
                $usernames[] = $row['username'];
            }
            return $usernames;
        } else {
            return [];
        }
    }

    public function getemails(Database $database) {
        $conn = $database->getConnection();
        $sql = "SELECT email FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $emails = [];
            while ($row = $result->fetch_assoc()) {
                $emails[] = $row['email'];
            }
            return $emails;
        } else {
            return [];
        }
    }

    public function getreviews($eventno, Database $database){
        $conn = $database->getConnection();
        $sql = "SELECT * FROM event_ask join events on events.no = event_ask.event_no join users on users.No = event_ask.user_no WHERE event_no = ? and event_ask.answered = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $eventno);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $reviews = [];
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
            return $reviews;
        } else {
            return [];
        }
    }
}
?>