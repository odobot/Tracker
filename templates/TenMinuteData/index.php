<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\TenMinuteData> $tenMinuteData
 */
?>
<div class="tenMinuteData index content">
    <?= $this->Html->link(__('New Ten Minute Data'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Ten Minute Data') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('uuid') ?></th>
                    <th><?= $this->Paginator->sort('device_id') ?></th>
                    <th><?= $this->Paginator->sort('temperature') ?></th>
                    <th><?= $this->Paginator->sort('humidity') ?></th>
                    <th><?= $this->Paginator->sort('current_reading') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('GpsX') ?></th>
                    <th><?= $this->Paginator->sort('GpsY') ?></th>
                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenMinuteData as $tenMinuteData): ?>
                <tr>
                    <td><?= h($tenMinuteData->uuid) ?></td>
                    <td><?= $this->Number->format($tenMinuteData->device_id) ?></td>
                    <td><?= $tenMinuteData->temperature === null ? '' : $this->Number->format($tenMinuteData->temperature) ?></td>
                    <td><?= $tenMinuteData->humidity === null ? '' : $this->Number->format($tenMinuteData->humidity) ?></td>
                    <td><?= $tenMinuteData->current_reading === null ? '' : $this->Number->format($tenMinuteData->current_reading) ?></td>
                    <td><?= $tenMinuteData->status === null ? '' : $this->Number->format($tenMinuteData->status) ?></td>
                    <td><?= $tenMinuteData->GpsX === null ? '' : $this->Number->format($tenMinuteData->GpsX) ?></td>
                    <td><?= $tenMinuteData->GpsY === null ? '' : $this->Number->format($tenMinuteData->GpsY) ?></td>
                    <td><?= h($tenMinuteData->timestamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tenMinuteData->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tenMinuteData->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tenMinuteData->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenMinuteData->id)]) ?>
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
