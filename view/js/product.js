
// $.ajax({

// 	url:"ajax/datatable-product.ajax.php",
// 	success: function(answer){
// 		console.log("answer",answer);
// 	}

// })

$('.tableProduct').DataTable( {
        "ajax": "ajax/datatable-product.ajax.php",
        "deferRender":true,
        "retrieve":true,
        "processing":true,
        "language":{
    "decimal":        "",
    "emptyTable":     "No data available in table",
    "info":           "Showing _START_ to _END_ of _TOTAL_ entries",
    "infoEmpty":      "Showing 0 to 0 of 0 entries",
    "infoFiltered":   "(filtered from _MAX_ total entries)",
    "infoPostFix":    "",
    "thousands":      ",",
    "lengthMenu":     "Show _MENU_ entries",
    "loadingRecords": "Loading...",
    "processing":     "Processing...",
    "search":         "Search:",
    "zeroRecords":    "No matching records found",
    "paginate": {
        "first":      "First",
        "last":       "Last",
        "next":       "Next",
        "previous":   "Previous"
    },
    "aria": {
        "sortAscending":  ": activate to sort column ascending",
        "sortDescending": ": activate to sort column descending"
    }
}
    } );

$(".newCategory").change(function(){

	var idCategory=$(this).val();
	//console.log("answer",idCategory);

	var data=new FormData();
	data.append("idCategory",idCategory);

	$.ajax({
		url:"ajax/product.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(answer){
			//console.log("answer",answer);

			if(!answer){
				var newCode=idCategory+"01";
				$("#newCode").val(newCode);
			}else{
				var newCode=Number(answer["code"])+1;
			$("#newCode").val(newCode);
			}
			
		}
	})

})

$("#newBuyprice,#editBuyprice").change(function(){

	if($(".percent").prop("checked")){
		var valpercentage=$(this).val();
		var percentage=Number(($("#newBuyprice").val()*valpercentage/100))+Number($("#newBuyprice").val());
		var editpercentage=Number(($("#editBuyprice").val()*valpercentage/100))+Number($("#editBuyprice").val());
		console.log("answer",valpercentage);
		$('#newSaleprice').val(percentage);
		//$('#newSaleprice').prop("readonly",true);
		$('#editSaleprice').val(editpercentage);
		//$('#editSaleprice').prop("readonly",true);

	}

	
})

$('.newPercentage').change(function(){

	if($(".percent").prop("checked")){
		var valpercentage=$(this).val();
		var percentage=Number(($("#newBuyprice").val()*valpercentage/100))+Number($("#newBuyprice").val());
		var editpercentage=Number(($("#editBuyprice").val()*valpercentage/100))+Number($("#editBuyprice").val());
		console.log("answer",valpercentage);
		$('#newSaleprice').val(percentage);
		// $('#newSaleprice').prop("readonly",true);
		$('#editSaleprice').val(editpercentage);
		// $('#editSaleprice').prop("readonly",true);

	}

})
$('.percent').on("ifUnchecked",function(){
	//$('#newSaleprice').prop("readonly",false);
	//$('#editSaleprice').prop("readonly",false);
})

$('.percent').on("ifChecked",function(){
	//$('#newSaleprice').prop("readonly",true);
	//$('#editSaleprice').prop("readonly",true);
})

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

$(".tableProduct tbody").on("click", "button.btnEditProduct", function(){

	var idProduct=$(this).attr("idProduct");
	
	var data=new FormData();
	data.append("idProduct",idProduct);
	$.ajax({
		url:"ajax/product.ajax.php",
		method:"POST",
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(response){
		

				var data=new FormData();
				data.append("idCategory",response["id_category"]);
				$.ajax({
					url:"ajax/category.ajax.php",
					method:"POST",
					data:data,
					cache:false,
					contentType:false,
					processData:false,
					dataType:"json",
					success:function(response){

					$("#editCategory").val(response["id"]);
					$("#editCategory").html(response["category"]);

				}
				})



	
			
			$('#editCode').val(response["code"]);
			$('#editDescription').val(response["description"]);
			$('#editStock').val(response["stock"]);
			$('#editBuyprice').val(response["buying_price"]);
			$('#editSaleprice').val(response["selling_price"]);

			if(response["photo"]!=""){
				$(".preview").attr("src",(response["photo"]));
				$("#currentPhoto").val(response["photo"]);
			}
		

		}
	})

})

$(".tableProduct tbody").on("click", "button.btnDeleteProduct", function(){ 
	var id=$(this).attr("productId");
	var code=$(this).attr("productCode");
	var photo=$(this).attr("productPhoto");

	swal({
						title:'Are you sure you want to delete product',
						text:'Click Yes to Delete or Click cancel',
						type:'warning',
						showCancelButton:true,
						confirmButtonColor:'#3085d6',
						cancelButtonColor:'#d33',
						cancelButtonText:'Cancel',
						confirmButtonText: 'Yes,delete product'
					}).then((result)=>{
							if(result.value){
								window.location= "index.php?root=product&id="+id+"&photo="+photo+"&code="+code;
							}
						})


})

