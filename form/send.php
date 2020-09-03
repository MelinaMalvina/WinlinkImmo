<?php
//ini_set('display_errors',1);
function return_error() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Erreur', true, 500);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
    return_error();
}
$content = "<p>Le formulaire vient d'être rempli.</p>";
$content .= '<h2>Demande de renseignement</h2>';
$content .= '<ul>';
if (isset($_POST['jesuis'])) {
    $content .= '<li><strong>J\'ai besoin de renseignement sur : </strong>';
    $values = array(
        'polesophrologie' => 'Sophrologue',
        'polepsychothérapie' => 'Psychotherapeute',
        'poleshiatsu' => 'Shiatsu',
        'polehypnose' => 'Hypnose',
        'poleautre' => 'Autre',
        'poleinfirmier' => 'Infirmier',
        'poleosteopathe' => 'Osteopathe',
        'polenouveaupraticien' => 'Nouveau praticien',
        'poleadministratif' => 'Administratif'
    );
    if (isset($values[$_POST['jesuis']])) {
        $content .= $values[$_POST['jesuis']];
    } $content .= '</li>';
}

if (isset($_POST['projet'])) {
    $content .= '<li><strong>Votre projet : </strong>';
    $values = array('creation' => "J'ai un projet de création de maison de santé", 'existant' => "J'exerce déjà en maison de santé");
    if (isset($values[$_POST['projet']])) {
        $content .= $values[$_POST['projet']];
    }
}
$content .= '</ul>';
$content .= '<h2>Coordonnées</h2>';
$content .= '<ul>';
if (isset($_POST['civilite'])) {
    $content .= '<li><strong>Civilité : </strong>';
    $values = array('mr' => 'Monsieur', 'mme' => 'Madame', 'mle' => 'Mademoiselle');
    if (isset($values[$_POST['civilite']])) {
        $content .= $values[$_POST['civilite']];
    } $content .= '</li>';
}
if (isset($_POST['societe'])) {

    $content .= '<li><strong>Structure : </strong>';

    $content .= htmlentities(utf8_decode($_POST['societe']), ENT_COMPAT, 'utf-8');

    $content .= '</li>';

}
if (isset($_POST['prenom'])) {
    $content .= '<li><strong>Prénom : </strong>';
    $content .= htmlentities(utf8_decode($_POST['prenom']), ENT_COMPAT, 'utf-8');
    $content .= '</li>';
}
if (isset($_POST['nom'])) {
    $content .= '<li><strong>Nom : </strong>';
    $content .= htmlentities(utf8_decode($_POST['nom']), ENT_COMPAT, 'utf-8');
    $content .= '</li>';
}
if (isset($_POST['email'])) {
    $content .= '<li><strong>Email : </strong>';
    $content .= htmlentities(utf8_decode($_POST['email']), ENT_COMPAT, 'utf-8');
    $content .= '</li>';
}
if (isset($_POST['telephone'])) {
    $content .= '<li><strong>Téléphone : </strong>';
    $content .= htmlentities(utf8_decode($_POST['telephone']), ENT_COMPAT, 'utf-8');
    $content .= '</li>';
}
if (isset($_POST['commentaires'])) {
    $content .= '<li><strong>Commentaires : </strong>';
    $content .= nl2br(htmlentities(utf8_decode($_POST['commentaires']), ENT_COMPAT, 'utf-8'));
    $content .= '</li>';
}
$content .= '</ul>';
$content .= '<hr />Message envoyé le ' . date("d/m/Y H:i:s");
include("class.phpmailer.php");

//var_dump($content);

file_put_contents('log.txt', $content . PHP_EOL . PHP_EOL, FILE_APPEND);
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();
$mail->SMTPAuth = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host = "**";      // sets GMAIL as the SMTP server
$mail->Port = 465;                   // set the SMTP port

$mail->Username = "**";
$mail->Password = "**";

$mail->From = "contact@centreberlioz.fr";
$mail->FromName = "Centre berlioz Marseille";
$mail->Subject = "Centre berlioz Marseille - Formulaire saisi par ".$_POST['nom'].", renseignements pour : ".$_POST['jesuis'];

$mail->MsgHTML($content);

// antirobot
if (
        ($_POST['nom']<>"" OR $_POST['commentaires']<>"")
       AND
       (substr($_POST['nom'], 1, 3)<>substr($_POST['prenom'], 1, 3))
    )
{
$mail->AddAddress("contact@winlinksante.com", "contact@winlinksante.com");
//$mail->AddBCC("contact@winlinksys.com", "Contact");
}
else
{
$mail->FromName = "aa.com";
$mail->Subject = "aa.com - Nouvelle réponse";
$mail->AddAddress("aatytuytuytuhbjhghjgvgvgyhv@khkjhkjfgyuftydrdhjhjgkjhkdgfdfg45465.com", "aa");
}
$mail->IsHTML(true); // send as HTML
if (!$mail->Send()) {
    return_error();
} else {
    exit;
}