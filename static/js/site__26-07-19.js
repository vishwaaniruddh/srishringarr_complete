function checkSatofficeOpen(f) {
	if (f.office.checked == true) {
		$("#satOpen").css('display', 'block');
	} else {
		$("#satOpen").css('display', 'none');
	}
}

function change(picurl) {
	document.ddd.src = picurl;
}

function displayBankList(id) {
	var x = document.getElementById("id_banklist");
	if (id == '1') {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

// Ajax fun
function addToWishlist(product_id) {
	var post_selected = {
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
		product_id : product_id,
	};
	jQuery.post("/add_wishlist/", post_selected,

	function(response) {
		if (response.success == "True") {
			$('.block2-btn-addwishlist').each(function() {
				var nameProduct = $('.block2-name').html();
				swal(nameProduct, response.strMsg, "success");
			});
		} else if (response.success == "False") {
			$('.block2-btn-towishlist').each(function() {
				var nameProduct = $('.block2-name').html();
				swal(nameProduct, response.strMsg, "success");
			});
		}
	}, "json");
}

// Ajax fun
function addToCart(product_id, isRent, rentAmount) {
	var days = $('input[name="selected_days"]').val();
	var amount = $('input[name="final_amount"]').val();
	fromDate = $('input[name="from_selected_days"]').val();
	toDate = $('input[name="to_selected_days"]').val();
	userDetail = $('input[name="user_id"]').val();
	var depositeAmount = $('input[name="deposite_amount"]').val();
	
	// $("#loader").css("display", "block");

	var post_selected = {
		product_id : product_id,
		is_rent : isRent,
		form_date : fromDate,
		to_date : toDate,
		days_index : days,
		total_final_price : amount,
		deposite : depositeAmount,
		user_id : userDetail,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};

	jQuery.post("/action_add_to_cart/", post_selected,

	function(response) {
		if (response.success == "True") {
			$("#cartCount").text(response.cart_count);
			$('.block2-txt').each(function() {
				var nameProduct = $('.block2-name').html();
				swal(nameProduct, response.strMsg, "success");
				location.reload();
			});
		}
	}, "json");

}

// Ajax fun 
function updateCart(product_id, action_type) {
	var post_selected = {
		product_id : product_id,
		action_type : action_type,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};

	jQuery.post("/action_update_cart/", post_selected,

	function(response) {
		if (response.success == "True") {
			$("#quantity_" + product_id).val(response.product_count);
			$("#product_total").text("Rs. " + response.product_total);
			$("#cart_total").text("Rs. " + response.cart_total);
			$("#productTotal_" + product_id).text(
					"Rs. " + response.updatedValue);
			$("#delivery_charge").text("Rs. " + response.delivery_charge);
			swal("", response.strMsg, "success");
			if (response.product_count == '0') {
				location.reload();
			} else {
				$("#responseMsg").addClass("sAlert");
				$("#responseMsg").css("display", "block");
				$("#responseMsg").text(response.strMsg);
			}
		}
	}, "json");
}

// Ajax fun for add reviews
function addUserRetings(product_id) {
	var isChecked5 = $('#star5:checked').val() ? true : false;
	var isChecked4 = $('#star4:checked').val() ? true : false;
	var isChecked3 = $('#star3:checked').val() ? true : false;
	var isChecked2 = $('#star2:checked').val() ? true : false;
	var isChecked1 = $('#star1:checked').val() ? true : false;
	var ratings = "0";

	if (isChecked5) {
		ratings = "5";
	} else if (isChecked4) {
		ratings = "4";
	} else if (isChecked3) {
		ratings = "3";
	} else if (isChecked2) {
		ratings = "2";
	} else if (isChecked1) {
		ratings = "1";
	}

	var post_selected = {
		product_id : product_id,
		ratings : ratings,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};

	jQuery.post("/action_add_ratings/", post_selected,

	function(response) {
		if (response.success == "True") {
			swal("Good job!", response.strMsg, "success");
		} else {
			swal("Something went wrong", response.strMsg);
		}
	}, "json");
}

// Ajax fun for add reviews
function addUserReviews(product_id) {
	if ($("#user_reviews").val().length >= 3) {
		var post_selected = {
			product_id : product_id,
			comment : $("#user_reviews").val(),
			csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]")
					.val(),
		};

		jQuery.post("/action_add_reviews/", post_selected,

		function(response) {
			if (response.success == "True") {
				swal("Good job!", response.strMsg, "success");
			} else {
				swal("Something went wrong", response.strMsg);
			}
		}, "json");
	} else {
		alert('Please enter reviews.');
	}
}
// function calculateRent(dataArray, index, rentValue, selectedDays, dipositPrice,isSelect) {
// 	var array = dataArray.split(",");
// 	var discount = (rentValue * array[index - 1]) / 100;
// 	var totalRent = Number(discount) + Number(rentValue);
// 	var finalData = "Rs. " + Number(totalRent) + " For " + selectedDays;
// 	$('#updatedRentValue').html(finalData);
// 	var finalPay = Number(totalRent) + Number(dipositPrice)
// 	$('#finalVaueForRentel').html("  Rs. " + finalPay);
// 	$('input[name="h_days_index"]').val(index);
// 	$('input[name="selected_days"]').val("");
// 	if(isSelect==1){
// 		$('input[name="from_selected_days"]').val("");
// 		$('input[name="to_selected_days"]').val("");
// 	}
// }

function calculateRent(index, rentValue, selectedDays,dipositPrice,isSelect) 
{
	// var array = dataArray.split(",");
	var daysObj = selectedDays;
	var rentMrp = rentValue;
	console.log("cbsdjcvjhsdbhjsbvhjs");
	console.log(rentMrp);

	var first_mrp = 20;
	var second_mrp = 15;
	var third_mrp = 10;
	
	if (rentMrp == 1)
	{
		if (daysObj <= 40000)
		{
			console.log("xxxxxxxxxxxxxxxxxxxxxx");
			rent_amt = (daysObj*(first_mrp))/100;
			console.log(rent_amt);
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
		if (daysObj > 40000 & daysObj <= 60000)
		{
			console.log("yyyyyyyyyyyyyyyy");
			rent_amt = daysObj*(second_mrp)/100;
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
		if (daysObj >= 60001)
		{
			console.log("zzzzzzzzzzzzzzzzzzzz");
			rent_amt = daysObj*(third_mrp)/100;
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
		
	}
	else if (rentMrp > 1)
	{
		total_day_difference = rentMrp - 1;
		if (daysObj <= 40000)
		{
			console.log("xxxxxxxxxxxxxxxxxxxxxx");
			rent_amt = daysObj*(first_mrp + total_day_difference)/100;
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
		if (daysObj > 40000 & daysObj <= 60000)
		{
			rent_amt = daysObj*(second_mrp + total_day_difference)/100;
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
		if (daysObj > 60000)
		{
			rent_amt = daysObj*(third_mrp + total_day_difference)/100;
			$("#rentalValue").html(Number(rent_amt));
			var finalData = "Rs. " + Number(rent_amt) + " For " + selectedDays;
			abcd = $("#rentalValue").html(finalData);
		}
	}
	var finalPay = (daysObj/2)-(rent_amt);
	console.log(finalPay);
	$('#finalVaueForRentel').html("Rs. " + finalPay);
	$('input[name="h_days_index"]').val(index);
	$('input[name="selected_days"]').val("");
	if(isSelect==1){
		$('input[name="from_selected_days"]').val("");
		$('input[name="to_selected_days"]').val("");
	}
}

