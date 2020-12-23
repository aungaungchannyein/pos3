$(document).on("click", ".btnEditClient", function(){

	var idClient=$(this).attr("idClient");

	var data= new FormData();
	data.append("idClient",idClient);


	$.ajax({
		url:"ajax/client.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData: false,
		dataType:"json",
		success:function(response){
			console.log("reponse",response);
			$("#idClient").val(response["id"]);
			$("#editName").val(response["name"]);
			$("#editDocumentId").val(response["document_id"]);
			$("#editEmail").val(response["email"]);
			$("#editPhone").val(response["phone"]);
			$("#editAddress").val(response["address"]);
			$("#editBirthDate").val(response["birth_date"]);
			
		}
	})
})
