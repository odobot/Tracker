<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ThresholdLimit> $thresholdLimits
 */
?>
<div class="thresholdLimits index content">
    <?= $this->Html->link(__('New Threshold Limit'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Threshold Limits') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('device_id') ?></th>
                    <th><?= $this->Paginator->sort('variable') ?></th>
                    <th><?= $this->Paginator->sort('lower_limit') ?></th>
                    <th><?= $this->Paginator->sort('upper_limit') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($thresholdLimits as $thresholdLimit): ?>
                <tr>
                    <td><?= $this->Number->format($thresholdLimit->device_id) ?></td>
                    <td><?= h($thresholdLimit->variable) ?></td>
                    <td><?= $thresholdLimit->lower_limit === null ? '' : $this->Number->format($thresholdLimit->lower_limit) ?></td>
                    <td><?= $thresholdLimit->upper_limit === null ? '' : $this->Number->format($thresholdLimit->upper_limit) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $thresholdLimit->device_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $thresholdLimit->device_id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $thresholdLimit->device_id], ['confirm' => __('Are you sure you want to delete # {0}?', $thresholdLimit->device_id)]) ?>
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
