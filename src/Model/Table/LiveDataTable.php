<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LiveData Model
 *
 * @method \App\Model\Entity\LiveData newEmptyEntity()
 * @method \App\Model\Entity\LiveData newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LiveData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LiveData get($primaryKey, $options = [])
 * @method \App\Model\Entity\LiveData findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LiveData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LiveData[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LiveData|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LiveData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LiveData[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LiveData[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LiveData[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LiveData[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class LiveDataTable extends Table
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

        $this->setTable('live_data');
        $this->setDisplayField('uuid');
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
            ->notEmptyString('device_id')
            ->add('device_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->decimal('temperature')
            ->allowEmptyString('temperature');

        $validator
            ->decimal('humidity')
            ->allowEmptyString('humidity');

        $validator
            ->decimal('current_reading')
            ->allowEmptyString('current_reading');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->dateTime('timestamp')
            ->allowEmptyDateTime('timestamp');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['device_id']), ['errorField' => 'device_id']);

        return $rules;
    }
}
