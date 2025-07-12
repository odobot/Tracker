<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\LiveData> $liveData
 */
?>
<div class="liveData index content">
    <?= $this->Html->link(__('New Live Data'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Live Data') ?></h3>
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
                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($liveData as $liveData): ?>
                <tr>
                    <td><?= h($liveData->uuid) ?></td>
                    <td><?= $this->Number->format($liveData->device_id) ?></td>
                    <td><?= $liveData->temperature === null ? '' : $this->Number->format($liveData->temperature) ?></td>
                    <td><?= $liveData->humidity === null ? '' : $this->Number->format($liveData->humidity) ?></td>
                    <td><?= $liveData->current_reading === null ? '' : $this->Number->format($liveData->current_reading) ?></td>
                    <td><?= $liveData->status === null ? '' : $this->Number->format($liveData->status) ?></td>
                    <td><?= h($liveData->timestamp) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $liveData->uuid]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $liveData->uuid]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $liveData->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $liveData->uuid)]) ?>
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
