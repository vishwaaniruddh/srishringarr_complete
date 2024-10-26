from django.shortcuts import render, get_object_or_404
from django.views.generic import TemplateView
from ecomauth.models import userDetails, userApiKey
from ecomadmin.models import HomeSetting, ProductListSetting, ProductDetailSetting, CartPageSetting, CheckoutPageSetting, ThankyouPageSetting, \
    StateList, Address, HomeSettingOptions, ProductListSettingOptions, PDSettingOptions, CartSettingOptions, CheckoutSettingOptions, ThankUSettingOptions
from .models import EcomSetting, EcomSettingOption, EcomSettingSteps
import random, base64
from Crypto.Cipher import AES
from Ecom.settings import API_SECRET_KEY
from django.http.response import HttpResponseRedirect, JsonResponse
from django.urls import reverse
from ecomadmin.models import Category, Products


# Create your views here.
class Home(TemplateView):
    template_name = 'mainapp/index.html'
    strMessage = ''
    status = False
    
    def post(self, request, *args, **kwargs):
        postdata = request.POST.copy()
        try:
            apiKey = get_object_or_404(userApiKey, user_id=self.request.session.get('userId'))
        except:
            apiKey = None
            
        if  apiKey:
            self.strMessage = 'Api key Available'
            self.status = True
        else:
            self.strMessage = 'api key not Available'     
            self.status = False  
            
        responseData = super(Home, self).get(request, *args, **kwargs)     
        return  responseData

    def get_context_data(self, **kwargs):
        context = super(Home, self).get_context_data(**kwargs)
        context['pageTitle'] = "Home"
        if self.request.session.get('userId') != '0' and self.request.session.get('userId') != None:
            try:
                apiKey = get_object_or_404(userApiKey, user_id=self.request.session.get('userId'))
            except:
                apiKey = None
            context['apiKey'] = apiKey
            try:
                sellerAddress = Address.objects.filter(user=self.request.session.get('userId')).first() 
            except:
                sellerAddress = None
        
            context['address'] = sellerAddress
            try:
                ecomsteps = get_object_or_404(EcomSettingSteps, user=self.request.session.get('userId'))
            except:
                ecomsteps = None
            context['ecom_steps'] = ecomsteps
            
            context['EcomSetting'] = check_save_setting(self.request)
            dataArrey = check_save_setting_options(self.request)
            context['EcomSettingOptions'] = dataArrey.ecom_config_setting_option
            if dataArrey.ecom_config_setting_option == [1, 1, 1, 1, 1, 1]:
                context['allComplete'] = 1
       
            context['strMessage'] = self.strMessage
            context['status'] = self.status
                        
        return context


def check_save_setting_options(request):
    if(request.session.get('userId') != '0'):
        userdetail = get_object_or_404(userDetails, id=request.session.get('userId'))
        
        # Start of option settying
        ecomSettingOption = EcomSettingOption.objects.filter(user=userdetail).first()
         
        if ecomSettingOption == None:
            ecomSettingOption = EcomSettingOption() 
        
        try:
            apiKey = get_object_or_404(userApiKey, user_id=userdetail)
        except:
            apiKey = None
      
        try:
            sellerAddress = Address.objects.filter(user=userdetail).first() 
        except:
            sellerAddress = None
            
        settingArray = [0, 0, 0, 0, 0, 0]
        homeSettng = HomeSetting.objects.filter(user=userdetail).first() 
        list_setting = ProductListSetting.objects.filter(user=userdetail).first() 
        details_setting = ProductDetailSetting.objects.filter(user=userdetail).first() 
        cart_setting = CartPageSetting.objects.filter(user=userdetail).first() 
        checkout_setting = CheckoutPageSetting.objects.filter(user=userdetail).first() 
        thankyou_setting = ThankyouPageSetting.objects.filter(user=userdetail).first() 
        
        if homeSettng:
            settingArray[0] = 1 
        else:
            settingArray[0] = 0 
            
        if list_setting:
            settingArray[1] = 1 
        else:
            settingArray[1] = 0 
            
        if details_setting:
            settingArray[2] = 1 
        else:
            settingArray[2] = 0 
            
        if cart_setting:
            settingArray[3] = 1 
        else:
            settingArray[3] = 0 
                    
        if checkout_setting:
            settingArray[4] = 1 
        else:
            settingArray[4] = 0 
            
        if thankyou_setting:
            settingArray[5] = 1 
        else:
            settingArray[5] = 0  
             
        ecomSettingOption.user = userdetail 
        ecomSettingOption.category_setting_option = Category.objects.filter(is_active=True, user=userdetail).count()
        ecomSettingOption.product_setting_option = Products.objects.filter(is_active=True, user=userdetail).count()
             
        if sellerAddress:
            ecomSettingOption.user_address_option = 1
        else:
            ecomSettingOption.user_address_option = 0
             
        if apiKey:
            ecomSettingOption.user_key_option = 1
        else:            
            ecomSettingOption.user_key_option = 0
            
        ecomSettingOption.ecom_config_setting_option = settingArray
        ecomSettingOption.user = userdetail
        ecomSettingOption.save()  
         
        return ecomSettingOption

    
