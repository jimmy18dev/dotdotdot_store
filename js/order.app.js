function ChangeQuantity(order_id,product_id){

	// Setup
	var reference_id 	= order_id+''+product_id;
	var amount 			= $('#product-quantity-'+order_id+product_id).val();;
	var price 			= $('#product-price-'+order_id+product_id).val();

	// Render to Input
	$('#product-payments-'+reference_id).val(amount*price);

	// Render to HTML
	var payments_string =  numeral(amount*price).format('0,0');
	$('#payments-display-'+reference_id).html(payments_string);

	// Render to Console
	console.log('Reference_id:'+reference_id+','+amount+' x '+price+' = '+ amount*price);

	SummaryPayments();

	// include'service/order.service.js'
	EditItemInOrder(order_id,product_id);
	MyCurrentOrder();
}

function SummaryPayments(){
	var all_payments = 0;
	var sub_payments = 0;
	var shipping_payments = 0;
	var shipping_type = $('#shipping_type').val();

	// Summary all payments
	$('.items-payments').each(function(){
        all_payments += Number($(this).val());
    });

    sub_payments = all_payments;

	if(shipping_type == "Ems"){
		all_payments += 50;
		shipping_payments = 50;
	}else if(shipping_type == "Register"){
		all_payments += 30;
		shipping_payments = 30;
	}else{
		all_payments;
	}

	$('#shipping_payments').html(numeral(shipping_payments).format('0,0'));
	$('#subpayments-display').html(numeral(sub_payments).format('0,0'));
    $('#all-payments').val(all_payments);
    $('#payments-display').html(numeral(all_payments).format('0,0'));
    $('#payments-btn-display').html(numeral(all_payments).format('0,0'));
}