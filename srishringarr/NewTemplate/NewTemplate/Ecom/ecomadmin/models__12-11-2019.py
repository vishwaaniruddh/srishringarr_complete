from django.db import models
from django.urls import reverse
from tinymce.models import HTMLField
from ecomauth.models import userDetails
from multiprocessing.connection import deliver_challenge
from errno import EINPROGRESS
from email.policy import default


class Category(models.Model):        
    name = models.CharField(max_length=50)
    parent = models.ForeignKey('self', on_delete='CASCADING', blank=True, null=True, related_name='child')
    slug = models.SlugField(max_length=50, unique=True, help_text='Unique value for product page url,Created from category name.')
    description = models.TextField()
    is_active = models.BooleanField(default=True)
    is_delete = models.BooleanField(default=False)
    meta_keywords = models.TextField(blank=True, null=True)
    meta_description = models.CharField("Meta Description", max_length=255, help_text="Content for Meta Description")
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)
    commission = models.DecimalField(decimal_places=2, max_digits=9, default='0.0')
    image = models.ImageField(blank=True, upload_to='images/catalog/categories/main', max_length=255)
    thumbnail = models.ImageField(blank=True, upload_to='images/catalog/categories/thumbnail', max_length=255)
    order = models.IntegerField(blank=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    is_rent = models.BooleanField(default=False)
    is_sale = models.BooleanField(default=False)
    
    class Meta:
        db_table = "categories"
        ordering = ['-order']
        verbose_name_plural = 'Categories'
        
    def __str__(self):
        return self.name
    
    def get_absolute_url(self):
        return reverse('catalog:catalog_category', kwargs={'category_slug':self.slug})

# Create your models here.
class Products(models.Model):
    name = models.CharField(max_length=255)
    slug = models.SlugField(max_length=255, unique=True, help_text='Unique value for product page url,Created from category name.')
    sku = models.CharField(max_length=50) 
    mrp = models.CharField(max_length=255,blank=True)
    sale_price = models.CharField(max_length=255,blank=True)
    rent_price = models.CharField(max_length=255,blank=True)
    discount = models.IntegerField(blank=True,default="0")
    # product_image = models.ImageField(blank=True, max_length=255)
    product_image = models.ImageField(blank=True, upload_to='images/catalog/products/main/', max_length=255)
    product_thumb_image_count = models.IntegerField(default=0)
    product_thumb_image = models.CharField(blank=True, max_length=2550)
    is_active = models.BooleanField(default=True)
    is_bestseller = models.BooleanField(default=False)
    is_featured = models.BooleanField(default=False)
    is_delete = models.BooleanField(default=False)
    small_description = HTMLField(blank=True)
    description = HTMLField(blank=True)
    highlights = HTMLField(blank=True)
    services = HTMLField(blank=True)
    specifications = HTMLField(blank=True)
    color = models.CharField(max_length=150, blank=True) 
    size = models.CharField(max_length=50, blank=True)
    categories = models.ForeignKey(Category, on_delete=models.CASCADE)
    specific_for = models.CharField(max_length=50, blank=True)
    brand = models.CharField(max_length=100, blank=True)
    type = models.CharField(max_length=100, blank=True)
    quantity = models.IntegerField(null=True, blank=True, default=1) 
    sleeve = models.CharField(max_length=100, blank=True)
    front_neck = models.CharField(max_length=100, blank=True)
    back_neck = models.CharField(max_length=100, blank=True)
    opening = models.CharField(max_length=100, blank=True)
    fit = models.CharField(max_length=100, blank=True)
    style = models.CharField(max_length=100, blank=True)
    weave_type = models.CharField(max_length=100, blank=True)
    pattern = models.CharField(max_length=100, blank=True)
    embellished = models.CharField(max_length=100, blank=True)
    embroidered = models.CharField(max_length=100, blank=True)
    ocassion = models.CharField(max_length=100, blank=True)
    age_group = models.CharField(max_length=50, blank=True)
    metal_base = models.CharField(max_length=100, blank=True)
    in_the_box = models.CharField(max_length=100, blank=True)
    back_lock = models.CharField(max_length=100, blank=True)
    seller = models.CharField(max_length=255, blank=True)
    designer = models.CharField(max_length=255, blank=True)
    warranty = models.CharField(max_length=255, blank=True)
    fabric_material = models.CharField(max_length=255, blank=True)
    fabric_care = HTMLField(blank=True,max_length=1000)
    dupatta_fabric = models.CharField(max_length=255, blank=True)
    ean_upc = models.CharField(max_length=100, blank=True)
    vat = models.CharField(max_length=100, blank=True)
    product_length = models.CharField(max_length=100, blank=True)
    product_width = models.CharField(max_length=100, blank=True)
    measuring_unit = models.CharField(max_length=255, blank=True)
    dimension_unit = models.CharField(max_length=255, blank=True)
    package_length = models.CharField(max_length=255, blank=True)
    package_width = models.CharField(max_length=255, blank=True)
    package_height = models.CharField(max_length=255, blank=True)
    package_weight = models.CharField(max_length=255, blank=True)
    pack_of = models.CharField(max_length=255, blank=True)
    sales_package = models.CharField(max_length=100, blank=True)
    meta_description = models.TextField(blank=True, null=True)
    meta_keywords = models.TextField(blank=True, null=True)
    disclaimer = models.CharField(max_length=100, blank=True)
    is_rent = models.BooleanField(default=False)
    is_sale = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now=True)
    updated_at = models.DateTimeField(auto_now=True)
    ordering = models.IntegerField(null=True, blank=True)
    bust_size = models.CharField(max_length=255, blank=True)
    waist_size = models.CharField(max_length=255, blank=True)
    hips_size = models.CharField(max_length=255, blank=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    
    class Meta:
        db_table = 'products'
        ordering = ['-created_at']
        verbose_name_plural = 'Products'

    def __str__(self):
        return self.name + " (" + self.sku + ")"
    
    def get_absolute_url(self):   
        return reverse('productdetail', kwargs={'product_slug':self.slug})
    
    def sale_price(self):
        if self.mrp > self.discount:
            return self.discount
        else:
            return None
        
    def final_product_price(self):
        if self.discount > 0:
            discountPrice = (self.mrp * self.discount) / 100
            return (self.mrp - discountPrice)
        else:
            return self.mrp  
          
    def product_saving_price(self):
        if self.discount > 0:
            discountPrice = (self.mrp * self.discount) / 100
            return discountPrice
        else:
            return 0   
        
    def isProductInStock(self):
        if self.quantity > 0:
            return True
        else:
            return False          

        
class ProductsRatings(models.Model):
    ratings = models.CharField(max_length=50, blank=True)
    product = models.ForeignKey(Products, on_delete=models.CASCADE)
    created_at = models.DateTimeField(auto_now_add=True)
    user = models.ForeignKey(userDetails, blank=True, null=True, on_delete=models.CASCADE)
    
    class Meta:
        db_table = 'product_ratings'
        ordering = ['-created_at']
    
    def get_int_ratings(self):
        return int(self.ratings)    

        
class ProductsReviews(models.Model):
    reviews = models.CharField(max_length=5000, blank=True)
    product = models.ForeignKey(Products, on_delete=models.CASCADE)
    created_at = models.DateTimeField(auto_now_add=True)
    user = models.ForeignKey(userDetails, blank=True, null=True, on_delete=models.CASCADE)
    
    class Meta:
        db_table = 'product_reviews'
        ordering = ['-created_at']

        
class HomeSetting(models.Model):        
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)
    slider = models.BooleanField(default=True)
    category_grid = models.BooleanField(default=True)
    top_trending_product = models.BooleanField(default=True)
    top_discount_product = models.BooleanField(default=True)
    top_discount_categories = models.BooleanField(default=True)
    top_selling_product = models.BooleanField(default=True)
    feture_product = models.BooleanField(default=True)
    new_arrivals = models.BooleanField(default=True)
    searchbar = models.BooleanField(default=True)
    cart_symbol = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "home_setting"
        
        
