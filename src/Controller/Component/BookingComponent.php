<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 10/01/2017
 * Time: 21:17
 */

namespace App\Controller\Component;

use Cake\Controller\Component;

class BookingComponent extends Component
{
    public $components = ['Flash'];

    /**
     * @param int $max The Value Maximum
     * @return void
     */
    public function randomColour($max = null)
    {
    }
}
