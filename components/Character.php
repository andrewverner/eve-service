<?php

namespace app\components;

use Yii;
use app\models\Token;
use yii\base\Component;

class Character extends Component
{
    /**
     * @var Token
     */
    public $token;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        $characterId = Yii::$app->request->getQueryParam('characterId');

        if (!$this->token) {
            $this->token = Token::findOne([
                'character_id' => $characterId,
                'user_id' => Yii::$app->user->id,
            ]);
        }
    }
}
