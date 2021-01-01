

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

            if(stock == 0){

                    
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
                        '<input type="text" class="form-control newDescriptionProduct" idProduct="'+idProduct+'" name="newDescriptionProduct" value="'+description+'" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-xs-3">'+
                        '<input type="number" class="form-control Productqty" name="Productqty" min="1" value="1" stock="'+stock+'" newStock="'+Number(stock-1)+'" required>'+
                    '</div>'+
                      '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                        '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" name="newProductPrice"  value="'+price+'" readonly required>'+
                        
                      '</div>'+
                    '</div>'+
                    '</div>')
                addingTotalPrices()

                addTax()

                listProducts()

                $(".newProductPrice").number(true, 2);




            
            
        }
})
});

$(".saleTable").on("draw.dt",function(){
    if(localStorage.getItem("removeProduct")!=null){
        var listIdProduct=JSON.parse(localStorage.getItem("removeProduct"));
        for( var i=0;i<listIdProduct.length; i++){
            // console.log("success");
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

     if($(".newProduct").children().length == 0){
        $("#newSaleTotal").val(0);
        $("#saleTotal").val(0);
        $("#newTaxSale").val(0);
        $("#newSaleTotal").attr("totalSale",0);

     }else{
         addingTotalPrices()
         addTax()
         listProducts()
     }
    
})
 
 var numProduct=0;
$(".btnAddProduct").click(function(){
    numProduct ++;
    var data= new FormData();
    data.append("bringProduct","ok");

    $.ajax({
        url:"ajax/product.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response){

             $(".newProduct").append(
                '<div class="row" style="padding:5px 15px">'+
                '<div class="col-xs-6" style="padding-right:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct><i class="fa fa-times"></i></button></span>'+
                        '<select class="form-control newDescriptionProduct" id="product'+numProduct+'" idProduct name="newDescriptionProduct" required> '+
                      '<option>Select Product</option>'+
                      '</select>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-xs-3 enterQuantity">'+
                        '<input type="number" class="form-control Productqty" name="Productqty" id="Productqty" min="1" value="1" stock newStock required>'+
                    '</div>'+
                      '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                        '<input type="text" class="form-control newProductPrice" name="newProductPrice" readonly required>'+
                        
                      '</div>'+
                    '</div>'+
                    '</div>');

             response.forEach(functionForEach);

             function functionForEach(item,index){

                if(item.stock!=0){

                     $("#product"+numProduct).append(
                    '<option idProduct="'+item.id+'" value="'+item.description+'">'+item.description+'</option>'
                    )

                }

                
               

             }
             addingTotalPrices()

             addTax()
             listProducts()
             

             $(".newProductPrice").number(true, 2);

            
        }

    })
})

$(".formSale").on("change","select.newDescriptionProduct", function(){

    var nameProduct=$(this).val();
    var newProductPrice=$(this).parent().parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var newProductDescription = $(this).parent().parent().parent().children().children().children(".newDescriptionProduct");
   

    var newProductQty=$(this).parent().parent().parent().children(".enterQuantity").children(".Productqty");
   

     var data=new FormData();
     data.append("nameProduct",nameProduct);

     $.ajax({
        url:"ajax/product.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response){
            

            $(newProductQty).attr("stock",response["stock"]);
            $(newProductDescription).attr("idProduct",response["id"]);
            $(newProductQty).attr("newStock",Number(response["stock"])-1);

            $(newProductPrice).val(response["selling_price"]);
            $(newProductPrice).attr("realPrice",response["selling_price"]);

             addingTotalPrices()

             addTax()

             listProducts()

             $(".newProductPrice").number(true, 2);
            


        }})

})

$(".formSale").on("change","input.Productqty", function(){

    var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var finalPrice = $(this).val()* price.attr("realPrice"); 
     price.val(finalPrice);
     var newStock=Number($(this).attr("stock"))-$(this).val();
     $(this).attr("newStock",newStock);

    //console.log("success",$(this).attr("realPrice"));  
    if(Number($(this).val())> Number($(this).attr("stock"))){
            $(this).val(1);
            var finalPrice=$(this).val()*price.attr("realPrice");
            price.val(finalPrice);
            addingTotalPrices();
                swal({
          title: "The quantity is more than your stock",
          text: "¡There's only "+$(this).attr("stock")+" units!",
          type: "error",
          confirmButtonText: "Close!"
        });
    }

  addingTotalPrices()
  addTax()
  listProducts()

    
})

