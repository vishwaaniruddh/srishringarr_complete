from django.db import models

# Create your models here.
class VisitorFormDetail(models.Model):
    fullname = models.CharField(max_length=255)
    mobile = models.CharField(max_length=20)
    email = models.CharField(max_length=255)
    message = models.CharField(max_length=255)
    is_active = models.BooleanField(default=False)
    is_delete = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True, null=True)
    updated_at = models.DateTimeField(auto_now=True, null=True)
    
    class Meta:
        db_table = "visitor_form"