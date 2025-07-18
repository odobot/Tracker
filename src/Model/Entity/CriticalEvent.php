<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CriticalEvent Entity
 *
 * @property string $uuid
 * @property int $device_id
 * @property float $temperature
 * @property float $humidity
 * @property float $current_reading
 * @property float $gps_x
 * @property float|null $gps_y
 * @property string|null $status
 * @property string|null $critical_label
 * @property \Cake\I18n\FrozenTime|null $timestamp
 */
class CriticalEvent extends Entity
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
        'gps_x' => true,
        'gps_y' => true,
        'status' => true,
        'critical_label' => true,
        'timestamp' => true,
    ];
}
