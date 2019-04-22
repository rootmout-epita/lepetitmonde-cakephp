<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 10/04/2019
 * Time: 20:46
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class TagsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        /** Liens entre les tables **/
        $this->belongsToMany('Articles');
    }
}