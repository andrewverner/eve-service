<?php
/**
 * @var \app\models\User $user
 * @var string $hash
 */
?>
<html>
<head>
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,400i,700,700i" />
    <style type="text/css">
        .message {
            font-family: 'Exo 2', sans-serif;
        }

        .logo-container {
            max-width: 630px;
            margin: 15px auto;
            text-align: center;
            font-size: 30px;
            font-style: italic;
            color: #fff;
            font-weight: 700;
        }

        .message-body {
            max-width: 600px;
            margin: auto;
            background-color: #1b1e21;
            border: 15px solid rgba(50,50,50,0.5);
            color: #fff;
        }

        .message-title {
            padding: 10px 15px;
            font-weight: 700;
            font-size: 20px;
            border-bottom: 1px solid #444;
            text-transform: uppercase;
        }

        .message-content {
            padding: 10px 15px;
        }

        .message-signature, .message-footer {
            padding: 10px 15px;
            color: #ccc;
        }

        .message-signature {
            font-size: 12px;
        }

        .message-footer {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div style="background-color:#252c46;" class="message">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" src="https://images5.alphacoders.com/434/434655.jpg" color="#252c46"/>
    </v:background>
    <![endif]-->
    <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td valign="top" align="left" background="https://images5.alphacoders.com/434/434655.jpg">
                <div class="logo-container">
                    <a href="#" style="color: #fff; text-decoration: none">EVE Services</a>
                </div>
                <div class="message-body">
                    <div class="message-title">
                        Registration
                    </div>
                    <div class="message-content">
                        <div style="font-weight: 700;">Hello, <?= $user->username; ?>!</div>
                        Welcome to EVE Services website.<br /><br />
                        Please follow <?= \yii\helpers\Html::a(
                            'this link',
                            Yii::$app->urlManager->createUrl(Yii::$app->params['hostUrl'] . "/activate/{$hash}"),
                            ['style' => 'color: #3e83be']
                        ) ?> to activate your account.
                    </div>
                    <div class="message-footer">
                        This message was generated automatically. Please don't reply.<br /><br />
                        Kind regards,<br />
                        EVE Services Website development team.
                    </div>
                    <div class="message-signature">
                        You received this email message, because you subscribed for our services. If you don't want to receive messages
                        of this type <a href="#" style="color: #3e83be">click here</a>. Also you can <a href="#" style="color: #3e83be">unsubscribe</a> from all our messages.
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
