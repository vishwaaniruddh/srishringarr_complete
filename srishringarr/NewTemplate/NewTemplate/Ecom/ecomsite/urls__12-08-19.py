from django.conf.urls import url
# from userLogin.views import userAuthentication
from . import views
from ecomsite import user_cart
from ecomsite import common 
from django.contrib.auth.views import logout
from ecomsite.site_decorator import is_publish_site,is_error_site,is_login

urlpatterns = [
    url(r'^$', is_publish_site(views.Home.as_view()), name='site_home'),
    url(r'^cart/$', views.CartView.as_view(), name='cart'),
    url(r'^checkout/$', is_login(views.CheckoutView.as_view()), name='checkout'),
    url(r'^terms-of-use/$', views.TermsOfUseView.as_view(), name='terms_of_use'),
    url(r'^privacy-policy/$', views.PrivacyPolicyView.as_view(), name='privacy_policy'),
    url(r'^about-us/$', views.AboutUsView.as_view(), name='about_us'),
    url(r'^enquiry/$', views.EnquiryView.as_view(), name='enquiry'),
    url(r'^take-a-tour/$', views.TakeATourView.as_view(), name='take_a_tour'),
    url(r'^faqs/$', views.FaqsView.as_view(), name='faqs'),
    url(r'^contact-us/$', views.ContactUsView.as_view(), name='contact_us'),
    url(r'^user-profile/$', is_login(views.UserProfileView.as_view()), name='user_profile'),
    url(r'^notification/$', is_login(views.NotificationView.as_view()), name='notification'),
    url(r'^action_add_to_cart/$',user_cart.add_to_cart , name='action_add_to_cart'),
    url(r'^action_update_cart/$',user_cart.update_cart , name='action_update_cart'),
    url(r'^action_add_reviews/$',common.add_user_reviews, name='action_add_reviews'),
    url(r'^action_add_ratings/$',common.add_user_ratings, name='action_add_ratings'),   
    url(r'^list/(?P<cat_id>\d+)/$', views.ProducListingView.as_view(), name='catprodlist'),
    url(r'^thank_you/(?P<order_id>\d+)/$', is_login(views.ThankyouView.as_view()), name='thank_you'),
    url(r'^order-details/(?P<order_id>\d+)/$', is_login(views.OrderDetailsView.as_view()), name='order_details'),
    url(r'^detail/(?P<product_slug>[-\w]+)/$', views.ProducDetailView.as_view(), name='productdetail'),
#     url(r'^detail/(?P<product_slug>[-\w]+)/$', views.ProducDetailView.as_view(), name='productdetail'),
    url(r'^login/$', views.LoginView.as_view(), name='site_login'),
    url(r'^signup/$', views.SignUPView.as_view(), name='site_signup'),
    url(r'^logout/', logout, {'next_page': '/'}, name='site_logout'),
    url(r'^add_wishlist/', views.add_to_wishlist, name='add_wishlist'),
    url(r'^wishlist/', is_login(views.WishListView.as_view()), name='wishlist'),
    url(r'^my-orders/', is_login(views.OrderListView.as_view()), name='my_orders'),
    url(r'^track-orders/', is_login(views.TrackOrderView.as_view()), name='track_order'),
    url(r'^error/', is_error_site(views.UnderConstruction.as_view()), name='error'),
    url(r'^search/(?P<stxt>[-\w]+)/$', views.SearchView.as_view(), name='search'),
    url(r'^search/$', views.SearchView.as_view(), name='empty_search'),
    url(r'^user-profile/$', is_login(views.UserProfileView.as_view()), name='user_profile'),
    url(r'^edit-profile/$', is_login(views.EditProfileView.as_view()), name='edit_profile'),
    url(r'^user-address/(?P<address_id>\d+)/$', is_login(views.AddressView.as_view()), name='user_address'),
    url(r'^payment/success/$', views.success, name='success'),
    url(r'^payment/failure/$', views.failure, name='failure'),
    url(r'^payment/(?P<postdata>[-\w]+)/(?P<order_id>\d+)/$', views.payUpayment, name='payu_payment'),
    url(r'^sub-category/(?P<cat_id>\d+)/$', views.SubCategory.as_view(), name='subcategory'),

    # added by sushant razorpay 13/12/2018
    url(r'^razorpay-payment/success$', views.rezorPaySuccess, name='payment_razorpay_success'),
    url(r'^orders/order-placed$', views.placeOrder, name='place_order'),
]
