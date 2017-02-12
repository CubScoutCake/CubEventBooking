<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 07/01/2017
 * Time: 20:40
 */
namespace App\Model\Behavior;

use Cake\Event\Event;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;

class SectionAuthBehavior extends Behavior
{
    /**
     * Find Section Types Directly
     *
     * @param Query $query The Query to be returned.
     * @param array $options Options for the query etc.
     *
     * @return Query
     */
    public function findSameSection(Query $query, array $options)
    {
        return $query->contain('Users.Sections')->where(['Sections.id' => $options['section_type_id']]);
    }

    /**
     * Find Section Types Directly
     *
     * @param Query $query The Query to be returned.
     * @param array $options Options for the query etc.
     *
     * @return Query
     */
    public function findUserSection(Query $query, array $options)
    {
        return $query->contain('Sections')->where(['Sections.id' => $options['section_type_id']]);
    }
}
