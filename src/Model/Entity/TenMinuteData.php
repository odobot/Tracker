<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TenMinuteData Entity
 *
 * @property string $uuid
 * @property int $device_id
 * @property float|null $temperature
 * @property float|null $humidity
 * @property float|null $current_reading
 * @property int|null $status
 * @property \Cake\I18n\FrozenTime $timestamp
 */
class TenMinuteData extends Entity
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
        'uuid' => true,
        'device_id' => true,
        'temperature' => true,
        'humidity' => true,
        'current_reading' => true,
        'status' => true,
        'timestamp' => true,
    ];
}
