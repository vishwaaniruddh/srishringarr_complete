from django.contrib import admin
from .models import  Category, Products , HomeSetting, ProductListSetting, ProductDetailSetting,CartPageSetting, CheckoutPageSetting,\
    ThankyouPageSetting, HomeSettingOptions,ProductListSettingOptions,Cart,Address,Order,OrderItem,AddtoWishlist,\
    PDSettingOptions, CartSettingOptions, BankList,ProductsRatings,ProductsReviews,StateList,Offers

# Register your models here.
admin.site.register(Category)
admin.site.register(Products)
admin.site.register(HomeSetting)
admin.site.register(HomeSettingOptions)
admin.site.register(ProductListSetting)
admin.site.register(ProductListSettingOptions)
admin.site.register(ProductDetailSetting)
admin.site.register(PDSettingOptions)
admin.site.register(CartPageSetting)
admin.site.register(CartSettingOptions)
admin.site.register(CheckoutPageSetting)
admin.site.register(ThankyouPageSetting)
admin.site.register(Cart)
admin.site.register(Address)
admin.site.register(Order)
admin.site.register(OrderItem)
admin.site.register(AddtoWishlist)
admin.site.register(ProductsRatings)
admin.site.register(ProductsReviews)
admin.site.register(Offers)
admin.site.register(StateList)
admin.site.register(BankList)

