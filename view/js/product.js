
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

$("#newCategory").change(function(){

	var idCategory=$(this).val();

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
