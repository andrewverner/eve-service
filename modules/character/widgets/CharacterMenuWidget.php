<?php


namespace app\modules\character\widgets;

use Yii;
use app\models\Scope;
use app\models\Token;
use yii\base\Widget;
use yii\web\NotFoundHttpException;

class CharacterMenuWidget extends Widget
{
    private $scopes;
    private $character;
    private $characterMenu;

    public function run()
    {
        /**
         * @var Token $token
         */
        $token = Yii::$app->character->token;
        if (!$token) {
            throw new NotFoundHttpException('Character not found');
        }
        $this->character = $token->character();

        $this->scopes = $token->getScopes();

        $this->addMenuItem(Scope::SCOPE_AGENT_RESEARCH_READ, "agents", 'Agents researches', 'fas fa-microscope');
        $this->addMenuItem(Scope::SCOPE_ASSETS_READ, "assets", 'Assets', 'fas fa-boxes');
        $this->addMenuItem(Scope::SCOPE_BP_READ, "bps", 'Blueprints', 'fas fa-scroll');
        $this->addMenuItem(Scope::SCOPE_BOOKMARKS_READ, "bookmarks", 'Bookmarks', 'fas fa-map-marker-alt');
        $this->addMenuItem(Scope::SCOPE_CALENDAR_READ, "calendar", 'Calendar events', 'fas fa-calendar-alt');
        $this->addMenuItem(Scope::SCOPE_CHATS_READ, "chats", 'Chat channels', 'fas fa-comments');
        $this->addMenuItem(Scope::SCOPE_CLONES_READ, "clones", 'Clones');
        $this->addMenuItem(Scope::SCOPE_CONTACTS_READ, "contacts", 'Contacts');
        $this->addMenuItem(Scope::SCOPE_CONTAINER_LOGS_READ, "logs", 'Containers logs');
        $this->addMenuItem(Scope::SCOPE_CONTRACTS_READ, "contracts", 'Contracts');
        $this->addMenuItem(Scope::SCOPE_FITTINGS_READ, "fittings", 'Fittings');
        $this->addMenuItem(Scope::SCOPE_FLEET_READ, "fleet", 'Fleet');
        $this->addMenuItem(Scope::SCOPE_FW_STATS_READ, "fw", 'Faction warfare');
        $this->addMenuItem(Scope::SCOPE_INDUSTRY_JOBS_READ, "industry-jobs", 'Industry jobs');
        $this->addMenuItem(Scope::SCOPE_KILL_MAILS_READ, "kill-mails", 'Kill mails');
        $this->addMenuItem(Scope::SCOPE_LP_READ, "lp", 'Loyalty points');
        $this->addMenuItem(Scope::SCOPE_MAIL_READ, "mail-list", 'Mail');
        $this->addMenuItem(Scope::SCOPE_MARKET_ORDERS_READ, "market-orders", 'Market orders');
        $this->addMenuItem(Scope::SCOPE_MINING_READ, "mining", 'Mining statistics');
        $this->addMenuItem(Scope::SCOPE_NOTIFICATIONS_READ, "notifications", 'Notifications');
        $this->addMenuItem(Scope::SCOPE_OPPORTUNITIES_READ, "opportunities", 'Opportunities');
        $this->addMenuItem(Scope::SCOPE_PLANETARY_READ, "planetary", 'Planetary');
        $this->addMenuItem(Scope::SCOPE_SKILLS_READ, "skills", 'Skills');
        $this->addMenuItem(Scope::SCOPE_STANDINGS_READ, "standings", 'Standings');
        $this->addMenuItem(Scope::SCOPE_STATS_READ, "stats", 'Statistics');
        $this->addMenuItem(Scope::SCOPE_WALLET_READ, "wallet", 'Wallet');
        $this->addMenuItem(Scope::SCOPE_WAY_POINT_WRITE, "routes", 'Routes');

        return $this->render('character-menu', ['menu' => $this->characterMenu, 'character' => $token->character()]);
    }

    private function addMenuItem($scope, $link, $title, $icon = null)
    {
        if (in_array($scope, $this->scopes)) {
            $link = Yii::$app->urlManager->createUrl("/character/{$this->character->characterId}/$link");
            $this->characterMenu[] = new MenuItem($title, $icon, $link);
        }
    }
}