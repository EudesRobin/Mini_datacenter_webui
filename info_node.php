<?php
include 'header.php';
include './action/json_functions.php';

gen_header("General view");
$url = 'http://localhost/oarapi/resources.json';
$json_array  = json_request_simple_url($url);

echo '
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
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>NETWORK ADDRESS</th>
						<th>STATE</th>
					</tr>
				</thead>
				<tbody>';

$alive = 0;
$absent = 0;
$dead =0;

foreach ($json_array['items'] as $key => $value) {
echo '
					<tr><td>'.$value['id'].'</td>'.'<td>'.$value['network_address'].'</td>';

	if(strcmp($value['state'],"Alive")==0){
		$alive++;
			echo '<td><a href="info_rsc.php?network_id='.$value['network_address'].'" role="button" class="btn btn-lg btn-success">Details - submit a job</a></td></tr>';
	}else if(strcmp($value['state'],"Absent")==0){
		$absent++;
		echo '<td><a href="info_rsc.php?network_id='.$value['network_address'].'" role="button" class="btn btn-lg btn-warning">Details - submit a job</a></td></tr>';
	}else{
		$dead++;
		echo '<td><a href="info_rsc.php?network_id='.$value['network_address'].'" role="button" class="btn btn-lg btn-danger">Details - submit a job</a></td></tr>';
	}
}
echo '
				</tbody>
			</table>
		</div><!--end col-md-6 -->
	</div><!--row -->
	<div class="page-header">
		<h1>General Availability</h1>
	</div>
	<div class="progress">
		<div class="progress-bar progress-bar-success" style="width: '.($alive/$json_array['total']*100).'%"><span class="sr-only">Complete (success)</span></div>
	        <div class="progress-bar progress-bar-warning" style="width: '.($absent/$json_array['total']*100).'%"><span class="sr-only">Complete (warning)</span></div>
	        <div class="progress-bar progress-bar-danger" style="width: '.($dead/$json_array['total']*100).'%"><span class="sr-only">Complete (danger)</span></div>
	</div>
</div><!-- end container theme-showcase -->
';

include 'footer.php';
?>
