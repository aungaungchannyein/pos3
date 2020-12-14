
$(".newPhoto").change(function(){


	var img= this.files[0];
	

	if(img["type"]!="image/jpeg" && img["type"]!="image/png"){
		$(".newPhoto").val("");

		swal({
			title: "Error upload image!",
			text: "Please upload image jpeg or png",
			type: "error",
			confirmButtonText:"close"

		});

	}else if (img["size"]>2000000) {

		$(".newPhoto").val("");

		swal({
			title:"Error upload image!",
			text: "Please upload image size less than 2M",
			type: "error",
			confirmButtonText:"close"

		});
		
	}else{
		var dataImage= new FileReader();
		dataImage.readAsDataURL(img);

		$(dataImage).on("load",function(event){
			var rootImage=event.target.result;
			$(".preview").attr("src",rootImage);
		})
	}


})
$(document).on("click", ".btnEditUser", function(){

	var idUser=$(this).attr("idUser");
	
	var data=new FormData();
	data.append("idUser",idUser);
	$.ajax({
		url:"ajax/user.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(response){
			$("#editName").val(response["name"]);
			$('#editUser').val(response["user"]);
			$('#editProfile').html(response["profile"]);
			$('#editProfile').val(response["profile"]);
			$('#currentPhoto').val(response["photo"]);
			$('#currentPassword').val(response["password"]);

			if(response["photo"]!=""){
				$(".preview").attr("src",(response["photo"]));
			}

		}
	});

})

$(document).on("click", ".btnActivate", function(){

	var userId=$(this).attr("userId");
	var userStatus=$(this).attr("userStatus");

	var data= new FormData();
	data.append("activateId",userId);
	data.append("activateUser",userStatus);

	$.ajax({
		url:"ajax/user.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		success:function(answer){

				if(window.matchMedia("(max-width:767px)").matches){
		
			swal({
				title: "The user status has been updated",
				type: "success",
				confirmButtonText: "Close"	
			}).then(function(result) {

				if (result.value) {
					window.location = "user";
				}

			})

		}



		}
	})

	if(userStatus==0){

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Deactivated');
		$(this).attr('userStatus',1);
		}else{
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activated');
		$(this).attr('userStatus',0);
		}
		
});


$("#newUser").change(function(){

	$(".alert").remove();

	var user=$(this).val();
	var data=new FormData();
	data.append("validateUser",user);

		$.ajax({
		url:"ajax/user.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		success:function(answer){

			// console.log(answer);

			if(answer!='false'){
				$('#newUser').parent().after('<div class="alert alert-warning">Username is already exited!</div>')
				$('#newUser').val("");
			}

		}
	})
})

$(document).on("click", ".btnDeleteUser", function(){

	var id=$(this).attr("userId");
	var photo=$(this).attr("userPhoto");
	var user=$(this).attr("user");

					swal({
					
						title:'Are you sure you want to delete user',
						text:'Click Yes to Delete or Click cancel',
						type:'warning',
						showCancelButton:true,
						confirmButtonColor:'#3085d6',
						cancelButtonColor:'#d33',
						cancelButtonText:'Cancel',
						confirmButtonText: 'Yes,delete user'
					}).then((result)=>{
							if(result.value){
								window.location= "index.php?root=user&id="+id+"&user"+user+"&photo="+photo;
							}
						})
})