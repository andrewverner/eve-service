<?php
/**
 * @var \app\components\esi\skills\QueuedSkill[] $queue
 * @var \app\components\esi\character\Character $character
 */
?>
<html>
<head>
    <title>Skill queue ends soon</title>
    <link href="https://fonts.googleapis.com/css?family=Exo+2:400,400i,700,700i" />
    <style type="text/css">
        body {
            font-family: 'Exo 2', sans-serif;
            font-weight: 400;
            color: #fff;
            background-image: url("https://wallpaper.wiki/wp-content/uploads/2017/04/wallpaper.wiki-Eve-online-minmatar-republic-thrasher-PIC-WPB006106.jpg");
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .message-body {
            max-width: 600px;
            margin: 50px auto;
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

        .message-signature {
            padding: 10px 15px;
            font-size: 12px;
            color: #ccc;
        }

        a {
            color: #3e83be;
        }
    </style>
</head>
<body>
    <div class="message-body">
        <div class="message-title">
            Skill queue ends soon
        </div>
        <div class="message-content">
            <div>
                <?= \yii\helpers\Html::img($character->image(128)); ?>
            </div>
            <div class="note note-danger"><?= $character->name ?>'s skill queue ends in 4 days at 2018-12-27 14:45:23</div>
            <div class="skill-queue">
                <?php foreach ($queue as $skill): ?>
                    <div class="skill">
                        <?= $skill->type()->name; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="message-signature">
            You received this email message, because you subscribed for our services. If you don't want to receive messages
            of this type <a href="#">click here</a>. Also you can <a href="#">unsubscribe</a> from all our messages.
        </div>
    </div>
</body>
</html>
