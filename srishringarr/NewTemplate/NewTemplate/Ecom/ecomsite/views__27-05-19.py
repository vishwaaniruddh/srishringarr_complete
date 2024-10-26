from django.shortcuts import render, render_to_response
from django.http.response import HttpResponseRedirect
from django.views.generic import TemplateView
from django.urls import reverse
from ecomauth.models import userDetails
from ecomadmin.models import Cart, Support
from ecomsite import user_cart 
from django.db.models import Q
from django.shortcuts import get_object_or_404
from ecomadmin.models import ProductsReviews, ProductsRatings, PDSettingOptions, HomeSettingOptions, Order, Cart, \
BankList, OrderItem, Products , HomeSetting, ProductListSetting, Category, StateList, ProductDetailSetting, CartPageSetting, \
 Address, CheckoutPageSetting, ThankyouPageSetting, ProductListSettingOptions, CartSettingOptions, ThankUSettingOptions, \
 CheckoutSettingOptions, AddtoWishlist, ProductNotify, Support, Rent
from ecomsite.app_setting import getUserID
from django.db import connection
from django.http.response import HttpResponseRedirect, JsonResponse
from django.contrib.auth.hashers import make_password, check_password
from django.core.paginator import Paginator, EmptyPage, PageNotAnInteger
from Ecom.settings import PAYU_INFO, RAZORPAY_INFO
import time
import hashlib
from django.views.decorators.csrf import csrf_protect, csrf_exempt
import numpy as np

import razorpay

STRIP_WORDS = ['a', 'an', 'and', 'by', 'for', 'from', 'in', 'no', 'not',
               'of', 'on', 'or', 'that', 'the', 'to', 'with']


def _prepare_words(q):
    words = q.split()
    for common in STRIP_WORDS:
        if common in words:
            words.remove(common)
    return words[0:5]


