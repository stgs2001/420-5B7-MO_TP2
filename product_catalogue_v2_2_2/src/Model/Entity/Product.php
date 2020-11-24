<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Issue[] $issues
 * @property \App\Model\Entity\Photo[] $photos
 * @property \App\Model\Entity\Accessory[] $accessories
 */
class Product extends Entity
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
        'user_id' => true,
        'category_id' => true,
        'title' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'category' => true,
        'issues' => true,
        'photos' => true,
        'accessories' => true,
    ];
}
