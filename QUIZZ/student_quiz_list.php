
<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('db_connect.php') ?>
	<title>My Quiz List</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">My Quiz List</div>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="30%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Quiz</th>
							<th>Score</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT * from  tbl_quiz_list where quiz_id in  (SELECT quiz_id FROM tbl_quiz_student_list where user_id ='".$_SESSION["user_id"]."' ) order by title asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
							$status = $conn->query("SELECT * from tbl_history where quiz_id = '".$row['id']."' and user_id ='".$_SESSION['user_id']."' ");
							$hist = $status->fetch_array();
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['title'] ?></td>
						<td><?php echo $status->num_rows > 0 ? $hist['score'].'/'.$hist['total_score'] : 'N/A' ?></td>
						<td><?php echo $status->num_rows > 0 ? 'Taken' : 'Pending' ?></td>
						<td>
							<center>
							 	<?php if($status->num_rows <= 0): ?>
							 	<a class="btn btn-sm btn-outline-primary" href="./answer_sheet.php?id=<?php echo $row['id']?>"><i class="fa fa-pencil"></i> Take Quiz</a>
								<?php else: ?>
								<a class="btn btn-sm btn-outline-primary" href="./view_answer.php?id=<?php echo $row['id']?>"><i class="fa fa-eye"></i> View</a>
							<?php endif; ?>
							</center>
						</td>
					</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>