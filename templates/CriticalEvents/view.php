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
                    <th><?= __('Variable') ?></th>
                    <td><?= h($criticalEvent->variable) ?></td>
                </tr>
                <tr>
                    <th><?= __('Threshold Type') ?></th>
                    <td><?= h($criticalEvent->threshold_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= $this->Number->format($criticalEvent->device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Value') ?></th>
                    <td><?= $this->Number->format($criticalEvent->value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Threshold Value') ?></th>
                    <td><?= $this->Number->format($criticalEvent->threshold_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timestamp') ?></th>
                    <td><?= h($criticalEvent->timestamp) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
