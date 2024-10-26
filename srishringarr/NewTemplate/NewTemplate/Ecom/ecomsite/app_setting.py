from functools import wraps
from Crypto.Cipher import AES
import base64

API_SECRET_KEY = '6krV*eJaJzHw#UgD' 

# APP_SETTING_KEY = 'wDgmH6BS0B5s/tcOmfAqtdrIHcDQGs0MYec2lMu2w/A='

APP_SETTING_KEY =  'wDgmH6BS0B5s/tcOmfAqtUuBgOWN42XD5/wYmke/lM0='

def decrypt(encoded):
    try:
        cipher = AES.new(API_SECRET_KEY.encode(),AES.MODE_ECB) # never use ECB in strong systems obviously
        decoded = cipher.decrypt(base64.b64decode(encoded))
        auth_cred = decoded.strip().decode().split(':')
    except:
        auth_cred =False
    return auth_cred

def getUserID():
    uid = decrypt(APP_SETTING_KEY.encode())
    return uid[0]
