@extends('layouts.admin.principal')

@section('content')

<div class="panel panel-primary">
	<div class="panel-heading">
		Titulo del panel
	</div>
	<div class="panel-body">
		<p>Cuepor del panel</p>

		
		
		<?php
		$transport = new \Kendo\Data\DataSourceTransport();

		$read = new \Kendo\Data\DataSourceTransportRead();

		$read->url('tesProcedimientogrid')
		->contentType('application/json')
		->type('POST');

		$transport->read($read)
		->parameterMap('function(data) {
			return kendo.stringify(data);
		}');

		$model = new \Kendo\Data\DataSourceSchemaModel();

		$shipNameField = new \Kendo\Data\DataSourceSchemaModelField('idtesprocedimiento');
		$shipNameField->type('number');

		$shipCityField = new \Kendo\Data\DataSourceSchemaModelField('usuario');
		$shipCityField->type('string');

		$orderIDField = new \Kendo\Data\DataSourceSchemaModelField('direccion');
		$orderIDField->type('string');

		$freightField = new \Kendo\Data\DataSourceSchemaModelField('telefono');
		$freightField->type('string');



		$model->addField($shipNameField)
		->addField($freightField)
		->addField($orderIDField)
		->addField($shipCityField);


		$schema = new \Kendo\Data\DataSourceSchema();
		$schema->data('data')
		->model($model)
		->total('total');

		$dataSource = new \Kendo\Data\DataSource();

		$dataSource->transport($transport)
		->pageSize(5)
		->schema($schema)
		->serverFiltering(true)
		->serverSorting(true)
		->serverPaging(true);

		$grid = new \Kendo\UI\Grid('grid');

		$orderID = new \Kendo\UI\GridColumn();
		$orderID->field('idtesprocedimiento')
		->filterable(false)
		->title('id');

		$freight = new \Kendo\UI\GridColumn();
		$freight->field('usuario')
		->title('usuario');

		$orderDate = new \Kendo\UI\GridColumn();
		$orderDate->field('direccion')
		->title('direccion');

		$shipName = new \Kendo\UI\GridColumn();
		$shipName->field('telefono')
		->title('telefono');

		$gridFilterable = new \Kendo\UI\GridFilterable();
	    $gridFilterable->mode("row");

		$grid->addColumn($orderID, $freight, $orderDate, $shipName)
		->dataSource($dataSource)
		->sortable(true)
		->filterable($gridFilterable)
		->pageable(true);

		echo $grid->render();
		?>
		<div id="grid2"></div>

	</div>
	<div class="panel-footer">
		el footer del panel
	</div>
</div>

@endsection

@section('scripts')

@endsection