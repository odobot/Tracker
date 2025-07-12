<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ThresholdLimit Entity
 *
 * @property int $device_id
 * @property string $variable
 * @property float|null $lower_limit
 * @property float|null $upper_limit
 */
class ThresholdLimit extends Entity
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
        'variable' => true,
        'lower_limit' => true,
        'upper_limit' => true,
    ];
}
