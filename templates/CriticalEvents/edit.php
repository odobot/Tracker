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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $criticalEvent->uuid],
                ['confirm' => __('Are you sure you want to delete # {0}?', $criticalEvent->uuid), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Critical Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="criticalEvents form content">
            <?= $this->Form->create($criticalEvent) ?>
            <fieldset>
                <legend><?= __('Edit Critical Event') ?></legend>
                <?php
                    echo $this->Form->control('device_id');
                    echo $this->Form->control('variable');
                    echo $this->Form->control('value');
                    echo $this->Form->control('threshold_type');
                    echo $this->Form->control('threshold_value');
                    echo $this->Form->control('timestamp', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
