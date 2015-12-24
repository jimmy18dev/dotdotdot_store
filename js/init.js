$(document).ready(function(){
	// Headbar loading
    $('#head-bar').click(function(){
        $('#head-bar .icon').html('<i class="fa fa-spinner fa-spin"></i>');
    });


    // $('#my-cart').click(function(){
    // 	$('#my-cart .icon').html('<i class="fa fa-spinner fa-spin"></i>');
    // 	console.log('Cart is clicked');
    // });

    // Order items loading
    $('.order-items').click(function(){
    	$('.icon',this).html('<i class="fa fa-spinner fa-spin"></i>');
    });

    $('.login').click(function(){
    	$('.icon',this).html('<i class="fa fa-spinner fa-spin"></i>');
    });
});