class HomeSettingOptions(models.Model):        
    logo_image = models.ImageField(blank=True, upload_to='images/site/logo/', max_length=255, default="images/site/logo/Ecommerce.png")
    tag_line = models.CharField(max_length=255, default="Store Near You")
    search_options = models.CharField(max_length=255, default="1")
    cart_image = models.ImageField(blank=True, upload_to='images/site/cart_image/', max_length=255, default="images/site/cart_image/cart.jpg")
    manu_type = models.IntegerField(default=0)
    menu_options = models.CharField(max_length=255, default="1, 2, 3, 4, 5, 6, 7")
    footer_options = models.CharField(max_length=255, default="1, 2, 3, 4, 5, 6, 7, 8")
    slider_image_count = models.IntegerField(default=2)
    slider_image = models.CharField(blank=True, max_length=2550, default="d_slider1.jpg,d_slider2.jpg")
    catgrid_col_count = models.IntegerField(default=2)
    top_trend_product_count = models.IntegerField(default=7)
    top_trend_product_options = models.CharField(max_length=255, default="1, 2")
    top_dist_product_count = models.IntegerField(default=7)
    top_dist_product_options = models.CharField(max_length=255, default="1, 2")
    top_dist_cat_count = models.IntegerField(default=7)
    top_dist_cat_options = models.CharField(max_length=255, default="1, 2")
    best_sellers_count = models.IntegerField(default=7)
    best_sellers_options = models.CharField(max_length=255, default="1, 2")
    featured_product_count = models.IntegerField(default=7)
    featured_product_options = models.CharField(max_length=255, default="1, 2")
    new_arri_product_count = models.IntegerField(default=7)
    new_arri_product_options = models.CharField(max_length=255, default="1, 2")
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "home_setting_options"

        
class PDSettingOptions(models.Model):        
    search_options = models.CharField(max_length=255, default="1")
    product_top_message = models.CharField(max_length=1255, default="Dummy Top Message")
    product_bottom_message = models.CharField(max_length=1255, default="Dummy Bottom Message")
    
    by_manufacturer = models.IntegerField(default=7)
    by_manufacturer_options = models.CharField(max_length=255, default="1, 2")
    
    recently_viewed = models.IntegerField(default=7)
    recently_viewed_options = models.CharField(max_length=255, default="1, 2")
    
    goes_well_with = models.IntegerField(default=7)
    goes_well_with_options = models.CharField(max_length=255, default="1, 2")
    
    similar_poducts = models.IntegerField(default=7)
    similar_poducts_options = models.CharField(max_length=255, default="1, 2")
    
    delvery_options = models.CharField(max_length=255)
    emi_options = models.CharField(max_length=255)
    
    interested_products = models.IntegerField(default=7)
    interested_products_options = models.CharField(max_length=255, default="1, 2")
    
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "product_setting_options"
                
        
class ProductListSetting(models.Model):  
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)    
    searchbar = models.BooleanField(default=True)
    cart_symbol = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    filter_by_gender = models.BooleanField(default=True)
    filter_by_category = models.BooleanField(default=True)
    filter_by_price = models.BooleanField(default=True)
    filter_by_discount = models.BooleanField(default=True)
    filter_by_colour = models.BooleanField(default=True)
    filter_by_brands = models.BooleanField(default=True)
    filter_by_reviews = models.BooleanField(default=True)
    filter_by_availability = models.BooleanField(default=True)
    product_by_grid = models.BooleanField(default=True)
    product_by_list = models.BooleanField(default=True)
    grid_and_list = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "produt_list_setting"


