<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 16:45
 */

namespace app\components\esi\wallet;

use app\components\esi\EVE;
use app\models\Token;

class CharacterWallet
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var float
     */
    private $balance;

    /**
     * @var CharacterWalletJournalRecord[]
     */
    private $journal;

    /**
     * @var CharacterWalletTransaction[]
     */
    private $transactions;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return float|int
     */
    public function balance()
    {
        if (is_null($this->balance)) {
            $cacheKey = "character:{$this->token->character_id}:balance";
            $request = EVE::secureRequest('/characters/{character_id}/wallet/', $this->token);
            $request->cacheDuration = 1200;
            $this->balance = $request->send(['character_id' => $this->token->character_id], $cacheKey) ?: 0;
        }

        return $this->balance;
    }

    /**
     * @return CharacterWalletJournalRecord[]|array|bool|mixed
     */
    public function journal()
    {
        if (is_null($this->journal)) {
            $cacheKey = "character:{$this->token->character_id}:wallet:journal";
            $request = EVE::secureRequest('/characters/{character_id}/wallet/journal/', $this->token);
            $request->cacheDuration = 1800;
            $data = $request->send(['character_id' => $this->token->character_id], $cacheKey);
            if ($data && is_array($data)) {
                foreach ($data as &$row) {
                    $row = new CharacterWalletJournalRecord($row);
                }

                $this->journal = $data;
            }
        }

        return $this->journal;
    }

    /**
     * @return CharacterWalletTransaction[]|array|bool|mixed
     */
    public function transactions()
    {
        if (!$this->transactions) {
            $cacheKey = "character:{$this->token->character_id}:wallet:transactions";
            $request = EVE::secureRequest('/characters/{character_id}/wallet/transactions/', $this->token);
            $request->cacheDuration = 1800;
            $data = $request->send(['character_id' => $this->token->character_id], $cacheKey);
            if ($data && is_array($data)) {
                foreach ($data as &$transaction) {
                    $transaction = new CharacterWalletTransaction($transaction);
                }

                $this->transactions = $data;
            }
        }

        return $this->transactions;
    }
}
