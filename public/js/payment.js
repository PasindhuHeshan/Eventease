document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('register').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            var currentStep = document.querySelector('div[id^="step"]:not([style*="display: none"])').id;
            var nextStep = getNextStep(currentStep);
            if (nextStep) {
                showNextStep(currentStep, nextStep, true);
            }
        }
    });
});

function getNextStep(currentStep) {
    var steps = ['step1', 'step2', 'step3', 'step4'];
    var currentIndex = steps.indexOf(currentStep);
    return currentIndex < steps.length - 1 ? steps[currentIndex + 1] : null;
}

function showNextStep(currentStep, nextStep, validate = false) {
    if (!validate || validateStep(currentStep)) {
        document.getElementById(currentStep).style.display = 'none';
        document.getElementById(nextStep).style.display = 'block';
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
            errorDiv.textContent = "Please enter a valid email address.";
            valid = false;
        }

        if (inputs[i].id === 'contactno1' && !validatePhoneNumber(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid phone number.";
            valid = false;
        }

        if (inputs[i].id === 'cardno' && !validateCardNumber(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid card number.";
            valid = false;
        }

        if (inputs[i].id === 'cvv' && !validateCVV(inputs[i].value)) {
            errorDiv.textContent = "Please enter a valid CVV.";
            valid = false;
        }
    }
    return valid;
}

function validateEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

function validatePhoneNumber(phone) {
    var phonePattern = /^\d{10}$/;
    return phonePattern.test(phone);
}

function validateCardNumber(cardNumber) {
    var cardPattern = /^\d{16}$/;
    return cardPattern.test(cardNumber);
}

function validateCVV(cvv) {
    var cvvPattern = /^\d{3,4}$/;
    return cvvPattern.test(cvv);
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

    if (!valid) {
        event.preventDefault(); // Prevent form submission
    }
}

function paymentGateWay() {
    // Fetch payment details from payhereprocess.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(this.responseText);

        // Payment details
        var payment = {
        "sandbox": true,
        "merchant_id": obj["merchant_id"],    // Replace your Merchant ID
        "return_url": "http://localhost/code/eventease/public/guestform.php?payment=cancle",     // Important
        "cancel_url": "http://localhost/code/eventease/public/guestform.php?payment=cancle",     // Important
        "notify_url": "http://localhost/code/eventease/public/guestform.php?payment=cancle",
        "merchant_title": "EventEase",
        "order_id": obj["order_id"],
        "items": obj["order_id"],
        "amount": obj["amount"],
        "currency": obj["currency"],
        "hash": obj["hash"], // *Replace with generated hash retrieved from backend
        "first_name": "Saman",
        "last_name": "Perera",
        "email": "samanp@gmail.com",
        "phone": "0771234567",
        "address": "No.1, Galle Road",
        "city": "Colombo",
        "country": "Sri Lanka",
        "delivery_address": "No. 46, Galle road, Kalutara South",
        "delivery_city": "Kalutara",
        "delivery_country": "Sri Lanka",
        "custom_1": "",
        "custom_2": ""
    };

        payhere.startPayment(payment);
    }
    };
    xhttp.open("GET", "../app/views/events/payhereprocess.php", true);
    xhttp.send();
}