class ProductDetailSetting(models.Model):  
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)    
    searchbar = models.BooleanField(default=True)
    cart_symbol = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    prod_name = models.BooleanField(default=True)
    s_review = models.BooleanField(default=True)    
    price = models.BooleanField(default=True)
    discount = models.BooleanField(default=True)
    offer = models.BooleanField(default=True)
    highlights = models.BooleanField(default=True)
    services = models.BooleanField(default=True)
    seller = models.BooleanField(default=True)    
    description = models.BooleanField(default=True)
    specifications = models.BooleanField(default=True)
    prod_brought_together = models.BooleanField(default=True)
    rating_reviews = models.BooleanField(default=True)
    rate_product = models.BooleanField(default=True)
    recent_view = models.BooleanField(default=True)
    manufacture = models.BooleanField(default=True)
    goes_with = models.BooleanField(default=True)
    similar_prod = models.BooleanField(default=True)
    delivery_option = models.BooleanField(default=True)
    emi_option = models.BooleanField(default=True)    
    interested_prod = models.BooleanField(default=True)
    buy_now = models.BooleanField(default=True)
    wishlist = models.BooleanField(default=True)
    top_msg = models.BooleanField(default=True)
    bottom_msg = models.BooleanField(default=True)
    stock = models.BooleanField(default=True)
    size = models.BooleanField(default=True)
    size_chart = models.BooleanField(default=True)
    is_rent = models.BooleanField(default=True)
    color = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "product_details_setting"

                
