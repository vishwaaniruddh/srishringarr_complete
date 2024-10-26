from django.shortcuts import render
from django.http.response import HttpResponseRedirect
from django.views.generic import TemplateView
from django.urls import reverse
from ecomauth.models import userDetails
from mainapp.models import EcomSettingSteps 
from django.db.models import Q
from django.contrib.auth.hashers import make_password, check_password


class LoginView(TemplateView):
    template_name = 'ecomauth/login.html'
    strMessage = ''
    responseStatus = False
    
    def post(self, request, *args, **kwargs):
        userAllData = userDetails.objects.filter(Q(email=request.POST['username']) | Q(password=make_password(request.POST['password'])), user_group = 0)
        if userAllData:
            userdata = userDetails.objects.filter(email=request.POST['username']).first()
            self.strMessage = "Logged in Successfully"
            self.responseStatus = True
            request.session['isUserLogin'] = True
            request.session['userId'] = userdata.id
            return HttpResponseRedirect(reverse('home'))
        else:
            self.strMessage = "Do not have an account?"
            self.responseStatus = False
            request.session['isUserLogin'] = False
            request.session['userId'] = '0'
            
        rseponseData = super(LoginView, self).get(request, *args, **kwargs)  
        return rseponseData
    
    def get_context_data(self, **kwargs):
        context = super(LoginView, self).get_context_data(**kwargs)
        context['successMessage'] = self.strMessage
        context['pageTitle'] = "Login"
        context['status'] = self.responseStatus
        return context  

    
class SignUPView(TemplateView):
    template_name = 'ecomauth/signup.html'
    strMessage = ''
    responseStatus = False

    def post(self, request, *args, **kwargs):
        isValid = True
        emailID = request.POST['userEmailId'].strip()
        mobileNumber = request.POST['userMobile'].strip()
        userAllData = userDetails.objects.filter(Q(email=emailID) | Q(mobile=mobileNumber))
        userMerchant = userDetails.objects.filter(Q(email=emailID) | Q(mobile=mobileNumber), user_group=1)
            
        if userAllData:
            if userMerchant:
                self.strMessage = "User already present as customer. Please Login"
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
            userData.user_group = 0
            userData.save() 
            ecomsettingsteps = EcomSettingSteps()
            ecomsettingsteps.user = userData
            ecomsettingsteps.save()
            self.strMessage = "Account created Successfully"
            self.responseStatus = True
            return HttpResponseRedirect(reverse('login'))

        rseponseData = super(SignUPView, self).get(request, *args, **kwargs)     
        return  rseponseData 

    def get_context_data(self, **kwargs):
        context = super(SignUPView, self).get_context_data(**kwargs)
        context['successMessage'] = self.strMessage
        context['status'] = self.responseStatus
        context['pageTitle'] = "Sign Up"
        return context      
  
