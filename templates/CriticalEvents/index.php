<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\CriticalEvent> $criticalEvents
 */
?>
<div class="criticalEvents index content">
    <?= $this->Html->link(__('New Critical Event'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Critical Events') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('uuid') ?></th>
                    <th><?= $this->Paginator->sort('device_id') ?></th>
                    <th><?= $this->Paginator->sort('temperature') ?></th>
                    <th><?= $this->Paginator->sort('humidity') ?></th>
                    <th><?= $this->Paginator->sort('current_reading') ?></th>
                    <th><?= $this->Paginator->sort('gps_x') ?></th>
                    <th><?= $this->Paginator->sort('gps_y') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('critical_label') ?></th>
                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($criticalEvents as $criticalEvent): ?>
                <tr>
                    <td><?= h($criticalEvent->uuid) ?></td>
                    <td><?= $this->Number->format($criticalEvent->device_id) ?></td>
                    <td><?= $this->Number->format($criticalEvent->temperature) ?></td>
                    <td><?= $this->Number->format($criticalEvent->humidity) ?></td>
                    <td><?= $this->Number->format($criticalEvent->current_reading) ?></td>
                    <td><?= $this->Number->format($criticalEvent->gps_x) ?></td>
                    <td><?= $criticalEvent->gps_y === null ? '' : $this->Number->format($criticalEvent->gps_y) ?></td>
                    <td><?= h($criticalEvent->status) ?></td>
                    <td><?= h($criticalEvent->critical_label) ?></td>
                    <td><?= h($criticalEvent->timestamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $criticalEvent->uuid]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $criticalEvent->uuid]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $criticalEvent->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $criticalEvent->uuid)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