class CartPageSetting(models.Model):  
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)    
    searchbar = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    title_with_count = models.BooleanField(default=True)
    cart_count = models.BooleanField(default=True)
    image = models.BooleanField(default=True)
    seller_name = models.BooleanField(default=True)
    add_to_wishlist = models.BooleanField(default=True)
    add_from_wishlist = models.BooleanField(default=True)
    continue_shopping = models.BooleanField(default=True)
    check_delivery = models.BooleanField(default=True)
    delivery_charges = models.BooleanField(default=True)
    replacement_policy = models.BooleanField(default=True)
    estimated_tax = models.BooleanField(default=True)
    message_top = models.BooleanField(default=True)
    message_bottom = models.BooleanField(default=True)
    emi_eligibity = models.BooleanField(default=True)
    add_coupon = models.BooleanField(default=True)
    coupon_list = models.BooleanField(default=True)
    empty = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
     
    class Meta:
        db_table = "cart_setting"
        
        
class Cart(models.Model):
    cart_id = models.CharField(max_length=50)
    user = models.ForeignKey(userDetails, blank=True, null=True, on_delete=models.CASCADE)
    product = models.ForeignKey(Products, on_delete=models.CASCADE)
    quantity = models.IntegerField(default=1)
    coupon = models.CharField(max_length=50, unique=False)
    coupon_discount = models.DecimalField(max_digits=9, decimal_places=2, default=0) 
    del_charges = models.IntegerField(default=0)   
    is_rent = models.IntegerField(default=0)
    days_index = models.CharField(max_length=50, unique=False, blank=True, null=True)
    form_date = models.CharField(max_length=250, unique=False, blank=True, null=True)
    to_date = models.CharField(max_length=250, unique=False, blank=True, null=True)
    total_final_price = models.IntegerField(default=0)
    deposite = models.CharField(max_length=100, blank=True, null=True)   
    created_at = models.DateTimeField(auto_now_add=True)
    # vikrant 130920
    bust_size = models.CharField(max_length=255, blank=True,null =True)
    waist_size = models.CharField(max_length=255, blank=True ,null =True)
    hips_size = models.CharField(max_length=255, blank=True,null =True)
    # vikrant 130920
    # sku = models.CharField(max_length=50,blank=True,null=True)

    
    class Meta:
        db_table = "cart_details"
        ordering = ['created_at']   
        
    def __str__(self):
        return self.product.name    
            
    def name(self):
        return self.product.name

    def image(self):
        return self.product.product_thumbnail

    def price(self):
        if self.product_variant:       
            if self.product_variant.discount == 0.00:
                return self.product_variant.mrp
            else:
                return self.product_variant.discount  
        else:
            if self.product.discount == 0.00:
                return self.product.mrp
            else:
                return self.product.discount 
              
    def cart_to_prod_slug(self):
        return self.product.slug

    def augment_quantity(self, quantity):
        self.quantity = self.quantity + int(quantity)
        self.save()        

    def productTotal(self):
        if self.product.discount:
            quantity_total = self.product.final_product_price() * self.quantity
        else:
            quantity_total = self.product.mrp * self.quantity
        return quantity_total
    
       
class CheckoutPageSetting(models.Model):  
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)    
    searchbar = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    billing = models.BooleanField(default=True)
    shipping = models.BooleanField(default=True)
    same_as_billing = models.BooleanField(default=True)
    add_type = models.BooleanField(default=True)
    add_coupon = models.BooleanField(default=True)
    coupon_list = models.BooleanField(default=True)
    order_summary = models.BooleanField(default=True)
    cod = models.BooleanField(default=True)
    paypal = models.BooleanField(default=True)
    citrus = models.BooleanField(default=True)
    netbanking = models.BooleanField(default=True)
    bank_transfer = models.BooleanField(default=True)
    emi = models.BooleanField(default=True)
    wallets = models.BooleanField(default=True)
    phonepe = models.BooleanField(default=True)
    credit_debit = models.BooleanField(default=True)
    new_address = models.BooleanField(default=True)
    chg_login = models.BooleanField(default=True)
    chg_address = models.BooleanField(default=True)
    chg_order = models.BooleanField(default=True)
    del_charge = models.BooleanField(default=True)
    tax = models.BooleanField(default=True)
    discount = models.BooleanField(default=True)
    near_by_you = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
     
    class Meta:
        db_table = "checkout_setting"

        
