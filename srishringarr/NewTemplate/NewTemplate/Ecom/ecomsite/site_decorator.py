from functools import wraps
from ecomauth.models import userApiKey, userDetails
from django.shortcuts import get_object_or_404
from django.http.response import HttpResponseRedirect
from django.urls import reverse
from ecomsite import app_setting

def is_publish_site(view_func):
    def _decorator(request, *args, **kwargs):
        # maybe do something before the view_func call
        print(app_setting.getUserID())
        if app_setting.getUserID():
            try:
                apiKey = get_object_or_404(userApiKey,user_id = app_setting.getUserID())
            except:
                apiKey = None
            
            if apiKey:
                if apiKey.active:
                    pass
                else:    
                    return HttpResponseRedirect(reverse('error'))
            else:    
                    return HttpResponseRedirect(reverse('error'))    
        else:
            return HttpResponseRedirect(reverse('error'))
        
        response = view_func(request, *args, **kwargs)
        # maybe do something after the view_func call
        return response
    return wraps(view_func)(_decorator)


def is_error_site(view_func):
    def _decorator(request, *args, **kwargs):
        # maybe do something before the view_func call
        print(app_setting.getUserID())
        if app_setting.getUserID():
            try:
                apiKey = get_object_or_404(userApiKey,user_id = app_setting.getUserID())
            except:
                apiKey = None
            
            if apiKey:
                if apiKey.active:
                    return HttpResponseRedirect(reverse('site_home'))
                else:    
                    pass
            else:    
                    pass    
        else:
            pass
        
        response = view_func(request, *args, **kwargs)
        # maybe do something after the view_func call
        return response
    return wraps(view_func)(_decorator)

def is_login(view_func):
    def _decorator(request, *args, **kwargs):
        # maybe do something before the view_func call
        if request.session.get('site_isUserLogin'):
            try:
                userData = get_object_or_404(userDetails, id = request.session.get('site_userId'))
            except:
                userData = None
            if userData is not None:
                pass
            else:
                return HttpResponseRedirect(reverse('site_login'))
        else:
            return HttpResponseRedirect(reverse('site_login'))
        
        response = view_func(request, *args, **kwargs)
        # maybe do something after the view_func call
        return response
    return wraps(view_func)(_decorator)