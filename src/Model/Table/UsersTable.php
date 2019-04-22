<?php
/**
 * Created by PhpStorm.
 * User: Helloïs
 * Date: 09/04/2019
 * Time: 00:50
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class UsersTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasMany('Comments');
        $this->hasMany('Articles');
    }
}