# Create your views here.
class Home(TemplateView):
    template_name = 'ecomsite/index.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
            print("********************")
            print(strValue)
            
        responseData = super(Home, self).get(request, *args, **kwargs)
        return responseData 

    
    def get_context_data(self, **kwargs):
        context = super(Home, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        
        context['product_count'] = Products.objects.filter(is_active=True, is_delete=False, user=getUserID()).count()         
        # context['product_list'] = Products.objects.filter(is_active=True, is_delete=False, user=getUserID())[:10]
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(is_active=True, user=getUserID())
        context['cat_list'] = cat_list
        cat_list_p = Category.objects.filter(user=getUserID(), is_active=True, parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        context['pageTitle'] = "Shopping Portel"
        return context

    
# Create your views here.
class UnderConstruction(TemplateView):
    template_name = 'ecomsite/underconstruction.html'
    
    def get_context_data(self, **kwargs):
        context = super(UnderConstruction, self).get_context_data(**kwargs)
        try:
            context['user'] = get_object_or_404(userDetails, id=getUserID())
        except:
            context['user'] = None
        context['pageTitle'] = "Shopping Portel"
        return context     

     
def dictfetchall(cursor):
    "Return all rows from a cursor as a dict"
    columns = [col[0] for col in cursor.description]
    return [
        dict(zip(columns, row))
        for row in cursor.fetchall()
    ]


class ProducListingView(TemplateView):
    template_name = 'ecomsite/productlisting.html'
    genderFilterBy = '' 
    catFilterBy = '' 
    priceFilterBy = '' 
    discountFilterBy = ''
    colorFilterBy = ''
    brandFilterBy = ''
    sizeFilterBy = ''
    stockFilterBy = ''
    product_list = ''
    paginate_by = 20
    sortBy = '0'

    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        catId = postdata.get('catId')
        subcatArr = getSubCats(catId)
        self.catFilterBy = ", ".join(postdata.getlist('categoryOption'))
        self.genderFilterBy = ", ".join(postdata.getlist('genderOption'))
        self.colorFilterBy = ", ".join(postdata.getlist('colorOption'))
        self.brandFilterBy = ", ".join(postdata.getlist('brandOption'))
        self.sizeFilterBy = ", ".join(postdata.getlist('sizeOption'))
        self.priceFilterBy = ", ".join(postdata.getlist('priceOption'))
        self.discountFilterBy = ", ".join(postdata.getlist('discountOption'))
        self.stockFilterBy = ", ".join(postdata.getlist('stockOption'))
        self.sortBy = postdata.get('sorting')
        if self.catFilterBy:
            categoryData = "`categories_id` IN (" + ', '.join(repr(e) for e in postdata.getlist('categoryOption')) + ")"
        else:
            categoryData = "`categories_id` IN (" + ', '.join(repr(e.id) for e in subcatArr) + ")"       
        if self.genderFilterBy:
            genderData = "`specific_for` IN (" + ', '.join(repr(e) for e in postdata.getlist('genderOption')) + ")"
        else:
            genderData = True
        if self.colorFilterBy:
            if '0' in postdata.getlist('colorOption'):
                colorData = True
            else:
                colorData = "`color` IN (" + ', '.join(repr(e) for e in postdata.getlist('colorOption')) + ")"
        else:
            colorData = True
        if self.brandFilterBy:
            if '0' in postdata.getlist('brandOption'):
                brandData = True
            else:
                brandData = "`brand` IN (" + ', '.join(repr(e) for e in postdata.getlist('brandOption')) + ")"
        else:
            brandData = True
        sizeDataArr = []
        if self.sizeFilterBy:
            if '0' in postdata.getlist('sizeOption'):
                sizeData = True
            else:
                for sizeResult in postdata.getlist('sizeOption'):
                    sizeQuery = "FIND_IN_SET(" + sizeResult + ",`size`)"
                    sizeDataArr.append(sizeQuery)
            sizeData = ' OR '.join(sizeDataArr)
        else:
            sizeData = True
        if self.priceFilterBy:
            priceQuery = ""
            for plist in postdata.getlist('priceOption'):
                if priceQuery == '':
                    if '0-0' in plist:
                        priceQuery = True
                    else:
                        priceQuery = priceQuery + str("`mrp` BETWEEN " + plist.split("-")[0] + " AND " + plist.split("-")[1])
                elif priceQuery != '': 
                    if '0-0' in plist:
                        priceQuery = True
                    else:
                        priceQuery = priceQuery + str(" OR `mrp` BETWEEN " + plist.split("-")[0] + " AND " + plist.split("-")[1])
            priceData = priceQuery
        else:
            priceData = True
        if self.discountFilterBy:
            discountQuery = ""
            for dlist in postdata.getlist('discountOption'):
                if discountQuery == '':
                    if '0' in dlist:
                        discountQuery = True
                    else:
                        if '9' in dlist:
                            discountQuery = discountQuery + str("(`discount`/`mrp`)*100 <= 10")
                        else:
                            discountQuery = discountQuery + str("(`discount`/`mrp`)*100 >= " + dlist)
                elif discountQuery != '':
                    if '0' in dlist:
                        discountQuery = True
                    else:
                        if '9' in dlist:
                            discountQuery = discountQuery + str(" OR (`discount`/`mrp`)*100 <= 10")
                        else:
                            discountQuery = discountQuery + str(" OR (`discount`/`mrp`)*100 >= " + dlist)
            discountData = discountQuery
        else:
            discountData = True
        if self.stockFilterBy:
            stockQuery = ""
            if stockQuery == '':
                if '0' in postdata.getlist('stockOption'):
                    stockQuery = True
                else:
                    if '1' in postdata.getlist('stockOption'):
                        stockQuery = stockQuery + str("quantity != 0")
                    elif '2' in postdata.getlist('stockOption'):
                        stockQuery = stockQuery + str("quantity = 0")
            elif stockQuery != '':
                if '0' in postdata.getlist('stockOption'):
                    stockQuery = True
                else:
                    if '1' in postdata.getlist('stockOption'):
                        stockQuery = stockQuery + str(" OR quantity != 0")
                    elif '2' in postdata.getlist('stockOption'):
                        stockQuery = stockQuery + str(" OR quantity = 0")
            stockData = stockQuery
        else:
            stockData = True
        
        if postdata.get('sorting') != '0':
            if postdata.get('sorting') == '1':
                sortData = "ORDER BY `mrp` ASC"
            elif postdata.get('sorting') == '2':
                sortData = "ORDER BY `mrp` DESC"
            else:
                sortData = "AND True" 
        else:
            sortData = "AND True"
                    
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            urlVar = '/search?stxt='+strValue
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:
                return HttpResponseRedirect(urlVar) 
        
        cursor = connection.cursor()
        print('++++++++++++++++++++++++++++++')
#         print(genderData)
        print(''' SELECT *,(`discount`/`mrp`)*100 AS percent FROM `products` WHERE {0} AND is_active=True AND is_delete=False AND user_id={1} AND {2} AND {3} AND {4} AND ({5}) AND ({6}) AND ({7}) AND ({8}) {9} '''.format(categoryData, getUserID(), genderData, colorData, brandData, sizeData, priceData, discountData, stockData, sortData))
        print('++++++++++++++++++++++++++++++')
        cursor.execute(''' SELECT *,(`discount`/`mrp`)*100 AS percent FROM `products` WHERE {0} AND is_active=True AND is_delete=False AND user_id={1} AND {2} AND {3} AND {4} AND ({5}) AND ({6}) AND ({7}) AND ({8}) {9} '''.format(categoryData, getUserID(), genderData, colorData, brandData, sizeData, priceData, discountData, stockData, sortData))
        self.product_list = dictfetchall(cursor)

        responseData = super(ProducListingView, self).get(request, *args, **kwargs)
        return responseData 
            
    def get_context_data(self, **kwargs):
        context = super(ProducListingView, self).get_context_data(**kwargs)
        cat_id = self.kwargs['cat_id']
        
        cursor = connection.cursor()
        subcatArr = getSubCats(cat_id)
        context['sub_cats'] = subcatArr

        try:
            catObj = Category.objects.filter(is_active=True,is_delete=False)
        except:
            catObj = None

        context['categories'] = catObj
        
        context['product_count'] = Products.objects.filter(categories_id__in=subcatArr, is_active=True, is_delete=False, user_id=getUserID()).count()
        
        if self.genderFilterBy == '' and self.catFilterBy == '' and self.priceFilterBy == '' and self.discountFilterBy == '' and self.colorFilterBy == '' and self.brandFilterBy == '' and self.sizeFilterBy == '' and self.stockFilterBy == '' and self.sortBy == "0":
            context['product_list'] = Products.objects.filter(categories_id__in=subcatArr, is_active=True, is_delete=False, user_id=getUserID()).order_by('-sku')
        else:
            context['product_list'] = self.product_list
        context['wishlist'] = AddtoWishlist.objects.filter(user=self.request.session.get('site_userId'))  
        paginator = Paginator(context['product_list'], self.paginate_by)
        page = self.request.GET.get('page')
        
        try:
            currentPage = paginator.page(page)
        except PageNotAnInteger:
            currentPage = paginator.page(1)
        except EmptyPage:
            currentPage = paginator.page(paginator.num_pages)
        
        if self.sortBy != "0":
            context['sort'] = self.sortBy
        
        context['current_page'] = currentPage

        context['gender_filter'] = self.genderFilterBy
        context['cat_filter'] = self.catFilterBy
        context['price_filter'] = self.priceFilterBy
        context['discount_filter'] = self.discountFilterBy
        context['color_filter'] = self.colorFilterBy
        context['brand_filter'] = self.brandFilterBy
        context['size_filter'] = self.sizeFilterBy
        context['stock_filter'] = self.stockFilterBy
        # selected filter
        list_setting = ProductListSetting.objects.filter(user_id=getUserID()).first()
        context['prolist_seting_option'] = ProductListSettingOptions.objects.filter(user_id=getUserID()).first()
        context['list_setting'] = list_setting
        context['isLogo'] = list_setting.logo
        context['isTagline'] = list_setting.headline
        context['isMenu'] = list_setting.menu
        context['isSearchBar'] = list_setting.searchbar
        context['isCart'] = list_setting.cart_symbol 
        context['isFooter'] = list_setting.footer
        context['cat_list'] = Category.objects.filter(user_id=getUserID())
        catIds = ', '.join(repr(e.id) for e in subcatArr)

        cursor.execute(''' SELECT * FROM `products` WHERE `categories_id` IN ({0}) AND is_active=True AND is_delete=False AND user_id={1} GROUP BY brand '''.format(catIds, getUserID()))
        context['brand'] = dictfetchall(cursor)

        cursor.execute(''' SELECT * FROM `products` WHERE `categories_id` IN ({0}) AND is_active=True AND is_delete=False AND user_id={1} GROUP BY color '''.format(catIds, getUserID()))
        context['color'] = dictfetchall(cursor)
        
        cursor.execute(''' SELECT size FROM `products` WHERE `categories_id` IN ({0}) AND is_active=True AND is_delete=False AND user_id={1} GROUP BY size '''.format(catIds, getUserID()))
        context['sizes'] = dictfetchall(cursor)
        
        allSize = []
        for size in context['sizes']:
            sizes = size['size'].split(',')
            for sizeResult in sizes:
                allSize.append(sizeResult)
        context['splitsizes'] = np.unique(allSize)
        
        context['pageTitle'] = "Product Listing"
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        return context
    

def getSubCats(cat_id):
    if cat_id == '0':
        cat = Category.objects.filter(is_active=True, is_delete=False)
    else:
        cat = Category.objects.filter(parent_id=cat_id)
    
    if cat.count() == 0:
        subcatArr = []
        main_cat = Category.objects.filter(id=cat_id)
        subcatArr = main_cat
    
    if cat.count() > 0:
        subcatArr = ''
        for sc in cat:
            level = Category.objects.filter(parent_id=sc.id)
            if level.count() > 0:
                subcatArr = level
            else:
                subcatArr = cat
    return subcatArr

    
class ProducDetailView(TemplateView):
    template_name = 'ecomsite/productdetail.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        prod_slug = self.kwargs['product_slug']
        
        if request.POST.get('product_details') == 'Check':
            if postdata.get('pincode'):
                request.session['pincode'] = postdata.get('pincode')
        
        elif request.POST.get('product_details') == 'Notify Me':
            productDetails = get_object_or_404(Products, slug=prod_slug)
            try:
                product_notify = get_object_or_404(ProductNotify, user_id=request.session.get('site_userId'), product_id=productDetails.id)
            except:
                product_notify = None
                
            if product_notify is None:
                product_notify = ProductNotify()
            product_notify.product = get_object_or_404(Products, slug=prod_slug)
            try:
                product_notify.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
            except:
                product_notify.user = None
            product_notify.seller = get_object_or_404(userDetails, id=getUserID())
            if postdata.get('user_info'):
                product_notify.user_info = postdata.get('user_info')
            product_notify.save()
            
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
                
        responseData = super(ProducDetailView, self).get(request, *args, **kwargs)
        return responseData
    
    def get_context_data(self, **kwargs):
        context = super(ProducDetailView, self).get_context_data(**kwargs)
        prod_slug = self.kwargs['product_slug']
        context['product_count'] = Products.objects.filter(is_active=True, is_delete=False, user=getUserID()).count()
        context['all_product_list'] = Products.objects.filter(is_active=True, is_delete=False, user=getUserID())
        productDetails =  Products.objects.filter(slug=prod_slug, is_active=True, is_delete=False, user=getUserID()).first()
        context['product_details'] = productDetails
        product = Products.objects.filter(slug=prod_slug, is_active=True, is_delete=False, user=getUserID()).first()
        context['ratings'] = ProductsRatings.objects.filter(product=product).count()
        productRatingList = ProductsRatings.objects.filter(product=product)
        
        totalRatings = 0
        for ratings in productRatingList:
            totalRatings = totalRatings + ratings.get_int_ratings()
        context['cart_setting_option'] = CartSettingOptions.objects.filter(user=getUserID()).first()
        if self.request.session.get('pincode') != 0:
            context['distance'] = user_cart.calculateDistance(self.request.session.get('pincode'))
            context['delivery_charge'] = user_cart.calculateDeliveryCharge(self.request.session.get('pincode'), context['cart_setting_option'])
        else:
            context['delivery_charge'] = 0 
            context['distance'] = 0   
        context['avg_ratings'] = (totalRatings / (productRatingList.count())) if totalRatings > 0 else  0
        context['reviews'] = ProductsReviews.objects.filter(product=product).count()
        context['reviews_list'] = ProductsReviews.objects.filter(product=product)
     
        prod_detail_setting = ProductDetailSetting.objects.filter(user=getUserID()).first()
        context['product_details_options'] = PDSettingOptions.objects.filter(user=getUserID()).first()
        
        context['prod_detail_setting'] = prod_detail_setting
        context['isLogo'] = prod_detail_setting.logo
        context['isTagline'] = prod_detail_setting.headline
        context['isMenu'] = prod_detail_setting.menu
        context['isSearchBar'] = prod_detail_setting.searchbar
        context['isCart'] = prod_detail_setting.cart_symbol 
        context['isFooter'] = prod_detail_setting.footer
        context['pageTitle'] = "Shopping Portel"
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
            context['cart_details'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request),product_id = productDetails.id).first()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
            context['cart_details'] = Cart.objects.filter(user=self.request.session.get('site_userId'),product_id = productDetails.id).first()
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
         
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list 
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        context['rent_details'] = Rent.objects.filter(user=getUserID()).first()
        
        return context

    
class CartView(TemplateView):
    template_name = 'ecomsite/cart.html'
    successMessage = ''
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.POST.get('cart_form_btn') == 'REMOVE': 
            Cart.objects.filter(product_id=postdata.get('pid'), cart_id=postdata.get('cid')).delete()
            self.successMessage = "Product has been removed from Cart!"
        
        elif request.POST.get('cart_form_btn') == 'Clear Cart':
            # if request.session.get('site_userId') == '0' or request.session.get('site_userId') == None:
            Cart.objects.filter(cart_id=postdata.get('cid')).delete()
            self.successMessage = "Cart has been cleared!"
        
        elif request.POST.get('cart_form_btn') == 'Add from wishlist':
            return HttpResponseRedirect(reverse('wishlist'))  
        
        elif request.POST.get('cart_form_btn') == 'CONTINUE SHOPPING':
            return HttpResponseRedirect(reverse('index'))
        
        elif request.POST.get('cart_form_btn') == 'PROCEED TO CHECKOUT':
            return HttpResponseRedirect(reverse('checkout'))  
        
        elif request.POST.get('cart_form_btn') == 'Check':
            if postdata.get('pincode'):
                request.session['pincode'] = postdata.get('pincode')
        
        elif request.POST.get('cart_form_btn') == 'Apply Coupon':
            coupon_code = postdata.get('coupon_code')
            msg = user_cart.check_coupon_validity(request, coupon_code)
            print('+++++++++++++++++++++++++++++++++')
            print(msg)
        
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
                        
        responseData = super(CartView, self).get(request, *args, **kwargs)
        return responseData
    
    def get_context_data(self, **kwargs):
        context = super(CartView, self).get_context_data(**kwargs)
        cartCount = 0
        cartList = None

        if self.request.session.get('site_userId') == '0' or self.request.session.get('site_userId') == None:
            cartCount = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            cartList = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            cartCount = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            cartList = Cart.objects.filter(user=self.request.session.get('site_userId'))
        
        context['cart_count'] = cartCount
        context['cart_list'] = cartList
        
        context['cart_setting_option'] = CartSettingOptions.objects.filter(user=getUserID()).first()
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        context['cart_total'] = cart_calculations['cart_total']
        if cartList:
            context['coupon_code'] = cartList[0].coupon
        else:
            context['coupon_code'] = ''    
        
        if self.request.session.get('pincode') != 0:
            context['distance'] = user_cart.calculateDistance(self.request.session.get('pincode'))
            context['delivery_charge'] = user_cart.calculateDeliveryCharge(self.request.session.get('pincode'), context['cart_setting_option'])
        cart_setting = CartPageSetting.objects.filter(user=getUserID()).first()
        context['banklist'] = BankList.objects.all()
        context['cart_setting'] = cart_setting
        context['isLogo'] = cart_setting.logo
        context['isTagline'] = cart_setting.headline
        context['isMenu'] = cart_setting.menu
        context['isFooter'] = cart_setting.footer
        context['isSearchBar'] = cart_setting.searchbar
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Cart"
        context['successMessage'] = self.successMessage
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        context['rent_details'] = Rent.objects.filter(user=getUserID()).first()
        return context


def logConsole(dataValue):
    print('+++++++++++++++++++++')
    print('')
    print(dataValue)
    print('')
    print('++++++++++++++++++++++++++')

class CheckoutView(TemplateView):
    template_name = 'ecomsite/checkout.html'
    allStateList = StateList.objects.all()
    successMessage = ''
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        dCharges = 0
        if request.POST.get('checkout') == 'Submit':
            try:
                add = get_object_or_404(Address, user=request.session.get('site_userId'))
            except:
                add = None
                
            if add is None:
                add = Address()   
                self.successMessage = "Setting saved successfully"
            else:
                self.successMessage = "Setting updated successfully"         
        
            add.name = postdata['ba_full_name']
            add.address = postdata['ba_address']
            add.area = postdata['ba_area']
            add.city = postdata['ba_city']
            add.state = postdata['ba_state']
            add.pin_zip = postdata['ba_pinzip']
            add.country = postdata['ba_country']
            add.mobile = postdata['ba_mobile']
            add.type = postdata['addressType']
            if request.POST.get('deliver'):
                add.deliver_sat = True
            else:
                add.deliver_sat = False
            if request.POST.get('same_as'):
                add.same_as_billing = True
            else:
                add.same_as_billing = False
            add.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
            add.save()
            request.session['pincode'] = postdata['ba_pinzip']
        
        elif request.POST.get('checkout') == 'Place Order':
            order = Order()
            order.payment_mode = postdata['payment_mode']
            try:
                add = get_object_or_404(Address, user=request.session.get('site_userId'))
            except:
                add = None

            order.address = add
            cart_calculations = user_cart.cartCalculations(self.request)
            if postdata['ba_pinzip'] != 0:
                try:
                    cart_setting_o = CartSettingOptions.objects.filter(user=getUserID()).first()
                except:
                    cart_setting_o = None
                if  cart_setting_o is not None:   
                    dCharges = user_cart.calculateDeliveryCharge(postdata['ba_pinzip'], cart_setting_o)
            
            order.total = cart_calculations['cart_total']
            order.delivery_chgs = dCharges
            order.status = 'X'
            order.tax = cart_setting_o.estimate_tax
            order.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
            order.seller = get_object_or_404(userDetails, id=getUserID())
            order.save()
            
            cartList = Cart.objects.filter(user=self.request.session.get('site_userId'))
            for cartData in cartList: 
                orderitem = OrderItem()
                orderitem.order = order
                
                currentProduct = get_object_or_404(Products, id=cartData.product.id)
                
                orderitem.product = currentProduct
                orderitem.quantity = cartData.quantity
                orderitem.subtotal = cartData.quantity * cartData.product.mrp
                
                currentProduct.quantity = currentProduct.quantity - cartData.quantity
               
                currentProduct.save()
                orderitem.save()
                cartData.delete()
                # Products.objects.filter(id=postdata.get('product_id')).delete()
            if order.payment_mode == 'cod':
                update_order_status(order.id)
                return HttpResponseRedirect(reverse('thank_you', kwargs={'order_id': order.id}))
            else:
                return HttpResponseRedirect(reverse('payu_payment', kwargs={'postdata': 'PayUPayment', 'order_id': order.id}))
    
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
            
        responseData = super(CheckoutView, self).get(request, *args, **kwargs)     
        return  responseData 
    
    def get_context_data(self, **kwargs):
        context = super(CheckoutView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Checkout Page"
        context['allStateList'] = self.allStateList
        userAdderss = Address.objects.filter(user=self.request.session.get('site_userId')).first()
        chkSetting = CheckoutPageSetting.objects.filter(user=getUserID()).first()
        context['checkout_setting'] = chkSetting
        context['cart_setting_option'] = CartSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = chkSetting.logo
        context['isTagline'] = chkSetting.headline
        context['isMenu'] = chkSetting.menu
        context['isSearchBar'] = chkSetting.searchbar
        context['isFooter'] = chkSetting.footer 
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        cartCount = 0
        context['api_key']= RAZORPAY_INFO["api_key"]

        if self.request.session.get('site_userId') == '0' or self.request.session.get('site_userId') == None:
            cartCount = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            cartCount = Cart.objects.filter(user=self.request.session.get('site_userId')).count()

        context['cart_count'] = cartCount

        context['add'] = userAdderss
        if userAdderss:
            self.request.session['pincode'] = userAdderss.pin_zip
            
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        context['cart_total'] = cart_calculations['cart_total']
        
        if self.request.session.get('pincode') != 0:
            context['distance'] = user_cart.calculateDistance(self.request.session.get('pincode'))
            context['delivery_charge'] = user_cart.calculateDeliveryCharge(self.request.session.get('pincode'), context['cart_setting_option'])
        context['successMessage'] = self.successMessage
        context['banklist'] = BankList.objects.all()
        context['checkout_setting_option'] = CheckoutSettingOptions.objects.filter(user=getUserID()).first()
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        return context  

    
class ThankyouView(TemplateView):
    template_name = 'ecomsite/thank_you.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
            
        responseData = super(ThankyouView, self).get(request, *args, **kwargs)
        return responseData 
    
    def get_context_data(self, **kwargs):
        context = super(ThankyouView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Thank you Page"
        self.request.session['order_id'] = ''
        thanku_setting = ThankyouPageSetting.objects.filter(user=getUserID()).first()
        context['thanku_setting_option'] = ThankUSettingOptions.objects.filter(user=getUserID()).first()
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = ''
        context['isCart'] = ''
        context['isFooter'] = '' 
        context['thanku_setting'] = thanku_setting
        context['pageTitle'] = "Thank You"
        
        order_id = self.kwargs['order_id']
        order = Order.objects.filter(id=order_id).first()
        orderProduct = OrderItem.objects.filter(order=order_id)
        context['orderItems'] = orderProduct
        context['orderData'] = order
        
        return context 

    
class AboutUsView(TemplateView):
    template_name = 'ecomsite/about_us.html'
    
    def get_context_data(self, **kwargs):
        context = super(AboutUsView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "About Us"
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        return context    


class TermsOfUseView(TemplateView):
    template_name = 'ecomsite/terms_of_use.html'
    
    def get_context_data(self, **kwargs):
        context = super(TermsOfUseView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']             
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Terms Of Use"
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        return context   


class PrivacyPolicyView(TemplateView):
    template_name = 'ecomsite/privacy_policy.html'
    
    def get_context_data(self, **kwargs):
        context = super(PrivacyPolicyView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']             
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Privacy Policy"
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        return context   
    
    
class EnquiryView(TemplateView):
    template_name = 'ecomsite/enquiry.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        if request.POST.get('send_enquiry') == 'Submit':
            support = Support()   
          
            support.fullname = postdata['e_full_name']
            support.email = postdata['e_email']
            support.mobile = postdata['e_mobile']
            support.message = postdata['e_subject']
            support.save()
      
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
            
        responseData = super(EnquiryView, self).get(request, *args, **kwargs)     
        return  responseData     
    
    def get_context_data(self, **kwargs):
        context = super(EnquiryView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0' and self.request.session.get('site_userId') != None:
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']             
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Enquiry"
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        
        if self.request.session.get('site_userId') != '0' and self.request.session.get('site_userId') != None:
            userData = get_object_or_404(userDetails, id=self.request.session.get('site_userId'))
            context['userData'] = userData
        else:
            context['userData'] = ''    
        return context   
    
    
class TakeATourView(TemplateView):
    template_name = 'ecomsite/take_a_tour.html'
    
    def get_context_data(self, **kwargs):
        context = super(TakeATourView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list        
        context['pageTitle'] = "Take A Tour"
        return context               

    
class FaqsView(TemplateView):
    template_name = 'ecomsite/faqs.html'
    
    def get_context_data(self, **kwargs):
        context = super(FaqsView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list        
        context['pageTitle'] = "FAQs"
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        return context       


class ContactUsView(TemplateView):
    template_name = 'ecomsite/contact_us.html'
    
    def get_context_data(self, **kwargs):
        context = super(ContactUsView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']          
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Contact Us"
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        return context   

    
class UserProfileView(TemplateView):
    template_name = 'ecomsite/user_profile.html'
    
    def get_context_data(self, **kwargs):
        context = super(UserProfileView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']          
        
        context['user_details'] = userDetails.objects.filter(id=self.request.session.get('site_userId')).first()
        context['user_address'] = Address.objects.filter(user_id=self.request.session.get('site_userId'))
        context['wishlist_count'] = AddtoWishlist.objects.filter(user_id=self.request.session.get('site_userId')).count()
        context['total_order_count'] = Order.objects.filter(user=self.request.session.get('site_userId')).count()
        context['pending_order_count'] = Order.objects.filter(status="P", user=self.request.session.get('site_userId')).count()
        context['confirm_order_count'] = Order.objects.filter(status="C", user=self.request.session.get('site_userId')).count()
        context['cancel_order_count'] = Order.objects.filter(status="X", user=self.request.session.get('site_userId')).count()
        
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "User Profile"
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        return context      

    
class NotificationView(TemplateView):
    template_name = 'ecomsite/notification.html'
    
    def get_context_data(self, **kwargs):
        context = super(NotificationView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "Notifications"
        return context         


class LoginView(TemplateView):
    template_name = 'ecomsite/login.html'
    strMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        userAllData = userDetails.objects.filter(Q(email=request.POST['username']) | Q(password=make_password(request.POST['password'])))
        if userAllData:
            userdata = userDetails.objects.filter(email=request.POST['username']).first()
            self.strMessage = "Logged in Successfully"
            self.responseStatus = True
            request.session['site_isUserLogin'] = True
            request.session['site_userId'] = userdata.id
            cartList = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
            if cartList:
                user_cart.update_userid_in_cart_login(self.request)
            return HttpResponseRedirect(reverse('site_home'))
        else:
            self.strMessage = "Do not have an account?"
            self.responseStatus = False
            request.session['site_isUserLogin'] = False
            request.session['site_userId'] = '0'
            
        rseponseData = super(LoginView, self).get(request, *args, **kwargs)  
        return rseponseData
    
    def get_context_data(self, **kwargs):
        context = super(LoginView, self).get_context_data(**kwargs)
        self.request.session['pincode'] = 0
        context['successMessage'] = self.strMessage
        context['pageTitle'] = "Login"
        context['status'] = self.responseStatus
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        return context  

    
class SignUPView(TemplateView):
    template_name = 'ecomsite/signup.html'
    strMessage = ''
    responseStatus = False

    def post(self, request, *args, **kwargs):
        isValid = True
        emailID = request.POST['userEmailId'].strip()
        mobileNumber = request.POST['userMobile'].strip()
        userAllData = userDetails.objects.filter(Q(email=emailID) | Q(mobile=mobileNumber))
        userMerchant = userDetails.objects.filter(Q(email=emailID) | Q(mobile=mobileNumber), user_group=0)
            
        if userAllData:
            if userMerchant:
                self.strMessage = "User already present as merchant. Please Login"
            else:
                self.strMessage = "User already present. Please Login"
            isValid = False
        else:
            if True  if request.POST['userName'].strip() == '' else False :
                self.strMessage = "Enter user name."
                isValid = False
            elif True  if request.POST['userPassword'].strip() == '' else False :
                self.strMessage = "Password required"
                isValid = False
            elif True  if request.POST['userMobile'].strip() == '' else False :
                self.strMessage = "Enter valid mobile number"
                isValid = False
            elif True  if request.POST['userEmailId'].strip() == '' else False :
                self.strMessage = "Enter valid email address"
                isValid = False
            
        if isValid:
            userData = userDetails()
            userData.username = request.POST['userName']
            userData.password = make_password(request.POST['userPassword'])
            userData.mobile = request.POST['userMobile']
            userData.email = request.POST['userEmailId']
            userData.user_group = 1
            userData.save() 
            self.strMessage = "Account created Successfully"
            self.responseStatus = True
            return HttpResponseRedirect(reverse('site_login'))

        rseponseData = super(SignUPView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(SignUPView, self).get_context_data(**kwargs)
        context['successMessage'] = self.strMessage
        context['status'] = self.responseStatus
        context['pageTitle'] = "Sign Up"
        if self.request.session.get('site_userId') == '0' or self.request.session.get('site_userId') == None:
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        return context

    
def add_to_wishlist(request):
    postdata = request.POST.copy()
    response = ''
    
    if request.session.get('site_userId') == '0' or request.session.get('site_userId') == None:
        response = {
            'success' : 'False',
            'strMsg' : 'Please login to proceed!',
        }
    else:
        try:
            wishlist = get_object_or_404(AddtoWishlist, product_id=postdata.get('product_id'), user_id=request.session.get('site_userId'))
        except:
            wishlist = None
            
        if wishlist is not None:
            AddtoWishlist.objects.filter(product_id=postdata.get('product_id'), user_id=request.session.get('site_userId')).delete()
            response = {
                'success' : 'True',
                'strMsg' : 'Product removed from wishlist',
            }
        else:
            wishlist = AddtoWishlist()
            wishlist.product = get_object_or_404(Products, id=postdata.get('product_id'))
            wishlist.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
            wishlist.save()
             
            response = {
                'success' : 'True',
                'strMsg' : 'Product added to wishlist',
            }
    return JsonResponse(response)


class WishListView(TemplateView):
    template_name = 'ecomsite/wishlist.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if postdata['clear_wishlist'] == 'Clear Wishlist':
            AddtoWishlist.objects.filter(user_id=request.session.get('site_userId')).delete()
            
        responseData = super(WishListView, self).get(request, *args, **kwargs)
        return responseData
    
    def get_context_data(self, **kwargs):
        context = super(WishListView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        wishlist = AddtoWishlist.objects.filter(user=self.request.session.get('site_userId'))
        
        board = []
        for w in wishlist:
            board.append(w.product.id)
        productList = board
        context['wishlist'] = wishlist
        context['product_list'] = Products.objects.filter(id__in=productList, is_active=True, is_delete=False, user=getUserID())
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['pageTitle'] = "Wish List"
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        return context

    
class OrderListView(TemplateView):
    template_name = 'ecomsite/orders.html'
    
    def get_context_data(self, **kwargs):
        context = super(OrderListView, self).get_context_data(**kwargs)
        order = Order.objects.filter(user=self.request.session.get('site_userId'))
        orderid = []
        for data in order:
            orderid.append(data.id)
            
        context['order_item_list'] = OrderItem.objects.filter(order__in=(orderid))
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['pageTitle'] = "My Orders"
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list        
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
   
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        return context

    
class OrderDetailsView(TemplateView):
    template_name = 'ecomsite/order_details.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'home'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:        
                return HttpResponseRedirect(reverse('search', kwargs={'stxt': strValue}))
            
        responseData = super(OrderDetailsView, self).get(request, *args, **kwargs)
        return responseData 
    
    def get_context_data(self, **kwargs):
        context = super(OrderDetailsView, self).get_context_data(**kwargs)
        thanku_setting = ThankyouPageSetting.objects.filter(user=getUserID()).first()
        context['thanku_setting_option'] = ThankUSettingOptions.objects.filter(user=getUserID()).first()
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['thanku_setting'] = thanku_setting
        context['pageTitle'] = "Order Details"
        
        order_id = self.kwargs['order_id']
        order = Order.objects.filter(id=order_id).first()
        orderProduct = OrderItem.objects.filter(order=order_id)
        context['orderItems'] = orderProduct
        context['orderData'] = order
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list        
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']
        
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        
        return context 


class TrackOrderView(TemplateView):
    template_name = 'ecomsite/track_order.html'
    
    def get_context_data(self, **kwargs):
        context = super(TrackOrderView, self).get_context_data(**kwargs)
        wishlist = AddtoWishlist.objects.filter(user=self.request.session.get('site_userId'))
        
        board = []
        for w in wishlist:
            board.append(w.product.id)
        productList = board
        
        context['product_list'] = Products.objects.filter(id__in=productList, is_active=True, is_delete=False, user=getUserID())
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['pageTitle'] = "Track My Orders"
        return context    

   
class SearchView(TemplateView):
    template_name = 'ecomsite/search.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if request.POST.get('searchbtn') == 'Search':
            request.session['page'] = 'search'
            try:
                strValue = postdata.get('searchtxt')
            except:
                strValue = ''
            urlVar = '/search?stxt='+strValue
            
            if strValue == '':
                return HttpResponseRedirect(reverse('empty_search')) 
            else:
                return HttpResponseRedirect(urlVar) 
                        
        responseData = super(SearchView, self).get(request, *args, **kwargs)
        return responseData
        
    def get_context_data(self, **kwargs):
        context = super(SearchView, self).get_context_data(**kwargs)
        try:
            stxt = self.request.GET.get('stxt')
        except:
            stxt = ''    
                
#         rtxt = stxt.strip().replace("'", "")
#         matchtxt = _prepare_words(rtxt)
#         newtxt1 = (" ".join(str(x) for x in matchtxt))
#         newtxt = newtxt1.strip("!@#$%^&*()|?")
        context['result'] = searchTxt(self.request, stxt)
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['pageTitle'] = "Search"
        cat_list = Category.objects.filter(is_active=True, user=getUserID())
        context['cat_list'] = cat_list
        cat_list_p = Category.objects.filter(is_active=True, user=getUserID(), parent=None)
        context['cat_list_p'] = cat_list_p
        try:
            sellerAddress = Address.objects.filter(user=getUserID()).first() 
        except:
            sellerAddress = None
    
        context['address'] = sellerAddress
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
            context['cart_list'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request))
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
            context['cart_list'] = Cart.objects.filter(user=self.request.session.get('site_userId'))
         
        cart_calculations = user_cart.cartCalculations(self.request)
        context['product_total'] = cart_calculations['product_total']          

        return context


def searchTxt(request, newtxt):
    search_dict = {}
    if newtxt:
        cursor = connection.cursor()
        if request.session.get('page') == 'home' or request.session.get('page') == 'search' or request.session.get('page') == 'cart' or request.session.get('page') == 'checkout':
            homeOptions = get_object_or_404(HomeSettingOptions, user_id=getUserID())
            if homeOptions.search_options == "1" or homeOptions.search_options == "1, 2, 3, 4, 5, 6" or homeOptions.search_options == "2, 3, 4, 5, 6":
                searchBy = 'all'
            elif homeOptions.search_options == "2":
                searchBy = '2'
            elif homeOptions.search_options == "3":
                searchBy = '3'
            elif homeOptions.search_options == "4":
                searchBy = '4'
            elif homeOptions.search_options == "5":
                searchBy = '5'
            elif homeOptions.search_options == "6":
                searchBy = '6'
        elif request.session.get('page') == 'prolist':
            prolistOptions = get_object_or_404(ProductListSettingOptions, user_id=getUserID())
            if prolistOptions.search_options == "1" or homeOptions.search_options == "1, 2, 3, 4, 5, 6" or homeOptions.search_options == "2, 3, 4, 5, 6":
                searchBy = 'all'
            elif prolistOptions.search_options == "2":
                searchBy = '2'
            elif prolistOptions.search_options == "3":
                searchBy = '3'
            elif prolistOptions.search_options == "4":
                searchBy = '4'
            elif prolistOptions.search_options == "5":
                searchBy = '5'
            elif prolistOptions.search_options == "6":
                searchBy = '6'
        elif request.session.get('page') == 'prodetails':
            prodetailsOptions = get_object_or_404(PDSettingOptions, user_id=getUserID())
            if prodetailsOptions.search_options == "1" or homeOptions.search_options == "1, 2, 3, 4, 5, 6" or homeOptions.search_options == "2, 3, 4, 5, 6":
                searchBy = 'all'
            elif prodetailsOptions.search_options == "2":
                searchBy = '2'
            elif prodetailsOptions.search_options == "3":
                searchBy = '3'
            elif prodetailsOptions.search_options == "4":
                searchBy = '4'
            elif prodetailsOptions.search_options == "5":
                searchBy = '5'
            elif prodetailsOptions.search_options == "6":
                searchBy = '6'
            
        if searchBy == "all":
            search_dict['display'] = 0
            cursor.execute(''' SELECT * FROM `categories` AS c 
                            WHERE c.user_id = {0} AND c.is_active = 1 AND (c.name LIKE '%{1}%' OR c.slug LIKE '%{1}%' OR c.description LIKE '%{1}%' OR c.meta_keywords LIKE '%{1}%' OR c.meta_description LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['category_list'] = dictfetchall(cursor)
            
            cursor.execute(''' SELECT * FROM `products` AS p 
                            WHERE p.user_id = {0} AND p.is_active = 1 AND (p.name LIKE '%{1}%' OR p.slug LIKE '%{1}%' OR p.sku LIKE '%{1}%' OR p.small_description LIKE '%{1}%' OR p.description LIKE '%{1}%' OR p.specific_for LIKE '%{1}%' OR p.brand LIKE '%{1}%' OR p.size LIKE '%{1}%' OR p.highlights LIKE '%{1}%' OR p.services LIKE '%{1}%' OR p.specifications LIKE '%{1}%' OR p.meta_keywords LIKE '%{1}%' OR p.meta_description LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['product_list'] = dictfetchall(cursor)
            
            cursor.execute(''' SELECT * FROM `offer_details` AS o 
                            WHERE o.user_id = {0} AND o.is_active = 1 AND (o.offer_name LIKE '%{1}%' OR o.offer_code LIKE '%{1}%' OR o.offer_slug LIKE '%{1}%' OR o.seller_ref_code LIKE '%{1}%' OR o.description LIKE '%{1}%' OR o.short_description LIKE '%{1}%' OR o.terms_condition LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['offer_list'] = dictfetchall(cursor)
            
            search_dict['cat_count'] = len(search_dict['category_list'])
            search_dict['prod_count'] = len(search_dict['product_list'])
            search_dict['offer_count'] = len(search_dict['offer_list'])
        elif searchBy == "2":
            search_dict['display'] = 1
            cursor.execute(''' SELECT * FROM `products` AS p 
                            WHERE p.user_id = {0} AND p.is_active = 1 AND (p.name LIKE '%{1}%' OR p.slug LIKE '%{1}%' OR p.sku LIKE '%{1}%' OR p.small_description LIKE '%{1}%' OR p.description LIKE '%{1}%' OR p.specific_for LIKE '%{1}%' OR p.brand LIKE '%{1}%' OR p.size LIKE '%{1}%' OR p.highlights LIKE '%{1}%' OR p.services LIKE '%{1}%' OR p.specifications LIKE '%{1}%' OR p.meta_keywords LIKE '%{1}%' OR p.meta_description LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['product_list'] = dictfetchall(cursor)
            search_dict['prod_count'] = len(search_dict['product_list'])
        elif searchBy == "3":
            search_dict['display'] = 1
            cursor.execute(''' SELECT * FROM `products` AS p 
                            WHERE p.user_id = {0} AND p.is_active = 1 AND p.discount != 0 AND (p.name LIKE '%{1}%' OR p.slug LIKE '%{1}%' OR p.sku LIKE '%{1}%' OR p.small_description LIKE '%{1}%' OR p.description LIKE '%{1}%' OR p.specific_for LIKE '%{1}%' OR p.brand LIKE '%{1}%' OR p.size LIKE '%{1}%' OR p.highlights LIKE '%{1}%' OR p.services LIKE '%{1}%' OR p.specifications LIKE '%{1}%' OR p.meta_keywords LIKE '%{1}%' OR p.meta_description LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['product_list'] = dictfetchall(cursor)
            search_dict['prod_count'] = len(search_dict['product_list'])
        elif searchBy == "4":
            search_dict['display'] = 2
            cursor.execute(''' SELECT * FROM `categories` AS c 
                            WHERE c.user_id = {0} AND c.is_active = 1 AND (c.name LIKE '%{1}%' OR c.slug LIKE '%{1}%' OR c.description LIKE '%{1}%' OR c.meta_keywords LIKE '%{1}%' OR c.meta_description LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['category_list'] = dictfetchall(cursor)
            search_dict['cat_count'] = len(search_dict['category_list'])
        elif searchBy == "5":
            search_dict['display'] = 3
            cursor.execute(''' SELECT * FROM `offer_details` AS o 
                            WHERE o.user_id = {0} AND o.is_active = 1 AND (o.offer_name LIKE '%{1}%' OR o.offer_code LIKE '%{1}%' OR o.offer_slug LIKE '%{1}%' OR o.seller_ref_code LIKE '%{1}%' OR o.description LIKE '%{1}%' OR o.short_description LIKE '%{1}%' OR o.terms_condition LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['offer_list'] = dictfetchall(cursor)
            search_dict['offer_count'] = len(search_dict['offer_list'])
        elif searchBy == "6":
            search_dict['display'] = 1
            cursor.execute(''' SELECT * FROM `products` AS p 
                            WHERE p.user_id = {0} AND p.is_active = 1 AND (p.brand LIKE '%{1}%') '''.format(getUserID(), newtxt))
            search_dict['product_list'] = dictfetchall(cursor)
            search_dict['prod_count'] = len(search_dict['product_list'])
        else:
            search_dict['cat_count'] = 0
            search_dict['prod_count'] = 0
            search_dict['offer_count'] = 0
    else:
        search_dict = []
        
    return search_dict


class EditProfileView(TemplateView):
    template_name = 'ecomsite/edit_profile.html'
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        
        if postdata['edit_profile'] == 'Save':
            try:
                user_details = get_object_or_404(userDetails, id=self.request.session.get('site_userId'))
            except:
                user_details = None
        if user_details != None:
            user_details.full_name = postdata.get('fullname')
            user_details.mobile = postdata.get('mobile')
            user_details.save()
            return HttpResponseRedirect(reverse('user_profile'))
            
        responseData = super(EditProfileView, self).get(request, *args, **kwargs)
        return responseData
    
    def get_context_data(self, **kwargs):
        context = super(EditProfileView, self).get_context_data(**kwargs)
        if self.request.session.get('site_userId') != '0':
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count()
        else:
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count()
        
        context['user_details'] = userDetails.objects.filter(id=self.request.session.get('site_userId')).first()
        
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        cat_list = Category.objects.filter(user=getUserID())
        context['cat_list'] = cat_list
        context['pageTitle'] = "User Profile"
        return context


class AddressView(TemplateView):
    template_name = 'ecomsite/address.html'

    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        aid = kwargs['address_id']
        if aid == '0':
            addressObj = Address()
        else:
            addressObj = get_object_or_404(Address, id=aid)
        
        addressObj.name = postdata.get('ba_full_name')
        addressObj.address = postdata.get('ba_address')
        addressObj.area = postdata.get('ba_area')
        addressObj.city = postdata.get('ba_city')
        addressObj.state = postdata.get('ba_state')
        addressObj.pin_zip = postdata.get('ba_pinzip')
        addressObj.country = postdata.get('ba_country')
        addressObj.mobile = postdata.get('ba_mobile')
        addressObj.type = postdata.get('addressType')
        if request.POST.get('deliver'):
            addressObj.deliver_sat = True
        else:
            addressObj.deliver_sat = False
        addressObj.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
        addressObj.save()
        return HttpResponseRedirect(reverse('user_profile'))
        
        responseData = super(AddressView, self).get(request, *args, **kwargs)     
        return  responseData    
    
    def get_context_data(self, **kwargs):
        context = super(AddressView, self).get_context_data(**kwargs)
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
        aid = self.kwargs['address_id']
        
        if aid != '0':
            context['address'] = get_object_or_404(Address, id=aid)
        else:
            context['address'] = ''
        
        context['home_setting'] = homeSettng
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first()
        context['isLogo'] = homeSettng.logo
        context['isTagline'] = homeSettng.headline
        context['isMenu'] = homeSettng.menu
        context['isSearchBar'] = homeSettng.searchbar
        context['isCart'] = homeSettng.cart_symbol
        context['isFooter'] = homeSettng.footer 
        context['allStateList'] = StateList.objects.all()
        return context

    
def payUpayment(request, postdata, order_id):
    posted = {}
    order_info = Order.objects.latest('id')
    for i in request.POST:
        posted[i] = request.POST[i]
    
    ts = int(time.time())  
    txnid = str(ts) + "XX" + str(order_id)
    hashh = ''
    order_info.txnid = txnid
    order_info.save()
    request.session['order_id'] = order_id
    posted['txnid'] = order_info.txnid
    hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10"
    posted['key'] = PAYU_INFO.get('merchant_key')
    posted['amount'] = order_info.total
    posted['firstname'] = order_info.address.name
    posted['email'] = order_info.user.email
    posted['phone'] = order_info.address.mobile
    posted['productinfo'] = order_info.user
    posted['surl'] = PAYU_INFO.get('success_url')
    posted['furl'] = PAYU_INFO.get('failuer_url')
        
    hash_string = ''
    hashVarsSeq = hashSequence.split('|')
    print("******************")
    print(hashVarsSeq)
    print("******************")
    for i in hashVarsSeq:
        try:
            hash_string += str(posted[i])
        except Exception:
            hash_string += ''
        hash_string += '|'
    hash_string += PAYU_INFO.get('merchant_salt')
    hashh = hashlib.sha512(hash_string.encode(encoding='utf_8', errors='strict')).hexdigest().lower()
    action = PAYU_INFO.get('payment_url')
    if(posted.get("key") != None and posted.get("txnid") != None and posted.get("productinfo") != None and posted.get("firstname") != None and posted.get("email") != None):
        return render(request, 'PayU/payUform.html', {"posted":posted,
                                                                                  "hashh":hashh, "MERCHANT_KEY":PAYU_INFO.get('merchant_key'),
                                                                                  "txnid":txnid, "hash_string":hash_string,
                                                                                  "action":action
                                                                                  })
    else:
        return render(request, 'PayU/payUform.html', {"posted":posted, "hashh":hashh, "MERCHANT_KEY":PAYU_INFO.get('merchant_key'), "txnid":txnid, "hash_string":hash_string, "action":"." })


@csrf_protect

@csrf_exempt
def success(request):
    status = request.POST["status"]
    firstname = request.POST["firstname"]
    amount = request.POST["amount"]
    txnid = request.POST["txnid"]
    posted_hash = request.POST["hash"]
    key = request.POST["key"]
    productinfo = request.POST["productinfo"]
    email = request.POST["email"]
    salt = PAYU_INFO.get('merchant_salt')
    try:
        additionalCharges = request.POST["additionalCharges"]
        retHashSeq = additionalCharges + '|' + salt + '|' + status + '|||||||||||' + email + '|' + firstname + '|' + productinfo + '|' + amount + '|' + txnid + '|' + key
    except Exception:
        retHashSeq = salt + '|' + status + '|||||||||||' + email + '|' + firstname + '|' + productinfo + '|' + amount + '|' + txnid + '|' + key
    hashh = hashlib.sha512(retHashSeq.encode(encoding='utf_8', errors='strict')).hexdigest().lower()
    if(hashh != posted_hash):
        print ("Invalid Transaction. Please try again")
    else:
        
        try:
            check_txnid = get_object_or_404(Order, user_id=request.session.get('site_userId'), txnid=txnid)
        except:
            check_txnid = None
        if check_txnid == None:    
            update_order_status(request.session.get('order_id'))
        print ("Thank You. Your order status is ", status)
        print ("Your Transaction ID for this transaction is ", txnid)
        print ("We have received a payment of Rs. ", amount , ". Your order will soon be shipped.")
    return HttpResponseRedirect(reverse('thank_you', kwargs={'order_id': request.session.get('order_id')}))


@csrf_protect
@csrf_exempt
def failure(request):
    c = {}
    dataValue = 'this is data'
    status = request.POST["status"]
    firstname = request.POST["firstname"]
    amount = request.POST["amount"]
    txnid = request.POST["txnid"]
    posted_hash = request.POST["hash"]
    key = request.POST["key"]
    productinfo = request.POST["productinfo"]
    email = request.POST["email"]
    salt = PAYU_INFO.get('merchant_salt')
    homeSettng = HomeSetting.objects.filter(user=getUserID()).first()
    home_setting = homeSettng
    home_seting_option = HomeSettingOptions.objects.filter(user=getUserID()).first()
    isLogo = homeSettng.logo
    isTagline = homeSettng.headline
    isMenu = homeSettng.menu
    isSearchBar = homeSettng.searchbar
    isCart = homeSettng.cart_symbol
    isFooter = homeSettng.footer 
    allStateList = StateList.objects.all()
    try:
        additionalCharges = request.POST["additionalCharges"]
        retHashSeq = additionalCharges + '|' + salt + '|' + status + '|||||||||||' + email + '|' + firstname + '|' + productinfo + '|' + amount + '|' + txnid + '|' + key
    except Exception:
        retHashSeq = salt + '|' + status + '|||||||||||' + email + '|' + firstname + '|' + productinfo + '|' + amount + '|' + txnid + '|' + key
    hashh = hashlib.sha512(retHashSeq.encode(encoding='utf_8', errors='strict')).hexdigest().lower()
    if(hashh != posted_hash):
        print ("Invalid Transaction. Please try again")
    else:
        try:
            check_txnid = get_object_or_404(Order, user_id=request.session.get('site_userId'), txnid=txnid)
        except:
            check_txnid = None
        if check_txnid == None:    
            print("something went wrong!")
        print ("Thank You. Your order status is ", status)
        print ("Your Transaction ID for this transaction is ", txnid)
        print ("We have received a payment of Rs. ", amount , ". Your order will soon be shipped.")
    return render_to_response(request, "PayU/failure.html", c, locals())


def update_order_status(order_id):
    try:
        order = get_object_or_404(Order, id=order_id)
    except:
        order = None
    if order != None:
        order.status = 'P'
        order.save()
        
class SubCategory(TemplateView): 
    template_name = 'ecomsite/subcategory.html' 
     
    def get_context_data(self, **kwargs): 
        context = super(SubCategory, self).get_context_data(**kwargs) 
        pid = self.kwargs['cat_id'] 
        if self.request.session.get('site_userId') != '0': 
            context['cart_count'] = Cart.objects.filter(cart_id=user_cart._cart_id(self.request)).count() 
        else: 
            context['cart_count'] = Cart.objects.filter(user=self.request.session.get('site_userId')).count() 
             
        homeSettng = HomeSetting.objects.filter(user=getUserID()).first() 
        context['home_setting'] = homeSettng 
        context['home_seting_option'] = HomeSettingOptions.objects.filter(user=getUserID()).first() 
        context['isLogo'] = homeSettng.logo 
        context['isTagline'] = homeSettng.headline 
        context['isMenu'] = homeSettng.menu 
        context['isSearchBar'] = homeSettng.searchbar 
        context['isCart'] = homeSettng.cart_symbol 
        context['isFooter'] = homeSettng.footer  
        cat_list = Category.objects.filter(user=getUserID(), is_active=True) 
        context['cat_list'] = cat_list         
        context['pageTitle'] = "FAQs" 
        cat_list_p = Category.objects.filter(user=getUserID(), parent=None) 
        sub_cat_list = Category.objects.filter(user=getUserID(), parent=pid, is_active=1) 
        context['cat_list_p'] = cat_list_p 
        context['sub_cat_list'] = sub_cat_list 
        try: 
            sellerAddress = Address.objects.filter(user=getUserID()).first()  
        except: 
            sellerAddress = None 
     
        context['address'] = sellerAddress 
        return context

# added by sushant razorpay 13/12/2018
def rezorPaySuccess(request):
    payment_id = request.POST["pay_id"]

    print("1111111111111111")
    print(payment_id)

    client = razorpay.Client(auth=(RAZORPAY_INFO["test_api_key"], RAZORPAY_INFO["test_secret_key"]))

    payment_response = client.payment.fetch(payment_id)
    
    if str(payment_response["status"]) == "authorized":
        cart_calculations = user_cart.cartCalculations(request)
        cart_amount = cart_calculations["cart_total"]
        cart_amount_in_paise = round(cart_amount * 100, 2)
        
        # delete cart details
        cartList = Cart.objects.filter(user=request.session.get('site_userId'))
        for cartData in cartList:
            cartData.delete() 

        print("2222222222222222")
        print(payment_response["amount"])
        print(cart_amount_in_paise)
        print(cart_calculations)
        if str(payment_response["amount"]) == str(cart_amount_in_paise):
            print("3333333333333333333")
            capture_response = client.payment.capture(payment_id, cart_amount_in_paise)

            order_id = request.session.get('order_id')
            print(order_id)
            # order_info = Order.objects.latest('id')
            order_info = get_object_or_404(Order,id=order_id)
            print("444444444444444444")
            print(payment_id)
            # ts = int(time.time())  
            # txnid = str(ts) + "XX" + str(order_id)
            txnid = payment_id
            order_info.txnid = txnid
            order_info.save()


        payment_dict={'order_id': request.session.get('order_id')}

    return HttpResponseRedirect(reverse('thank_you', kwargs=payment_dict))

def placeOrder(request):
    order = Order()
    order.payment_mode = request.POST['payment_mode']
    ba_pinzip = request.POST['ba_pinzip']

    try:
        add = get_object_or_404(Address, user=request.session.get('site_userId'))
    except:
        add = None

    order.address = add
    cart_calculations = user_cart.cartCalculations(request)
    if ba_pinzip != 0:
        try:
            cart_setting_o = CartSettingOptions.objects.filter(user=getUserID()).first()
        except:
            cart_setting_o = None
        if  cart_setting_o is not None:   
            dCharges = user_cart.calculateDeliveryCharge(ba_pinzip, cart_setting_o)
    
    order.total = cart_calculations['cart_total']
    order.delivery_chgs = dCharges
    order.status = 'P'
    order.tax = cart_setting_o.estimate_tax
    order.user = get_object_or_404(userDetails, id=request.session.get('site_userId'))
    order.seller = get_object_or_404(userDetails, id=getUserID())
    order.save()

    request.session['order_id'] = order.id
    
    cartList = Cart.objects.filter(user=request.session.get('site_userId'))
    for cartData in cartList: 
        orderitem = OrderItem()
        orderitem.order = order
        
        currentProduct = get_object_or_404(Products, id=cartData.product.id)
        
        orderitem.product = currentProduct
        orderitem.quantity = cartData.quantity
        orderitem.subtotal = cartData.quantity * cartData.product.mrp
        
        currentProduct.quantity = currentProduct.quantity - cartData.quantity
       
        currentProduct.save()
        orderitem.save()
        # cartData.delete()

    response = {'success':'true',
                'order_id':order.id ,             
                }
    return JsonResponse(response)   

# razorpay end