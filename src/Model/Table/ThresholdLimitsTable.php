<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ThresholdLimits Model
 *
 * @method \App\Model\Entity\ThresholdLimit newEmptyEntity()
 * @method \App\Model\Entity\ThresholdLimit newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ThresholdLimit[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ThresholdLimit get($primaryKey, $options = [])
 * @method \App\Model\Entity\ThresholdLimit findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ThresholdLimit patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ThresholdLimit[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ThresholdLimit|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ThresholdLimit saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ThresholdLimit[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThresholdLimit[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThresholdLimit[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ThresholdLimit[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ThresholdLimitsTable extends Table
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

        $this->setTable('threshold_limits');
        $this->setDisplayField('variable');
        $this->setPrimaryKey('device_id');
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
            ->notEmptyString('device_id', 'Device ID cannot be empty');
            
        $validator
            ->scalar('variable')
            ->maxLength('variable', 50)
            ->requirePresence('variable', 'create')
            ->notEmptyString('variable');

        $validator
            ->numeric('lower_limit')
            ->allowEmptyString('lower_limit');

        $validator
            ->numeric('upper_limit')
            ->allowEmptyString('upper_limit');

        return $validator;
    }
}
