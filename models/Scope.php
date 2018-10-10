<?php

namespace app\models;

use app\components\esi\EVE;
use Yii;

/**
 * This is the model class for table "scope".
 *
 * @property integer $id
 * @property string $scope
 * @property string $description
 * @property integer $active
 * @property integer $group_id
 */
class Scope extends \yii\db\ActiveRecord
{
    const SCOPE_CALENDAR_READ = 'esi-calendar.read_calendar_events.v1';
    const SCOPE_CALENDAR_WRITE = 'esi-calendar.respond_calendar_events.v1';
    const SCOPE_LOCATION_READ = 'esi-location.read_location.v1';
    const SCOPE_SHIP_READ = 'esi-location.read_ship_type.v1';
    const SCOPE_MAIL_UPDATE_DELETE = 'esi-mail.organize_mail.v1';
    const SCOPE_MAIL_READ = 'esi-mail.read_mail.v1';
    const SCOPE_MAIL_WRITE = 'esi-mail.send_mail.v1';
    const SCOPE_SKILLS_READ = 'esi-skills.read_skills.v1';
    const SCOPE_SKILL_QUEUE_READ = 'esi-skills.read_skillqueue.v1';
    const SCOPE_WALLET_READ = 'esi-wallet.read_character_wallet.v1';
    const SCOPE_STRUCTURES_SEARCH = 'esi-search.search_structures.v1';
    const SCOPE_CLONES_READ = 'esi-clones.read_clones.v1';
    const SCOPE_CONTACTS_READ = 'esi-characters.read_contacts.v1';
    const SCOPE_STRUCTURES_READ = 'esi-universe.read_structures.v1';
    const SCOPE_BOOKMARKS_READ = 'esi-bookmarks.read_character_bookmarks.v1';
    const SCOPE_KILL_MAILS_READ = 'esi-killmails.read_killmails.v1';
    const SCOPE_ASSETS_READ = 'esi-assets.read_assets.v1';
    const SCOPE_PLANETARY_READ = 'esi-planets.manage_planets.v1';
    const SCOPE_FLEET_READ = 'esi-fleets.read_fleet.v1';
    const SCOPE_FLEET_WRITE = 'esi-fleets.write_fleet.v1';
    const SCOPE_UI_WINDOW_OPEN = 'esi-ui.open_window.v1';
    const SCOPE_WAY_POINT_WRITE = 'esi-ui.write_waypoint.v1';
    const SCOPE_CONTACTS_WRITE = 'esi-characters.write_contacts.v1';
    const SCOPE_FITTINGS_READ = 'esi-fittings.read_fittings.v1';
    const SCOPE_FITTINGS_WRITE = 'esi-fittings.write_fittings.v1';
    const SCOPE_STRUCTURES_MARKET = 'esi-markets.structure_markets.v1';
    const SCOPE_LP_READ = 'esi-characters.read_loyalty.v1';
    const SCOPE_OPPORTUNITIES_READ = 'esi-characters.read_opportunities.v1';
    const SCOPE_CHATS_READ = 'esi-characters.read_chat_channels.v1';
    const SCOPE_MEDALS_READ = 'esi-characters.read_medals.v1';
    const SCOPE_STANDINGS_READ = 'esi-characters.read_standings.v1';
    const SCOPE_AGENT_RESEARCH_READ = 'esi-characters.read_agents_research.v1';
    const SCOPE_INDUSTRY_JOBS_READ = 'esi-industry.read_character_jobs.v1';
    const SCOPE_MARKET_ORDERS_READ = 'esi-markets.read_character_orders.v1';
    const SCOPE_BP_READ = 'esi-characters.read_blueprints.v1';
    const SCOPE_ONLINE_READ = 'esi-location.read_online.v1';
    const SCOPE_CONTRACTS_READ = 'esi-contracts.read_character_contracts.v1';
    const SCOPE_IMPLANTS_READ = 'esi-clones.read_implants.v1';
    const SCOPE_FATIGUE_READ = 'esi-characters.read_fatigue.v1';
    const SCOPE_TRACK_MEMBERS = 'esi-corporations.track_members.v1';
    const SCOPE_NOTIFICATIONS_READ = 'esi-characters.read_notifications.v1';
    const SCOPE_CONTAINER_LOGS_READ = 'esi-corporations.read_container_logs.v1';
    const SCOPE_MINING_READ = 'esi-industry.read_character_mining.v1';
    const SCOPE_PLANETS_OFFICES_READ = 'esi-planets.read_customs_offices.v1';
    const SCOPE_TITLES_READ = 'esi-characters.read_titles.v1';
    const SCOPE_ALLIANCE_CONTACTS_READ = 'esi-alliances.read_contacts.v1';
    const SCOPE_FW_STATS_READ = 'esi-characters.read_fw_stats.v1';
    const SCOPE_STATS_READ = 'esi-characterstats.read.v1';
    
