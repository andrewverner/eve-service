<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 9:38
 */

namespace app\widgets;

use app\models\Scope;
use app\models\Token;
use yii\base\Widget;
use yii\web\NotFoundHttpException;

class CharacterMenuWidget extends Widget
{
    public $characterId;
    private $menu;
    private $scopes;

    public function run()
    {
        $token = Token::findOne(['character_id' => $this->characterId]);
        if (!$token) {
            throw new NotFoundHttpException('Character not found');
        }

        $this->scopes = $token->getScopes();

        $this->addMenuItem(Scope::SCOPE_AGENT_RESEARCH_READ, "character/{$this->characterId}/agents", 'Agents researches');
        $this->addMenuItem(Scope::SCOPE_ASSETS_READ, "character/{$this->characterId}/assets", 'Assets');
        $this->addMenuItem(Scope::SCOPE_BP_READ, "character/{$this->characterId}/bps", 'Blueprints');
        $this->addMenuItem(Scope::SCOPE_BOOKMARKS_READ, "character/{$this->characterId}/bookmarks", 'Bookmarks');
        $this->addMenuItem(Scope::SCOPE_CALENDAR_READ, "character/{$this->characterId}/calendar", 'Calendar events');
        $this->addMenuItem(Scope::SCOPE_CHATS_READ, "character/{$this->characterId}/chats", 'Chat channels');
        $this->addMenuItem(Scope::SCOPE_CLONES_READ, "character/{$this->characterId}/clones", 'Clones');
        $this->addMenuItem(Scope::SCOPE_CONTACTS_READ, "character/{$this->characterId}/contacts", 'Contacts');
        $this->addMenuItem(Scope::SCOPE_CONTAINER_LOGS_READ, "character/{$this->characterId}/logs", 'Containers logs');
        $this->addMenuItem(Scope::SCOPE_CONTRACTS_READ, "character/{$this->characterId}/contracts", 'Contracts');
        $this->addMenuItem(Scope::SCOPE_FITTINGS_READ, "character/{$this->characterId}/fittings", 'Fittings');
        $this->addMenuItem(Scope::SCOPE_FLEET_READ, "character/{$this->characterId}/fleet", 'Fleet');
        $this->addMenuItem(Scope::SCOPE_FW_STATS_READ, "character/{$this->characterId}/fw", 'Faction warfare');
        $this->addMenuItem(Scope::SCOPE_INDUSTRY_JOBS_READ, "character/{$this->characterId}/industry", 'Industry jobs');
        $this->addMenuItem(Scope::SCOPE_KILL_MAILS_READ, "character/{$this->characterId}/kill-mails", 'Kill mails');
        $this->addMenuItem(Scope::SCOPE_LP_READ, "character/{$this->characterId}/lp", 'Loyalty points');
        $this->addMenuItem(Scope::SCOPE_MAIL_READ, "character/{$this->characterId}/mail-list", 'Mail');
        $this->addMenuItem(Scope::SCOPE_MARKET_ORDERS_READ, "character/{$this->characterId}/market-orders", 'Market orders');
        $this->addMenuItem(Scope::SCOPE_MINING_READ, "character/{$this->characterId}/mining", 'Mining statistics');
        $this->addMenuItem(Scope::SCOPE_NOTIFICATIONS_READ, "character/{$this->characterId}/notifications", 'Notifications');
        $this->addMenuItem(Scope::SCOPE_OPPORTUNITIES_READ, "character/{$this->characterId}/opportunities", 'Opportunities');
        $this->addMenuItem(Scope::SCOPE_PLANETARY_READ, "character/{$this->characterId}/planetary", 'Planetary');
        $this->addMenuItem(Scope::SCOPE_SKILLS_READ, "character/{$this->characterId}/skills", 'Skills');
        $this->addMenuItem(Scope::SCOPE_STANDINGS_READ, "character/{$this->characterId}/standings", 'Standings');
        $this->addMenuItem(Scope::SCOPE_STATS_READ, "character/{$this->characterId}/stats", 'Statistics');
        $this->addMenuItem(Scope::SCOPE_WALLET_READ, "character/{$this->characterId}/wallet", 'Wallet');
        $this->addMenuItem(Scope::SCOPE_WAY_POINT_WRITE, "character/{$this->characterId}/routes", 'Routes');

        return $this->render('character-menu', ['menu' => $this->menu, 'character' => $token->character()]);
    }

    private function addMenuItem($scope, $link, $title)
    {
        if (in_array($scope, $this->scopes)) {
            $this->menu[$title] = \Yii::$app->urlManager->createUrl($link);
        }
    }
}