def check_save_setting(request):
    if(request.session.get('userId') != '0'):
        userdetail = get_object_or_404(userDetails, id=request.session.get('userId'))
        
        # Start of option settying
        ecomSettingOption = EcomSettingOption.objects.filter(user=userdetail).first()
         
        if ecomSettingOption == None:
            return None
        else:
            site_setting = EcomSetting.objects.filter(user=userdetail).first()
            
            if site_setting == None:
                site_setting = EcomSetting()        
        
            if ecomSettingOption.product_setting_option > 0:
                site_setting.product_setting = 1
            else:
                site_setting.product_setting = 0
                
            if ecomSettingOption.category_setting_option > 0:
                site_setting.category_setting = 1
            else:
                site_setting.category_setting = 0    
                
            if ecomSettingOption.user_address_option:
                site_setting.user_address = 1
            else:
                site_setting.user_address = 0
                
            if ecomSettingOption.user_key_option:
                site_setting.user_key = 1
            else:            
                site_setting.user_key = 0
            
            isSettingSaved = True    
            for data in ecomSettingOption.ecom_config_setting_option:
                if data == 0:
                    isSettingSaved = False  
            
            site_setting.ecom_config_setting = isSettingSaved  
            site_setting.user = userdetail
            site_setting.save()
 
        return site_setting    
    
    
class AboutUsView(TemplateView):
    template_name = 'mainapp/about_us.html'
    
    def get_context_data(self, **kwargs):
        context = super(AboutUsView, self).get_context_data(**kwargs)
        context['pageTitle'] = "About Us"
        return context

    
class ProfileView(TemplateView):
    template_name = 'mainapp/m_profile.html'

    def post(self, request, *args, **kwargs):
        
        postdata = request.POST.copy()
        try:
            add = get_object_or_404(Address, user=request.session.get('userId'))
        except:
            add = None
            
        if add is None:
            add = Address()   
            self.successMessage = "Address saved successfully"
        else:
            self.successMessage = "Address updated successfully"         
    
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
        add.user = get_object_or_404(userDetails, id=request.session.get('userId'))
        add.save()
        
        ecomsettingsteps = get_object_or_404(EcomSettingSteps, user=request.session.get('userId'))
        ecomsettingsteps.step = 2
        ecomsettingsteps.user = get_object_or_404(userDetails, id=request.session.get('userId'))
        ecomsettingsteps.save()
        
        return HttpResponseRedirect(reverse('home'))
            
        responseData = super(ContactUsView, self).get(request, *args, **kwargs)     
        return  responseData    
    
    def get_context_data(self, **kwargs):
        context = super(ProfileView, self).get_context_data(**kwargs)
        context['allStateList'] = StateList.objects.all()
        try:
            sellerAddress = Address.objects.filter(user=self.request.session.get('userId')).first() 
        except:
            sellerAddress = None
            
        context['address'] = sellerAddress
        context['pageTitle'] = "Merchant Profile"
        return context

    