function addingTotalPrices(){
    var itemPrice=$(".newProductPrice");
    var arrayAdditionPrice = [];
    //console.log(arrayAdditionPrice);
    for(var i=0; i<itemPrice.length;i++){


       arrayAdditionPrice.push(Number($(itemPrice[i]).val()));

       

    }

    function additionArrayPrices(totalSale, numberArray){

        return totalSale + numberArray;

    }

    var addingTotalPrice = arrayAdditionPrice.reduce(additionArrayPrices);
   $("#newSaleTotal").val(addingTotalPrice);
   $("saleTotal").val(addingTotalPrice);
   $("#newSaleTotal").attr("totalSale",addingTotalPrice);

    

     


}


function addTax(){

    var tax = $("#newTaxSale").val();
    //console.log("success",tax);

    var totalPrice = $("#newSaleTotal").attr("totalSale");

    var taxPrice = Number(totalPrice * tax/100);

    var totalwithTax = Number(taxPrice) + Number(totalPrice);
    
    $("#newSaleTotal").val(totalwithTax);

    $("#saleTotal").val(totalwithTax);

    $("#totalSale").val(totalwithTax);

    $("#newTaxPrice").val(taxPrice);

    $("#newNetPrice").val(totalPrice);

}

$("#newTaxSale").change(function(){

    addTax();


});

$("#newSaleTotal").number(true, 2);

$("#newPaymentMethod").change(function(){
    var method = $(this).val();
    if(method =="cash"){
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".paymentMethodBoxes").html(
          '<div class="col-xs-4">'+ 

                '<div class="input-group">'+ 

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

                    '<input type="text" class="form-control newCashValue" id="newCashValue" placeholder="000000" required>'+

                '</div>'+

             '</div>'+

             '<div class="col-xs-4 getCashChange" id="getCashChange" style="padding-left:0px">'+

                '<div class="input-group">'+

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                    '<input type="text" class="form-control newCashChange" id="newCashChange" placeholder="000000" readonly required>'+

                '</div>'+

             '</div>'
            )

            $('#newCashValue').number( true, 2);
            $('#newCashChange').number( true, 2);
            listMethods()
    }else{
        $(this).parent().parent().removeClass('col-xs-4');

        $(this).parent().parent().addClass('col-xs-6');

         $(this).parent().parent().parent().children('.paymentMethodBoxes').html(

            '<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control newTransactionCode" id="newTransactionCode" placeholder="Transaction code"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')
    }
})

$(".formSale").on("change","input#newCashValue", function(){

    var cash = $(this).val();
    console.log("success",cash);

    var change = Number(cash) - $('#newSaleTotal').val();
    console.log("success",change);

    var newCashChange = $(this).parent().parent().parent().children('#getCashChange').children().children('.newCashChange');

    newCashChange.val(change);

})

$(".formSale").on("change","input#newTransactionCode", function(){
     listMethods()
  

})


function listProducts(){

    var productsList = [];

    var description = $(".newDescriptionProduct");

    var quantity = $(".Productqty");

    var price = $(".newProductPrice");

    for(var i = 0; i < description.length; i++){

        productsList.push({ "id" : $(description[i]).attr("idProduct"), 
                              "description" : $(description[i]).val(),
                              "quantity" : $(quantity[i]).val(),
                              "stock" : $(quantity[i]).attr("newStock"),
                              "price" : $(price[i]).attr("realPrice"),
                              "totalPrice" : $(price[i]).val()})
    }

    $("#productsList").val(JSON.stringify(productsList));
    //console.log("productList",productsList);

    //$("#productsList").val(JSON.stringify(productsList)); 

}


function listMethods(){

    var listMethods = "";

    if($("#newPaymentMethod").val() == "cash"){

        $("#listPaymentMethod").val("cash");

    }else{

        $("#listPaymentMethod").val($("#newPaymentMethod").val()+"-"+$("#newTransactionCode").val());

    }

}


//EditSale

$(".btnEditSale").click(function(){
  var idSale=$(this).attr("idSale");
  window.location="index.php?root=edit-sale&idSale="+idSale;
})
