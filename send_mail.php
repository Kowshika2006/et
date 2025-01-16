<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize inputs
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $destination = htmlspecialchars(strip_tags(trim($_POST['destination'])));
    $checkin = htmlspecialchars(strip_tags(trim($_POST['checkin'])));
    $checkout = htmlspecialchars(strip_tags(trim($_POST['checkout'])));
    $transport = htmlspecialchars(strip_tags(trim($_POST['transport'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Prepare email details
    $to = "kowshikaiyyappan7@gmail.com"; // Replace with your support email
    $subject = "New Booking Request from $name";

    $email_message = "New booking request details:\n\n";
    $email_message .= "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Destination: $destination\n";
    $email_message .= "Check-In Date: $checkin\n";
    $email_message .= "Check-Out Date: $checkout\n";
    $email_message .= "Preferred Transport: $transport\n";
    $email_message .= "Special Requests: $message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "Thank you, $name! Your booking request has been submitted successfully. We will get back to you soon.";
    } else {
        echo "Sorry, there was an issue submitting your booking request. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
