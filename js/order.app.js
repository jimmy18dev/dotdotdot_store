function ChangeAmount(order_id,product_id,action){
	var amount = $('#product-amount-'+order_id+product_id).val();
	var price = $('#product-price-'+order_id+product_id).val();

	if(action == "up"){
		amount++;
	}
	else if(action == "down"){
		if(amount > 1){
			amount--;
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}

	$('#product-amount-'+order_id+product_id).val(amount);
	$('#product-payments-'+order_id+product_id).val(amount*price);

	console.log(amount+' x '+price+' = '+ amount*price);

	SummaryPayments();

	// include'service/order.service.js'
	EditItemInOrder(order_id,product_id);
}

function SummaryPayments(){
	var all_payments = 0;
	var shipping_type = $('#shipping_type').val();

	// Summary all payments
	$('.items-payments').each(function(){
        all_payments += Number($(this).val());
    });

	if(shipping_type == "Ems")
		all_payments += 50;
	else if(shipping_type == "Register")
		all_payments += 30;
	else
		all_payments;

    $('#all-payments').val(all_payments);
}