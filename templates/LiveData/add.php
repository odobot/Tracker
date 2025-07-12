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
            <?= $this->Html->link(__('List Live Data'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="liveData form content">
            <?= $this->Form->create($liveData) ?>
            <fieldset>
                <legend><?= __('Add Live Data') ?></legend>
                <?php
                    echo $this->Form->control('device_id');
                    echo $this->Form->control('temperature');
                    echo $this->Form->control('humidity');
                    echo $this->Form->control('current_reading');
                    echo $this->Form->control('status');
                    echo $this->Form->control('timestamp');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
