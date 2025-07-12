<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TenMinuteData $tenMinuteData
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Ten Minute Data'), ['action' => 'edit', $tenMinuteData->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Ten Minute Data'), ['action' => 'delete', $tenMinuteData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenMinuteData->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Ten Minute Data'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Ten Minute Data'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenMinuteData view content">
            <h3><?= h($tenMinuteData->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($tenMinuteData->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= $this->Number->format($tenMinuteData->device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Temperature') ?></th>
                    <td><?= $tenMinuteData->temperature === null ? '' : $this->Number->format($tenMinuteData->temperature) ?></td>
                </tr>
                <tr>
                    <th><?= __('Humidity') ?></th>
                    <td><?= $tenMinuteData->humidity === null ? '' : $this->Number->format($tenMinuteData->humidity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Reading') ?></th>
                    <td><?= $tenMinuteData->current_reading === null ? '' : $this->Number->format($tenMinuteData->current_reading) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $tenMinuteData->status === null ? '' : $this->Number->format($tenMinuteData->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timestamp') ?></th>
                    <td><?= h($tenMinuteData->timestamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