    const SCOPE_CORP_MEMBERS_READ = 'esi-corporations.read_corporation_membership.v1';
    const SCOPE_CORP_STRUCTURES_READ = 'esi-corporations.read_structures.v1';
    const SCOPE_CORP_STRUCTURES_WRITE = 'esi-corporations.write_structures.v1';
    const SCOPE_CORP_ROLES_READ = 'esi-characters.read_corporation_roles.v1';
    const SCOPE_CORP_KILL_MAILS_READ = 'esi-killmails.read_corporation_killmails.v1';
    const SCOPE_CORP_WALLET_READ = 'esi-wallet.read_corporation_wallets.v1';
    const SCOPE_CORP_DIVISIONS_READ = 'esi-corporations.read_divisions.v1';
    const SCOPE_CORP_CONTACTS_READ = 'esi-corporations.read_contacts.v1';
    const SCOPE_CORP_ASSETS_READ = 'esi-assets.read_corporation_assets.v1';
    const SCOPE_CORP_TITLES_READ = 'esi-corporations.read_titles.v1';
    const SCOPE_CORP_BP_READ = 'esi-corporations.read_blueprints.v1';
    const SCOPE_CORP_BOOKMARKS_READ = 'esi-bookmarks.read_corporation_bookmarks.v1';
    const SCOPE_CORP_CONTRACTS_READ = 'esi-contracts.read_corporation_contracts.v1';
    const SCOPE_CORP_STANDINGS_READ = 'esi-corporations.read_standings.v1';
    const SCOPE_CORP_STARBASES_READ = 'esi-corporations.read_starbases.v1';
    const SCOPE_CORP_INDUSTRY_JOBS_READ = 'esi-industry.read_corporation_jobs.v1';
    const SCOPE_CORP_MARKET_ORDERS_READ = 'esi-markets.read_corporation_orders.v1';
    const SCOPE_CORP_MINING_READ = 'esi-industry.read_corporation_mining.v1';
    const SCOPE_CORP_FACILITIES_READ = 'esi-corporations.read_facilities.v1';
    const SCOPE_CORP_MEDALS_READ = 'esi-corporations.read_medals.v1';
    const SCOPE_CORP_FW_STATS_READ = 'esi-corporations.read_fw_stats.v1';
    const SCOPE_CORP_OUTPOSTS_READ = 'esi-corporations.read_outposts.v1';

    const DEFAULT_SCOPES = [
        self::SCOPE_LOCATION_READ,
        self::SCOPE_SHIP_READ,
        self::SCOPE_ONLINE_READ,
        self::SCOPE_FATIGUE_READ,
        self::SCOPE_IMPLANTS_READ,
    ];

    const CORP_SCOPES = [
        self::SCOPE_CORP_ASSETS_READ,
        self::SCOPE_CORP_BOOKMARKS_READ,
        self::SCOPE_CORP_BP_READ,
        self::SCOPE_CORP_CONTACTS_READ,
        self::SCOPE_CORP_CONTRACTS_READ,
        self::SCOPE_CORP_DIVISIONS_READ,
        self::SCOPE_CORP_FACILITIES_READ,
        self::SCOPE_CORP_FW_STATS_READ,
        self::SCOPE_CORP_INDUSTRY_JOBS_READ,
        self::SCOPE_CORP_KILL_MAILS_READ,
        self::SCOPE_CORP_MARKET_ORDERS_READ,
        self::SCOPE_CORP_MEDALS_READ,
        self::SCOPE_CORP_MEMBERS_READ,
        self::SCOPE_CORP_MINING_READ,
        self::SCOPE_CORP_OUTPOSTS_READ,
        self::SCOPE_CORP_ROLES_READ,
        self::SCOPE_CORP_STANDINGS_READ,
        self::SCOPE_CORP_STARBASES_READ,
        self::SCOPE_CORP_STRUCTURES_READ,
        self::SCOPE_CORP_STRUCTURES_WRITE,
        self::SCOPE_CORP_TITLES_READ,
        self::SCOPE_CORP_WALLET_READ,
        self::SCOPE_TRACK_MEMBERS,
        self::SCOPE_ALLIANCE_CONTACTS_READ,
    ];

