<?php
// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Sanitize and capture the form data
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = trim($_POST["message"]);

    // 2. Setup the Recipient and Subject
    // *** CHANGE THIS EMAIL TO ANKARA WEAR'S REAL EMAIL ADDRESS ***
    $recipient = "hello@yourdomain.com"; 
    
    $subject = "New Bespoke Consultation Request from $name";

    // 3. Build the email content
    $email_content = "You have received a new bespoke consultation request.\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Service Requested: $service\n\n";
    $email_content .= "Client Vision/Message:\n$message\n";

    // 4. Build the email headers (Allows you to hit "Reply" and email the client directly)
    $email_headers = "From: $name <$email>";

    // 5. Send the email and redirect the user
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Success: Redirect back to the bespoke page with a success flag in the URL
        header("Location: bespoke.html?status=success#booking-section");
        exit;
    } else {
        // Error: Redirect back with an error flag
        header("Location: bespoke.html?status=error#booking-section");
        exit;
    }

} else {
    // If someone tries to access this file directly without submitting the form, send them back
    header("Location: bespoke.html");
    exit;
}
?>