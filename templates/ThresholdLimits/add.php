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
            <?= $this->Html->link(__('List Threshold Limits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="thresholdLimits form content">
            <?= $this->Form->create($thresholdLimit) ?>
            <fieldset>
                <legend><?= __('Add Threshold Limit') ?></legend>
                <?php
                    echo $this->Form->control('variable');
                    echo $this->Form->control('lower_limit');
                    echo $this->Form->control('upper_limit');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
