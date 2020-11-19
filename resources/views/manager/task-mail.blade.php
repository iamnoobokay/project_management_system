<!DOCTYPE html>
<html>
<head>
	<title>New Task Assigned</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">
		table,th,td{
			border:1px solid black;
		}
	</style>
</head>
<body>
	<h1>Dear User/Manager</h1>

	<p>You have been assigned a new task on the project {{$project->project_name}}. Please stay tuned for tasks and information regarding this project</p>

	<p>Regards,</p>
	<p>4 Tuples</p>

	<table>
		<tr>
			<td>Project: {{$project->project_name}}</td>
			<td>Project Manager: {{$projectManager->name}}</td>
			<td>Manager Email: {{$projectManager->email}}</td>
		</tr>
		<tr>
			<td>Task: {{$task->message}}</td>
			<td>Status: {{$task->status}}</td>
			<td>Deadline: {{$task->deadline}}</td>
		</tr>
	</table>

	
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>