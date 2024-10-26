from django.conf.urls import url
# from userLogin.views import userAuthentication
from . import views

# urlpatterns = [
#     url(r'Login/$', userAuthentication.Login, name='Login'),
#     url(r'SignUp/$', userAuthentication.SignUP, name='SignUp'),
# ]

urlpatterns = [
    url(r'^index/$', views.Home.as_view(), name='home'),
    url(r'^admin/about-us/$', views.AboutUsView.as_view(), name='admin_about_us'),
    url(r'^admin/contact-us/$', views.ContactUsView.as_view(), name='admin_contact_us'),
    url(r'^admin/terms/$', views.TermsView.as_view(), name='terms'),
    url(r'^admin/profile/(?P<address_id>\d+)/$', views.ProfileView.as_view(), name='m_profile'),
    url(r'^generate_key/$', views.generate_key, name='generate_key'),
    url(r'^set_default/$', views.set_default, name='set_default'),
    url(r'^go_live/$', views.go_live, name='go_live'), 
]
