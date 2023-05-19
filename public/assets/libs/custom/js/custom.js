
    //  --------select2 js ---------
    $( document ).ready(function() {
        $(".select2").select2();
    });

    setTimeout(() => {
        $( document ).ready(function() {

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                  opens: 'left'
                }, function(start, end, label) {
                  console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                });
              });
        });


        // $(".getSales").on("change", function () {
        //     getSales();
        // });

    }, 1000);
    // daterangepicker



    //  --------sidebar active transition js ---------
    $(document).on('click', '#sidebar li', function() {
        $(this).addClass('active').siblings().removeClass('active')
    });

    //  --------sidebar collapse toggle js ---------
    $(document).ready(function() {
        $("#toggleSidebar").click(function() {
            $(".left-menu").toggleClass("hide");
            $(".content-wrapper").toggleClass("hide");
        });
    });

    // --------- left menu sidebar dropdown toggle    ---------
    $('.sub-menu ul').hide();
    $('.sub-menu a').click(function() {
        $(this).parent(".sub-menu").children("ul").slideToggle("180");
        $(this).find(".right").toggleClass("bi-caret-up-fill bi-caret-down-fill");
    });

    // ------- datatables js ------
    $(document).ready(function () {
        $('#order-table').DataTable();
    });

    // ------- full screen button ---------
    const toggleFullScreen = () => {
        let doc = window.document;
        let docEl = doc.documentElement;

        let requestFullScreen =
          docEl.requestFullscreen ||
          docEl.mozRequestFullScreen ||
          docEl.webkitRequestFullScreen ||
          docEl.msRequestFullscreen;
        let cancelFullScreen =
          doc.exitFullscreen ||
          doc.mozCancelFullScreen ||
          doc.webkitExitFullscreen ||
          doc.msExitFullscreen;

        if (
          !doc.fullscreenElement &&
          !doc.mozFullScreenElement &&
          !doc.webkitFullscreenElement &&
          !doc.msFullscreenElement
        ) {
          requestFullScreen.call(docEl);
        } else {
          cancelFullScreen.call(doc);
        }
      };

    //   $( document ).ready(function() {
    //     toggleFullScreen
    //  })

    function getPrice(id)
    {
        var productid = $("#"+id+"-product_id").val();

        $.ajax({
            type: "GET",
            url: "/get-price/"+productid,
            success: function(data) {
                $("#"+id+"-sale_price").val(data.sale_price)

                $("#"+id+"-available-stock").css({"font-size":"12px","color":"red","font-weight":"bold"}).text(" Available("+data.stock+")");
                
                
                
                calcualtePrice();
            }
        });
    }

    function calcualtePrice()
    {


        var paid_amount = $("#paid_amount").val();
        var qty = $("#qty").val();
        var discount = $("#discount").val();

        var n = $("input[name^='products']").length;
        var price = 0;
        var qty = 0;
        $("input[name^='products']").each(function (index,val) {
            var id = this.id;
            if(id.includes('qty')){
                var row_id = parseInt(id);
                row_qty =  $("#"+row_id+"-qty").val();
                row_price =  $("#"+row_id+"-sale_price").val();
                qty += row_qty;
                price += row_qty * row_price;
            }
         });
        // var values = $("input[name='products[]']")
        //       .map(function(){return $(this).val();}).get();


        sale_price = price;
        qty = qty;





        var total_amount = parseFloat(sale_price)-parseFloat(discount);
        var subtotal = parseFloat(sale_price);
        var remaining_amount=  total_amount - parseFloat(paid_amount);
        $("#remaining_amount").val(remaining_amount);
        $("#total").val(total_amount);
        $("#remaining").text(remaining_amount);
        $("#paid").text(paid_amount);
        $("#sub_total").text(subtotal);
        $("#show_discount").text(discount);
        $("#show_total").text(total_amount);




    }



    $(document).on("change",".calculation", function () {
        calcualtePrice();
    });



    function showLoader()
    {
    alert("showLoader");
    }

    function hideLoader()
    {
    alert("hideLoader");
    }

    function getStatisticsForDashBoard()
    {
        var daterange = $("#daterange").val();
        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-dashboard",
            data:{"daterange":daterange},
            success: function(data) {
                $('#searchable').html(data.html);
            }
        });

    }

    function getSales()
    {
        var daterange = $("#daterange").val();
        var search = $("#search").val();
        var customer_id = $("#customer_id").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-sales",
            data:{"daterange":daterange,"search":search,"customer_id":customer_id},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);
            }
        });

    }

    //  Get products


    function getProducts()
    {
        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-products",
            data:{"search":search},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);
            }
        });

    }

    // Get Purchases


    function getPurchases()
    {
        var daterange = $("#daterange").val();
        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-purchases",
            data:{"daterange":daterange,"search":search},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);
            }
        });

    }

    //  Get Productions
    function getProductions()
    {
        var daterange = $("#daterange").val();
        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-productions",
            data:{"daterange":daterange,"search":search},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);
            }
        });

    }


    // Get expenses
    function getExpenses()
    {
        var daterange = $("#daterange").val();
        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-expenses",
            data:{"daterange":daterange,"search":search},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);
            }
        });

    }

    // Get customers
    function getCustomers()
    {

        var search = $("#search").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/get-customers",
            data:{"search":search},
            success: function(data) {
                $('#searchable').html(data.html);
                $('#searchable_pagination').html(data.phtml);

            }
        });

    }



    $(document).on('click','.export-csv-sale',function(){

        //var restaurants_id = $('#restaurants_id').val();



        var datetimerange = $('#daterange').val();
        var search = $('#daterange').val();
        var url = "/get-csv-sales?daterange="+datetimerange+'search='+search,

        new_window = window.open(url);
    })


    $(document).on('click','.export-csv-production',function(){

        //var restaurants_id = $('#restaurants_id').val();



        var datetimerange = $('#daterange').val();
        var search = $('#daterange').val();
        var url = "/get-csv-productions?daterange="+datetimerange+'search='+search,

        new_window = window.open(url);
    })



    $(document).on('click','.export-csv-expense',function(){

        //var restaurants_id = $('#restaurants_id').val();



        var datetimerange = $('#daterange').val();
        var search = $('#daterange').val();
        var url = "/get-csv-expenses?daterange="+datetimerange+'search='+search,

        new_window = window.open(url);
    })



    $(document).on('click','.export-csv-purchase',function(){

        //var restaurants_id = $('#restaurants_id').val();



        var datetimerange = $('#daterange').val();
        var search = $('#daterange').val();
        var url = "/get-csv-purchases?daterange="+datetimerange+'search='+search,

        new_window = window.open(url);
    })


    $(document).on('click','.export-csv-product',function(){

        //var restaurants_id = $('#restaurants_id').val();



        var datetimerange = $('#daterange').val();
        var url = "/get-csv-products?daterange="+datetimerange,

        new_window = window.open(url);
    })
    function addSetting(id) {

        $("#setting-row" +id+ "-href").attr('disabled',true)
       var OldRow = id;
            totalrows = $(".setting > .setting-row").length;
            totalrecord = $('.totalrecord-settings').length;
         var div = $(".setting > .setting-row:last");
         FirstRowId = div.attr('id');
         lastRow = FirstRowId.split("setting-row");
        //  console.log(lastRow);

         var NextRow = parseInt(lastRow[1]) + 1;

         $.ajaxSetup({

           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         });

         var addButton = '<a href="javascript:void(0)" class="btn btn-success " onclick="addSetting('+NextRow+')"><i class="bi bi-plus-lg"></i> Add</a>';
         var removeButton = '<a href="javascript:void(0)" class="btn btn-danger" rel='+FirstRowId+' onclick="removeSetting(this.rel)"><i class="bi bi-trash"></i></a>';
         $("#"+FirstRowId+'-btn').html(removeButton);

        //  $(".setting").append("<div class='setting-row' id='setting-row"+NextRow+"' >Hello  <a href='#' class='btn btn-success ' onclick='removeSetting("+NextRow+")'><i class='bi bi-minus-lg'></i> Remove</a></div>");

        products = [];
        $("input[name^='products']").each(function (index,val) {
            var id = this.id;
            if(id.includes('qty')){
                var row_id = parseInt(id);
                product_id =  $("#"+row_id+"-product_id").val();
                products.push(product_id);
            }
         });


        //  console.log(totalrows+ ' '+ NextRow);
         $.ajax({

           type: 'get',

           url: '/add-new-row',

           data: { new_row: NextRow,totalrecord:totalrecord,"products":products },
           dataType: 'html',

           success: function (data) {
            $("#" + FirstRowId+ "-btn").html(removeButton)
             $(".setting").append(data)
           }
         })


     }


       function removeSetting(id) {

           $("#"+id).remove();

       }


           //  Get Productions
           $("#FormData").submit(function (event) {

            event.preventDefault();

               $.ajaxSetup({
                   headers: {
                       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                           "content"
                       ),
                   },
               });
               FormData = $("#FormData").serialize();
               $.ajax({
                   type: "POST",
                   url: '/customer',
                   data: FormData,
                   success: function (data) {
                    dropdownElement = $("#user_id");
                    dropdownElement.find('option[value='+data.data.id+']').remove();

                    var updateOptionPP = '<option value='+data.data.id+' selected>'+data.data.name+'</option>';
                    $("#user_id").append(updateOptionPP)

                    $("#add_customer").modal('hide');
                   },
               });
           });

                      //  Get Productions
                      $("#FormDataVendor").submit(function (event) {

                        event.preventDefault();

                           $.ajaxSetup({
                               headers: {
                                   "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                       "content"
                                   ),
                               },
                           });
                           FormData = $("#FormDataVendor").serialize();
                           $.ajax({
                               type: "POST",
                               url: '/vendor',
                               data: FormData,
                               success: function (data) {
                                dropdownElement = $("#user_id");
                                dropdownElement.find('option[value='+data.data.id+']').remove();

                                var updateOptionPP = '<option value='+data.data.id+' selected>'+data.data.name+'</option>';
                                $("#user_id").append(updateOptionPP)

                                $("#add_vendor").modal('hide');
                               },
                           });
                       });
