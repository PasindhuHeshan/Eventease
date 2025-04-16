<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/loginformstyle.css">
    <script>
        function showNextStep(currentStep, nextStep) {
            if (validateStep(currentStep)) {
                document.getElementById(currentStep).style.display = 'none';
                document.getElementById(nextStep).style.display = 'block';

                if (nextStep === 'step3') {
                    document.getElementById('register').action = "index.php?url=processsignin";
                }
            }
        }

        function validateStep(step) {
            var inputs = document.querySelectorAll('#' + step + ' input[required]');
            var valid = true;
            for (var i = 0; i < inputs.length; i++) {
                var errorDiv = document.getElementById(inputs[i].id + '_error');
                if (inputs[i].value.trim() === '') {
                    errorDiv.textContent = "This field is required.";
                    valid = false;
                } else {
                    errorDiv.textContent = "";
                }

                if (inputs[i].type === 'email' && !validateEmail(inputs[i].value)) {
                    errorDiv.textContent = "Please enter a valid email address ending with @ucsc.cmb.ac.lk.";
                    valid = false;
                }
            }
            return valid;
        }

        function validateEmail(email) {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var domainPattern = /@ucsc\.cmb\.ac\.lk$/;
            return emailPattern.test(email) && domainPattern.test(email);
        }

        function validatePasswords(event) {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var username = document.getElementById('username').value;
            var valid = true;

            if (username.length < 4) {
                document.getElementById('username_error').textContent = "Username must be at least 4 characters long.";
                valid = false;
            } else {
                document.getElementById('username_error').textContent = "";
            }

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

            function validatePhoneNumber(phoneNumber) { 
                var phonePattern = /^07\d{8}$/; // Adjust this pattern based on your requirements 
                return phonePattern.test(phoneNumber); 
            } 
            
            function validateAddress(address) {
                 return address.length >= 10; // Adjust the minimum length as needed 
            }

            if (!valid) {
                event.preventDefault(); // Prevent form submission
            }
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
    </style>
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Registration Form</h2>
            <h4>For University Academic Staff</h4>
            <form id="register" name="register" action="index.php?url=processsignin" method="post" onsubmit="validatePasswords(event)">
                <!-- Step 1: Basic Information -->
                <div id="step1">
                    <table>
                        <tr>
                            <td><label for="fname">First Name <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="fname" name="fname" placeholder="Navindu" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="fname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="lname">Last Name <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="lname" name="lname" placeholder="Perera" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="lname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="email" id="email" name="email" placeholder="navindu@ucsc.cmb.ac.lk" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="email_error" class="error"></div></td>
                        </tr>
                        <!-- New rows for University ID and University Registration No -->
                        <tr>
                            <td><label for="id">University ID <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="id" name="id" placeholder="2202XXXX" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="id_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="universityregno">University Registration No <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="universityregno" name="universityregno" placeholder="2022/IS/XXX" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="universityregno_error" class="error"></div></td>
                        </tr>
                    </table>
                    <div class="button-container"> 
                        <button type="reset">Clear</button>
                        <button type="button" onclick="showNextStep('step1', 'step2')">Next</button>
                    </div>
                </div>

                <!-- Step 2: Additional Information -->
                <div id="step2" style="display: none;">
                    <table>
                        <tr>
                            <td><label for="contactno1">Primary Contact Number <span class="star">*</span></label></td>
                            <td colspan="2"><input type="number" id="contactno1" name="contactno1" placeholder="07XXXXXXXX" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="contactno1_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="contactno2">Secondary Contact Number</label></td>
                            <td colspan="2"><input type="number" id="contactno2" name="contactno2" placeholder="07XXXXXXXX(Optional)"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="contactno2_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="address">Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="address" name="address" placeholder="123 Main St" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="address_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="city">City <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="city" name="city" placeholder="Colombo" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="city_error" class="error"></div></td>
                        </tr>
                    </table>
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step2', 'step1')">Back</button>
                        <button type="button" onclick="showNextStep('step2', 'step3')">Next</button>
                    </div>
                </div>

                <!-- Step 3: Account Information -->
                <div id="step3" style="display: none;">
                    <table>
                        <tr>
                            <td><label for="username">Username <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="username" name="username" placeholder="pasindu" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="username_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password <span class="star">*</span></label></td>
                            <td colspan="2"><input type="password" id="password" name="password" placeholder="********" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="password_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="confirm_password">Confirm Password <span class="star">*</span></label></td>
                            <td colspan="2"><input type="password" id="confirm_password" name="confirm_password" placeholder="********" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="confirm_password_error" class="error"></div></td>
                        </tr>
                    </table>
                    <input type="text" id="usertype" name="usertype" value="5" hidden>
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step3', 'step2')">Back</button>
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<style>
    .main_box table input[type="text"],
    .main_box table input[type="email"],
    .main_box table input[type="number"] {
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 5px; /* Add space between inputs */
        margin-top: 5px;
    }
    /* Hide the number input scrolls */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>