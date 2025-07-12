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
                    <th><?= $this->Paginator->sort('variable') ?></th>
                    <th><?= $this->Paginator->sort('value') ?></th>
                    <th><?= $this->Paginator->sort('threshold_type') ?></th>
                    <th><?= $this->Paginator->sort('threshold_value') ?></th>
                    <th><?= $this->Paginator->sort('timestamp') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($criticalEvents as $criticalEvent): ?>
                <tr>
                    <td><?= h($criticalEvent->uuid) ?></td>
                    <td><?= $this->Number->format($criticalEvent->device_id) ?></td>
                    <td><?= h($criticalEvent->variable) ?></td>
                    <td><?= $this->Number->format($criticalEvent->value) ?></td>
                    <td><?= h($criticalEvent->threshold_type) ?></td>
                    <td><?= $this->Number->format($criticalEvent->threshold_value) ?></td>
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
