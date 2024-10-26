from celery.decorators import shared_task
from celery.utils.log import get_task_logger
from celeryapp.emails import send_feedback_email
from django.core.mail import send_mail
from xircls.settings import ADMIN_EMAIL

logger=get_task_logger(__name__)

# This is the decorator which a celery worker uses
@shared_task(name="send_feedback_email_task")
def send_feedback_email_task(name,email,message):
    logger.info("Sent email")
    return send_feedback_email('send_feedback_email_task',[ADMIN_EMAIL],'tesing')