class StateList(models.Model):
    name = models.CharField(max_length=255)
    code = models.CharField(max_length=20)
    
    class Meta:
        db_table = "statelist"

        
class Address(models.Model):
    name = models.CharField(max_length=100)
    address = models.CharField(max_length=255)
    area = models.CharField(max_length=100)
    city = models.CharField(max_length=100)
    state = models.CharField(max_length=20)
    pin_zip = models.CharField(max_length=50)
    country = models.CharField(max_length=100)
    mobile = models.CharField(max_length=20)
    type = models.CharField(max_length=100)
    same_as_billing = models.BooleanField(default=False)
    deliver_sat = models.BooleanField(default=False)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    latitude = models.CharField(max_length=255, blank=True)
    longitude = models.CharField(max_length=255, blank=True)
    
    class Meta:
        db_table = "address"

        
class Order(models.Model):
    PENDING = 'P'
    CONFIRMED = 'C'
    SHIPPED = 'S'
    DELIVERED = 'D'
    CANCELLED = 'X'
    
    ORDER_STATUSES = ((PENDING, 'Pending'),
                      (CONFIRMED, 'Confirmed'),
                      (SHIPPED, 'Shipped'),
                      (DELIVERED, 'Delivered'),
                      (CANCELLED, 'Cancelled'),)
    
    payment_mode = models.CharField(max_length=50)
    address = models.ForeignKey(Address, on_delete=models.CASCADE)
    total = models.CharField(max_length=100)
    delivery_chgs = models.CharField(max_length=100)
    tax = models.CharField(max_length=100, blank=True)
    # status = models.CharField(choices=ORDER_STATUSES, default=CANCELLED, max_length=2)
    status = models.CharField(choices=ORDER_STATUSES, default=PENDING, max_length=2)
    created_at = models.DateTimeField(auto_now=True)
    updated_at = models.DateTimeField(auto_now=True)
    user = models.ForeignKey(userDetails, related_name="user_id", on_delete=models.CASCADE)
    seller = models.ForeignKey(userDetails, related_name="seller_id", on_delete=models.CASCADE)

    # added by sushant 13/12/2018
    txnid = models.CharField(max_length=100, blank=True, null=True)
    final_deposite = models.CharField(max_length=100, blank=True, null=True)
    deposite_collect = models.CharField(max_length=250, unique=False, blank=True, null=True)
    deposite_return = models.CharField(max_length=250, unique=False, blank=True, null=True)
    deposite_collect_id = models.CharField(max_length=250, unique=True, blank=True, null=True)
    deposite_return_id = models.CharField(max_length=250, unique=True, blank=True, null=True)
    # vikrant 130920
    bust_size = models.CharField(max_length=255, blank=True,null =True)
    waist_size = models.CharField(max_length=255, blank=True ,null =True)
    hips_size = models.CharField(max_length=255, blank=True,null =True)
    # vikrant 130920
    # end
    
    class Meta:
        db_table = "orders"


class OrderItem(models.Model):
    order = models.ForeignKey(Order, on_delete=models.CASCADE)
    product = models.ForeignKey(Products, on_delete=models.CASCADE)
    coupon = models.CharField(max_length=50, blank=True)
    quantity = models.CharField(max_length=10)
    #delivery_dt = models.DateTimeField(auto_now=True)
    delivery_dt = models.CharField(max_length=250)
    subtotal = models.CharField(max_length=100)
    booking_dt = models.CharField(max_length=250,blank=True)
    

        
    class Meta:
        db_table = "order_items"

   
class ThankyouPageSetting(models.Model):  
    logo = models.BooleanField(default=True)
    headline = models.BooleanField(default=True)    
    searchbar = models.BooleanField(default=True)
    menu = models.BooleanField(default=True)
    footer = models.BooleanField(default=True)
    order_msg_txt = models.BooleanField(default=True)
    order_summary = models.BooleanField(default=True)
    order_address = models.BooleanField(default=True)
    delivery_dt = models.BooleanField(default=True)
    cont_shop_btn = models.BooleanField(default=True)
    cancel_rule = models.BooleanField(default=True)
    note = models.BooleanField(default=True)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
     
    class Meta:
        db_table = "thanku_setting"

        
