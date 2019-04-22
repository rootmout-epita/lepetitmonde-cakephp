<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 09/04/2019
 * Time: 00:51
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        /** Liens entre les tables **/
        $this->hasMany('Comments');
        $this->belongsToMany('Tags');
        $this->belongsTo('Users');
    }
}