class TermsView(TemplateView):
    template_name = 'mainapp/terms.html'
    
    def get_context_data(self, **kwargs):
        context = super(TermsView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Terms and Conditions"
        return context    

    
class ContactUsView(TemplateView):
    template_name = 'mainapp/contact_us.html'
    
    def get_context_data(self, **kwargs):
        context = super(ContactUsView, self).get_context_data(**kwargs)
        context['pageTitle'] = "Contact Us"
        return context        

    
def generate_key(request):
    if(request.session.get('userId') != '0'):
        userdetail = get_object_or_404(userDetails, id=request.session.get('userId'))
            
    if userdetail:
        '''Encryption - Generate API KEY'''          
        random_number = random.randint(111111, 999999)
        encryt_string = str(request.session.get('userId')) + ":" + str(random_number)
        msg_text = encryt_string.encode().strip().rjust(32)     
        cipher = AES.new(API_SECRET_KEY.encode(), AES.MODE_ECB)  # never use ECB in strong systems obviously
        encoded = base64.b64encode(cipher.encrypt(msg_text))
        apiKey = encoded.decode()
        user_apikey = userApiKey()
        user_apikey.user = userdetail
        user_apikey.key = apiKey
        user_apikey.save()
        
        ecomsettingsteps = get_object_or_404(EcomSettingSteps, user=userdetail)
        ecomsettingsteps.step = 4
        ecomsettingsteps.user = userdetail
        ecomsettingsteps.save()
                
    try:
        apiKey = get_object_or_404(userApiKey, user_id=request.session.get('userId'))
    except:
        apiKey = None
        
    response = {
        'apiKey' : str(apiKey.key),
        'success' : 'True'
        }
    return JsonResponse(response)


def set_default(request):
    if(request.session.get('userId') != '0'):
        userdetail = get_object_or_404(userDetails, id=request.session.get('userId'))
            
    if userdetail:
        homesetting = HomeSetting()
        homesetting.user = userdetail
        homesetting.save()
        
        homesettingOption = HomeSettingOptions()
        homesettingOption.user = userdetail
        homesettingOption.save()
        
        prodlistsetting = ProductListSetting()
        prodlistsetting.user = userdetail
        prodlistsetting.save()
        
        prodlistsettingOption = ProductListSettingOptions()
        prodlistsettingOption.user = userdetail
        prodlistsettingOption.save()
        
        prodetailsetting = ProductDetailSetting()
        prodetailsetting.user = userdetail
        prodetailsetting.save()
        
        prodetailsettingOption = PDSettingOptions()
        prodetailsettingOption.user = userdetail
        prodetailsettingOption.save()
        
        cartsetting = CartPageSetting()
        cartsetting.user = userdetail
        cartsetting.save()
        
        cartsettingOption = CartSettingOptions()
        cartsettingOption.user = userdetail
        cartsettingOption.save()
        
        checkoutsetting = CheckoutPageSetting()
        checkoutsetting.user = userdetail
        checkoutsetting.save()
        
        checkoutsettingOption = CheckoutSettingOptions()
        checkoutsettingOption.user = userdetail
        checkoutsettingOption.save()
        
        thankusetting = ThankyouPageSetting()
        thankusetting.user = userdetail
        thankusetting.save()
        
        thankusettingOption = ThankUSettingOptions()
        thankusettingOption.user = userdetail
        thankusettingOption.save()
        
        ecomsettingsteps = get_object_or_404(EcomSettingSteps, user=userdetail)
        ecomsettingsteps.step = 3
        ecomsettingsteps.user = userdetail
        ecomsettingsteps.save()
        
        dataArrey = check_save_setting_options(request)
        if dataArrey.ecom_config_setting_option == [1, 1, 1, 1, 1, 1]:
            allComplete = 1
        
    response = {
        'msg' : 'You have intailize all setting with default values.',
        'allComplete' : allComplete,
        'success' : 'True'
        }
    
    return JsonResponse(response)


def go_live(request):
    if(request.session.get('userId') != '0'):
        userdetail = get_object_or_404(userDetails, id=request.session.get('userId'))
            
    if userdetail:                
        try:
            apiKey = get_object_or_404(userApiKey, user_id=request.session.get('userId'))
        except:
            apiKey = None
    
        apiKey.active = True
        apiKey.save()
        
        ecomsettingsteps = get_object_or_404(EcomSettingSteps, user=userdetail)
        ecomsettingsteps.step = 5
        ecomsettingsteps.user = userdetail
        ecomsettingsteps.save()
        
    response = {
        'msg' : 'Your account is been activated.',
        'success' : 'True'
        }
    return JsonResponse(response) 
