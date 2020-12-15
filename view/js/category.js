$(document).on("click", ".btnEditCategory", function(){

	var idCategory=$(this).attr("idCategory");

	var data= new FormData();
	data.append("idCategory",idCategory);
	console.log("reponse",idCategory);

	$.ajax({
		url:"ajax/category.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData: false,
		dataType:"json",
		success:function(response){
			console.log("reponse",response);
			$("#editCategory").val(response["category"]);
			$("#idCategory").val(response["id"]);
		}
	})
})



$(document).on("click", ".btnDeleteCategory", function(){
	 var id=$(this).attr("CategoryId");

	 	swal({
						title:'Are you sure you want to delete category',
						text:'Click Yes to Delete or Click cancel',
						type:'warning',
						showCancelButton:true,
						confirmButtonColor:'#3085d6',
						cancelButtonColor:'#d33',
						cancelButtonText:'Cancel',
						confirmButtonText: 'Yes,delete category'
					}).then((result)=>{
							if(result.value){
								window.location= "index.php?root=category&id="+id;
							}
						})
})