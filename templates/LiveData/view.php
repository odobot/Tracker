<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LiveData $liveData
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Live Data'), ['action' => 'edit', $liveData->uuid], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Live Data'), ['action' => 'delete', $liveData->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $liveData->uuid), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Live Data'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Live Data'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="liveData view content">
            <h3><?= h($liveData->uuid) ?></h3>
            <table>
                <tr>
                    <th><?= __('Uuid') ?></th>
                    <td><?= h($liveData->uuid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= $this->Number->format($liveData->device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Temperature') ?></th>
                    <td><?= $liveData->temperature === null ? '' : $this->Number->format($liveData->temperature) ?></td>
                </tr>
                <tr>
                    <th><?= __('Humidity') ?></th>
                    <td><?= $liveData->humidity === null ? '' : $this->Number->format($liveData->humidity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Reading') ?></th>
                    <td><?= $liveData->current_reading === null ? '' : $this->Number->format($liveData->current_reading) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $liveData->status === null ? '' : $this->Number->format($liveData->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('GpsX') ?></th>
                    <td><?= $liveData->GpsX === null ? '' : $this->Number->format($liveData->GpsX) ?></td>
                </tr>
                <tr>
                    <th><?= __('GpsY') ?></th>
                    <td><?= $liveData->GpsY === null ? '' : $this->Number->format($liveData->GpsY) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timestamp') ?></th>
                    <td><?= h($liveData->timestamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
