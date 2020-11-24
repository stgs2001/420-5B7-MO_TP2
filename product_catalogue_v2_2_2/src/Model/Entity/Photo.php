<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Photo Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $owner
 * @property \Cake\I18n\FrozenDate $date
 * @property string $description
 * @property string $filename
 * @property string $path
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Product $product
 */
class Photo extends Entity
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
        'product_id' => true,
        'title' => true,
        'owner' => true,
        'date' => true,
        'description' => true,
        'filename' => true,
        'path' => true,
        'created' => true,
        'modified' => true,
        'product' => true,
    ];
}
