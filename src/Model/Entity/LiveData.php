<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LiveData Entity
 *
 * @property string $uuid
 * @property int $device_id
 * @property string|null $temperature
 * @property string|null $humidity
 * @property string|null $current_reading
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime|null $timestamp
 * @property string|null $GpsX
 * @property string|null $GpsY
 */
class LiveData extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'device_id' => true,
        'temperature' => true,
        'humidity' => true,
        'current_reading' => true,
        'status' => true,
        'timestamp' => true,
        'GpsX' => true,
        'GpsY' => true,
    ];
}
