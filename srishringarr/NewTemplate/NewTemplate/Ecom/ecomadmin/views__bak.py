from django.shortcuts import render
from django.http.response import HttpResponseRedirect
from django.views.generic import TemplateView
from django.urls import reverse
from ecomadmin.models import Category, Products , HomeSetting, ProductListSetting, ProductDetailSetting, CartPageSetting, CheckoutPageSetting, ThankyouPageSetting, HomeSettingOptions, ProductListSettingOptions, \
     PDSettingOptions, CartSettingOptions, BankList, CheckoutSettingOptions, ThankUSettingOptions, Offers, Order, OrderItem, \
    Rent
from django.contrib.auth import logout
from django.shortcuts import get_object_or_404
from ecomauth.models import userDetails
from ecomsite.app_setting import getUserID
from django.http import JsonResponse
from Ecom.settings import STATIC_PATH
import uuid
from django.core.mail import send_mail
from django.template.loader import render_to_string
from django.utils.html import strip_tags
from django.core.mail import EmailMultiAlternatives
from django.db import connection


# Create your views here.
class DashBoardView(TemplateView):
    template_name = 'ecomadmin/dashboard.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if postdata['seting_type'] == 'home_setting':
            if request.session.get('userId') != '0':
                try:
                    homesetting = get_object_or_404(HomeSetting, user=request.session.get('userId'))
                except:
                    homesetting = None
                        
                if homesetting is None:
                    homesetting = HomeSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"

                homesetting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                if request.POST.get('clogo_icon'):
                    homesetting.logo = True
                else:
                    homesetting.logo = False
                if request.POST.get('ctag_line'):
                    homesetting.headline = True
                else:
                    homesetting.headline = False
                if request.POST.get('cslider'):
                    homesetting.slider = True
                else:
                    homesetting.slider = False
                if request.POST.get('cmenu'):
                    homesetting.menu = True
                else:
                    homesetting.menu = False
                if request.POST.get('ccat_grid'):
                    homesetting.category_grid = True
                else:
                    homesetting.category_grid = False
                if request.POST.get('ctop_t_product'):
                    homesetting.top_trending_product = True
                else:
                    homesetting.top_trending_product = False
                if request.POST.get('ctop_d_product'):
                    homesetting.top_discount_product = True
                else:
                    homesetting.top_discount_product = False
                if request.POST.get('ctop_d_cat'):
                    homesetting.top_discount_categories = True
                else:
                    homesetting.top_discount_categories = False
                if request.POST.get('ctop_sale'):
                    homesetting.top_selling_product = True
                else:
                    homesetting.top_selling_product = False
                if request.POST.get('cf_product'):
                    homesetting.feture_product = True
                else:
                    homesetting.feture_product = False
                if request.POST.get('cnew_arrivals'):
                    homesetting.new_arrivals = True
                else:
                    homesetting.new_arrivals = False
                if request.POST.get('csearchbar'):
                    homesetting.searchbar = True
                else:
                    homesetting.searchbar = False
                if request.POST.get('ccart_icon'):
                    homesetting.cart_symbol = True
                else:
                    homesetting.cart_symbol = False
                if request.POST.get('cfooter'):
                    homesetting.footer = True
                else:
                    homesetting.footer = False
                homesetting.save()
                self.responseStatus = True
                
        elif postdata['seting_type'] == 'product_setting':
            if request.session.get('userId') != '0':
                try:
                    product_list_setting = get_object_or_404(ProductListSetting, user=request.session.get('userId'))
                except:
                    product_list_setting = None
                    
                if product_list_setting is None:
                    product_list_setting = ProductListSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                product_list_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                if request.POST.get('pljlogo_icon'):
                    product_list_setting.logo = True
                else:
                    product_list_setting.logo = False
                if request.POST.get('pljtag_line'):
                    product_list_setting.headline = True
                else:
                    product_list_setting.headline = False
                if request.POST.get('pljsearchbar'):
                    product_list_setting.searchbar = True
                else:
                    product_list_setting.searchbar = False
                if request.POST.get('pljcart_icon'):
                    product_list_setting.cart_symbol = True
                else:
                    product_list_setting.cart_symbol = False
                if request.POST.get('pljmenu'):
                    product_list_setting.menu = True
                else:
                    product_list_setting.menu = False
                if request.POST.get('pljfooter'):
                    product_list_setting.footer = True
                else:
                    product_list_setting.footer = False
                if request.POST.get('pljfilter_by_gender'):
                    product_list_setting.filter_by_gender = True
                else:
                    product_list_setting.filter_by_gender = False
                if request.POST.get('pljfilter_by_category'):
                    product_list_setting.filter_by_category = True
                else:
                    product_list_setting.filter_by_category = False
                if request.POST.get('pljfilter_by_price'):
                    product_list_setting.filter_by_price = True
                else:
                    product_list_setting.filter_by_price = False
                if request.POST.get('pljfilter_by_discount'):
                    product_list_setting.filter_by_discount = True
                else:
                    product_list_setting.filter_by_discount = False
                if request.POST.get('pljfilter_by_colour'):
                    product_list_setting.filter_by_colour = True
                else:
                    product_list_setting.filter_by_colour = False
                if request.POST.get('pljfilter_by_brands'):
                    product_list_setting.filter_by_brands = True
                else:
                    product_list_setting.filter_by_brands = False
                if request.POST.get('pljfilter_by_reviews'):
                    product_list_setting.filter_by_reviews = True
                else:
                    product_list_setting.filter_by_reviews = False
                if request.POST.get('pljfilter_by_availability'):
                    product_list_setting.filter_by_availability = True
                else:
                    product_list_setting.filter_by_availability = False
                if request.POST.get('pljproduct_by_grid'):
                    product_list_setting.product_by_grid = True
                else:
                    product_list_setting.product_by_grid = False
                if request.POST.get('pljproduct_by_list'):
                    product_list_setting.product_by_list = True
                else:
                    product_list_setting.product_by_list = False
                if request.POST.get('pljgrid_and_list'):
                    product_list_setting.grid_and_list = True
                else:
                    product_list_setting.grid_and_list = False
                product_list_setting.save() 
                self.responseStatus = True    
                   
        elif postdata['seting_type'] == 'product_details_setting':
            if request.session.get('userId') != '0':
                try:
                    product_detail_setting = get_object_or_404(ProductDetailSetting, user=request.session.get('userId'))
                except:
                    product_detail_setting = None
                    
                if product_detail_setting is None:
                    product_detail_setting = ProductDetailSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                product_detail_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                
                if request.POST.get('pdjlogo_icon'):
                    product_detail_setting.logo = True
                else:
                    product_detail_setting.logo = False
                if request.POST.get('pdjtag_line'):
                    product_detail_setting.headline = True
                else:
                    product_detail_setting.headline = False
                if request.POST.get('pdjsearchbar'):
                    product_detail_setting.searchbar = True
                else:
                    product_detail_setting.searchbar = False
                if request.POST.get('pdjcart_icon'):
                    product_detail_setting.cart_symbol = True
                else:
                    product_detail_setting.cart_symbol = False
                if request.POST.get('pdjmenu'):
                    product_detail_setting.menu = True
                else:
                    product_detail_setting.menu = False
                if request.POST.get('pdjfooter'):
                    product_detail_setting.footer = True
                else:
                    product_detail_setting.footer = False
                if request.POST.get('pdjprod_name'):
                    product_detail_setting.prod_name = True
                else:
                    product_detail_setting.prod_name = False
                if request.POST.get('pdjs_reviews'):
                    product_detail_setting.s_review = True
                else:
                    product_detail_setting.s_review = False
                if request.POST.get('pdjprice'):
                    product_detail_setting.price = True
                else:
                    product_detail_setting.price = False
                if request.POST.get('pdjdiscount'):
                    product_detail_setting.discount = True
                else:
                    product_detail_setting.discount = False
                if request.POST.get('pdjoffer'):
                    product_detail_setting.offer = True
                else:
                    product_detail_setting.offer = False
                if request.POST.get('pdjhighlights'):
                    product_detail_setting.highlights = True
                else:
                    product_detail_setting.highlights = False
                if request.POST.get('pdjservices'):
                    product_detail_setting.services = True
                else:
                    product_detail_setting.services = False
                if request.POST.get('pdjseller'):
                    product_detail_setting.seller = True
                else:
                    product_detail_setting.seller = False
                if request.POST.get('pdjdesc'):
                    product_detail_setting.description = True
                else:
                    product_detail_setting.description = False
                if request.POST.get('pdjspecification'):
                    product_detail_setting.specifications = True
                else:
                    product_detail_setting.specifications = False
                if request.POST.get('pdjbroght_together'):
                    product_detail_setting.prod_brought_together = True
                else:
                    product_detail_setting.prod_brought_together = False
                    
                    # bfghfd
                if request.POST.get('pdjrate_reviews'):
                    product_detail_setting.rating_reviews = True
                else:
                    product_detail_setting.rating_reviews = False
                if request.POST.get('pdjrate'):
                    product_detail_setting.rate_product = True
                else:
                    product_detail_setting.rate_product = False
                if request.POST.get('pdjrecent_viewed'):
                    product_detail_setting.recent_view = True
                else:
                    product_detail_setting.recent_view = False
                if request.POST.get('pdjmanufacture'):
                    product_detail_setting.manufacture = True
                else:
                    product_detail_setting.manufacture = False
                if request.POST.get('pdjgoes_with'):
                    product_detail_setting.goes_with = True
                else:
                    product_detail_setting.goes_with = False
                if request.POST.get('pdjsimilar'):
                    product_detail_setting.similar_prod = True
                else:
                    product_detail_setting.similar_prod = False
                if request.POST.get('pdjdelivery'):
                    product_detail_setting.delivery_option = True
                else:
                    product_detail_setting.delivery_option = False
                if request.POST.get('pdjemi'):
                    product_detail_setting.emi_option = True
                else:
                    product_detail_setting.emi_option = False
                    
                    # bfghfd
                if request.POST.get('pdjinterested'):
                    product_detail_setting.interested_prod = True
                else:
                    product_detail_setting.interested_prod = False
                if request.POST.get('pdjbuy_now_btn'):
                    product_detail_setting.buy_now = True
                else:
                    product_detail_setting.buy_now = False
                if request.POST.get('pdjwishlist_btn'):
                    product_detail_setting.wishlist = True
                else:
                    product_detail_setting.wishlist = False
                if request.POST.get('pdjtop_msg'):
                    product_detail_setting.top_msg = True
                else:
                    product_detail_setting.top_msg = False
                if request.POST.get('pdjbottom_msg'):
                    product_detail_setting.bottom_msg = True
                else:
                    product_detail_setting.bottom_msg = False
                if request.POST.get('pdjstock'):
                    product_detail_setting.stock = True
                else:
                    product_detail_setting.stock = False
                if request.POST.get('pdjsize'):
                    product_detail_setting.size = True
                else:
                    product_detail_setting.size = False
                if request.POST.get('pdjsize_chart'):
                    product_detail_setting.size_chart = True
                else:
                    product_detail_setting.size_chart = False
                if request.POST.get('pdjcolor'):
                    product_detail_setting.color = True
                else:
                    product_detail_setting.color = False
                product_detail_setting.save()
                self.responseStatus = True    
                
        elif postdata['seting_type'] == 'cart_setting':
            if request.session.get('userId') != '0':
                try:
                    cart_setting = get_object_or_404(CartPageSetting, user=request.session.get('userId'))
                except:
                    cart_setting = None
                    
                if cart_setting is None:
                    cart_setting = CartPageSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                cart_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                if request.POST.get('cartlogo_icon'):
                    cart_setting.logo = True
                else:
                    cart_setting.logo = False
                if request.POST.get('carttag_line'):
                    cart_setting.headline = True
                else:
                    cart_setting.headline = False
                if request.POST.get('cartsearchbar'):
                    cart_setting.searchbar = True
                else:
                    cart_setting.searchbar = False
                if request.POST.get('cartmenu'):
                    cart_setting.menu = True
                else:
                    cart_setting.menu = False
                if request.POST.get('cartfooter'):
                    cart_setting.footer = True
                else:
                    cart_setting.footer = False
                if request.POST.get('cart_title_with_count'):
                    cart_setting.title_with_count = True
                else:
                    cart_setting.title_with_count = False
                if request.POST.get('cart_count'):
                    cart_setting.cart_count = True
                else:
                    cart_setting.cart_count = False
                if request.POST.get('cart_image'):
                    cart_setting.image = True
                else:
                    cart_setting.image = False
                if request.POST.get('cart_seller_name'):
                    cart_setting.seller_name = True
                else:
                    cart_setting.seller_name = False
                if request.POST.get('cart_add_to_wishlist'):
                    cart_setting.add_to_wishlist = True
                else:
                    cart_setting.add_to_wishlist = False
                if request.POST.get('cart_add_from_wishlist'):
                    cart_setting.add_from_wishlist = True
                else:
                    cart_setting.add_from_wishlist = False
                if request.POST.get('cart_continue_shopping'):
                    cart_setting.continue_shopping = True
                else:
                    cart_setting.continue_shopping = False
                if request.POST.get('cart_check_delivery'):
                    cart_setting.check_delivery = True
                else:
                    cart_setting.check_delivery = False
                if request.POST.get('cart_delivery_charges'):
                    cart_setting.delivery_charges = True
                else:
                    cart_setting.delivery_charges = False
                if request.POST.get('cart_replacement_policy'):
                    cart_setting.replacement_policy = True
                else:
                    cart_setting.replacement_policy = False
                if request.POST.get('cart_estimated_tax'):
                    cart_setting.estimated_tax = True
                else:
                    cart_setting.estimated_tax = False
                if request.POST.get('cart_message_top'):
                    cart_setting.message_top = True
                else:
                    cart_setting.message_top = False
                if request.POST.get('cart_message_bottom'):
                    cart_setting.message_bottom = True
                else:
                    cart_setting.message_bottom = False
                if request.POST.get('cart_emi_eligibity'):
                    cart_setting.emi_eligibity = True
                else:
                    cart_setting.emi_eligibity = False
                if request.POST.get('cart_add_coupon'):
                    cart_setting.add_coupon = True
                else:
                    cart_setting.add_coupon = False
                if request.POST.get('cart_coupon_list'):
                    cart_setting.coupon_list = True
                else:
                    cart_setting.coupon_list = False
                if request.POST.get('cart_empty'):
                    cart_setting.empty = True
                else:
                    cart_setting.empty = False
                cart_setting.save()
                self.responseStatus = True                    
        elif postdata['seting_type'] == 'checkout_setting':
            if request.session.get('userId') != '0':
                try:
                    checkout_setting = get_object_or_404(CheckoutPageSetting, user=request.session.get('userId'))
                except:
                    checkout_setting = None
                    
                if checkout_setting is None:
                    checkout_setting = CheckoutPageSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                checkout_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                
                if request.POST.get('ct_logo_icon'):
                    checkout_setting.logo = True
                else:
                    checkout_setting.logo = False
                if request.POST.get('ct_tag_line'):
                    checkout_setting.headline = True
                else:
                    checkout_setting.headline = False
                if request.POST.get('ct_searchbar'):
                    checkout_setting.searchbar = True
                else:
                    checkout_setting.searchbar = False
                if request.POST.get('ct_menu'):
                    checkout_setting.menu = True
                else:
                    checkout_setting.menu = False
                if request.POST.get('ct_footer'):
                    checkout_setting.footer = True
                else:
                    checkout_setting.footer = False
                if request.POST.get('ct_bill_add'):
                    checkout_setting.billing = True
                else:
                    checkout_setting.billing = False
                if request.POST.get('ct_ship_add'):
                    checkout_setting.shipping = True
                else:
                    checkout_setting.shipping = False
                if request.POST.get('ct_as_bill'):
                    checkout_setting.same_as_billing = True
                else:
                    checkout_setting.same_as_billing = False
                if request.POST.get('ct_add_type'):
                    checkout_setting.add_type = True
                else:
                    checkout_setting.add_type = False
                if request.POST.get('ct_coupon'):
                    checkout_setting.add_coupon = True
                else:
                    checkout_setting.add_coupon = False
                if request.POST.get('ct_coupon_list'):
                    checkout_setting.coupon_list = True
                else:
                    checkout_setting.coupon_list = False
                if request.POST.get('ct_order_summary'):
                    checkout_setting.order_summary = True
                else:
                    checkout_setting.order_summary = False
                if request.POST.get('ct_cod'):
                    checkout_setting.cod = True
                else:
                    checkout_setting.cod = False
                if request.POST.get('ct_paypal'):
                    checkout_setting.paypal = True
                else:
                    checkout_setting.paypal = False
                if request.POST.get('ct_citrus'):
                    checkout_setting.citrus = True
                else:
                    checkout_setting.citrus = False
                if request.POST.get('ct_netbanking'):
                    checkout_setting.netbanking = True
                else:
                    checkout_setting.netbanking = False
                if request.POST.get('ct_bank_transfer'):
                    checkout_setting.bank_transfer = True
                else:
                    checkout_setting.bank_transfer = False
                if request.POST.get('ct_emi'):
                    checkout_setting.emi = True
                else:
                    checkout_setting.emi = False
                if request.POST.get('ct_wallets'):
                    checkout_setting.wallets = True
                else:
                    checkout_setting.wallets = False
                if request.POST.get('ct_phonepe'):
                    checkout_setting.phonepe = True
                else:
                    checkout_setting.phonepe = False
                if request.POST.get('ct_cr_db'):
                    checkout_setting.credit_debit = True
                else:
                    checkout_setting.credit_debit = False
                if request.POST.get('ct_new_add'):
                    checkout_setting.new_address = True
                else:
                    checkout_setting.new_address = False
                if request.POST.get('ct_chg_login'):
                    checkout_setting.chg_login = True
                else:
                    checkout_setting.chg_login = False
                if request.POST.get('ct_chg_add'):
                    checkout_setting.chg_address = True
                else:
                    checkout_setting.chg_address = False
                if request.POST.get('ct_chg_order'):
                    checkout_setting.chg_order = True
                else:
                    checkout_setting.chg_order = False
                if request.POST.get('ct_del_charge'):
                    checkout_setting.del_charge = True
                else:
                    checkout_setting.del_charge = False
                if request.POST.get('ct_tax'):
                    checkout_setting.tax = True
                else:
                    checkout_setting.tax = False
                if request.POST.get('ct_discount'):
                    checkout_setting.discount = True
                else:
                    checkout_setting.discount = False
                if request.POST.get('ct_near_u'):
                    checkout_setting.near_by_you = True
                else:
                    checkout_setting.near_by_you = False
                checkout_setting.save()
                self.responseStatus = True
            
        elif postdata['seting_type'] == 'thankyou_setting':
            if request.session.get('userId') != '0':
                try:
                    thanku_setting = get_object_or_404(ThankyouPageSetting, user=request.session.get('userId'))
                except:
                    thanku_setting = None
                    
                if thanku_setting is None:
                    thanku_setting = ThankyouPageSetting()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                thanku_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                if request.POST.get('tu_logo_icon'):
                    thanku_setting.logo = True
                else:
                    thanku_setting.logo = False
                if request.POST.get('tu_tag_line'):
                    thanku_setting.headline = True
                else:
                    thanku_setting.headline = False
                if request.POST.get('tu_searchbar'):
                    thanku_setting.searchbar = True
                else:
                    thanku_setting.searchbar = False
                if request.POST.get('tu_menu'):
                    thanku_setting.menu = True
                else:
                    thanku_setting.menu = False
                if request.POST.get('tu_footer'):
                    thanku_setting.footer = True
                else:
                    thanku_setting.footer = False
                if request.POST.get('tu_order_msg'):
                    thanku_setting.order_msg_txt = True
                else:
                    thanku_setting.order_msg_txt = False
                if request.POST.get('tu_order_summary'):
                    thanku_setting.order_summary = True
                else:
                    thanku_setting.order_summary = False
                if request.POST.get('tu_address'):
                    thanku_setting.order_address = True
                else:
                    thanku_setting.order_address = False
                if request.POST.get('tu_delivery_dt'):
                    thanku_setting.delivery_dt = True
                else:
                    thanku_setting.delivery_dt = False
                if request.POST.get('tu_cont_btn'):
                    thanku_setting.cont_shop_btn = True
                else:
                    thanku_setting.cont_shop_btn = False
                if request.POST.get('tu_cancel'):
                    thanku_setting.cancel_rule = True
                else:
                    thanku_setting.cancel_rule = False
                if request.POST.get('tu_notes'):
                    thanku_setting.note = True
                else:
                    thanku_setting.note = False
                thanku_setting.save()
                self.responseStatus = True  
                
        elif postdata['seting_type'] == 'rent_setting':
            if request.session.get('userId') != '0':
                try:
                    rent_setting = get_object_or_404(Rent, user=request.session.get('userId'))
                except:
                    rent_setting = None
                    
                if rent_setting is None:
                    rent_setting = Rent()
                    self.successMessage = "Setting saved successfully"
                else:
                    self.successMessage = "Setting updated successfully"
                    
                rent_setting.user = get_object_or_404(userDetails, id=request.session.get('userId'))
                days2 = request.POST['2_days_value'] if request.POST['2_days_value'].strip() != '' else '0'
                days3 = request.POST['3_days_value'] if request.POST['3_days_value'].strip() != '' else '0'
                days4 = request.POST['4_days_value'] if request.POST['4_days_value'].strip() != '' else '0'
                days5 = request.POST['5_days_value'] if request.POST['5_days_value'].strip() != '' else '0'
                days6 = request.POST['6_days_value'] if request.POST['6_days_value'].strip() != '' else '0'
                days7 = request.POST['7_days_value'] if request.POST['7_days_value'].strip() != '' else '0'
                finalData = days2 + ',' + days3 + ',' + days4 + ',' + days5 + ',' + days6 + ',' + days7 +''
                daysForRent = '2 days,3 days,4 days,5 days,6 days,7 days'        
                rent_setting.percent_value = finalData
                rent_setting.days = daysForRent
                rent_setting.save()
                self.responseStatus = True                    
                
        rseponseData = super(DashBoardView, self).get(request, *args, **kwargs)     
        return  rseponseData 
    
    def get_context_data(self, **kwargs):
        context = super(DashBoardView, self).get_context_data(**kwargs)
        context['pageTitle'] = "DashBoard"
        context['category_count'] = Category.objects.filter(user=self.request.session.get('userId')).count()
        context['offers_count'] = Offers.objects.filter(user=self.request.session.get('userId')).count()
        context['orders_count'] = Order.objects.filter(seller=self.request.session.get('userId')).count()
        context['home_setting'] = HomeSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['list_setting'] = ProductListSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['prod_detail_setting'] = ProductDetailSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['cart_setting'] = CartPageSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['checkout_setting'] = CheckoutPageSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['thanku_setting'] = ThankyouPageSetting.objects.filter(user=self.request.session.get('userId')).first()
        context['product_count'] = Products.objects.filter(user=self.request.session.get('userId')).count()
        rentData = Rent.objects.filter(user=self.request.session.get('userId')).first()
        context['rent_setting'] = rentData
        context['successMessage'] = self.successMessage
        context['status'] = self.responseStatus
        return context    

    
