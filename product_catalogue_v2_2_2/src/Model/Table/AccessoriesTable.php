<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Accessories Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsToMany $Products
 *
 * @method \App\Model\Entity\Accessory get($primaryKey, $options = [])
 * @method \App\Model\Entity\Accessory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Accessory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accessory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accessory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accessory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Accessory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accessory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccessoriesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Translate', ['fields' => ['title', 'description']]);
        $this->setTable('accessories');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Products', [
            'foreignKey' => 'accessory_id',
            'targetForeignKey' => 'product_id',
            'joinTable' => 'accessories_products',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
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

}
