<?php
	session_start();
	$image="";
	if(isset($_SESSION['email']))
	{
		$email=$_SESSION['email'];
		$name =$_SESSION['name'];
		if(isset($_SESSION['image']))
		{
			$image=$_SESSION['image'];
		}
	}
	else
	{
		header('location:index.html');
	}
?>


<!DOCTYPE html>

<html lang="en">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<link rel="stylesheet" href="cssIOT/deshbord.css">
	<title>IOT</title>
	<style>
		.my-custom-scrollbar
		{
			position: relative;
			height: 90%;
			overflow: auto;
		}
		.table-wrapper-scroll-y {
		display: block;
		}

	</style>
	</head>
	<body>
	<div class="container-fluid header">
		<div class="row" >
			<div class="col-md-2 headerlogo" >
				<div>
					<img src="image/iot.jpg" height="50px" width="200px" style="margin-top:10px;" /><br>
				</div>
			</div>
			<div class="col-md-10 headerdete" >
				<div style="margin: 15px 0 0px 1000px;">
					<a href="logout.php"><img src="image/logout.svg" height="40px" width="200px" /></a>
				</div>
			</div>
		</div>
	</div>

	
	
	<div class="container-fluid">
			<div class="row ">
				
				<div class="col-md-2 colheight1">
					<div class="navbar">
						<div>
						<?php
							if($image!=null)
							{
							?>
								<img src="<?php echo $image; ?>" height="80px" width="80px" style="border-radius:100%;"/><br><br> 
							<?php
							}
							else
							{
								echo '<img src="image\profile.jpg" height="80px" width="80px" style="border-radius:100%;"/><br><br>';
							}
						?>
							
							<label style="color:white"><b><?php echo $name; ?></b></label>
						</div>
						<div style="margin-top:100px;">
							<img src="image/home.jpg" height="18px" width="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="Home.php">Home</a>
						</div><br>
						<div>
							<img src="image/user.jpg" height="18px" width="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="Profile.php">Profile</a>
						</div><br>
						<div>
							<img src="image/recored.jpg" height="18px" width="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="Records.php">Records</a>
						</div><br>
						<div>
							<img src="image/about.jpg" height="18px" width="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="#">AboutUs</a>
						</div><br>
						<div>
							<img src="image/feedback.jpg" height="18px" width="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="FeedBack.php">FeedBack</a>
						</div><br>
						<div>
							<img src="image/logout.jpg" height="18px" width="18px" class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="Logout.php" class="text-center">Log out</a>
						</div>
					</div>
				</div>
				
				
				<div class="col-md-10 colheight2"> 
					<div style="width:100%"> 
					<table><tr><td><h2 class="text-danger">All Records </h2></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><input type="button"  class="btn btn-primary" id="btnExport" value="Print Pdf" onclick="Export()" /></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Search......" style="width:300px;height:35px" /></td></tr></table>
					</div>
					
					<div class="table-wrapper-scroll-y my-custom-scrollbar mytable">

						<div>
							<table class="table table-bordered table-striped mb-0" id="tblCustomers" >
								<tr>
								<th>S.no</th>
								<th>Name</th>
								<th>Email</th>
								<th>Product Number</th>
								<th>Temp</th>
								<th>Mode</th>
								<th>Food Time</th>
								</tr>
								
								<?php 
									include('DatabaseConnection.php');
									$query = "select name,email,product_number,temp,mode,datetime from `reccords` where email='$email' ";
									$result = mysqli_query($conn,$query);
									if(mysqli_num_rows($result) > 0)
									{
										$number=1;
										while($row=mysqli_fetch_array($result))
										{
											echo "<tr><td>".$number."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['product_number']."</td><td>".$row['temp']."</td><td>".$row['mode']."</td><td>".$row['datetime']."</td></tr>";
											$number=$number + 1;
										}
									}
								
								?>
							</table>
						</div>
					<div>
					
				</div>
			</div>
		</div>
		
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        function Export() {
            html2canvas(document.getElementById('tblCustomers'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Records.pdf");
                }
            });
        }
    </script>
		
		
		
		
		
	</body>
</html>