    const CHARACTER_SCOPES = [
        self::SCOPE_AGENT_RESEARCH_READ,
        self::SCOPE_ASSETS_READ,
        self::SCOPE_BP_READ,
        self::SCOPE_BOOKMARKS_READ,
        self::SCOPE_CALENDAR_READ,
        self::SCOPE_CALENDAR_WRITE,
        self::SCOPE_CHATS_READ,
        self::SCOPE_CLONES_READ,
        self::SCOPE_CONTACTS_READ,
        self::SCOPE_CONTACTS_WRITE,
        self::SCOPE_CONTAINER_LOGS_READ,
        self::SCOPE_CONTRACTS_READ,
        self::SCOPE_FITTINGS_READ,
        self::SCOPE_FITTINGS_WRITE,
        self::SCOPE_FLEET_READ,
        self::SCOPE_FLEET_WRITE,
        self::SCOPE_FW_STATS_READ,
        self::SCOPE_INDUSTRY_JOBS_READ,
        self::SCOPE_KILL_MAILS_READ,
        self::SCOPE_LP_READ,
        self::SCOPE_MAIL_READ,
        self::SCOPE_MAIL_UPDATE_DELETE,
        self::SCOPE_MAIL_WRITE,
        self::SCOPE_MARKET_ORDERS_READ,
        self::SCOPE_MEDALS_READ,
        self::SCOPE_MINING_READ,
        self::SCOPE_NOTIFICATIONS_READ,
        self::SCOPE_OPPORTUNITIES_READ,
        self::SCOPE_PLANETARY_READ,
        self::SCOPE_PLANETS_OFFICES_READ,
        self::SCOPE_SKILLS_READ,
        self::SCOPE_SKILL_QUEUE_READ,
        self::SCOPE_STANDINGS_READ,
        self::SCOPE_STATS_READ,
        self::SCOPE_STRUCTURES_SEARCH,
        self::SCOPE_STRUCTURES_READ,
        self::SCOPE_STRUCTURES_MARKET,
        self::SCOPE_TITLES_READ,
        self::SCOPE_UI_WINDOW_OPEN,
        self::SCOPE_WALLET_READ,
        self::SCOPE_WAY_POINT_WRITE,
    ];

