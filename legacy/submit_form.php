<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

header('Content-Type: application/json');

// Initialize response
$response = ['success' => false, 'message' => 'An error occurred.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = new PHPMailer(true);

    try {
        // SMTP Settings (from mail.php)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agootechnology@gmail.com';
        $mail->Password = 'xpzmjypkdhgzpnvz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Common Headers
        $mail->setFrom('agootechnology@gmail.com', 'Agoo Website');
        $mail->addAddress('info@agoo.in', 'Agoo Info');
        $mail->isHTML(true);

        // Check if it's a Career Application (has resume)
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $fullName = $_POST['fullName'] ?? 'Unknown';
            $email = $_POST['email'] ?? 'Unknown';
            $phone = $_POST['phone'] ?? 'Unknown';

            $mail->Subject = "New Job Application from $fullName";
            $mail->Body = "
                <h2>New Job Application</h2>
                <p><strong>Name:</strong> $fullName</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p>Please find the resume attached.</p>
            ";

            $mail->addAttachment($_FILES['resume']['tmp_name'], $_FILES['resume']['name']);

            // Handling Contact Form
        } else {
            $name = $_POST['name'] ?? 'Unknown';
            $email = $_POST['email'] ?? 'Unknown';
            $number = $_POST['number'] ?? 'Unknown';
            $messageContent = $_POST['message'] ?? 'No message';

            $mail->Subject = "New Contact Inquiry from $name";
            $mail->Body = "
                <h2>New Contact Inquiry</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $number</p>
                <p><strong>Message:</strong><br>$messageContent</p>
            ";
        }

        $mail->send();
        $response = ['success' => true, 'message' => 'Message sent successfully!'];

    } catch (Exception $e) {
        $response = ['success' => false, 'message' => "Mailer Error: {$mail->ErrorInfo}"];
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid request method.'];
}

echo json_encode($response);
exit;
