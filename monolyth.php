<!DOCTYPE html>
<html>
<head>
	<title>Monolyth</title>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <style type="text/css">
 	.sidebar {
 		background: #fff;
 		left: 0px;
 		height: 100vh;
 		width: 60px;
 		box-shadow: 4px -6px 55px -20px rgba(0,0,0,0.75);
 	}

    .logo {
    	font-size: 45px;
       background: linear-gradient(to right, #30CFD0 0%, #330867 100%);
       -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .n-item {
    	font-size: 30px;
    	cursor: pointer;
    	border: 2px solid #ddd;
    	margin-bottom: 20px;
    	border-radius: 100%;
    	margin-left: 5px;
    	color: #bbb;
    	transition: 0.4s;
    }

    .n-item:hover {
    	background: lightblue;
      border: 2px solid #30CFD0;
        color:#330867;
    	transition: 0.4s;
    }
 </style>
</head>
<body class="bg-light">
	<div class="sidebar">
		<ul class="p-0" style="list-style: none;">
			<li><i class="material-icons logo p-2">layers</i></li>
			<hr>
			<li data-toggle="tooltip" data-placement="right" title="Dashboard"><i class="material-icons n-item p-2">dashboard</i></li>
			<li data-toggle="tooltip" data-placement="right" title="Datasets"><i class="material-icons n-item p-2">line_style</i></li>
			<li  data-toggle="tooltip" data-placement="right" title="Feedbacks"><i class="material-icons n-item p-2">description</i></li>
			<li data-toggle="tooltip" data-placement="right" title="API"><i class="material-icons n-item p-2">track_changes</i></li>
			<li data-toggle="tooltip" data-placement="right" title="Settings"><i class="material-icons n-item p-2">settings</i></li>

		</ul>
	</div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
</html>