
$(document).ready(function(){

	$("input[name='quantity']").keypress(function(event){
		event.preventDefault();
	});

	$("#cng_currency").change(function(e){

		var totalprice = $( "input[name='totalprice']" ).val();
		var currency = $(this).val();
		var convertedPrice;
		if((currency=="Rupee")||(currency=="RS."))
		{
			convertedPrice = totalprice / 1.5;

		}else if((currency=="Taka")||(currency=="TK."))
		{
			convertedPrice = totalprice;

		}else if(currency=="$")
		{
			convertedPrice = totalprice / 82.71;  

		}else if(currency=="Euro")
		{
			convertedPrice = totalprice / 94.91;  

		}
		convertedPrice = parseFloat(convertedPrice);
		convertedPrice = convertedPrice.toFixed(2);
		$("#totalprice").html("<strong> Over all Price : "+convertedPrice+"</strong>");
		console.log("total price : "+totalprice);

	});

	$("input[name='quantity']").change(function(e){

		//1euro = 94.91bdt, 1.13$, 81.52inr
		//1$ = 82.71bdt, 0.88euro, 71.90inr
		var quantity= $(this).val();
		console.log(quantity);
		var parentDivId = (e.target).parentNode.parentNode.id;
		console.log(parentDivId);
		var price = $("#" + parentDivId + " > input[name='price']").val();
		var squantity = $("#" + parentDivId + " > input[name='squantity']").val();
		$("#" + parentDivId + " > input[name='squantity']").val(quantity);
		console.log(squantity);
		var totalprice = $( "input[name='totalprice']" ).val();
		var currency = $("#" + parentDivId + " > input[name='currency']").val();
		console.log(totalprice);
		console.log(price);
		console.log(currency);
		var column = $( "#" + parentDivId ).find( ".price" );
		console.log(column);
		var total = Number(quantity)*Number(price);
		column.html(total + " " +currency);
		subprice=Number(squantity)*Number(price);
		console.log("subprice : "+subprice);
		if((currency=="Rupee")||(currency=="RS."))
		{
			totalprice -= subprice*1.5;
			totalprice += total*1.5;
		}else if((currency=="Taka")||(currency=="TK."))
		{
			totalprice -= subprice;
			totalprice += total;  
		}else if(currency=="$")
		{
			totalprice -= subprice*82.71;
			totalprice += total*82.71;  
		}else if(currency=="Euro")
		{
			totalprice -= subprice*94.91;
			totalprice += total*94.91;  
		}
		totalprice=totalprice.toFixed(2);
		$( "input[name='totalprice']" ).val(totalprice);
		$("#totalprice").html("<strong> Over all Price : "+totalprice+"</strong>");

	});

});
