<!DOCTYPE html>
<html>
<head>	
    <!-- designing table  -->
	<style type="text/css">
		table
		{
			border-collapse;
			width: 40%
			font-size:15pt;
		}
		table,th,td
		{
			border: 1px solid rgb(255,51,153)
		}
		th
		{
			background: rgb(255,51,153);
			color:white;
		}
		tr:nth-child(odd)
		{
			background: rgba(255,51,153,.2);
		}

	</style>
</head>

<!-- <body style="background: #99315e; background-image:url(1.jpg); opacity: 1; z-index:2;" "> -->
<body style="background: #99315e; background-image:url(1.jpg); opacity: 1; z-index:2;" ">
	<center>
		<table>
			<tr>
				<th>ID</th>
				<th>Fullname</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Username</th>
			</tr>
			<?php
			$con = mysqli_connect("localhost","root","","php-registration-validation")				or die("Couldn't connect db..");
				
				$sql="select ID,FullName,Email,Mobile,Username from registeredusers";
				$result=mysqli_query($con,$sql);

				while($row=mysqli_fetch_array($result))
				{
					echo"<tr>
							<td>".$row["ID"]."</td>
							<td>".$row["FullName"]."</td>
							<td>".$row["Email"]."</td>
							<td>".$row["Mobile"]."</td>
							<td>".$row["Username"]."</td>
					</tr>";
				}
			?>
		</table>
	</center>>
		
	</body>




	</html>