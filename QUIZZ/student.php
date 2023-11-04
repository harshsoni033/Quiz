
<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('db_connect.php') ?>
	<title>Student List</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">Student List</div>
                <a href="add_student.php"><button class="btn btn-primary bt-sm" id="new_student"><i class="fa fa-plus"></i>     Add New</button></a>    
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="30%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>class</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = mysqli_query($conn,"SELECT s.user_id,u.name,c.class_name from tbl_user u INNER join tbl_student s on u.user_id=s.user_id INNER join tbl_class c on s.class_id=c.class_id; ");
					$i = 1;
					if(mysqli_num_rows($qry) > 0){
						while($row= mysqli_fetch_array($qry) ){
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php echo $row['class_name'] ?></td>
						<td>
							<center>
                                                        <a href='view_student.php?id=<?php echo $row['user_id']; ?>' ><button class="btn btn-sm btn-outline-primary edit_student" >Edit </button></a>
                                                        <a href='delete_student.php?id=<?php echo $row['user_id']; ?>' ><button class="btn btn-sm btn-outline-danger remove_student" > Delete</button></a>
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