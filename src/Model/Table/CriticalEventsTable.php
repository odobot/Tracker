<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CriticalEvents Model
 *
 * @method \App\Model\Entity\CriticalEvent newEmptyEntity()
 * @method \App\Model\Entity\CriticalEvent newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CriticalEvent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CriticalEvent get($primaryKey, $options = [])
 * @method \App\Model\Entity\CriticalEvent findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CriticalEvent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CriticalEvent[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CriticalEvent|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CriticalEvent saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CriticalEvent[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CriticalEvent[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CriticalEvent[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CriticalEvent[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CriticalEventsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('critical_events');
        $this->setDisplayField('variable');
        $this->setPrimaryKey('uuid');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('device_id')
            ->requirePresence('device_id', 'create')
            ->notEmptyString('device_id');

        $validator
            ->numeric('temperature')
            ->requirePresence('temperature', 'create')
            ->notEmptyString('temperature');

        $validator
            ->numeric('humidity')
            ->requirePresence('humidity', 'create')
            ->notEmptyString('humidity');

        $validator
            ->numeric('current_reading')
            ->requirePresence('current_reading', 'create')
            ->notEmptyString('current_reading');

        $validator
            ->numeric('gps_x')
            ->requirePresence('gps_x', 'create')
            ->notEmptyString('gps_x');

        $validator
            ->numeric('gps_y')
            ->allowEmptyString('gps_y');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->allowEmptyString('status');

        $validator
            ->scalar('critical_label')
            ->maxLength('critical_label', 20)
            ->allowEmptyString('critical_label');

        $validator
            ->dateTime('timestamp')
            ->allowEmptyDateTime('timestamp');

        return $validator;
    }
}
