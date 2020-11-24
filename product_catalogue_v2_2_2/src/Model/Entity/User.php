<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $uuid
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Product[] $products
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'role_id' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'uuid' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'products' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
    
    // Add this method
    protected function _setPassword($value) {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
