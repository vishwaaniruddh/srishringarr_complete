from django.conf.urls import url
# from userLogin.views import userAuthentication
from . import views

urlpatterns = [
     url(r'^madmin/login/$', views.LoginView.as_view(), name='login'),
     url(r'^madmin/signup/$', views.SignUPView.as_view(), name='signup'),
]