class ProductListSettingOptions(models.Model):        
    search_options = models.CharField(max_length=100, default="1")
    filter_gender = models.CharField(max_length=100, default="Women,Men,Men & Women,Baby,Baby Boys & Baby Girl,Girls,Boys,Boys & Girl")
    filter_category = models.CharField(max_length=100, default=0)
    filter_cattype = models.CharField(max_length=100, default="1,2,0")
    filter_price = models.CharField(max_length=100, default="1,2,3,4,5,6,0")
    filter_discount = models.CharField(max_length=100, default="1,2,3,4,5,6,0")
    filter_color = models.CharField(max_length=100, default=0)
    filter_size = models.CharField(max_length=100, default="XS, S, M, L, XL, XXL")
    filter_brand = models.CharField(max_length=100, default=0)
    filter_stock = models.CharField(max_length=100, default="1,2,0")
    display_list_as = models.CharField(max_length=100, default="1,2,0")
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "prolist_setting_options"
        

class AddtoWishlist(models.Model):
    product = models.ForeignKey(Products, unique=True, on_delete=models.CASCADE)        
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "wishlist"

        
class CartSettingOptions(models.Model):        
    coupon_list_count = models.CharField(max_length=100, default="10")
    emi_eligible = models.CharField(max_length=100, default="1,2,3,4,5,6,7,8,9,10")
    top_msg = models.CharField(max_length=100, default="Dummy Top Message")
    bottom_msg = models.CharField(max_length=100, default="Dummy Bottom Message")
    estimate_tax = models.CharField(max_length=100, default=0)
    replacement_policy = models.CharField(max_length=100, default="Dummy Replacement Policy")
    deliver_type = models.CharField(max_length=100, default="fixed")
    delivery_charges = models.CharField(max_length=100, default=0)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "cart_setting_options"    


class CheckoutSettingOptions(models.Model):   
    coupon_list_count = models.CharField(max_length=100, default="10")
    bank_list = models.CharField(max_length=100, default="1,2,3,4,5,6,7,8,9,10")
    estimate_tax = models.CharField(max_length=100, default=0)
    deliver_type = models.CharField(max_length=100, default="fixed")
    delivery_charges = models.CharField(max_length=100, default=0)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "checkout_setting_options" 

        
class BankList(models.Model):        
    name = models.CharField(max_length=255)
    interest_rate = models.CharField(max_length=100)
    month = models.CharField(max_length=255)
    total = models.CharField(max_length=255)
    
    class Meta:
        db_table = "bank_list"  


# class ThankUSettingOptions(models.Model):        
#     order_msg = models.CharField(max_length=255, default="Dummy message after order placed")
#     rules_cancel_order = models.CharField(max_length=255, default="Dummy rules for cancelling order")
#     notes = models.CharField(max_length=255, default="Dummy notes text")
#     user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
#     class Meta:
#         db_table = "thanku_setting_options"

class ThankUSettingOptions(models.Model):        
    order_msg = models.CharField(max_length=255, default="Your order has been placed")
    rules_cancel_order = models.CharField(max_length=255, default="Rules for cancelling order")
    notes = models.CharField(max_length=255, default="Notes text")
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "thanku_setting_options"


