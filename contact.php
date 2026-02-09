<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tvoj email na koji stižu upiti
    $to = "info.nauticcareporec@gmail.com";
    
    // Čišćenje podataka od neželjenih znakova
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject_form = strip_tags(trim($_POST["subject"]));
    $message_content = htmlspecialchars(trim($_POST["message"]));

    // Naslov maila koji ti stiže
    $email_subject = "Web Upit: $subject_form (od $name)";

    // Izgled poruke u tvom inboxu
    $email_body = "Stigao je novi upit s web stranice:\n\n";
    $email_body .= "Ime i prezime: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Naslov: $subject_form\n\n";
    $email_body .= "Poruka:\n$message_content\n";

    // Zaglavlja da bi mogao direktno stisnuti 'Reply'
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Slanje i povratna informacija korisniku
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('Hvala Vam! Poruka je uspješno poslana.'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Došlo je do pogreške. Molimo pokušajte ponovno ili nas nazovite.'); window.location.href='contact.html';</script>";
    }
} else {
    echo "Pristup zabranjen.";
}
?>
