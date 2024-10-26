function checkSatofficeOpen(f) {
	if (f.office.checked == true) {
		$("#satOpen").css('display', 'block');
	} else {
		$("#satOpen").css('display', 'none');
	}
}

function myFunction() {
	var x = document.getElementById("userPassword");
	var x1 = document.getElementById("rUserPassword");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}

	if (x1.type === "password") {
		x1.type = "text";
	} else {
		x1.type = "password";
	}
}

function funActiveSelection() {
	if (document.getElementById("activeSelection").checked == true) {
		document.getElementById("isactive").value = '1';
	} else {
		document.getElementById("isactive").value = '0';
	}
}

$(document).ready(function() {
	var show_home_checked = jQuery("#home_all_checked").val();
	var show_plist_checked = jQuery("#plist_all_checked").val();
	var show_pdetail_checked = jQuery("#pdetail_all_checked").val();
	var show_cart_checked = jQuery("#cart_all_checked").val();
	var show_checkout_checked = jQuery("#checkout_all_checked").val();
	var show_thanku_checked = jQuery("#thanku_all_checked").val();
	if (show_home_checked == 1) {
		$("#clogo_icon").attr("checked", "checked");
		$("#ctag_line").attr("checked", "checked");
		$("#cslider").attr("checked", "checked");
		$("#cmenu").attr("checked", "checked");
		$("#ccat_grid").attr("checked", "checked");
		$("#ctop_t_product").attr("checked", "checked");
		$("#ctop_d_product").attr("checked", "checked");
		$("#ctop_d_cat").attr("checked", "checked");
		$("#ctop_sale").attr("checked", "checked");
		$("#cf_product").attr("checked", "checked");
		$("#cnew_arrivals").attr("checked", "checked");
		$("#csearchbar").attr("checked", "checked");
		$("#ccart_icon").attr("checked", "checked");
		$("#cfooter").attr("checked", "checked");
	}
	if (show_plist_checked == 1) {
		$("#pljlogo_icon").attr("checked", "checked");
		$("#pljtag_line").attr("checked", "checked");
		$("#pljsearchbar").attr("checked", "checked");
		$("#pljcart_icon").attr("checked", "checked");
		$("#pljfooter").attr("checked", "checked");
		$("#pljmenu").attr("checked", "checked");
		$("#pljfilter_by_gender").attr("checked", "checked");
		$("#pljfilter_by_category").attr("checked", "checked");
		$("#pljfilter_by_price").attr("checked", "checked");
		$("#pljfilter_by_discount").attr("checked", "checked");
		$("#pljfilter_by_colour").attr("checked", "checked");
		$("#pljfilter_by_brands").attr("checked", "checked");
		$("#pljfilter_by_reviews").attr("checked", "checked");
		$("#pljfilter_by_availability").attr("checked", "checked");
		$("#pljproduct_by_grid").attr("checked", "checked");
		$("#pljproduct_by_list").attr("checked", "checked");
		$("#pljgrid_and_list").attr("checked", "checked");
	}
	if (show_pdetail_checked == 1) {
		$("#pdjlogo_icon").attr("checked", "checked");
		$("#pdjtag_line").attr("checked", "checked");
		$("#pdjsearchbar").attr("checked", "checked");
		$("#pdjcart_icon").attr("checked", "checked");
		$("#pdjmenu").attr("checked", "checked");
		$("#pdjfooter").attr("checked", "checked");
		$("#pdjprod_name").attr("checked", "checked");
		$("#pdjs_reviews").attr("checked", "checked");
		$("#pdjdiscount").attr("checked", "checked");
		$("#pdjoffer").attr("checked", "checked");
		$("#pdjhighlights").attr("checked", "checked");
		$("#pdjservices").attr("checked", "checked");
		$("#pdjseller").attr("checked", "checked");
		$("#pdjdesc").attr("checked", "checked");
		$("#pdjspecification").attr("checked", "checked");
		$("#pdjbroght_together").attr("checked", "checked");
		$("#pdjrate_reviews").attr("checked", "checked");
		$("#pdjrate").attr("checked", "checked");
		$("#pdjrecent_viewed").attr("checked", "checked");
		$("#pdjmanufacture").attr("checked", "checked");
		$("#pdjgoes_with").attr("checked", "checked");
		$("#pdjsimilar").attr("checked", "checked");
		$("#pdjdelivery").attr("checked", "checked");
		$("#pdjemi").attr("checked", "checked");
		$("#pdjinterested").attr("checked", "checked");
		$("#pdjbuy_now_btn").attr("checked", "checked");
		$("#pdjwishlist_btn").attr("checked", "checked");
		$("#pdjtop_msg").attr("checked", "checked");
		$("#pdjbottom_msg").attr("checked", "checked");
		$("#pdjstock").attr("checked", "checked");
		$("#pdjsize").attr("checked", "checked");
		$("#pdjsize_chart").attr("checked", "checked");
		$("#pdjcolor").attr("checked", "checked");
	}
	if (show_cart_checked == 1) {
		$("#cartlogo_icon").attr("checked", "checked");
		$("#carttag_line").attr("checked", "checked");
		$("#cartsearchbar").attr("checked", "checked");
		$("#cartmenu").attr("checked", "checked");
		$("#cartfooter").attr("checked", "checked");
		$("#cart_title_with_count").attr("checked", "checked");
		$("#cart_count").attr("checked", "checked");
		$("#cart_image").attr("checked", "checked");
		$("#cart_seller_name").attr("checked", "checked");
		$("#cart_add_to_wishlist").attr("checked", "checked");
		$("#cart_add_from_wishlist").attr("checked", "checked");
		$("#cart_continue_shopping").attr("checked", "checked");
		$("#cart_check_delivery").attr("checked", "checked");
		$("#cart_delivery_charges").attr("checked", "checked");
		$("#cart_replacement_policy").attr("checked", "checked");
		$("#cart_estimated_tax").attr("checked", "checked");
		$("#cart_message_top").attr("checked", "checked");
		$("#cart_message_bottom").attr("checked", "checked");
		$("#cart_emi_eligibity").attr("checked", "checked");
		$("#cart_add_coupon").attr("checked", "checked");
		$("#cart_coupon_list").attr("checked", "checked");
		$("#cart_empty").attr("checked", "checked");
	}
	if (show_checkout_checked == 1) {
		$("#ct_logo_icon").attr("checked", "checked");
		$("#ct_tag_line").attr("checked", "checked");
		$("#ct_searchbar").attr("checked", "checked");
		$("#ct_menu").attr("checked", "checked");
		$("#ct_footer").attr("checked", "checked");
		$("#ct_bill_add").attr("checked", "checked");
		$("#ct_ship_add").attr("checked", "checked");
		$("#ct_as_bill").attr("checked", "checked");
		$("#ct_add_type").attr("checked", "checked");
		$("#ct_coupon").attr("checked", "checked");
		$("#ct_coupon_list").attr("checked", "checked");
		$("#ct_order_summary").attr("checked", "checked");
		$("#ct_cod").attr("checked", "checked");
		$("#ct_paypal").attr("checked", "checked");
		$("#ct_citrus").attr("checked", "checked");
		$("#ct_netbanking").attr("checked", "checked");
		$("#ct_bank_transfer").attr("checked", "checked");
		$("#ct_emi").attr("checked", "checked");
		$("#ct_wallets").attr("checked", "checked");
		$("#ct_phonepe").attr("checked", "checked");
		$("#ct_cr_db").attr("checked", "checked");
		$("#ct_new_add").attr("checked", "checked");
		$("#ct_chg_login").attr("checked", "checked");
		$("#ct_chg_add").attr("checked", "checked");
		$("#ct_chg_order").attr("checked", "checked");
		$("#ct_del_charge").attr("checked", "checked");
		$("#ct_tax").attr("checked", "checked");
		$("#ct_discount").attr("checked", "checked");
		$("#ct_near_u").attr("checked", "checked");
	}
	if (show_thanku_checked == 1) {
		$("#tu_logo_icon").attr("checked", "checked");
		$("#tu_tag_line").attr("checked", "checked");
		$("#tu_searchbar").attr("checked", "checked");
		$("#tu_menu").attr("checked", "checked");
		$("#tu_footer").attr("checked", "checked");
		$("#tu_order_msg").attr("checked", "checked");
		$("#tu_order_summary").attr("checked", "checked");
		$("#tu_address").attr("checked", "checked");
		$("#tu_delivery_dt").attr("checked", "checked");
		$("#tu_cont_btn").attr("checked", "checked");
		$("#tu_cancel").attr("checked", "checked");
		$("#tu_notes").attr("checked", "checked");
	}
});

