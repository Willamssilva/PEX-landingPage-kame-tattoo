<?php

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function limparTexto($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

//Função de Segurança para validar uploads de imagem
function validarImagem($file)
{
    if ($file['error'] !== UPLOAD_ERR_OK)
        return false;
    $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $tamanhoMaximo)
        return false;
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipoReal = $finfo->file($file['tmp_name']);
    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    return in_array($tipoReal, $tiposPermitidos);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['termos'])) {
        die("Erro: Você precisa aceitar os termos para continuar.");
    }

    $nome        = limparTexto($_POST['nome']);
    $email       = limparTexto($_POST['email']);
    $idade       = limparTexto($_POST['idade']);
    $celular     = limparTexto($_POST['numeroCel']);
    $cidade      = limparTexto($_POST['cidade']);
    $estado      = limparTexto($_POST['estado']);
    $tamanho     = limparTexto($_POST['tamanhotattoo']);
    $localCorpo  = limparTexto($_POST['localCorpo']);
    $ideia       = limparTexto($_POST['ideiaTattoo']);


    $mail = new PHPMailer(true);

    try {
        // Configuração do Servidor
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'email@exemplo.com'; //seu enail aqui
        $mail->Password   = 'senha';//sua senha de app aqui
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        //Destinatarios
        $mail->setFrom('email@exemplo.com', 'Site Kame Tattoo'); //seu email

        // email de quem recebe o formulario
        $mail->addAddress('email@exemplo.com');

        // Responder para (O Cliente)
        $mail->addReplyTo($email, $nome);

        //Validar e Anexar Arquivos
        if (isset($_FILES['fotoLocalCorpo']) && $_FILES['fotoLocalCorpo']['size'] > 0) {
            if (validarImagem($_FILES['fotoLocalCorpo'])) {
                $mail->addAttachment($_FILES['fotoLocalCorpo']['tmp_name'], 'foto_local.jpg');
            } else {
                throw new Exception("O arquivo 'Foto do Local' é inválido.");
            }
        }

        if (isset($_FILES['imgRefTattoo']) && $_FILES['imgRefTattoo']['size'] > 0) {
            if (validarImagem($_FILES['imgRefTattoo'])) {
                $mail->addAttachment($_FILES['imgRefTattoo']['tmp_name'], 'referencia.jpg');
            } else {
                throw new Exception("O arquivo 'Referência' é inválido.");
            }
        }


        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Novo Pedido de Orçamento de: ' . $nome;

        $mail->Body    = "<h2>Novo Pedido de Orçamento Recebido</h2>"
            . "<p><b>Nome:</b> {$nome}</p>"
            . "<p><b>Email:</b> {$email}</p>"
            . "<p><b>Idade:</b> {$idade}</p>"
            . "<p><b>Celular:</b> {$celular}</p>"
            . "<p><b>Cidade/Estado:</b> {$cidade} / {$estado}</p>"
            . "<hr>"
            . "<h3>Detalhes da Tattoo</h3>"
            . "<p><b>Tamanho:</b> {$tamanho}</p>"
            . "<p><b>Local do Corpo:</b> {$localCorpo}</p>"
            . "<p><b>Ideia:</b></p>"
            . "<blockquote>" . nl2br($ideia) . "</blockquote>"
            . "<p><i>Os arquivos de imagem estão em anexo.</i></p>";

        $mail->AltBody = "Novo Pedido de Orçamento Recebido\n"
            . "Nome: {$nome}\n"
            . "Email: {$email}\n"
            . "Ideia: {$ideia}";

        //envia o email
        $mail->send();

        header('Location: index.html?status=sucesso');
        exit;
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem. Por favor, tente novamente.<br>";
        // echo "Erro ao enviar mensagem: {$mail->ErrorInfo}"; 
    }
} else {
    echo "Acesso inválido.";
}