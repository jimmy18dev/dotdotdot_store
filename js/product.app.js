$(document).ready(function(){
	setTimeout(function(){
		//include function from product.service.js
		ReadUpdate();
	},3000);

	// include function from product.service.js
	GetProductInfo();

	$('#subproduct_id').change(function(){
		GetProductInfo();
	});
});