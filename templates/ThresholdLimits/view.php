<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ThresholdLimit $thresholdLimit
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Threshold Limit'), ['action' => 'edit', $thresholdLimit->device_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Threshold Limit'), ['action' => 'delete', $thresholdLimit->device_id], ['confirm' => __('Are you sure you want to delete # {0}?', $thresholdLimit->device_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Threshold Limits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Threshold Limit'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="thresholdLimits view content">
            <h3><?= h($thresholdLimit->variable) ?></h3>
            <table>
                <tr>
                    <th><?= __('Variable') ?></th>
                    <td><?= h($thresholdLimit->variable) ?></td>
                </tr>
                <tr>
                    <th><?= __('Device Id') ?></th>
                    <td><?= $this->Number->format($thresholdLimit->device_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lower Limit') ?></th>
                    <td><?= $thresholdLimit->lower_limit === null ? '' : $this->Number->format($thresholdLimit->lower_limit) ?></td>
                </tr>
                <tr>
                    <th><?= __('Upper Limit') ?></th>
                    <td><?= $thresholdLimit->upper_limit === null ? '' : $this->Number->format($thresholdLimit->upper_limit) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
