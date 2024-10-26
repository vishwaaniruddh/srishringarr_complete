from django import template

register = template.Library()


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

@register.filter(name='getValueAtIndex')
def getValueAtIndex(sid, values):
    optionValue = [x.strip() for x in values.split(',')]
    return optionValue[sid]