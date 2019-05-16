<?php 
	session_start();
	include "header.php";
	$id = $_GET['id'];
	$username = $_GET['username'];
	$log = Database::search("l.azione, l.data_inserimento, liv.background_color, liv.color", "log l, level liv", "l.utente = $id AND liv.id = l.level ORDER BY l.data_inserimento DESC");
?>

<div class="row new_section" style="background-color: white">
	<h1 style="text-align: center;color:black">LOG <?php echo $username; ?></h1>
	<br>
	<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
		<div class="col-lg-4 col-md-5 col-sm-8 col-xs-12">
			<ul class="list-group">
				<li class="list-group-item list-group-item-success">Basic Activities (Login, logout..)</li>
				<li class="list-group-item list-group-item-primary">New Data (Aroma, liquido, user..)
				<li class="list-group-item list-group-item-warning">Data Update (Modify profile, changing status..)</li>
				<li class="list-group-item list-group-item-danger">Data Delete (Aroma, liquido, user..)</li>
			</ul>
		</div>
		<!-- TABELLA LOG -->
		<table id="tableLog" name="tableLog" class="table table-bordered" style="width: 100%; color:green">
			<thead>
				<tr>
					<th style="width:40%" class="header_table_log">Time</th><th class="header_table_log">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if($log){
						for ($i=0; $i < sizeof($log); $i++) {
						$curr_row = $log[$i];
						$curr_row['data_inserimento'] = date('d/m/Y H:i:s', strtotime($curr_row['data_inserimento']));
						$style="background-color: ".$curr_row['background_color'].";color: ".$curr_row['color'];
				?>
							<tr>
								<td style="<?php echo $style; ?>"><?php echo $curr_row['data_inserimento'] ?></td>
								<td style="<?php echo $style; ?>"><?php echo $curr_row['azione']; ?></td>
							</tr>
					<?php } }?>
			</tbody>
		</table>
	</div>
</div>
<script src="js/log.js">