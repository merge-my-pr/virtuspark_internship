<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'contact@example.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
// 
//Contact Form//////////////////////////////////////////////////////////////////////////
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags(trim($_POST["subject"])));
    $message = htmlspecialchars(strip_tags(trim($_POST["message"])));

    // Validate input
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If any field is invalid, return an error message
        echo json_encode(["status" => "error", "message" => "Please fill in all fields correctly."]);
        exit;
    }

    // Recipient email
    $recipient = "edueliteclub2023@gmail.com"; // Change this to your email address

    // Email subject
    $email_subject = "Contact form: $subject";

    // Email body
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>";

    // Send email
    if (mail($recipient, $email_subject, $email_body, $headers)) {
        // On success
        echo json_encode(["status" => "success", "message" => "Your message has been sent."]);
    } else {
        // On failure
        echo json_encode(["status" => "error", "message" => "Sorry, there was an issue sending your message."]);
    }
} else {
    // If the request method is not POST, return an error
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>

