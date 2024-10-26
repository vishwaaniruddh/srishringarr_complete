import random
from django.shortcuts import get_object_or_404
from ecomadmin.models import Cart, Products, userDetails, ProductsReviews, ProductsRatings
from django.http import JsonResponse


def add_user_reviews(request):
    postdata = request.POST.copy()
    product = postdata.get('product_id')
    reviews = postdata.get('comment')

    try:
        userData = get_object_or_404(userDetails, id=request.session.get('site_userId'))
    except:
        userData = None
        
    try:
        productObject = get_object_or_404(Products,id=product)       
    except:
        productObject = None     
        
    try:
        productReviews = get_object_or_404(ProductsReviews, user=userData.id, product=productObject.id)  
    except:
        productReviews = ProductsReviews() 

    
    if userData:  
        productReviews.user = userData
        productReviews.product = productObject      
        productReviews.reviews = reviews
        productReviews.save()    
        response = {
            'success' : 'True',
            'strMsg' : 'Reviews added successfully'  ,
        }
    else:
        response = {
            'success' : 'false',
            'strMsg' : 'Please login to rate this product'  ,
        }
    return JsonResponse(response)


def add_user_ratings(request):
    postdata = request.POST.copy()
    product = postdata.get('product_id')
    ratings = postdata.get('ratings')
    
    try:
        userData = get_object_or_404(userDetails, id=request.session.get('site_userId'))
    except:
        userData = None
        
    try:
        productObject = get_object_or_404(Products,id=product)       
    except:
        productObject = None     
        
    try:
        productsRatings = get_object_or_404(ProductsRatings, user=userData.id, product=productObject.id)  
    except:
        productsRatings = ProductsRatings() 
    
    if userData:
        productsRatings.user = userData
        productsRatings.product = productObject      
        productsRatings.ratings = ratings
        productsRatings.save()    
        response = {
            'success' : 'True',
            'strMsg' : 'Ratings added successfully'  ,
        }
    else:
        response = {
            'success' : 'false',
            'strMsg' : 'Please login to rate this product'  ,
        }

    return JsonResponse(response)
