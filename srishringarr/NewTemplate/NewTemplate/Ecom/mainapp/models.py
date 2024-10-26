from django.db import models
from ecomauth.models import userDetails


# Create your models here.
class EcomSetting(models.Model): 
    category_setting = models.BooleanField(default=False)
    product_setting = models.BooleanField(default=False)
    ecom_config_setting = models.BooleanField(default=False)
    user_address = models.BooleanField(default=False)
    user_key = models.BooleanField(default=False)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "ecom_setting"

        
class EcomSettingOption(models.Model):  
    category_setting_option = models.IntegerField(default=0)
    product_setting_option = models.IntegerField(default=0)
    ecom_config_setting_option = models.CharField(max_length=255) 
    user_address_option = models.IntegerField(default=0)
    user_key_option = models.IntegerField(default=0)      
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE) 
    
    class Meta:
        db_table = "ecom_option_setting"

class EcomSettingSteps(models.Model):
    step = models.IntegerField(default=1)
    user = models.ForeignKey(userDetails, on_delete=models.CASCADE)
    
    class Meta:
        db_table = "ecom_setting_step"