<?php
declare(strict_types=1);

namespace App\View\Cell;

use App\Form\AdminForm;
use Cake\View\Cell;

/**
 * QuickLink cell
 */
class QuickLinkCell extends Cell
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
        $adminFormLink = new AdminForm();
        $this->set(compact('adminFormLink'));
    }
}