class Offers(models.Model):
    FLAT_VALUE = 'FLT'
    DISCOUNT_VALUE = 'DIST'
    
    ISSUE_METHOD = ((FLAT_VALUE, 'Flat Value'),
                    (DISCOUNT_VALUE, 'Discount'),)
    
    offer_name = models.CharField(max_length=255)
    offer_code = models.CharField(max_length=20)
    offer_slug = models.SlugField(max_length=20)
    seller_ref_code = models.CharField(max_length=20)
    description = models.TextField(blank=True)
    short_description = models.TextField()
    offer_image = models.ImageField(blank=True, upload_to='images/catalog/Offers/', max_length=255)
    is_active = models.BooleanField(default=False)
    is_delete = models.BooleanField(default=False)
    
    offer_type = models.CharField(choices=ISSUE_METHOD, default=DISCOUNT_VALUE, max_length=10)
    product = models.ForeignKey(Products, on_delete=models.CASCADE, blank=True, null=True, help_text="If you select a product which has variants.Then the coupon will be applicable to all it's variants unless you select a product variant from the dropdown below.")
    category = models.ForeignKey(Category, blank=True, on_delete=models.CASCADE, null=True, help_text="If a top level category is selected then the coupon will be applicable to all of the categories under the top level category. e.g. If you select HOME DECOR then the coupon will also be applicable to Sofas, Profile chairs, Coffee tables ... etc.")
    
    offer_value = models.DecimalField(max_digits=9, decimal_places=2, default=0, help_text="Please enter the discount to be applied in percentage value.")
    max_users = models.IntegerField(default=0, help_text="Max number of times the coupon can be redeemed.For unlimited coupon redemptions enter the value 0 ")
    max_per_user = models.IntegerField(default=0, help_text="Max number of times the coupon can be redeemed by a single user.For unlimited coupon redemptions enter the value 0 ")
    exp_date = models.DateTimeField('expiry date', blank=True, null=True, help_text="For unlimited coupon validity leave it blank")
    min_order = models.DecimalField(max_digits=9, decimal_places=2, default=0, help_text="Minimum order for the coupon to be applicable.For no minimum order enter the value 0")
    max_order = models.DecimalField(max_digits=9, decimal_places=2, default=0, help_text="Maximum order for the coupon to be applicable.For no minimum order enter the value 0")
    terms_condition = models.TextField()
   
    last_modified_by = models.ForeignKey(userDetails, on_delete=models.CASCADE, related_name='offer_last_modified_by', blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, null=True)
    updated_at = models.DateTimeField(auto_now=True, null=True)
    customer = models.ForeignKey(userDetails, related_name="customer", blank=True, null=True, on_delete=models.CASCADE)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
     
    class Meta:
        db_table = "offer_details"


class ProductNotify(models.Model):        
    product = models.ForeignKey(Products, on_delete=models.CASCADE)
    user_info = models.CharField(max_length=255, blank=True, null=True)
    user = models.ForeignKey(userDetails, related_name="user", on_delete=models.CASCADE, blank=True, null=True)
    seller = models.ForeignKey(userDetails, related_name="seller", on_delete=models.CASCADE, blank=True, null=True)
    
    class Meta:
        db_table = "product_notify"

        
class Support(models.Model):
    PENDING = '0'
    INPROGRESS = '1'
    CLOSED = '2'
    
    ORDER_STATUSES = ((PENDING, 'Pending'),
                      (INPROGRESS, 'Inprogress'),
                      (CLOSED, 'Closed'),)
    
    fullname = models.CharField(max_length=255)
    mobile = models.CharField(max_length=15)
    email = models.CharField(max_length=255)
    message = models.CharField(max_length=2550)
    status = models.CharField(choices=ORDER_STATUSES, default=PENDING, max_length=2)
    
    class Meta:
        db_table = "support"

        
class Rent(models.Model):
    days = models.CharField(max_length=255)
    percent_value = models.CharField(max_length=100)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    
    class Meta:
        db_table = "rent"
        
class ImportCategory(models.Model):
    name = models.CharField(max_length=255)
    slug = models.CharField(max_length=100)
    desc = models.CharField(max_length=255)
    is_active = models.BooleanField(default=False)
    is_delete = models.BooleanField(default=False)
    meta_keywords = models.TextField(blank=True, null=True)
    meta_desc  = models.TextField(blank=True, null=True)
    commission = models.CharField(max_length=20)
    img = models.CharField(max_length=255)
    thumb_img = models.CharField(max_length=255)
    ordering = models.CharField(max_length=20)
    parent = models.CharField(max_length=100)
    user = models.CharField(max_length=100)
    is_rent = models.BooleanField(default=False)
    is_sale = models.BooleanField(default=False)
    
    class Meta:
        db_table = "import_cat" 


# class VisitorFormDetail(models.Model):
#     fullname = models.CharField(max_length=255)
#     mobile = models.CharField(max_length=20)
#     email = models.CharField(max_length=255)
#     message = models.CharField(max_length=255)
#     is_active = models.BooleanField(default=False)
#     is_delete = models.BooleanField(default=False)
#     created_at = models.DateTimeField(auto_now_add=True, null=True)
#     updated_at = models.DateTimeField(auto_now=True, null=True)
    
#     class Meta:
#         db_table = "visitor_form" 
