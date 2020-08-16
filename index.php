<?php
//session_start();
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
include 'include/connection.php';
if (!isset($_SESSION['uid']) || $_SESSION['uid'] == '') {
  header('location:login.php');
  }
 
 $sql =("select * from ticket_details where status != 2");
 $sqlget = mysqli_query($conn,$sql);


 $id = $_SESSION['uid'];
 $sqls = "select * from admin_details where id='$id'";
 $sqlgets = mysqli_query($conn,$sqls);
 $sqldatas = mysqli_fetch_assoc($sqlgets);

 ?>
<html class="no-js" lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Pree | XP</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

          
		
      
	</head>

	<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#">PreeXp</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <li style="margin-left: 1200px" ><a href="logout.php?lg=1">Logout</a></li>
      </li>
        
    </ul>
  </div>  
</nav>
<br>

<div class="container">
<a href="addticket.php"><button type="button" class="btn btn-success">Add New Ticket</button> </a>

<section class="content">
		<div class="box">
			<div class="box-header offset-md-5">
				<h3 class="box-title">Ticket Details</h3>
			</div>

		<div class="container box-body">
			
			<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Category</th>
                <th>Project Url</th>
                <th>Subject</th>
                <th>Phone</th>
                <th>Priority</th>
            </tr>
        </thead>
        <tbody>
            
            <?php 
					$count=1;
					while($sqldata = mysqli_fetch_assoc($sqlget))
					{	?>                
					<tr>
					<td><?php echo $count; ?> </td>
					<td><?php echo $sqldatas['name']; ?> </td>
					<td><?php echo $sqldatas['email']; ?> </td>
					<td><?php echo $sqldata['dept']; ?></td>
					<td><?php echo $sqldata['category']; ?></td>
					<td><?php echo $sqldata['projecturl']; ?></td>
					<td><?php echo $sqldata['subject']; ?></td>
					<td><?php echo $sqldata['phone']; ?></td>
					<td><?php echo $sqldata['priority']; ?></td>
				   </tr>
					<?php $count++;
			  } ?>   
        </tbody>
        
    </table>
	</div>
  </div>
</section>



		

		
       

	
		<script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
		<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"> </script>
		<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript">
/*
$(".calculate").on('submit',(function(e) {
        // alert('dsssf');
      e.preventDefault();
      // $('#loading').show();
      $.ajax({
      url: "prizepool_stats.php", 
      type: "POST",   
      data: new FormData(this), 
      contentType: false,   
      cache: false,    
      processData:false,   
      success: function(data) 
      {
          //alert(data);
          // $("#newitem")[0].reset();
      $("#success").html(data);
      // $('html, body').animate({ scrollTop: 0 }, 'slow');
      // window.location.href='inventory_list.php';
      }
        });
          }));
*/

$(document).ready(function() {
    $('#example').DataTable();
} );

$(document).ready(function(){
var form=$(".calculate");
$("#login_submit").click(function(){
$.ajax({
        type:"POST",
        url: "prizepool_stats.php",
        data:form.serialize(),
        success: function(data){
            console.log(data);
              $(".calculate")[0].reset();
            $("#success").html(data); 
            window.setTimeout(function() {
	   // window.location.href = 'prizepool.php';
     }, 2000);
        }
    });
});
});

										
$("#distid").on('change',function(e)
{
	e.preventDefault();
	var val=$(this).val();
	//alert(val)
	var formdata="distid=" + val;
	$.ajax({
			url: "getdist.php", 
			type: "POST",   
			data: formdata, 
			 
			success: function(data) 
			{	
					//alert(data);
					var name=data.split(',')[0];					
					var amt=data.split(',')[1];
					var dist=data.split(',')[2];
					
					
					$('#addr').val(name);
					$('#addr1').val(amt);
					$('#addr2').val(dist);
					
			}
				});	
});


$(".calculate").on('submit',(function(e) {
        // alert('dsssf');
      e.preventDefault();
      // $('#loading').show();
      $.ajax({
      url: "prizepooljs.php", 
      type: "POST",   
      data: new FormData(this), 
      contentType: false,   
      cache: false,    
      processData:false,   
      success: function(data) 
      {
          //alert(data);
          $(".calculate")[0].reset();
      $("#success").html(data);
       window.setTimeout(function() {
	    window.location.href = 'prizepool.php';
     }, 2000);
      }
        });
          }));

		</script>
	</body>

</html>