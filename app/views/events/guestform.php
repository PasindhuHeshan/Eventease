<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/loginformstyle.css">
    <script type="text/javascript" src="./js/payment.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</head>
<script>
    function showNextStep(currentStep, nextStep, validate = false) {
        if (validate && !validateStep(currentStep)) {
            return; // Stop if validation fails
        }
        document.getElementById(currentStep).style.display = 'none';
        document.getElementById(nextStep).style.display = 'block';
    }

    var existingUsernames = <?php echo json_encode($usernames); ?>;
    var existingEmails = <?php echo json_encode($emails); ?>;

    function validateStep(step) {
    var inputs = document.querySelectorAll('#' + step + ' input[required]');
    var valid = true;
    for (var i = 0; i < inputs.length; i++) {
        var errorDiv = document.getElementById(inputs[i].id + '_error');
        var errorRow = errorDiv.parentElement.parentElement; // Get the error row
        if (inputs[i].value.trim() === '') {
            errorDiv.textContent = "This field is required.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else {
            errorDiv.textContent = "";
            errorRow.style.display = 'none';
        }

        if (inputs[i].type === 'email' && !validateEmail(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid email address.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else if (inputs[i].id === 'id' && !validateNIC(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid NIC.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else if (inputs[i].id === 'contactno1' && !validatePhoneNumber(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid contact number.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else if (inputs[i].id === 'address' && !validateAddress(inputs[i].value)) {
            errorDiv.textContent = "Address must be at least 10 characters long.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else if (inputs[i].id === 'email' && existingEmails.includes(inputs[i].value)) {
            errorDiv.textContent = "This email is already registered.";
            errorRow.style.display = 'table-row';
            valid = false;
        } else if (inputs[i].id === 'username') {
            if (inputs[i].value.length < 4) {
                errorDiv.textContent = "Username must be at least 4 characters long.";
                errorRow.style.display = 'table-row';
                valid = false;
            } else if (existingUsernames.includes(inputs[i].value)) {
                errorDiv.textContent = "This username is already taken.";
                errorRow.style.display = 'table-row';
                valid = false;
            } else {
                errorDiv.textContent = "";
                errorRow.style.display = 'none';
            }
        } else {
            errorDiv.textContent = "";
            errorRow.style.display = 'none';
        }
    }
    return valid;
}


    function validatePasswords(event) {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirm_password').value;
        var valid = true;

        var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
        if (!passwordPattern.test(password)) {
            document.getElementById('password_error').textContent = "Password must contain at least one uppercase letter, one lowercase letter, and one number.";
            valid = false;
        } else {
            document.getElementById('password_error').textContent = "";
        }

        if (password !== confirmPassword) {
            document.getElementById('confirm_password_error').textContent = "Passwords do not match. Please try again.";
            valid = false;
        } else {
            document.getElementById('confirm_password_error').textContent = "";
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission
        }
    }

    function validateEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function validateNIC(nic) {
        var nicPattern = /^[0-9]{9}[vVxX]$/;
        var nicPattern2 = /^[0-9]{12}$/;
        return nicPattern.test(nic) || nicPattern2.test(nic);
    }

    function validatePhoneNumber(phoneNumber) {
        var phonePattern = /^07\d{8}$/;
        return phonePattern.test(phoneNumber);
    }

    function validateAddress(address) {
        return address.length >= 10;
    }
</script>
<style>
    label {
        text-align: left;
        display: block;
        margin-right: 10px;
    }
    .error {
        color: red;
        font-size: 0.9em;
    }
    .error-row{
        display: none;
    }
</style>

<body>
    <div class="main">
        <div class="main_box">
            <h2>Registration Form</h2>
            <h4>For Guests (Outsiders of the campus)</h4>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once '../app/controllers/HeaderController.php';
                $controller = new \App\Controllers\HeaderController();
                $username_error = $controller->processRegistration();
            }
            ?>
            <?php if (isset($username_error)): ?>
                <div class="error"><?php echo $username_error; ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['payment']) && $_GET['payment'] === 'cancel'): ?>
                <div class="error">Payment was cancelled.<br/>Account not created!</div>
            <?php endif; ?>
            <form id="register" name="register" action="index.php?url=processsignin" method="post" onsubmit="validatePasswords(event)">
                <!-- Step 1: Basic Information -->
                <div id="step1">
                    <table>
                        <tr>
                            <td><label for="fname">First Name <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="fname" name="fname" placeholder="Navindu" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="fname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="lname">Last Name <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="lname" name="lname" placeholder="Perera" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="lname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="id">NIC <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="id" name="id" placeholder="XXXXXXXXXXX" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="id_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="email" id="email" name="email" placeholder="navindu.perera@gmail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="email_error" class="error"></div></td>
                        </tr>
                    </table>
                    <div class="button-container"> 
                        <button type="reset">Clear</button>
                        <button type="button" onclick="showNextStep('step1', 'step2', true)">Next</button>
                    </div>
                </div>

                <!-- Step 2: Additional Information -->
                <div id="step2" style="display: none;">
                    <table>
                        <tr>
                            <td><label for="contactno1">Primary Contact Number <span class="star">*</span></label></td>
                            <td colspan="2"><input type="number" id="contactno1" name="contactno1" placeholder="07152XXXXX" value="<?php echo isset($_POST['contactno1']) ? htmlspecialchars($_POST['contactno1']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="contactno1_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="contactno2">Secondary Contact Number</label></td>
                            <td colspan="2"><input type="number" id="contactno2" name="contactno2" placeholder="Optional" value="<?php echo isset($_POST['contactno2']) ? htmlspecialchars($_POST['contactno2']) : ''; ?>"></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="contactno2_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="address">Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="address" name="address" placeholder="123 Main St" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="address_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="city">City <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="city" name="city" placeholder="Colombo" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="city_error" class="error"></div></td>
                        </tr>
                    </table>
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step2', 'step1')">Back</button>
                        <button type="button" onclick="showNextStep('step2', 'step3', true)">Next</button>
                    </div>
                </div>

                <!-- Step 3: Account Information -->
                <div id="step3" style="display: none;">
                    <table>
                        <tr>
                            <td><label for="username">Username <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="username" name="username" placeholder="navindup" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="username_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password <span class="star">*</span></label></td>
                            <td colspan="2"><input type="password" id="password" name="password" placeholder="********" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="password_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="confirm_password">Confirm Password <span class="star">*</span></label></td>
                            <td colspan="2"><input type="password" id="confirm_password" name="confirm_password" placeholder="********" required></td>
                        </tr>
                        <tr class="error-row">
                            <td colspan="3"><div id="confirm_password_error" class="error"></div></td>
                        </tr>
                    </table>
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step3', 'step2')">Back</button>
                        <button type="button" onclick="showNextStep('step3', 'step4', true)">Next</button>
                    </div>
                </div>
                <!-- Step 4: Payment Information -->
                <div id="step4" style="display: none;">
                    <p>You are about to pay Rs. 500 for the registration.</p>
                    <button type="button" onclick="paymentGateWay()">Pay Now</button>
                    <input type="text" id="usertype" name="usertype" value="2" hidden>
                    <input type="number" id="status" name="status" value="1" hidden>
                    <input type="hidden" id="payment_status" name="payment_status" value="">
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step4', 'step3')">Back</button>
                    </div>
                </div>
                <div id="step5" style="display: none;">
                    <div class="success">Payment was successful!</div>
                    <div class="button-container"> 
                        <button type="submit">Finish</button>
                    </div>
                </div>
                <script>
                    payhere.onCompleted = function onCompleted(orderId) {
                        document.getElementById('payment_status').value = 'success';
                        showNextStep('step4', 'step5', true);
                    };

                    payhere.onDismissed = function onDismissed() {
                        window.location.href = "guestform.php?payment=cancel";
                    };

                    payhere.onError = function onError(error) {
                        window.location.href = "guestform.php?payment=cancle";
                    };
                </script>
            </form>
        </div>
    </div>
</body>
</html>