<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="contactus.css">
</head>
<body>
    <div class="main">
        <div class="main_box">
            <h2>Contact Support</h2>
            <form name="contactsupport" action="" method="post">
                <table>
                    <tr>
                        <td><label for="name">Type</label></td>
                        <td>
                            <select>
                                <option default value="Choose option">Choose Option</option>
                                <option value="feedback">Feedback</option>
                                <option value="question">Question</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><input type="email" id="email" name="email" placeholder="Enter your Email"></td>
                    </tr>
                    <tr>
                        <td><label for="contact">Contact number</label></td>
                        <td><input type="contact" id="contact" name="contact" placeholder="Enter your Contact Number"></td>
                    </tr>
                    <tr>
                        <td><label for="feedback">Feedback</label></td>
                        <td><textarea class="myTextarea" rows="4" placeholder="Enter your feedback"></textarea></td>
                    </tr>
                    <tr class="button">
                        <td colspan="2"><button type="submit">Send</button></td>
                    </tr>
                </table>
                <p>For the Questions,<br>our contact support will get in touch with you as soon as possible</p>
            </form>
        </div>
    </div>
</body>
</html>
