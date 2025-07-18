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
            <?= $this->Html->link(__('List Ten Minute Data'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenMinuteData form content">
            <?= $this->Form->create($tenMinuteData) ?>
            <fieldset>
                <legend><?= __('Add Ten Minute Data') ?></legend>
                <?php
                    echo $this->Form->control('uuid');
                    echo $this->Form->control('device_id');
                    echo $this->Form->control('temperature');
                    echo $this->Form->control('humidity');
                    echo $this->Form->control('current_reading');
                    echo $this->Form->control('status');
                    echo $this->Form->control('GpsX');
                    echo $this->Form->control('GpsY');
                    echo $this->Form->control('timestamp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
