<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover dataTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>firstname</th>
                    <th>lastname</th>
                </tr>
            </thead>
            <tfoot>
            <tr class="table-search info">
                <td><input type="text" placeholder="Search ..." class="form-control input-sm input-block-level" /></td>
            </tr>
            </tfoot>
            <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><?= $item->firstname ?></td>
                    <td><?= $item->lastname ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript">
    <?php
        use Cake\Routing\Router;
        $this->DataTables->init([
            'ajax' => [
                'url' => Router::url(['action' => 'dataTableIndex']),
            ],
            'deferLoading' => $recordsTotal,
            'delay' => 600,
            'columns' => [
                [
                    'name' => 'Users.id',
                    'data' => 'id',
                    'orderable' => false
                ],
                [
                    'name' => 'Users.firstname',
                    'data' => 'firstname'
                ],
                [
                    'name' => 'Users.lastname',
                    'data' => 'lastname'
                ]
            ]
        ])->draw('.dataTable');
    ?>
</script>
<?php $this->end(); ?>