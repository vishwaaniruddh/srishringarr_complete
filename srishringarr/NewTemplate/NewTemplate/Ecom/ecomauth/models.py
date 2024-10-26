from django.db import models
from django.core import validators
from django.utils.translation import ugettext_lazy as _
from django.utils import timezone
from django.contrib.auth.models import AbstractBaseUser
from django.contrib.auth.models import PermissionsMixin
from django.contrib.auth.models import UserManager
import re
         
class userDetails(AbstractBaseUser, PermissionsMixin):

    class Meta:
        app_label = 'ecomauth'
        db_table = "userdetails"
        #ordering=["created"]

    username = models.CharField(_('username'), max_length=75, unique=True,
        help_text=_('Required. 30 characters or fewer. Letters, numbers and '
                    '@/./+/-/_ characters'),
        validators=[
            validators.RegexValidator(re.compile('^[\w.@+-]+$'), 
            _('Enter a valid username.'), 'invalid')
        ])
    full_name = models.CharField(_('full name'), max_length=254, blank=True)
    email = models.EmailField(_('email address'), max_length=254, unique=True)
    # custom added fields
    mobile = models.CharField(max_length=10,blank=False)
    password = models.CharField(_('password'),max_length=225,blank=False)
    desktop_mac_id = models.CharField(max_length=50,blank=True)
    mobile_mac_id = models.CharField(max_length=50,blank=True)
    imei_no = models.CharField(max_length=50,blank=True)
    is_superuser = models.BooleanField(default=False)
    is_phone_verify = models.BooleanField(default=False)
    is_email_verify = models.BooleanField(default=False)
    gender = models.CharField(max_length=50,blank=True)
    user_address = models.CharField(max_length=255)  
    user_street = models.CharField(max_length=255,null=True)
    user_landmark = models.CharField(max_length=255,null=True)
    user_city = models.CharField(max_length=255,null=True)
    user_state = models.CharField(max_length=255,null=True)
    user_pincode = models.CharField(max_length=255,null=True)
    user_country = models.CharField(max_length=255,null=True)
    landline =  models.CharField(max_length=10)
    
    # custom added fields
    is_staff = models.BooleanField(_('staff status'), default=False,
        help_text=_('Designates whether the user can log into this admin '
                    'site.'))
    is_active = models.BooleanField(_('active'), default=True,
        help_text=_('Designates whether this user should be treated as '
                    'active. Unselect this instead of deleting accounts.'))
    date_joined = models.DateTimeField(_('date joined'), default=timezone.now)
    user_group = models.CharField(max_length=10,blank=True)
    objects = UserManager()

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ['username']
    
    def get_full_name(self):
        return self.full_name

    def get_short_name(self):
        return self.username

    def __unicode__(self):
        return self.email



class userApiKey(models.Model):
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    key = models.CharField(max_length=255,blank=False)
    url = models.CharField(max_length=255,blank=False)
    active = models.BooleanField(default=False)
    site_type = models.CharField(max_length=100,blank=True)
    
    class Meta:
        db_table = 'user_apikey'
