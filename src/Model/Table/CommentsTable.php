<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 09/04/2019
 * Time: 00:52
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class CommentsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        /** Liens entre les tables **/
        $this->belongsTo('Users');
        $this->belongsTo('Articles');
    }
}