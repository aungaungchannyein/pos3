

$('.saleTable').DataTable( {
        "ajax": "ajax/datatable-sale.ajax.php",
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



$(".saleTable tbody").on("click","button.addProduct", function(){
    var idProduct = $(this).attr("idProduct");
    

    $(this).removeClass("btn-primary addProduct");

    $(this).addClass("btn-default");

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

            var description=response["description"];
            var stock=response["stock"];
            var price=response["selling_price"];

            if(stock ==0){

                    
                    swal({
                        type: "error",
                        title: "There is no stock",
                        showConfirmButton: true,
                        confirmButtonText: "Close"
            
                        });
                     $("button[idProduct='"+idProduct+"']").addClass('btn-primary addProduct');
                     return;
                    
            }

                $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">'+
                '<div class="col-xs-6" style="padding-right:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+
                        '<input type="text" class="form-control" name="newProduct" id="newProduct" value="'+description+'" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-xs-3">'+
                        '<input type="number" class="form-control" name="Productqty" id="Productqty" min="1" value="1" stock="'+stock+'" required>'+
                    '</div>'+
                      '<div class="col-xs-3" style="padding-left:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                        '<input type="number" class="form-control" name="newProductPrice" id="newProductPrice" value="'+price+'" readonly required>'+
                        
                      '</div>'+
                    '</div>'+
                    '</div>')

            
            
        }
})
});

$(".saleTable").on("draw.dt",function(){
    if(localStorage.getItem("removeProduct")!=null){
        var listIdProduct=JSON.parse(localStorage.getItem("removeProduct"));
        for( var i=0;i<listIdProduct.length; i++){
            console.log("success");
            $("button.recallerButton[idProduct='"+listIdProduct[i]["idProduct"]+"']").removeClass('btn-default');
             $("button.recallerButton[idProduct='"+listIdProduct[i]["idProduct"]+"']").addClass('btn-primary addProduct');


        }


    }
})
var idRemoveProduct =[];
$(".formSale").on("click","button.removeProduct", function(){
    $(this).parent().parent().parent().parent().remove();
     var idProduct = $(this).attr("idProduct");

     if(localStorage.getItem("removeProduct") == null){
        idRemoveProduct =[];
     }else{
        idRemoveProduct.concat(localStorage.getItem("removeProduct"))
     }
     idRemoveProduct.push({"idProduct":idProduct});
     localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));

     $("button.recallerButton[idProduct='"+idProduct+"']").removeClass('btn-default');
     $("button.recallerButton[idProduct='"+idProduct+"']").addClass('btn-primary addProduct');

})