    const SCOPE_TITLE = [
        self::SCOPE_CALENDAR_READ => 'Read calendar events',
        self::SCOPE_CALENDAR_WRITE => 'Respond to a calendar events',
        self::SCOPE_LOCATION_READ => 'Read location',
        self::SCOPE_SHIP_READ => 'Read ship type',
        self::SCOPE_MAIL_READ => 'Read mails',
        self::SCOPE_MAIL_UPDATE_DELETE => 'Update mail labels, delete mails',
        self::SCOPE_MAIL_WRITE => 'Write and send mails',
        self::SCOPE_SKILLS_READ => 'Read skills',
        self::SCOPE_SKILL_QUEUE_READ => 'Read skill queue',
        self::SCOPE_WALLET_READ => 'Read wallet',
        self::SCOPE_STRUCTURES_SEARCH => 'Search structures',
        self::SCOPE_CLONES_READ => 'Read clones',
        self::SCOPE_CONTACTS_READ => 'Read contracts',
        self::SCOPE_STRUCTURES_READ => 'Read structures',
        self::SCOPE_BOOKMARKS_READ => 'Read bookmarks',
        self::SCOPE_KILL_MAILS_READ => 'Read kill mails',
        self::SCOPE_ASSETS_READ => 'Read assets',
        self::SCOPE_PLANETARY_READ => 'Read planetary',
        self::SCOPE_FLEET_READ => 'Read fleet',
        self::SCOPE_FLEET_WRITE => 'Manipulate fleet',
        self::SCOPE_UI_WINDOW_OPEN => 'Open UI window',
        self::SCOPE_WAY_POINT_WRITE => 'Write routes',
        self::SCOPE_CONTACTS_WRITE => 'Update contracts',
        self::SCOPE_FITTINGS_READ => 'Read fittings',
        self::SCOPE_FITTINGS_WRITE => 'Update fittings',
        self::SCOPE_STRUCTURES_MARKET => 'Read structure market data',
        self::SCOPE_LP_READ => 'Read loyalty points',
        self::SCOPE_OPPORTUNITIES_READ => 'Read opportunities',
        self::SCOPE_CHATS_READ => 'Read chats',
        self::SCOPE_MEDALS_READ => 'Read medals',
        self::SCOPE_STANDINGS_READ => 'Read standings',
        self::SCOPE_AGENT_RESEARCH_READ => 'Read agents researches',
        self::SCOPE_INDUSTRY_JOBS_READ => 'Read industry jobs',
        self::SCOPE_MARKET_ORDERS_READ => 'Read market orders',
        self::SCOPE_BP_READ => 'Read blueprints',
        self::SCOPE_ONLINE_READ => 'Read online state',
        self::SCOPE_CONTRACTS_READ => 'Read contracts',
        self::SCOPE_IMPLANTS_READ => 'Read implants',
        self::SCOPE_FATIGUE_READ => 'Read jump fatigue',
        self::SCOPE_TRACK_MEMBERS => 'Track corporation members',
        self::SCOPE_NOTIFICATIONS_READ => 'Read',
        self::SCOPE_CONTAINER_LOGS_READ => 'Read containers logs',
        self::SCOPE_MINING_READ => 'Read mining stats',
        self::SCOPE_PLANETS_OFFICES_READ => 'Read planetary offices',
        self::SCOPE_TITLES_READ => 'Read titles',
        self::SCOPE_FW_STATS_READ => 'Read faction warfare stats',
        self::SCOPE_STATS_READ => 'Read stats',
        self::SCOPE_CORP_MEMBERS_READ => 'Read members list',
        self::SCOPE_CORP_STRUCTURES_READ => 'Read structures',
        self::SCOPE_CORP_STRUCTURES_WRITE => 'Update structures',
        self::SCOPE_CORP_ROLES_READ => 'Read roles',
        self::SCOPE_CORP_KILL_MAILS_READ => 'Read kill mails',
        self::SCOPE_CORP_WALLET_READ => 'Read wallet',
        self::SCOPE_CORP_DIVISIONS_READ => 'Read divisions',
        self::SCOPE_CORP_CONTACTS_READ => 'Read contacts',
        self::SCOPE_CORP_ASSETS_READ => 'Read assets',
        self::SCOPE_CORP_TITLES_READ => 'Read titles',
        self::SCOPE_CORP_BP_READ => 'Read blueprints',
        self::SCOPE_CORP_BOOKMARKS_READ => 'Read bookmarks',
        self::SCOPE_CORP_CONTRACTS_READ => 'Read contracts',
        self::SCOPE_CORP_STANDINGS_READ => 'Read standings',
        self::SCOPE_CORP_STARBASES_READ => 'Read starbases',
        self::SCOPE_CORP_INDUSTRY_JOBS_READ => 'Read industry jobs',
        self::SCOPE_CORP_MARKET_ORDERS_READ => 'Read market orders',
        self::SCOPE_CORP_MINING_READ => 'Read mining stats',
        self::SCOPE_CORP_FACILITIES_READ => 'Read facilities',
        self::SCOPE_CORP_MEDALS_READ => 'Read medals',
        self::SCOPE_CORP_FW_STATS_READ => 'Read faction warfare stats',
        self::SCOPE_CORP_OUTPOSTS_READ => 'Read outposts',
        self::SCOPE_ALLIANCE_CONTACTS_READ => 'Read alliance contacts',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scope';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope'], 'required'],
            [['group_id'], 'integer'],
            [['scope', 'description'], 'string', 'max' => 255],
            [['active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope' => 'Scope',
            'description' => 'Description',
            'active' => 'Active',
            'group_id' => 'Group ID',
        ];
    }

    public static function getScopeTitle($scope)
    {
        $scopes = EVE::sso()->getScopesList();
        return $scopes[$scope] ?? '';
    }

    public static function getCharacterScopes($withDefault = true)
    {
        return $withDefault
            ? array_merge(self::CHARACTER_SCOPES, self::DEFAULT_SCOPES)
            : self::CHARACTER_SCOPES;
    }
}
