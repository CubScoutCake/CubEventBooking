<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * ScoutManagerStatus cell
 */
class ScoutManagerStatusCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $this->ScoutManager = $this->_registry->load('ScoutManager');

        $this->ScoutManager->checkOsmStatus();
    }
}
