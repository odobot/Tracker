<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CriticalEvent $criticalEvent
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Critical Event'), ['action' => 'edit', $criticalEvent->uuid], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Critical Event'), ['action' => 'delete', $criticalEvent->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $criticalEvent->uuid), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Critical Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Critical Event'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="criticalEvents view content">
            <h3><?= h($criticalEvent->variable) ?></h3>
            <table>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($criticalEvent->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($criticalEvent->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Critical Label') ?></th>
                    <td><?= h($criticalEvent->critical_label) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= $this->Number->format($criticalEvent->device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Temperature') ?></th>
                    <td><?= $this->Number->format($criticalEvent->temperature) ?></td>
                </tr>
                <tr>
                    <th><?= __('Humidity') ?></th>
                    <td><?= $this->Number->format($criticalEvent->humidity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Reading') ?></th>
                    <td><?= $this->Number->format($criticalEvent->current_reading) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gps X') ?></th>
                    <td><?= $this->Number->format($criticalEvent->gps_x) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gps Y') ?></th>
                    <td><?= $criticalEvent->gps_y === null ? '' : $this->Number->format($criticalEvent->gps_y) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timestamp') ?></th>
                    <td><?= h($criticalEvent->timestamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
