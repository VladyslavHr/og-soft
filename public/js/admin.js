
  $(document).ready(function(){
    $("#order_item_update").on("submit", function(){
      $("#admin_pageloader").fadeIn();
    });//submit
  });//document ready

  $(document).ready(function(){
    $("#order_item_refund").on("submit", function(){
      $("#admin_pageloader_refund").fadeIn();
    });//submit
  });//document ready

  $(document).ready(function(){
    $("#order_refund").on("submit", function(){
      $("#admin_pageloader_order_refund").fadeIn();
    });//submit
  });//document ready
