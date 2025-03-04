<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./css/loginformstyle.css">
    <script type="text/javascript" src="./js/payment.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</head>
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
                        <tr>
                            <td colspan="3"><div id="fname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="lname">Last Name <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="lname" name="lname" placeholder="Perera" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="lname_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="email" id="email" name="email" placeholder="navindu.perera@gmail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required></td>
                        </tr>
                        <tr>
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
                        <tr>
                            <td colspan="3"><div id="contactno1_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="contactno2">Secondary Contact Number</label></td>
                            <td colspan="2"><input type="number" id="contactno2" name="contactno2" placeholder="Optional" value="<?php echo isset($_POST['contactno2']) ? htmlspecialchars($_POST['contactno2']) : ''; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="contactno2_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="address">Address <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="address" name="address" placeholder="123 Main St" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required></td>
                        </tr>
                        <tr>
                            <td colspan="3"><div id="address_error" class="error"></div></td>
                        </tr>
                        <tr>
                            <td><label for="city">City <span class="star">*</span></label></td>
                            <td colspan="2"><input type="text" id="city" name="city" placeholder="Colombo" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required></td>
                        </tr>
                        <tr>
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
                    <div class="button-container"> 
                        <button type="button" onclick="showNextStep('step3', 'step2')">Back</button>
                        <button type="button" onclick="showNextStep('step3', 'step4', true)">Next</button>
                    </div>
                </div>
                <!-- Step 4: Payment Information -->
                <div id="step4" style="display: none;">
                    <p>You are about to pay Rs. 500 for the registration.</p>
                    <button type="button" onclick="paymentGateWay()">Pay Now</button>
                    <input type="text" id="universityid" name="universityid" value="X" hidden>
                    <input type="text" id="universityregno" name="universityregno" value="X" hidden>
                    <input type="text" id="usertype" name="usertype" value="guest" hidden>
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