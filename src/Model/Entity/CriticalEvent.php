<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CriticalEvent Entity
 *
 * @property string $uuid
 * @property int $device_id
 * @property string $variable
 * @property float $value
 * @property string $threshold_type
 * @property float $threshold_value
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
        'variable' => true,
        'value' => true,
        'threshold_type' => true,
        'threshold_value' => true,
        'timestamp' => true,
    ];
}
