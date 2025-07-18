<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TenMinuteData Model
 *
 * @method \App\Model\Entity\TenMinuteData newEmptyEntity()
 * @method \App\Model\Entity\TenMinuteData newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TenMinuteData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TenMinuteData get($primaryKey, $options = [])
 * @method \App\Model\Entity\TenMinuteData findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TenMinuteData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TenMinuteData[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TenMinuteData|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TenMinuteData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TenMinuteData[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TenMinuteData[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TenMinuteData[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TenMinuteData[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TenMinuteDataTable extends Table
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

        $this->setTable('ten_minute_data');
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
            ->uuid('uuid')
            ->requirePresence('uuid', 'create')
            ->notEmptyString('uuid');

        $validator
            ->integer('device_id')
            ->requirePresence('device_id', 'create')
            ->notEmptyString('device_id');

        $validator
            ->numeric('temperature')
            ->allowEmptyString('temperature');

        $validator
            ->numeric('humidity')
            ->allowEmptyString('humidity');

        $validator
            ->numeric('current_reading')
            ->allowEmptyString('current_reading');

        $validator
            ->integer('status')
            ->allowEmptyString('status');

        $validator
            ->numeric('GpsX')
            ->allowEmptyString('GpsX');

        $validator
            ->numeric('GpsY')
            ->allowEmptyString('GpsY');

        $validator
            ->dateTime('timestamp')
            ->notEmptyDateTime('timestamp');

        return $validator;
    }
}
