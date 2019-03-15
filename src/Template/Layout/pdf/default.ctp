<?php

use Cake\Core\Configure;

$cakeDescription = 'HertsCubs Booking System';
?>
<html lang="en">
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo $this->Html->css('print.css'); ?>
    <style>
		.panel {
			margin-bottom: 20px;
			background-color: #fff;
			border: 1px solid transparent;
			border-radius: 4px;
			-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
			box-shadow: 0 1px 1px rgba(0,0,0,.05);
		}
    	.panel-warning {
			border-color: #f0ad4e;
		}
        .panel-default {
            border-color: #00a794;
        }
    	.panel-warning .panel-heading {
			border-color: #f0ad4e;
			color: #fff;
			background-color: #f0ad4e;
		}
        .panel-default .panel-heading {
            border-color: #00a794;
            color: #fff;
            background-color: #00a794;
        }
		.panel-heading {
			padding: 10px 15px;
			border-bottom: 1px solid transparent;
			border-top-left-radius: 3px;
			border-top-right-radius: 3px;
		}
		.panel-body {
			padding: 15px;
		}
		.panel-footer {
			padding: 10px 15px;
			background-color: #f5f5f5;
			border-top: 1px solid #ddd;
			border-bottom-right-radius: 3px;
			border-bottom-left-radius: 3px;
		}
		body {
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size: 14px;
			line-height: 1.42857143;
			color: #333;
			background-color: #fff;
		}
		.table-responsive {
			min-height: .01%;
			overflow-x: auto;
		}
		table.table {
			clear: both;
			margin-bottom: 6px !important;
			max-width: none !important;
		}
		.table {
			width: 100%;
		}
		tbody {
			display: table-row-group;
			vertical-align: middle;
			border-top-color: inherit;
			border-right-color: inherit;
			border-bottom-color: inherit;
			border-left-color: inherit;
		}
		tr {
			display: table-row;
			vertical-align: inherit;
			border-top-color: inherit;
			border-right-color: inherit;
			border-bottom-color: inherit;
			border-left-color: inherit;
		}
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 8px;
			line-height: 1.42857143;
			vertical-align: top;
			border-top: 1px solid #ddd;
		}
		th {
			text-align: left;
			font-weight: bold;
			display: table-cell;
			vertical-align: inherit;
		}
	</style>

    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

</head>
<body>
    <div id="wrapper">
        <div id="page-wrapper">
            <?= $this->fetch('content') ?>    
        </div>
    </div>
</body>

</html>
