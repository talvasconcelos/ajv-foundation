<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["form-name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["form-email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["form-message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! Houve um problema com o envio. Complete o formulário e tente de novo.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "ajvasconcelos.lda@gmail.com";

        // Set the email subject.
        $subject = "Novo contacto via site, de $name";

        // Build the email content.
        $email_content = "Nome: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Menssagem:\n$message\n";

        // Build the email headers.
        $email_headers = "De: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Obrigado! A sua mensagem foi enviada.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Algo correu mal e não conseguimos enviar a sua mensagem.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Ocorreu um problema com o envio. Por favor tente novamente.";
    }

?>