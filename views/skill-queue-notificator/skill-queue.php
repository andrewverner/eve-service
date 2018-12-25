<?php
/**
 * @var \app\components\esi\skills\QueuedSkill[] $queue
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\skills\QueuedSkill $lastSkill
 * @var DateInterval $diff
 */
?>
<html>
<head>
    <title>Skill queue ends soon</title>
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

        .note {
            padding: 10px 15px;
            margin: 15px 0;
        }

        .note-danger {
            background-color: #be2f29;
            border-left: 5px solid #9e2924;
        }

        .skill-queue {
            font-size: 14px;
        }

        .skill {
            padding: 5px;
            border-bottom: 1px solid #444;
        }

        .skill:last-child {
            border-bottom: none;
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
                        Skill queue ends soon
                    </div>
                    <div class="message-content">
                        <div>
                            <?= \yii\helpers\Html::img($character->image(128)); ?>
                        </div>
                        <div class="note note-danger">
                            <?= $character->name ?>'s skill queue ends in <?= $diff->days ?> day<?= $diff->days > 1 ? 's' : '' ?> at
                            <?= $lastSkill->finishDate->format('Y-m-d H:i:s') ?>
                        </div>
                        <div class="skill-queue">
                            <?php foreach ($queue as $skill): ?>
                                <div class="skill">
                                    <?= $skill->type()->name; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
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
