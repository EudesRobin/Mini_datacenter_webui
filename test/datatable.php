<?php
include '../header.php';
gen_header("Test");
session_start(); ?>
			<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#tab').dataTable({
					"ajax": {
						"url" : "http://localhost:48080/oarapi/resources/full.json",
						"dataSrc":"items"
					},
					"columns": [
					{ "data": "host","title": "Hostname",
						"render": function ( data, type, full, meta ) {
							return '<a href="/webui-oardocker/info_rsc.php?network_id='+data+'"><button type="button" class="btn btn-lg btn-default">'+data+'</button></a>';
					    }
					},
					{ "data" : "cpu","title": "CPU ID"},
					{ "data" : "core","title": "Core ID"},
					{ "data" : "state", "title": "State",
						"render": function ( data, type, full, meta ) {
							if(data=='Alive'){
								return '<button type="button" class="btn btn-lg btn-success">'+data+'</button>';
							}else if(data=='Absent'){
								return '<button type="button" class="btn btn-lg btn-warning">'+data+'</button>';
							}
							return '<button type="button" class="btn btn-lg btn-danger">'+data+'</button>';
					    }
					},
					{"data":"core", "title": "Action",
						"render": function ( data, type, full, meta ){
							return '<a href="/webui-oardocker/job.php?core='+data+'"><button type="button" class="btn btn-lg btn-success">Send a job to this core</button></a>';
						}	
					}
					],
					"order": [[ 0, "asc" ]],
				});
			} );
		</script>
<div class="container theme-showcase" role ="main">
	<div class="jumbotron">
		<h1>General view of the nodes</h1>
	</div><!--end jumbotron -->
	<div class="page-header">
		<h1>State of each cores </h1>
	</div>
	<div class="row">
		<div class="col-md-6">
		<!--begining table -->
			<table id="tab" class="table table-striped">
			</table>
		</div>
	</div>
<?php include '../footer.php'; ?>

