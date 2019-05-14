<?php
    $alert = '';
    $alertClass = '';

    if (filter_has_var(INPUT_POST, 'submit')) {
        $name = ucwords(htmlentities(trim($_POST['name'])));
        $email = htmlentities(trim($_POST['email']));
        $message = htmlentities(trim($_POST['message']));

        if (!empty($name) && !empty($email) && !empty($message)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $to = 'nvnthct@gmail.com';
                $subject = 'Contact Form';
                $body = '<strong>Name</strong>: '.$name.'<br><strong>Email</strong>: '.$email.'<br><strong>Message</strong>: '.$message;
                $headers = array(
                    'MIME-Version: 1.0',
                    'Content-type: text/html; charset=utf-8',
                    'From: <'.$email.'>'
                );

                if (mail($to, $subject, $body, implode("\r\n", $headers))) {
                    $alert = 'You have succesfully contacted us';
                    $alertClass = 'success';
                } else {
                    $alert = 'You have failed to contact us';
                    $alertClass = 'error';
                }
            } else {
                $alert = 'Invalid email address';
                $alertClass = 'error';
            }
        } else {
            $alert = 'Please fill in all the fields';
            $alertClass = 'error';
        }
    }
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <title>Contact Form</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
<?php if ($alert !== ''): ?><div class="<?php echo $alertClass; ?>"><?php echo $alert; ?></div><?php endif; ?>
    <h1><span>Contact Form</span></h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input name="name" value="<?php if (isset($_POST['name'])) { echo $name; } ?>" placeholder="Name" type="text"><br>
        <input name="email" value="<?php if (isset($_POST['email'])) { echo $email; } ?>" placeholder="Email" type="text"><br>
        <textarea name="message" placeholder="Message"><?php if (isset($_POST['message'])) { echo $message; } ?></textarea><br>
        <input name="submit" type="submit">
    </form>
</body>
</html>