class ProductsView(TemplateView):
    template_name = 'ecomadmin/products.html'
    
    def get_context_data(self, **kwargs):
        context = super(ProductsView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Products"
        context['product_list'] = Products.objects.filter(user=self.request.session.get('userId'))
        context['product_count'] = Products.objects.filter(user=self.request.session.get('userId')).count()
        context['published_product_count'] = Products.objects.filter(is_active=True, user=self.request.session.get('userId')).count()
        context['unPublished_product_count'] = Products.objects.filter(is_active=False, user=self.request.session.get('userId')).count()
        context['deleted_product_count'] = Products.objects.filter(is_delete=True, user=self.request.session.get('userId')).count()
        return context 

      
class CategoryView(TemplateView):
    template_name = 'ecomadmin/category.html'
    
    def get_context_data(self, **kwargs):
        context = super(CategoryView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Category"
        context['category_list'] = Category.objects.filter(user=self.request.session.get('userId'))
        context['category_count'] = Category.objects.filter(user=self.request.session.get('userId')).count()
        context['active_category_count'] = Category.objects.filter(is_active=True, user=self.request.session.get('userId')).count()
        context['inactive_category_count'] = Category.objects.filter(is_active=False, user=self.request.session.get('userId')).count()
        context['deleted_category_count'] = Category.objects.filter(is_delete=True, user=self.request.session.get('userId')).count()
        return context    

    
class OffersView(TemplateView):
    template_name = 'ecomadmin/offers.html'
    
    def get_context_data(self, **kwargs):
        context = super(OffersView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Offers"
        offerList = Offers.objects.filter(user=self.request.session.get('userId'))
        context['offer_list'] = offerList
        context['offer_count'] = Offers.objects.filter(user=self.request.session.get('userId')).count()
        context['published_offer_count'] = Offers.objects.filter(is_active=True, user=self.request.session.get('userId')).count()
        context['unPublished_offer_count'] = Offers.objects.filter(is_active=False, user=self.request.session.get('userId')).count()
        context['deleted_offer_count'] = Offers.objects.filter(is_delete=True, user=self.request.session.get('userId')).count()
        return context     


class OrdersView(TemplateView):
    template_name = 'ecomadmin/orders.html'
    
    def get_context_data(self, **kwargs):
        context = super(OrdersView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Orders"
        orderList = Order.objects.filter(seller=self.request.session.get('userId')).order_by('-id')
        context['order_list'] = orderList
        context['orders_count'] = Order.objects.filter(seller=self.request.session.get('userId')).count()
        context['confirmed_order_count'] = Order.objects.filter(status='C', seller=self.request.session.get('userId')).count()
        context['pending_order_count'] = Order.objects.filter(status='P', seller=self.request.session.get('userId')).count()
        context['cancelled_order_count'] = Order.objects.filter(status='X', seller=self.request.session.get('userId')).count()
        return context    


class OrderDetailsView(TemplateView):
    template_name = 'ecomadmin/order_detail.html'
    
    def get_context_data(self, **kwargs):
        context = super(OrderDetailsView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Order Detail"
        orderId = self.kwargs['order_id']
        context['order'] = get_object_or_404(Order, id=orderId, seller=self.request.session.get('userId'))
        context['order_items'] = OrderItem.objects.filter(order_id=orderId)
        return context

 
class AddProductsView(TemplateView):
    template_name = 'ecomadmin/addproducts.html'
    successMessage = ''
    responseStatus = False
   
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        productId = self.kwargs['product_id']
        if productId != '0':
            productObject = get_object_or_404(Products, id=productId)
        else: 
            productObject = Products()
        
        productObject.name = postdata.get('productname')
        productObject.sku = postdata.get('sku')
        productObject.mrp = postdata.get('productmrp')
        
        if postdata.get('productsaleprice'):
            productObject.sale_price = postdata.get('productsaleprice')
        
        if postdata.get('productrentprice'):
            productObject.rent_price = postdata.get('productrentprice')
            
        if postdata.get('discount'):
            productObject.discount = postdata.get('discount')
        
        if postdata.get('product_image') != '':
            imageData = request.FILES['product_image']
            productObject.product_image = imageData
        
        if postdata.get('thumbnail_images') != '':
            imageThumbData = request.FILES.getlist('thumbnail_images')
            imageCount = 0
            strImage = ''
            for f in imageThumbData:
                imageCount += 1
                filename = f._get_name()
                strImage = strImage + filename + ','
                filepath = STATIC_PATH + '/images/catalog/products/thumbnail/' + filename 
                import os,inspect
                path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error.txt"
                file = open(path,"a+")                
                file.write(str(filepath) + "," +str(STATIC_PATH))
                file.write("\n")
                file.close()
                with open(filepath, 'wb+') as dest:
                    for chunk in f.chunks():
                        dest.write(chunk)
            productObject.product_thumb_image = strImage[:-1]   
            productObject.product_thumb_image_count = imageCount
        
        if postdata.get('is_rent'):
            productObject.is_rent = True
        else:
            productObject.is_rent = False
            
        if postdata.get('is_sale'):
            productObject.is_sale = True
        else:
            productObject.is_sale = False
        
        if postdata.get('isactive'):
            productObject.is_active = True
        else:
            productObject.is_active = False
            
        if postdata.get('isbestseller'):
            productObject.is_bestseller = True
        else:
            productObject.is_bestseller = False
            
        if postdata.get('isfeatured'):
            productObject.is_featured = True
        else:
            productObject.is_featured = False
            
        productObject.small_description = postdata.get('small_description')
        productObject.description = postdata.get('description')
        productObject.highlights = postdata.get('highlights')
        productObject.services = postdata.get('services')
        productObject.specifications = postdata.get('specifications')
        productObject.color = postdata.get('color')
        #productObject.size = postdata.get('size')
        if request.POST['categories'] != '0':
            cat_Id = get_object_or_404(Category, id=request.POST['categories'])
            if cat_Id:
                productObject.categories = cat_Id
        productObject.specific_for = postdata.get('genderOption')
        productObject.brand = postdata.get('brand')
        productObject.type = postdata.get('type')
        productObject.quantity = postdata.get('quantity')
        productObject.sleeve = postdata.get('sleeve')
        productObject.front_neck = postdata.get('front_neck')
        productObject.back_neck = postdata.get('back_neck')
        productObject.opening = postdata.get('opening')
        productObject.fit = postdata.get('fit')
        productObject.style = postdata.get('style')
        productObject.weave_type = postdata.get('weave_type')
        productObject.pattern = postdata.get('pattern')
        if productObject.embellished:
            productObject.embellished = postdata.get('embellished')
        if productObject.embroidered:
            productObject.embroidered = postdata.get('embroidered')
        productObject.ocassion = postdata.get('occasion')
        productObject.age_group = postdata.get('age_group')
        productObject.metal_base = postdata.get('metal_base')
        productObject.in_the_box = postdata.get('box')
        productObject.back_lock = postdata.get('back_lock')
        productObject.seller = postdata.get('seller')
        productObject.designer = postdata.get('designer')
        productObject.warranty = postdata.get('warranty')
        productObject.fabric_material = postdata.get('fabric_material')
        productObject.fabric_care = postdata.get('fabric_care')
        # productObject.dupatta_fabric = postdata.get('dupatta_fabric')
        productObject.ean_upc = postdata.get('ean_upc')
        productObject.vat = postdata.get('vat')
        productObject.product_length = postdata.get('product_length')
        productObject.product_width = postdata.get('product_width')
        productObject.measuring_unit = postdata.get('measuring_unit')
        productObject.dimension_unit = postdata.get('dimension_unit')
        productObject.package_length = postdata.get('package_length')
        productObject.package_width = postdata.get('package_width')
        productObject.package_height = postdata.get('package_height')
        productObject.package_weight = postdata.get('package_weight')
        productObject.pack_of = postdata.get('pack_of')
        productObject.sales_package = postdata.get('sales_package')
        productObject.meta_description = postdata.get('meta_description') 
        productObject.meta_keywords = postdata.get('meta_keywords')
        productObject.disclaimer = postdata.get('disclaimer')
        print(productObject.disclaimer)
        print("(((((((((((((((((((((((((((((((((((((((((((")
        productObject.bust_size = postdata.get('bustsize',None)
        print(productObject.bust_size)
        print(")))))))))))))))))))))))))))))))))))))0")
        productObject.hips_size = postdata.get('hipsize',None)
        productObject.waist_size  = postdata.get('waistsize',None)
        if productObject.ordering :
            productObject.ordering = postdata.get('prod_order')
        productObject.user = get_object_or_404(userDetails, id=request.session.get('userId'))     
        productObject.save()
        if productId == '0':
            prepopulated_fields = "prd_"+str(productObject.id)
            print(prepopulated_fields[0]+"_"+str(productObject.id))
            productObject.slug = prepopulated_fields[0]+"_"+str(productObject.id)
            productObject.save() 
            # prepopulated_fields = postdata.get('productname').strip().replace(' ', '-')
            # productObject.slug = prepopulated_fields + "_" + productObject.id
            # productObject.slug = "prd_" + productObject.id
            # productObject.save()
        
        self.successMessage = "Product added Successfully"
        self.responseStatus = True
        return HttpResponseRedirect(reverse('products'))            

        rseponseData = super(AddProductsView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(AddProductsView, self).get_context_data(**kwargs)
        context['cat_list'] = Category.objects.filter(user_id=self.request.session.get('userId'))
        productId = self.kwargs['product_id']
        burst=[30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49]   
        waist=[24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42]
        hips=[24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,
        43,44,45,46,47,48,49,50,51,52,53,54]
        print(burst)
        if productId == '0':
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Add Product"
        else:
            context['productData'] = Products.objects.filter(id=productId, user_id=self.request.session.get('userId')).first()
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Edit Product"
        return context                 


class AddCategoryView(TemplateView):
    template_name = 'ecomadmin/addcategory.html'
    successMessage = ''
    responseStatus = False

    def post(self, request, *args, **kwargs):
        catId = self.kwargs['cat_id']
        postdata = request.POST.copy()
        isValid = True
        if True  if request.POST['cat_name'].strip() == '' else False :
            self.successMessage = "Enter category name."
            isValid = False
        elif True  if request.POST['description'].strip() == '' else False :
            self.successMessage = "Category description required"
            isValid = False
        elif True  if request.POST['order'].strip() == '' else False :
            self.successMessage = "Category order required"
            isValid = False    
            
        if isValid:
            if catId != '0':
                categoryData = get_object_or_404(Category, id=catId)
            else: 
                categoryData = Category()
            
            categoryData.name = request.POST['cat_name']
            if request.POST['parentName'] != '0':
                cat_Id = get_object_or_404(Category, id=request.POST['parentName'])
                if cat_Id:
                    categoryData.parent = cat_Id
                    
            categoryData.user = get_object_or_404(userDetails, id=request.session.get('userId'))
            categoryData.description = request.POST['description']
            prepopulated_fields = request.POST['cat_name'].strip().replace(' ', '-')
            categoryData.slug = prepopulated_fields
            
            if postdata.get('isactive'):
                categoryData.is_active = True
            else:
                categoryData.is_active = False
                
            categoryData.meta_keywords = request.POST['meta_keywords']
            categoryData.meta_description = request.POST['meta_description']
            categoryData.order = request.POST['order']
            categoryData.commission = request.POST['commission']
            
            if postdata.get('myfile') != '':
                imageData = request.FILES['myfile']
                categoryData.image = imageData
                
            categoryData.save()
            self.successMessage = "Category added Successfully"
            self.responseStatus = True
            return HttpResponseRedirect(reverse('category'))
       
        rseponseData = super(AddCategoryView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(AddCategoryView, self).get_context_data(**kwargs)
        catId = self.kwargs['cat_id']
        if catId == '0':
            categoryData = '0'
            context['cat_list'] = Category.objects.filter(user=self.request.session.get('userId'))
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Add Category"
        else:
            context['categoryData'] = Category.objects.filter(id=catId).first()
            context['catDetails'] = '1'
            context['cat_list'] = Category.objects.filter(user=self.request.session.get('userId'))
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Edit Category"
        return context  


class AddOffersView(TemplateView):
    template_name = 'ecomadmin/addoffers.html'
    successMessage = ''
    responseStatus = False
   
    def post(self, request, *args, **kwargs):
        offerId = self.kwargs['offer_id']
        postdata = request.POST.copy()
        
        if offerId != '0':
            offerData = get_object_or_404(Offers, id=offerId)
        else: 
            offerData = Offers()
        
        offerData.user = get_object_or_404(userDetails, id=request.session.get('userId'))
        offerData.offer_name = request.POST['offername'] 
        offerData.offer_code = request.POST['offercode'] 
        offerData.seller_ref_code = request.POST['seller_ref_code'] 
        offerData.short_description = request.POST['short_description'] 
        offerData.description = request.POST['description'] 
        offerData.offer_type = request.POST['offer_type'] 
        offerData.offer_value = request.POST['offer_value'] 
        offerData.max_users = request.POST['max_users'] 
        offerData.max_per_user = request.POST['max_per_users'] 
        offerData.exp_date = request.POST['exp_dt'] 
        offerData.min_order = request.POST['min_order']
        offerData.max_order = request.POST['max_order']
        offerData.terms_condition = request.POST['terms_condition']
        
        if postdata.get('is_active'):
            offerData.is_active = True
        else:
            offerData.is_active = False  
        
        if postdata.get('offer_image') != '':
            imageData = request.FILES['offer_image']
            offerData.offer_image = imageData
        
        if request.POST['offer_cat'] != '0':
            cat_Id = get_object_or_404(Category, id=request.POST['offer_cat'])
        
        if cat_Id:
            offerData.category = cat_Id
        
        offerData.save()
        return HttpResponseRedirect(reverse('offers'))
    
        rseponseData = super(AddOffersView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(AddOffersView, self).get_context_data(**kwargs)
        context['color'] = Products.objects.all()
        context['cat_list'] = Category.objects.filter(user_id=self.request.session.get('userId'))
        offerId = self.kwargs['offer_id']
        if offerId == '0':
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Add Offer"
        else:
            context['offerData'] = Offers.objects.filter(id=offerId, user_id=self.request.session.get('userId')).first()
            context['successMessage'] = self.successMessage
            context['status'] = self.responseStatus
            context['pageTitle'] = "Edit Offer"
        context['product_list'] = Products.objects.filter(user=self.request.session.get('userId'))    
        return context        
    

def deleteProduct(request):
    postdata = request.POST.copy()
    
    Products.objects.filter(id=postdata.get('product_id')).delete()
    
    response = {
        'success' : 'True',
        'strMsg' : 'Product deleted successfully'  ,
    }
    return JsonResponse(response)


def deleteCategory(request):
    postdata = request.POST.copy()
    
    Category.objects.filter(id=postdata.get('category_id')).delete()
    
    response = {
        'success' : 'True',
        'strMsg' : 'Delete successfully'  ,
    }
    return JsonResponse(response) 
 

class HomeSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/home_setting.html'
    successMessage = ''
    responseStatus = False

    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        homesettingOptions = None
        if request.session.get('userId') != '0':
            try:
                homesettingOptions = get_object_or_404(HomeSettingOptions, user_id=request.session.get('userId'))
            except:
                homesettingOptions = None
                
        if homesettingOptions is None:
            homesettingOptions = HomeSettingOptions()
        
        homesettingOptions.user = get_object_or_404(userDetails, id=request.session.get('userId'))
        
        if postdata['seting_option_type'] == 'site_icon':
            imageData = request.FILES['logo_icon']
            homesettingOptions.logo_image = imageData    
            self.responseStatus = True
                
        elif postdata['seting_option_type'] == 'save_tagline':
            homesettingOptions.tag_line = request.POST['tagline']    
            self.responseStatus = True
                
        elif postdata['seting_option_type'] == 'save_searchbar':
            homesettingOptions.search_options = ", ".join(postdata.getlist('searchBar'))
            self.responseStatus = True  
 
        elif postdata['seting_option_type'] == 'cart_icon':
            imageData = request.FILES['cart_image']
            homesettingOptions.cart_image = imageData    
            self.responseStatus = True     
                         
        elif postdata['seting_option_type'] == 'type_menu_options':
            homesettingOptions.manu_type = request.POST['menuType']  
            homesettingOptions.menu_options = ", ".join(postdata.getlist('menuOptionData'))
            self.responseStatus = True  
      
        elif postdata['seting_option_type'] == 'type_footer_options':
            homesettingOptions.footer_options = ", ".join(postdata.getlist('footerOption'))
            self.responseStatus = True   
                
        elif postdata['seting_option_type'] == 'type_slider_options':
            imageData = request.FILES.getlist('slider_images')
            
            imageCount = 0
            strImage = ''
            for f in imageData:
                imageCount += 1
                filename = f._get_name()
                strImage = strImage + filename + ','
                filepath = STATIC_PATH +'/images/site/slider/' + filename
                with open(filepath, 'wb+') as dest:
                    for chunk in f.chunks():
                        dest.write(chunk)
            
            homesettingOptions.slider_image = strImage[:-1]   
            homesettingOptions.slider_image_count = imageCount        
            self.responseStatus = True  
        
        elif postdata['seting_option_type'] == 'type_cargrid_options':
            homesettingOptions.catgrid_col_count = request.POST['colCount']  
            self.responseStatus = True    

        elif postdata['seting_option_type'] == 'type_ttp_options':
            homesettingOptions.top_trend_product_count = request.POST['tt_product_count']
            homesettingOptions.top_trend_product_options = ", ".join(postdata.getlist('ttp_Option'))
            self.responseStatus = True                      

        elif postdata['seting_option_type'] == 'type_tdp_options':
            homesettingOptions.top_dist_product_count = request.POST['td_product_count']
            homesettingOptions.top_dist_product_options = ", ".join(postdata.getlist('tdp_Option'))
            self.responseStatus = True  

        elif postdata['seting_option_type'] == 'type_tdc_options':
            homesettingOptions.top_dist_cat_count = request.POST['tdcCount']
            homesettingOptions.top_dist_cat_options = ", ".join(postdata.getlist('tdcOption'))
            self.responseStatus = True
                
        elif postdata['seting_option_type'] == 'type_bs_options':
            homesettingOptions.best_sellers_count = request.POST['bsCount']
            homesettingOptions.best_sellers_options = ", ".join(postdata.getlist('tbsOption'))
            self.responseStatus = True                

        elif postdata['seting_option_type'] == 'type_fp_options':
            homesettingOptions.featured_product_count = request.POST['featured_product_count']
            homesettingOptions.featured_product_options = ", ".join(postdata.getlist('tfpOption'))
            self.responseStatus = True                                
        
        elif postdata['seting_option_type'] == 'type_na_options':
            homesettingOptions.new_arri_product_count = request.POST['na_product_count']
            homesettingOptions.new_arri_product_options = ", ".join(postdata.getlist('tnaOption'))
            self.responseStatus = True                                        

        homesettingOptions.save() 
        self.successMessage = "Setting saved successfully"
        rseponseData = super(HomeSettingOptionsView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(HomeSettingOptionsView, self).get_context_data(**kwargs)
        context['home_setting_option'] = HomeSettingOptions.objects.filter(user=self.request.session.get('userId')).first()
        context['successMessage'] = self.successMessage
        context['status'] = self.responseStatus
        context['pageTitle'] = "Home Options Setting"
        return context  


class ProductListSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/product_list_setting.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.session.get('userId') != '0':
            try:
                prodListsettingOptions = get_object_or_404(ProductListSettingOptions, user_id=request.session.get('userId'))
            except:
                prodListsettingOptions = None
                
            if prodListsettingOptions is None:
                prodListsettingOptions = ProductListSettingOptions()
                self.successMessage = "Menu added successfully"
            else:
                self.successMessage = "Menu updated successfully"
                
            prodListsettingOptions.user = get_object_or_404(userDetails, id=request.session.get('userId'))
            
            if postdata['prodlistOption'] == 'save_searchbar':
                prodListsettingOptions.search_options = ", ".join(postdata.getlist('searchBar'))
                self.responseStatus = True
            
            elif postdata['prodlistOption'] == 'save_filters':
                prodListsettingOptions.filter_gender = ", ".join(postdata.getlist('genderOption'))
                if postdata.get('catOption'):
                    prodListsettingOptions.filter_category = postdata.get('catOption')
                else:
                    prodListsettingOptions.filter_category = ''
                prodListsettingOptions.filter_cattype = ", ".join(postdata.getlist('catTypeOption'))
                prodListsettingOptions.filter_price = ", ".join(postdata.getlist('priceOption'))
                prodListsettingOptions.filter_discount = ", ".join(postdata.getlist('discountOption'))
                if postdata.get('colorOption'):
                    prodListsettingOptions.filter_color = postdata.get('colorOption')
                else:
                    prodListsettingOptions.filter_color = ''
                prodListsettingOptions.filter_size = ", ".join(postdata.getlist('sizeOption'))
                if postdata.get('brandOption'):
                    prodListsettingOptions.filter_brand = postdata.get('brandOption')
                else:
                    prodListsettingOptions.filter_brand = ''
                prodListsettingOptions.filter_stock = ", ".join(postdata.getlist('stockOption'))
                self.responseStatus = True
            
            elif postdata['prodlistOption'] == 'save_display':
                prodListsettingOptions.display_list_as = ", ".join(postdata.getlist('displayOption'))
                self.responseStatus = True
                
            prodListsettingOptions.save()
            
        responseData = super(ProductListSettingOptionsView, self).get(request, *args, **kwargs)     
        return  responseData            
    
    def get_context_data(self, **kwargs):
        context = super(ProductListSettingOptionsView, self).get_context_data(**kwargs)
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['prolist_seting_option'] = ProductListSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['pageTitle'] = "Product List Options Setting"
        return context


class ProductDetailSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/product_detail_setting.html'
    successMessage = ''
    responseStatus = False

    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        pDSettingOptions = None
        
        if request.session.get('userId') != '0':
            try:
                pDSettingOptions = get_object_or_404(PDSettingOptions, user=request.session.get('userId'))
            except:
                pDSettingOptions = None
                                
            if pDSettingOptions is None:
                pDSettingOptions = PDSettingOptions()

            pDSettingOptions.user = get_object_or_404(userDetails, id=request.session.get('userId'))
            
            if postdata['seting_option_type'] == 'save_searchbar':
                pDSettingOptions.search_options = ", ".join(postdata.getlist('searchBar'))
                self.responseStatus = True  
            elif postdata['seting_option_type'] == 'save_top_message':    
                pDSettingOptions.product_top_message = request.POST['top_message']    
                self.responseStatus = True    
            elif postdata['seting_option_type'] == 'save_bottom_message':    
                pDSettingOptions.product_bottom_message = request.POST['bottom_message']    
                self.responseStatus = True 
            elif postdata['seting_option_type'] == 'type_rvp_options':
                pDSettingOptions.recently_viewed = request.POST['rvp_product_count']
                pDSettingOptions.recently_viewed_options = ", ".join(postdata.getlist('rvp_Option'))
                self.responseStatus = True  
            elif postdata['seting_option_type'] == 'type_ftm_options':    
                pDSettingOptions.by_manufacturer = request.POST['ftm_product_count']
                pDSettingOptions.by_manufacturer_options = ", ".join(postdata.getlist('ftm_Option'))
                self.responseStatus = True  
            elif postdata['seting_option_type'] == 'type_gww_options':    
                pDSettingOptions.goes_well_with = request.POST['gww_product_count']
                pDSettingOptions.goes_well_with_options = ", ".join(postdata.getlist('gww_Option'))
                self.responseStatus = True
            elif postdata['seting_option_type'] == 'type_sm_options':    
                pDSettingOptions.similar_poducts = request.POST['sm_product_count']
                pDSettingOptions.similar_poducts_options = ", ".join(postdata.getlist('sm_Option'))
                self.responseStatus = True
            elif postdata['seting_option_type'] == 'type_ip_options':    
                pDSettingOptions.interested_products = request.POST['ip_product_count']
                pDSettingOptions.interested_products_options = ", ".join(postdata.getlist('ip_Option'))
                self.responseStatus = True
                                                
            pDSettingOptions.save()
            
        rseponseData = super(ProductDetailSettingOptionsView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(ProductDetailSettingOptionsView, self).get_context_data(**kwargs)
        pds = PDSettingOptions.objects.filter(user=self.request.session.get('userId')).first()
        context['product_setting_option'] = pds
        context['successMessage'] = self.successMessage
        context['status'] = self.responseStatus
        context['pageTitle'] = "Product Details Setting"
        return context


class CartSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/cart_setting.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.session.get('userId') != '0':
            try:
                cartSettingOptions = get_object_or_404(CartSettingOptions, user_id=self.request.session.get('userId'))
            except:
                cartSettingOptions = None
                checkoutSettingOptions = None
            
            try:
                checkoutSettingOptions = get_object_or_404(CheckoutSettingOptions, user_id=self.request.session.get('userId'))
            except:
                checkoutSettingOptions = None
                
            if cartSettingOptions is None:
                cartSettingOptions = CartSettingOptions()
                self.successMessage = "Saved successfully"
            else:
                self.successMessage = "Updated successfully"
            
            if checkoutSettingOptions is None:
                checkoutSettingOptions = CheckoutSettingOptions()
                   
            cartSettingOptions.user = get_object_or_404(userDetails, id=self.request.session.get('userId'))
            checkoutSettingOptions.user = get_object_or_404(userDetails, id=self.request.session.get('userId'))
            
            if postdata['cartOption'] == 'save_coupon_count':
                cartSettingOptions.coupon_list_count = postdata.get('coupon_count')
                checkoutSettingOptions.coupon_list_count = postdata.get('coupon_count')
                self.responseStatus = True
            
            elif postdata['cartOption'] == 'save_emi':
                cartSettingOptions.emi_eligible = ", ".join(postdata.getlist('bank_list'))
                checkoutSettingOptions.bank_list = ", ".join(postdata.getlist('bank_list'))
                self.responseStatus = True
                
            elif postdata['cartOption'] == 'save_top_msg':
                cartSettingOptions.top_msg = postdata.get('top_msg')
                self.responseStatus = True
                
            elif postdata['cartOption'] == 'save_bottom_msg':
                cartSettingOptions.bottom_msg = postdata.get('bottom_msg')
                self.responseStatus = True
                
            elif postdata['cartOption'] == 'save_estimate_tax':
                cartSettingOptions.estimate_tax = postdata.get('estimate_tax')
                checkoutSettingOptions.estimate_tax = postdata.get('estimate_tax')
                self.responseStatus = True
                
            elif postdata['cartOption'] == 'save_replacement_policy':
                cartSettingOptions.replacement_policy = postdata.get('replacement_policy')
                self.responseStatus = True
                
            elif postdata['cartOption'] == 'save_delivery_charges':
                cartSettingOptions.deliver_type = postdata.get('del_charge')
                cartSettingOptions.delivery_charges = postdata.get('delivery_charges')
                checkoutSettingOptions.deliver_type = postdata.get('del_charge')
                checkoutSettingOptions.delivery_charges = postdata.get('delivery_charges')
                self.responseStatus = True
                
            cartSettingOptions.save()
            checkoutSettingOptions.save()
            
        responseData = super(CartSettingOptionsView, self).get(request, *args, **kwargs)     
        return  responseData            
    
    def get_context_data(self, **kwargs):
        context = super(CartSettingOptionsView, self).get_context_data(**kwargs)
        context['banklist'] = BankList.objects.all()
        context['cart_setting_option'] = CartSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['checkout_setting_option'] = CheckoutSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['pageTitle'] = "Cart Options Setting"
        return context

    
class CheckoutSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/checkout_setting.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.session.get('userId') != '0':
            try:
                checkoutSettingOptions = get_object_or_404(CheckoutSettingOptions, user_id=self.request.session.get('userId'))
            except:
                checkoutSettingOptions = None
            
            try:
                cartSettingOptions = get_object_or_404(CartSettingOptions, user_id=self.request.session.get('userId'))
            except:
                cartSettingOptions = None
                
            if checkoutSettingOptions is None:
                checkoutSettingOptions = CheckoutSettingOptions()
                self.successMessage = "Saved successfully"
            else:
                self.successMessage = "Updated successfully"
            
            if cartSettingOptions is None:
                cartSettingOptions = CartSettingOptions()
                
            checkoutSettingOptions.user = get_object_or_404(userDetails, id=self.request.session.get('userId'))
            cartSettingOptions.user = get_object_or_404(userDetails, id=self.request.session.get('userId'))
                
            if postdata['checkoutOption'] == 'save_coupon_count':
                checkoutSettingOptions.coupon_list_count = postdata.get('coupon_count')
                cartSettingOptions.coupon_list_count = postdata.get('coupon_count')
                self.responseStatus = True
            
            elif postdata['checkoutOption'] == 'save_bank_list':
                checkoutSettingOptions.bank_list = ", ".join(postdata.getlist('bank_list'))
                cartSettingOptions.emi_eligible = ", ".join(postdata.getlist('bank_list'))
                self.responseStatus = True
                
            elif postdata['checkoutOption'] == 'save_estimate_tax':
                checkoutSettingOptions.estimate_tax = postdata.get('estimate_tax')
                cartSettingOptions.estimate_tax = postdata.get('estimate_tax')
                self.responseStatus = True
                
            elif postdata['checkoutOption'] == 'save_delivery_charges':
                checkoutSettingOptions.deliver_type = postdata.get('del_charge')
                checkoutSettingOptions.delivery_charges = postdata.get('delivery_charges')
                cartSettingOptions.deliver_type = postdata.get('del_charge')
                cartSettingOptions.delivery_charges = postdata.get('delivery_charges')
                self.responseStatus = True
                
            checkoutSettingOptions.save()
            cartSettingOptions.save()
            
        responseData = super(CheckoutSettingOptionsView, self).get(request, *args, **kwargs)     
        return  responseData
    
    def get_context_data(self, **kwargs):
        context = super(CheckoutSettingOptionsView, self).get_context_data(**kwargs)
        context['banklist'] = BankList.objects.all()
        context['cart_setting_option'] = CartSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['checkout_setting_option'] = CheckoutSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['pageTitle'] = "Checkout Options Setting"
        return context

    
class ThankUSettingOptionsView(TemplateView):
    template_name = 'ecomadmin/thanku_setting.html'
    successMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.session.get('userId') != '0':
            try:
                thankuSettingOptions = get_object_or_404(ThankUSettingOptions, user_id=self.request.session.get('userId'))
            except:
                thankuSettingOptions = None
                            
            if thankuSettingOptions is None:
                thankuSettingOptions = ThankUSettingOptions()
                self.successMessage = "Saved successfully"
            else:
                self.successMessage = "Updated successfully"
            
            thankuSettingOptions.user = get_object_or_404(userDetails, id=self.request.session.get('userId'))
                
            if postdata['thankuOption'] == 'save_msg':
                thankuSettingOptions.order_msg = postdata.get('order_msg')
                self.responseStatus = True
            
            elif postdata['thankuOption'] == 'save_rules':
                thankuSettingOptions.rules_cancel_order = ", ".join(postdata.getlist('order_rules'))
                self.responseStatus = True
                
            elif postdata['thankuOption'] == 'save_notes':
                thankuSettingOptions.notes = postdata.get('order_notes')
                self.responseStatus = True
            
            thankuSettingOptions.save()
            
        responseData = super(ThankUSettingOptionsView, self).get(request, *args, **kwargs)     
        return  responseData
    
    def get_context_data(self, **kwargs):
        context = super(ThankUSettingOptionsView, self).get_context_data(**kwargs)
        context['banklist'] = BankList.objects.all()
        context['thanku_setting_option'] = ThankUSettingOptions.objects.filter(user_id=self.request.session.get('userId')).first()
        context['pageTitle'] = "Thank You Options Setting"
        return context

# vikrant19-09-2019    
def update_status(request):
    postdata = request.POST.copy()
    response = ''

    try:
        
        orderDetails = get_object_or_404(Order, id=postdata.get("order_id"))
        user_email = orderDetails.user.email

    except:
        orderDetails = None

    order_items = OrderItem.objects.filter(order_id=orderDetails.id)
    for items in order_items:
        depo=items.booking_dt
        date_time_obj = datetime.strptime(depo, '%d/%m/%Y')
        date_depo = date_time_obj - timedelta(days=7)
        
        if orderDetails is not None:

            orderDetails.status = postdata.get("status")
            orderDetails.save()
            import os,inspect
            path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error18.txt"
            file = open(path,"w+")  # to append line use a+ instead of w+              
            file.write(orderDetails.status)
            file.close()
            
            if orderDetails.status=='C':

                from django.core.mail import send_mail
                print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
                subject, from_email, to = 'ORDER STATUS', 'Srishringarr <info@srishringarr.com>', user_email
                html_content = render_to_string('ecomsite/order_confirmed.html', locals())
                text_content = 'This is an important message.'
                #text_content = strip_tags(html_content)
                #html_content = '<p>This is an <strong>important</strong> message.</p>'
                msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
                #msg.attach_alternative(html_content, "ecomsite/oder_status.html")
                msg.attach_alternative(html_content, "text/html")
                msg.send()
            elif orderDetails.status=='S':
                import os,inspect
                path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error20.txt"
                file = open(path,"w+")  # to append line use a+ instead of w+              
                file.write(str(postdata))
                file.close()
                from django.core.mail import send_mail
                print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
                subject, from_email, to = 'ORDER STATUS', 'Srishringarr <info@srishringarr.com>', user_email
                html_content = render_to_string('ecomsite/order_shipped.html', locals())
                text_content = 'This is an important message.'
                #text_content = strip_tags(html_content)
                #html_content = '<p>This is an <strong>important</strong> message.</p>'
                msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
                #msg.attach_alternative(html_content, "ecomsite/oder_status.html")
                msg.attach_alternative(html_content, "text/html")
                msg.send()

            elif orderDetails.status=='D':
                import os,inspect
                path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error20.txt"
                file = open(path,"w+")  # to append line use a+ instead of w+              
                file.write(str(postdata))
                file.close()
                from django.core.mail import send_mail
                print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
                subject, from_email, to = 'ORDER STATUS', 'Srishringarr <info@srishringarr.com>', user_email
                html_content = render_to_string('ecomsite/order_delivered.html', locals())
                text_content = 'This is an important message.'
                #text_content = strip_tags(html_content)
                #html_content = '<p>This is an <strong>important</strong> message.</p>'
                msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
                #msg.attach_alternative(html_content, "ecomsite/oder_status.html")
                msg.attach_alternative(html_content, "text/html")
                msg.send()
            elif orderDetails.status=='X':
                import os,inspect
                path = os.path.dirname(os.path.abspath(inspect.getfile(inspect.currentframe()))) + "/error20.txt"
                file = open(path,"w+")  # to append line use a+ instead of w+              
                file.write(str(postdata))
                file.close()
                from django.core.mail import send_mail
                print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
                subject, from_email, to = 'ORDER STATUS', 'Srishringarr <info@srishringarr.com>', user_email
                html_content = render_to_string('ecomsite/order_cancel.html', locals())
                text_content = 'This is an important message.'
                #text_content = strip_tags(html_content)
                #html_content = '<p>This is an <strong>important</strong> message.</p>'
                msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
                #msg.attach_alternative(html_content, "ecomsite/oder_status.html")
                msg.attach_alternative(html_content, "text/html")
                msg.send()
             
        response = {
            'success' : 'True',
            'strMsg' : 'Order Updated',
        }
    return JsonResponse(response)
    

def update_deposite_entry(request):
    postdata = request.POST.copy()
    response = ''
    try:
        orderDetails = get_object_or_404(Order, id=postdata.get("order_id"))
        user_email = orderDetails.user.email
    except:
        orderDetails = None

    # new new code
    order_items = OrderItem.objects.filter(order_id=orderDetails.id)
    for items in order_items:
        print(items.product_id)
        print(items.product.name)
# end new code
    
    if orderDetails is not None:
        orderDetails.deposite_collect = postdata.get("deposite_collect")
        # orderDetails.deposite_given = postdata.get("deposite_given")
        id = uuid.uuid1()
        # print("888888888888888888888888888888888888888")
        # print("collect_"+str(id)) 
        orderDetails.deposite_collect_id = "collect_"+str(id)+"_dp"
        orderDetails.save()


        from django.core.mail import send_mail
        print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
        subject, from_email, to = 'hello', 'sushant@nucleusads.com', 'info@srishringarr.com'
        html_content = render_to_string('ecomsite/deposite_collect_email.html', locals())
        text_content = strip_tags(html_content)
        html_content = '<p>This is an <strong>important</strong> message.</p>'
        msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
        msg.attach_alternative(html_content, "ecomsite/deposite_collect_email.html")
        msg.send()

        from django.core.mail import send_mail
        print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
        subject, from_email, to = 'hello', 'sushant@nucleusads.com', user_email
        html_content = render_to_string('ecomsite/deposite_collect_email.html', locals())
        text_content = strip_tags(html_content)
        html_content = '<p>This is an <strong>important</strong> message.</p>'
        msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
        msg.attach_alternative(html_content, "ecomsite/deposite_collect_email.html")
        msg.send()
             
    response = {
        'success' : 'True',
        'strMsg' : 'Deposite Dates Updated',
    }
    return JsonResponse(response)


def update_deposite_return_entry(request):
    postdata = request.POST.copy()
    response = ''
    try:
        orderDetails = get_object_or_404(Order, id=postdata.get("order_id"))
        user_email = orderDetails.user.email
    except:
        orderDetails = None

     # new new code
    order_items = OrderItem.objects.filter(order_id=orderDetails.id)
    for items in order_items:
        print(items.product_id)
        print(items.product.name)
    
    if orderDetails is not None:
        orderDetails.deposite_return = postdata.get("deposite_return")
        id = uuid.uuid1()
        orderDetails.deposite_return_id = "return_"+str(id)+"_dp"
        orderDetails.save()
             
        from django.core.mail import send_mail
        print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
        subject, from_email, to = 'hello', 'sushant@nucleusads.com', 'info@srishringarr.com'
        html_content = render_to_string('ecomsite/deposite_return_email.html', locals())
        text_content = strip_tags(html_content)
        html_content = '<p>This is an <strong>important</strong> message.</p>'
        msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
        msg.attach_alternative(html_content, "ecomsite/deposite_return_email.html")
        msg.send()

        from django.core.mail import send_mail
        print("maiiiiiiiiiiiiiiiiiiillllllllllllllllllllllllllllll")
        subject, from_email, to = 'hello', 'sushant@nucleusads.com', user_email
        html_content = render_to_string('ecomsite/deposite_return_email.html', locals())
        text_content = strip_tags(html_content)
        html_content = '<p>This is an <strong>important</strong> message.</p>'
        msg = EmailMultiAlternatives(subject, text_content, from_email, [to])
        msg.attach_alternative(html_content, "ecomsite/deposite_return_email.html")
        msg.send()
             
    response = {
        'success' : 'True',
        'strMsg' : 'Deposite Dates Updated Updated',
    }
    return JsonResponse(response)

