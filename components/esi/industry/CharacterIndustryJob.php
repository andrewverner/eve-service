<?php

namespace app\components\esi\industry;

use app\components\esi\character\Character;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\LocationObject;
use app\components\esi\universe\Station;
use app\components\esi\universe\Type;
use DateTime;
use yii\helpers\Html;

class CharacterIndustryJob extends EVEObject
{
    const STATUS_READY     = 'ready';
    const STATUS_ACTIVE    = 'active';
    const STATUS_PAUSED    = 'paused';
    const STATUS_REVERTED  = 'reverted';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_DELIVERED = 'delivered';

    const STATUS_BG_CLASS = [
        self::STATUS_READY => 'bg-green',
        self::STATUS_ACTIVE => 'bg-blue',
        self::STATUS_PAUSED => 'bg-orange',
        self::STATUS_REVERTED => 'bg-orange',
        self::STATUS_CANCELLED => 'bg-red',
        self::STATUS_DELIVERED => 'bg-green',
    ];

    /**
     * Job activity ID
     *
     * @var int
     */
    public $activityId;

    /**
     * Blueprint ID
     *
     * @var int
     */
    public $blueprintId;

    /**
     * Location ID of the location from which the blueprint was installed. Normally a station ID, but can also be an
     * asset (e.g. container) or corporation facility
     *
     * @var int
     */
    public $blueprintLocationId;

    /**
     * Blueprint type ID
     *
     * @var int
     */
    public $blueprintTypeId;

    /**
     * ID of the character which completed this job
     *
     * @var int
     * @optional
     */
    public $completedCharacterId;

    /**
     * Date and time when this job was completed
     *
     * @var DateTime
     * @optional
     */
    public $completedDate;

    /**
     * The sume of job installation fee and industry facility tax
     *
     * @var float
     * @optional
     */
    public $cost;

    /**
     * Job duration in seconds
     *
     * @var int
     */
    public $duration;

    /**
     * Date and time when this job finished
     *
     * @var DateTime
     */
    public $endDate;

    /**
     * ID of the facility where this job is running
     *
     * @var int
     */
    public $facilityId;

    /**
     * ID of the character which installed this job
     *
     * @var int
     */
    public $installerId;

    /**
     * Unique job ID
     *
     * @var int
     */
    public $jobId;

    /**
     * Number of runs blueprint is licensed for
     *
     * @var int
     * @optional
     */
    public $licensedRuns;

    /**
     * Location ID of the location to which the output of the job will be delivered. Normally a station ID, but can also
     * be a corporation facility
     *
     * @var int
     */
    public $outputLocationId;

    /**
     * Date and time when this job was paused (i.e. time when the facility where this job was installed went offline)
     *
     * @var DateTime
     * @optional
     */
    public $pauseDate;

    /**
     * Chance of success for invention
     *
     * @var float
     * @optional
     */
    public $probability;

    /**
     * Type ID of product (manufactured, copied or invented)
     *
     * @var int
     * @optional
     */
    public $productTypeId;

    /**
     * Number of runs for a manufacturing job, or number of copies to make for a blueprint copy
     *
     * @var int
     */
    public $runs;

    /**
     * Date and time when this job started
     *
     * @var DateTime
     */
    public $startDate;

    /**
     * ID of the station where industry facility is located
     *
     * @var int
     */
    public $stationId;

    /**
     * status string = ['active', 'cancelled', 'delivered', 'paused', 'ready', 'reverted']
     *
     * @var string
     */
    public $status;

    /**
     * Number of successful runs for this job. Equal to runs unless this is an invention job
     *
     * @var int
     * @optional
     */
    public $successfulRuns;

    /**
     * @var Type
     */
    private $blueprintType;

    /**
     * @var LocationObject
     */
    private $facility;

    /**
     * @var Character
     */
    private $installer;

    /**
     * @var Character
     * @optional
     */
    private $completedCharacter;

    /**
     * @var Type
     */
    private $productType;

    /**
     * @var Station|Facility
     */
    private $outputLocation;

    /**
     * @var Station
     */
    private $station;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->startDate = new DateTime($this->startDate);
        $this->endDate = new DateTime($this->endDate);
    }

    /**
     * @return Type
     */
    public function getBlueprintType()
    {
        if (!$this->blueprintType) {
            $this->blueprintType = EVE::universe()->type($this->blueprintTypeId);
        }

        return $this->blueprintType;
    }

    /**
     * @return Character|null
     * @throws \yii\web\NotFoundHttpException
     */
    public function getCompletedCharacter()
    {
        if (!$this->completedCharacterId) {
            return null;
        }

        if (!$this->completedCharacter) {
            $this->completedCharacter = EVE::character($this->completedCharacterId);
        }

        return $this->completedCharacter;
    }

    /**
     * @return LocationObject
     */
    public function getFacility()
    {
        if (!$this->facility) {
            $this->facility = new LocationObject($this->facilityId);
        }

        return $this->facility;
    }

    /**
     * @return Character
     * @throws \yii\web\NotFoundHttpException
     */
    public function getInstaller()
    {
        if (!$this->installer) {
            $this->installer = EVE::character($this->installerId);
        }

        return $this->installer;
    }

    /**
     * @return Facility|Station|null
     */
    public function getOutputLocation()
    {
        if (!$this->outputLocation) {
            $facility = null;
            $station = EVE::universe()->station($this->outputLocationId);
            if (!$station) {
                $facility = EVE::universe()->facility($this->outputLocationId);
            }

            if (!$station && !$facility) {
                return null;
            }

            $this->outputLocation = $station ?: $facility;
        }

        return $this->outputLocation;
    }

    /**
     * @return Type|null
     */
    public function getProductType()
    {
        if (!$this->productTypeId) {
            return null;
        }

        if (!$this->productType) {
            $this->productType = EVE::universe()->type($this->productType);
        }

        return $this->productType;
    }

    /**
     * @return Station
     */
    public function getStation()
    {
        if (!$this->station) {
            $this->station = EVE::universe()->station($this->stationId)
                ?: EVE::universe()->structure($this->stationId);
        }

        return $this->station;
    }

    public function getStatusBadge()
    {
        return Html::tag(
            'span',
            ucfirst($this->status),
            ['class' => sprintf('badge %s', self::STATUS_BG_CLASS[$this->status])]
        );
    }
}
