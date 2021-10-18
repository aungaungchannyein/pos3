if(localStorage.getItem("captureRange")!=null){
  $(".daterange-btn span").html(localStorage.getItem("captureRange"));
}else{
  $(".daterange-btn span").html('<i class="fa fa-calendar"></i> Date Range')
}


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
            var whole=response["whole_selling_price"];

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
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" id="removeProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+
                        '<input type="text" class="form-control newDescriptionProduct" idProduct="'+idProduct+'" name="newDescriptionProduct" value="'+description+'" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-xs-3">'+
                        '<input type="number" class="form-control Productqty" name="Productqty" min="1" value="1" stock="'+stock+'" newStock="'+Number(stock-1)+'" required>'+
                    '</div>'+
                      '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                      '<div class="input-group">'+
                        '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                        '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" name="newProductPrice"  value="'+price+'"  required>'+
                        '<input type="hidden" class="form-control newWholeProductPrice" realWholePrice="'+whole+'" name="newWholeProductPrice"  value="'+whole+'"  required>'+
                        
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
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" id="removeProduct" idProduct><i class="fa fa-times"></i></button></span>'+
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
                        '<input type="text" class="form-control newProductPrice" name="newProductPrice"  required>'+
                        '<input type="hidden" class="form-control newWholeProductPrice" name="newWholeProductPrice"  required>'+
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
    var newWholeProductPrice=$(this).parent().parent().parent().children(".enterPrice").children().children(".newWholeProductPrice");
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
            $(newWholeProductPrice).val(response["whole_selling_price"]);
            $(newWholeProductPrice).attr("realWholePrice",response["whole_selling_price"]);

             addingTotalPrices()

             addTax()

             listProducts()

             $(".newProductPrice").number(true, 2);
            


        }})

})

$(".formSale").on("change","input.Productqty", function(){

    var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var wholeprice = $(this).parent().parent().children(".enterPrice").children().children(".newWholeProductPrice");

    if($(this).val() > 4 ){
      var finalPrice = $(this).val()* wholeprice.attr("realWholePrice"); 

    }else{
      var finalPrice = $(this).val()* price.attr("realPrice"); 
    }
   
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
    if(method =="cash" || method =="notPaid"){
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
    }else {
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
    // console.log("success",cash);

    var change = Number(cash) - $('#newSaleTotal').val();
    // console.log("success",change);

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

    var wholeprice = $(".newWholeProductPrice");

    var price = $(".newProductPrice");
     
    for(var i = 0; i < description.length; i++){

        productsList.push({ "id" : $(description[i]).attr("idProduct"), 
                              "description" : $(description[i]).val(),
                              "quantity" : $(quantity[i]).val(),
                              "stock" : $(quantity[i]).attr("newStock"),
                              "price" : $(price[i]).attr("realPrice"),
                              "wholeprice" : $(wholeprice[i]).attr("realWholePrice"),
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

    }else if ($("#newPaymentMethod").val() == "notPaid") {

      $("#listPaymentMethod").val("NOT-PAID");
      
    }
    else {

        $("#listPaymentMethod").val($("#newPaymentMethod").val()+"-"+$("#newTransactionCode").val());

    }

}


//EditSale


$(".tables").on("click", ".btnEditSale", function(){
  var idSale=$(this).attr("idSale");
  window.location="index.php?root=edit-sale&idSale="+idSale;
})


function removeAddProductSale(){

  //We capture all the products' id that were selected in the sale
  var idProducts = $(".removeProduct");

  //We capture all the buttons to add that appear in the table
  var tableButtons = $(".saleTable tbody button.addProduct");


  //We navigate the cycle to get the different idProducts that were added to the sale
  for(var i = 0; i < idProducts.length; i++){

    //We capture the IDs of the products added to the sale
    var button = $(idProducts[i]).attr("idProduct");
    
    //We go over the table that appears to deactivate the "add" buttons
    for(var j = 0; j < tableButtons.length; j ++){

      if($(tableButtons[j]).attr("idProduct") == button){

        $(tableButtons[j]).removeClass("btn-primary addProduct");
        $(tableButtons[j]).addClass("btn-default");

      }
    }

  }
  
}

/*=============================================
EVERY TIME THAT THE TABLE IS LOADED WHEN WE NAVIGATE THROUGH IT EXECUTES A FUNCTION
=============================================*/

$('.saleTable').on( 'draw.dt', function(){

  removeAddProductSale();

})



$(".tables").on("click", ".btnDeleteSales", function(){

  var idSale=$(this).attr("idSale");
  
 
  swal({
            title:'Are you sure you want to delete client',
            text:'Click Yes to Delete or Click cancel',
            type:'warning',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            cancelButtonText:'Cancel',
            confirmButtonText: 'Yes,delete category'
          }).then((result)=>{

              if(result.value){
                window.location= "index.php?root=manage-sale&idSale="+idSale;
              }
})
         })


$(".tables").on("click", ".btnPrintSales", function(){

  var code=$(this).attr("saleCode");
  //console.log("success",code);
  //window.open("extensions/TCPDF-main/examples/bill.php?code="+code,"bill.pdf");
  window.open("pdf_example/bill.php?code="+code,"bill.pdf");
  //window.open("pdf_example/bill2.php?code="+code,"bill.pdf");

})

//extensions/TCPDF-main/examples/
//extensions/tcpdf/pdf/
//extensions/tcpdf-code/examples
//extensions/vendor/tecnickcom/tcpdf/examples


$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 days': [moment().subtract(29, 'days'), moment()],
      'this month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var initialDate = start.format('YYYY-MM-DD');

    var finalDate = end.format('YYYY-MM-DD');

    var captureRange = $("#daterange-btn span").html();
   
    localStorage.setItem("captureRange", captureRange);
    console.log("localStorage", localStorage);

    window.location = "index.php?root=manage-sale&initialDate="+initialDate+"&finalDate="+finalDate;

  }

)

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("captureRange");
  localStorage.clear();
  window.location = "manage-sale";
})

$(".daterangepicker.opensleft .ranges li").on("click", function(){

  var todayButton = $(this).attr("data-range-key");

  if(todayButton == "Today"){

    var d = new Date();
    
    var day = d.getDate();
    var month= d.getMonth()+1;
    var year = d.getFullYear();

    if(month < 10 && day < 10){

      var initialDate = year+"-0"+month+"-"+day;
      var finalDate = year+"-0"+month+"-"+day;

      var initialDate = year+"-0"+month+"-0"+day;
      var finalDate = year+"-0"+month+"-0"+day;

    }else if(day < 10){

      var initialDate = year+"-"+month+"-0"+day;
      var finalDate = year+"-"+month+"-0"+day;

    }else if(month < 10 ){

      var initialDate = year+"-0"+month+"-0"+day;
      var finalDate = year+"-0"+month+"-0"+day;

      var initialDate = year+"-0"+month+"-"+day;
      var finalDate = year+"-0"+month+"-"+day;

    }else{

      var initialDate = year+"-"+month+"-"+day;
        var finalDate = year+"-"+month+"-"+day;

    } 

      localStorage.setItem("captureRange", "Today");

      window.location = "index.php?root=manage-sale&initialDate="+initialDate+"&finalDate="+finalDate;

  }

})