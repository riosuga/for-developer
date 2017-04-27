<!DOCTYPE html>
<html>
<head> 
	<title>test control</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajax CRUD with Bootstrap modals and Datatables</title>
	<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
  </head> 
  <body>
  	<div class="col-lg-6">
  		<form id="my_form">
  			<!-- <div class="form-group">
  				<label>Nama</label>
  				<input type="text" name="nama" class="form-control" id="nama">
  			</div>
  			<div class="form-group">
  				<label>Kelas</label>
  				<input type="text" name="kelas" class="form-control" id="kelas">
  			</div>
  			<div class="form-group">
  				<label>Hobi</label>
  				<input type="text" name="hobi" class="form-control" id="hobi" value="1">
  			</div> -->
  			<!-- <div class="form-group">
  				<input type="text" id="member" name="member" value="">Number of members: (max. 10)<br />
				<a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
			</div> -->
			<!-- <div class="form-group">
				<div id="container" class="form-group"></div>
			</div> -->
			<div class="form-group">
				<div id="container"></div>
			</div>
			<div class="form-group">
			    <label>Tambah Orang</label>
				<!-- <button id="add_btn" type="button" class="btn btn-default" onclick="addFieldsManual()">add</button> -->
				<button id="add_btn" type="button" class="btn btn-default">add</button>
			</div>
  			<button type="submit" class="btn btn-default">Submit</button>
  		</form>
  	</div>
  	<div class="col-lg-6">

  	</div>
  </body>
  <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
  <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
  <script type="text/javascript">
        // function addFields(){
        // 	//gak kanggo
        //     var number = document.getElementById("member").value;
        //     var container = document.getElementById("container");
        //     while (container.hasChildNodes()) {
        //         container.removeChild(container.lastChild);
        //     }
        //     for (i=0;i<number;i++){
        //         // container.appendChild(document.createTextNode("Member " + (i+1)));
        //         // container.appendChild(document.createElement("LABEL").setAttribute(""));
        //         var x = document.createElement("LABEL");
        //         var t = document.createTextNode("Member");
        //         x.setAttribute("for","member");
        //         x.appendChild(t);
        //         container.appendChild(x);
        //         var input = document.createElement("input");
        //         input.type = "text";
        //         input.className ="form-control";
        //         input.id ='member'+(i+1);
        //         input.name = 'member'+(i+1);
        //         container.appendChild(input);
        //         container.appendChild(document.createElement("br"));
        //     }
        // }
  </script>
  <script type="text/javascript">
 //  	function addFieldsManual(){
 //  		//gak kanggo
 //  		var container = document.getElementById('container');
  
 //  		var label = document.createElement('label');
 //  		var tulisan = document.createTextNode('NIP');
 //  		label.appendChild(tulisan);
 //  		container.appendChild(label);
 //  		var input = document.createElement('input');
 //  		input.type = 'text';
 //  		input.className ='form-control';
 //  		input.name = 'nip[]';
 //  		input.id = 'nip';
 //  		container.appendChild(input);
 //  		container.appendChild(document.createElement('br'));
  		
 //  		var label2 = document.createElement('label');
 //  		var tulisan2 = document.createTextNode('Nama');
 //  		label2.appendChild(tulisan2);
 //  		container.appendChild(label2);
 //  		var input2 = document.createElement('input');
 //  		input2.className = 'form-control';
 //  		input2.type ='text';
 //  		input2.name = 'nmBC[]';
 //  		input.id = 'nmBC';
 //  		container.appendChild(input2);
 //  		container.appendChild(document.createElement('br'));
  		
 //  		var button = document.createElement('button');
 //  		var tulisanBtn = document.createTextNode('Hapus');
 //  		button.type ='button';
 //  		button.setAttribute('class', 'rmvBtn');
 //  		button.appendChild(tulisanBtn);
 //  		container.appendChild(button);
 //  		container.appendChild(document.createElement('br'));
 //  		container.appendChild(document.createElement('br'));
 //  		return false;
 //  	}

 //  	$("#my_form").on('click', '.rmvBtn', function () {
	//     $(this).parent().fadeOut(300, function () {
	//         $(this).empty();
	//         return false;
	//     });
	// });
  </script>

  <script type="text/javascript">
    function updateScroll(i){
      var element = document.getElementById("container");
      element.scrollTop = element.scrollHeight;
    }
  </script>
  
  <script type="text/javascript">
  	var i = $('#form-step2 :input').length + 1;

	//add input
	$('#add_btn').click(function () {
	    $('<div id="'+i+'"><div class="form-group"><label>NIP</label><input class="form-control" name="nip[]" id="nip'+i+'"/></div>'+
	    '<div class="form-group"><label>Nama Petugas BC</label><input class="form-control" name="nmBC[]" id="nmBC'+i+'"/></div>'+
	    '<button type ="button" class="rmvBtn btn btn-danger" id="rmvBtnBc'+i+'">Hapus</button></div>').fadeIn("slow").appendTo('#container');
	    i++;
	    return false;
	});
	//fadeout selected item and remove
	$("#my_form").on('click', '.rmvBtn', function () {
	    $(this).parent().fadeOut(300, function () {
	        $(this).empty();
	        return false;
	    });
	});

  updateScroll();
  </script>
 
</html>
