<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issues Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\Issue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Issue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Issue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Issue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Issue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Issue findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IssuesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Translate', ['fields' => ['title', 'description']]);
        $this->setTable('issues');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',//////////////////////////////////////////////////
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['product_id'], 'Products'));
        
        $rules->add($rules->existsIn(['category_id'], 'Categories'));///////////////////////////////////////////////

        return $rules;
    }
}
