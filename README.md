# 🐉 Kame Tattoo - Landing Page

Landing Page desenvolvida para o estúdio/tatuador **Kame Tattoo**. O projeto foca na apresentação do portfólio e na captação de orçamentos através de um formulário funcional com envio de e-mail e upload de imagens.

## 🚀 Tecnologias Utilizadas

* **HTML5** (Semântico e Acessível)
* **CSS3** (Mobile First, Flexbox, Grid Layout e Variáveis)
* **JavaScript** (Manipulação de DOM e Modal de Sucesso)
* **PHP** (Backend para processamento de formulário)
* **PHPMailer** (Biblioteca para envio seguro de e-mails via SMTP)

## ⚙️ Funcionalidades

* 📱 **Design Totalmente Responsivo:** Adapta-se de celulares a telas ultrawide.
* 🖼️ **Portfólio em Grid:** Layout dinâmico para exibir os trabalhos.
* 📧 **Formulário de Orçamento:**
    * Coleta dados completos (Nome, Idade, Tamanho, Local do corpo).
    * **Upload de Arquivos:** Permite enviar foto do local e referência da tattoo.
    * **Validação de Segurança:** Proteção contra XSS e validação de tipo de arquivo (MIME Check).
    * **Termos de Uso:** Checkbox obrigatório para conformidade com a LGPD.
* 📍 **Localização:** Mapa interativo (Google Maps) com recurso "Clique para ver" (melhora a performance).

## 🔧 Como Rodar o Projeto Localmente

Este projeto utiliza PHP, portanto necessita de um servidor local como o **XAMPP**.

### Pré-requisitos
* [XAMPP](https://www.apachefriends.org/) instalado.
* Conta no Gmail (ou outro provedor) com "Senha de App" gerada.

### Passo a Passo

1.  **Clone ou Baixe** este repositório.
2.  Mova a pasta do projeto para dentro do diretório do XAMPP:
    * Caminho padrão: `C:\xampp\htdocs\landing-page-Kame-Tattoo`
3.  **Configure o E-mail:**
    * Abra o arquivo `enviar.php`.
    * Localize as configurações do PHPMailer e insira suas credenciais (para testes):
    ```php
    $mail->Username   = 'seu-email@gmail.com';
    $mail->Password   = 'sua-senha-de-app';
    $mail->addAddress('email-do-tatuador@gmail.com');
    ```
4.  **Inicie o Servidor:**
    * Abra o Painel do XAMPP e clique em **Start** no **Apache**.
5.  **Acesse:**
    * Abra o navegador e digite: `http://localhost/landing-page-Kame-Tattoo/`

## ⚠️ Segurança

Este projeto implementa funções de segurança no PHP (`limparTexto` e `validarImagem`) para prevenir injeção de códigos maliciosos e upload de arquivos perigosos.

---
Desenvolvido por **Willams Silva** 💻
Estudante de Análise e Desenvolvimento de Sistemas.