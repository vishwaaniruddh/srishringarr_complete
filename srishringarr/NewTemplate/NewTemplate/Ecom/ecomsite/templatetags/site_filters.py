from django import template
from ecomadmin.models import Category
from ecomsite.app_setting import getUserID
import os.path
from Ecom.settings import STATIC_DIR_PATH

register = template.Library()


@register.filter(name='isValueSelected')
def isValueSelected(sid, values):
    optionValue = [x.strip() for x in values.split(',')]
    returnValue = 'display: none;'
    
    for s in optionValue:
        if str(s) == str(sid):
            returnValue = 'display: block;'
            
    return returnValue


@register.filter(name='isValChecked')
def isValChecked(sid, values):
    optionValue = [x.strip() for x in values.split(',')]
    returnValue = ''
    for s in optionValue:
        if str(s) == str(sid):
            returnValue = 'checked'
   
    return returnValue


@register.filter(name='getList')
def getList(values):
    return [x.strip() for x in values.split(',')]
 

@register.filter(name='isSOChecked')
def isSOChecked(sid, values):
    returnValue = ''
    if str(sid) == str(values):
        returnValue = 'checked'
   
    return returnValue


@register.filter(name='isAddToWishlist')
def isAddToWishlist(pid, values):
    returnValue = False
    for v in values:
        if str(pid) == str(v.product_id):
            returnValue = True
   
    return returnValue


@register.filter(name='rentSubCats')
def rentSubCats(cid):
    returnValue = ''
    
    return returnValue


@register.filter(name='saleSubCats')
def saleSubCats(cid):
    returnValue = ''
    
    return returnValue


@register.filter(name='getMainCats')
def getMainCats(display):
    cat = Category.objects.filter(is_active=True, is_delete=False, parent_id=None, user_id=getUserID())
    return cat


@register.filter(name='getSubLevel')
def getSubLevel(cid):
    sl_cat = Category.objects.filter(parent_id=cid, user_id=getUserID(), is_active=True, is_delete=False)
    slArr = []
    if sl_cat.count() > 0:
        for sc in sl_cat:
            slArr.append(sc)
        return slArr

    
@register.filter(name='getValueAtIndex')
def getValueAtIndex(sid, values):
    optionValue = [x.strip() for x in values.split(',')]
    return optionValue[sid]


@register.filter(name='addValues')
def addValues(data1, data2):
    return data1 + data2


@register.filter(name='checkProductImageAvailable')
def checkProductImageAvailable(image_path):
    returnValue = False
    if image_path != "":
        file_path = str(STATIC_DIR_PATH)+'images/catalog/products/main/'+str(image_path)
        print(file_path)
        if os.path.isfile(file_path) == True:
            returnValue = True
    
    return returnValue

