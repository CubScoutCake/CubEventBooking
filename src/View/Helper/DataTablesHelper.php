<?php
namespace App\View\Helper;

use Cake\ORM\Query;
use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
use Cake\View\View;

/**
 * DataTables helper
 *
 *
 */
class DataTablesHelper extends Helper
{

    use StringTemplateTrait;

    protected $_defaultConfig = [
        'ajax' => [
            'dataSrc' => 'data',
        ],
        'searching' => true,
        'processing' => true,
        'serverSide' => true,
        'deferRender' => true,
        'dom' => '<<"row"<"col-sm-4"i><"col-sm-8"lp>>rt>',
        'delay' => 600,
    ];

    /**
     * @param array $options Options for Initialisation
     *
     * @return $this
     */
    public function init(array $options = [])
    {
        $this->_templater = $this->templater();
        $this->config($options);

        // -- load i18n
        $this->config('language', [
            'paginate' => [
                'next' => '<i class="fal fa-chevron-right"></i>',
                'previous' => '<i class="fal fa-chevron-left"></i>',
            ],
            'processing' => __d('DataTables', 'Your request is processing ...'),
            'lengthMenu' =>
                '<select class="form-control">' .
                '<option value="10">' . __d('DataTables', 'Display {0} records', 10) . '</option>' .
                '<option value="25">' . __d('DataTables', 'Display {0} records', 25) . '</option>' .
                '<option value="50">' . __d('DataTables', 'Display {0} records', 50) . '</option>' .
                '<option value="100">' . __d('DataTables', 'Display {0} records', 100) . '</option>' .
                '</select>',
            'info' => __d('DataTables', 'Showing _START_ to _END_ of _TOTAL_ entries'),
            'infoFiltered' => __d('DataTables', '(filtered from _MAX_ total entries)'),
        ]);

        return $this;
    }

    /**
     * @param int $selector The Thing being selected
     *
     * @return string
     */
    public function draw($selector)
    {
        return sprintf('delay=%d;table=jQuery("%s").dataTable(%s);initSearch();', $this->config('delay'), $selector, json_encode($this->config()));
    }
}
