<?php
declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 07/01/2017
 * Time: 20:40
 */
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Query;

class SectionAuthBehavior extends Behavior
{
    /**
     * Find Section Types Directly
     *
     * @param \Cake\ORM\Query $query The Query to be returned.
     * @param array $options Options for the query etc.
     *
     * @return \Cake\ORM\Query
     */
    public function findSameSection(Query $query, array $options)
    {
        $assoc = $query->repository()->associations();

        if ($options['section_limited'] || is_null($options['section_limited'])) {
            if ($assoc->has('SectionTypes')) {
                $query = $query->contain('SectionTypes')->where(['SectionTypes.id' => $options['section_type_id']]);

                return $query;
            }

            if ($assoc->has('Sections')) {
                $query = $query
                    ->contain('Sections.SectionTypes')
                    ->where(['SectionTypes.id' => $options['section_type_id']]);

                return $query;
            }

            if ($assoc->has('Users')) {
                $query = $query
                    ->contain('Users.Sections.SectionTypes')
                    ->where(['SectionTypes.id' => $options['section_type_id']]);

                return $query;
            }

            if ($assoc->has('Applications')) {
                $query = $query
                    ->contain('Applications.Sections.SectionTypes')
                    ->where(['SectionTypes.id' => $options['section_type_id']]);

                return $query;
            }
        }

        return $query;
    }
}
