from django.conf.urls import url
# from userLogin.views import userAuthentication
from . import views
from django.contrib.auth.views import logout
from ecomadmin.admin_decorator import check_redirect
from ecomadmin import import_data

urlpatterns = [
    url(r'^site-settings/$', check_redirect(views.site_settingView.as_view()), name='site-settings'),
    url(r'^dashboard/$', check_redirect(views.DashBoardView.as_view()), name='dashboard'),
    url(r'^products/$', check_redirect(views.ProductsView.as_view()), name='products'),
    url(r'^customers/$', check_redirect(views.CustomerView.as_view()), name='Customers'),
    url(r'^customers-profile/(?P<user_id>\d+)/$', check_redirect(views.CustomerProfile.as_view()), name='CustomerProfile'),
    url(r'^offers/$', check_redirect(views.OffersView.as_view()), name='offers'),
    url(r'^orders/$', check_redirect(views.OrdersView.as_view()), name='orders'),
    url(r'^order_detail/(?P<order_id>\d+)/$', check_redirect(views.OrderDetailsView.as_view()), name='order_detail'),
    url(r'^home_options/$', views.HomeSettingOptionsView.as_view(), name='home_options'),
    url(r'^product_list_options/$', views.ProductListSettingOptionsView.as_view(), name='product_list_options'),
    url(r'^product-details-setting/$', views.ProductDetailSettingOptionsView.as_view(), name='product_detail_options'),
    url(r'^addproducts/(?P<product_id>\d+)/$', check_redirect(views.AddProductsView.as_view()), name='addproducts'),
    url(r'^category/$', check_redirect(views.CategoryView.as_view()), name='category'),
    url(r'^addcategory/(?P<cat_id>\d+)/$', check_redirect(views.AddCategoryView.as_view()), name='addcategory'),
    url(r'^addoffer/(?P<offer_id>\d+)/$', check_redirect(views.AddOffersView.as_view()), name='addoffer'),
    url(r'^madmin/logout/', logout, {'next_page': '/madmin/login'}, name='logout'),
    url(r'^delete_product/', views.deleteProduct, name='delete_product'),
    url(r'^delete_category/', views.deleteCategory, name='delete_category'),
    url(r'^cart_options/$', views.CartSettingOptionsView.as_view(), name='cart_options'),
    url(r'^checkout_options/$', views.CheckoutSettingOptionsView.as_view(), name='checkout_options'),
    url(r'^thanku_options/$', views.ThankUSettingOptionsView.as_view(), name='thanku_options'),
    url(r'^update_status/$', views.update_status, name='update_status'),
    url(r'^import/$', import_data.ImportData.as_view(), name='import'),
    url(r'^update_deposite_entry/$', views.update_deposite_entry, name='update_deposite_entry'),
    url(r'^update_deposite_return_entry/$', views.update_deposite_return_entry, name='update_deposite_return_entry'),
]
