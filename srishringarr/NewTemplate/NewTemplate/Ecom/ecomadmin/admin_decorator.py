from functools import wraps
from ecomauth.models import userApiKey
from django.shortcuts import get_object_or_404
from django.http.response import HttpResponseRedirect
from django.urls import reverse

def check_redirect(view_func):
    def _decorator(request, *args, **kwargs):
        # maybe do something before the view_func call
        if request.session.get('isUserLogin'):
            try:
                checkApiKey = get_object_or_404(userApiKey, user_id = request.session.get('userId'))
            except:
                checkApiKey = None
            if checkApiKey is None:
                return HttpResponseRedirect(reverse('home'))
        else:
            return HttpResponseRedirect(reverse('login'))
        
        response = view_func(request, *args, **kwargs)
        # maybe do something after the view_func call
        return response
    return wraps(view_func)(_decorator)