function mySnakbar() {
	var x = document.getElementById("snackbar")
	x.className = "show";
	setTimeout(function() {
		x.className = x.className.replace("show", "");
	}, 3000);
}

// Ajax fun
function generateKey() {
	var post_selected = {
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/generate_key/", post_selected,

	function(response) {
		if (response.success == "True") {
			$("#generateKeyForm").css("display", "none");
			$("#displayKey").css("display", "block");
			$("#displayKey").text("Your API Key: " + response.apiKey);
		}
	}, "json");
}

// Ajax fun
function deleteProduct(product_id) {
	var post_selected = {
		product_id : product_id,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery
			.post(
					"/delete_product/",
					post_selected,

					function(response) {
						if (response.success == "True") {
							$("#delete").submit();
							document.getElementById("msg").innerHTML = "<div id='snackbar'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>response.strMsg</div>"
						}
					}, "json");
}

// Ajax fun
function deleteCategory(category_id) {
	var post_selected = {
		category_id : category_id,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery
			.post(
					"/delete_category/",
					post_selected,

					function(response) {
						if (response.success == "True") {
							$("#delete").submit();
							document.getElementById("msg").innerHTML = "<div id='snackbar'><span class='closebtn' onclick='this.parentElement.style.display='none';'>&times;</span>response.strMsg</div>"
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
				alert(response.strMsg);
			} else {
				 alert(response.strMsg);
			 }
		}, "json");
	} else {
		alert('Please enter reviews.');
	}
}

function update_status(){
	var order_id = $("#orderId").val();
	var status = $("#order_status").val();
	var post_selected = {
		order_id : order_id,
		status : status,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/update_status/", post_selected,
	function(response) {
		if (response.success == "True") {
			window.load();
			$("#responseMsg").addClass("sAlert");
			$("#responseMsg").css("display","block");
			$("#responseMsg").text(response.strMsg);
		}
	}, "json");
}



function deposite_dates(){
	var order_id = $("#orderId").val();
	var deposite_collect = $("#deposite_taken_id").val();
	var post_selected = {
		order_id : order_id,
		deposite_collect : deposite_collect,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/update_deposite_entry/", post_selected,
	function(response) {
		if (response.success == "True") {
			window.load();
			$("#responseMsg").addClass("sAlert");
			$("#responseMsg").css("display","block");
			$("#responseMsg").text(response.strMsg);
		}
	}, "json");
}

function deposite_return_dates(){
	var order_id = $("#orderId").val();
	var deposite_return = $("#deposite_given_id").val();

	var post_selected = {
		order_id : order_id,
		deposite_return : deposite_return,
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/update_deposite_return_entry/", post_selected,
	function(response) {
		if (response.success == "True") {
			window.load();
			$("#responseMsg").addClass("sAlert");
			$("#responseMsg").css("display","block");
			$("#responseMsg").text(response.strMsg);
		}
	}, "json");
}




//Ajax fun
function importDefault() {
	var post_selected = {
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/set_default/", post_selected,

	function(response) {
		if (response.success == "True") {
			$("#setDefaultForm").css("display", "none");
			$("#displaySetMsg").css("display", "block");
			$("#displaySetMsg").text(response.msg);
			location.reload();
		}
	}, "json");
}


//Ajax fun
function goLive() {
	var post_selected = {
		csrfmiddlewaretoken : jQuery("input[name=csrfmiddlewaretoken]").val(),
	};
	jQuery.post("/go_live/", post_selected,

	function(response) {
		if (response.success == "True") {
			$("#goLiveForm").css("display", "none");
			$("#displayLiveMsg").css("display", "block");
			$("#displayLiveMsg").text(response.msg);
			location.reload();
		}
	}, "json");
}

function openCity(evt, cityName) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById("id_"+cityName).style.display = "block";
	evt.currentTarget.className += " active";
}