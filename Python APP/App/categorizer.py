# import requests
# from base64 import urlsafe_b64encode
# import json
#
# def categorize(domain):
#     target_website = domain
#     key = "U7XWnaLKdHlSgx4CeLwt"
#     secret_key = "gEhnqk7F3iCvhvwyHATJ"
#     api_url = "https://api.webshrinker.com/hosts/v3/%s" % urlsafe_b64encode(target_website).decode('utf-8')
#     response = requests.get(api_url, auth=(key, secret_key))
#     status_code = response.status_code
#     data = response.json()
#     category = json.loads(json.dumps(data))
#     if status_code == 200:
#         # Do something with the JSON response
#         output = category['data'][0]['categories']
#         for i in output:
#             print i
#     elif status_code == 400:
#         # Bad or malformed HTTP request
#         print("Bad or malformed HTTP request")
#         print data
#     elif status_code == 401:
#         # Unauthorized
#         print("Unauthorized - check your access and secret key permissions")
#         print data
#     elif status_code == 402:
#         # Request limit reached
#         print("Account request limit reached")
#         print data
#     else:
#         # General error occurred
#         print "A general error occurred, try the request again"

try:
    from urllib import urlencode
except ImportError:
    from urllib.parse import urlencode

from base64 import urlsafe_b64encode
import hashlib
import requests
import json

class categorizer_api:
    def __init__(self,access_key, secret_key, url="", params={}):
        params['key'] = access_key
        request = "categories/v3/{}?{}".format(urlsafe_b64encode(url).decode('utf-8'), urlencode(params, True))
        request_to_sign = "{}:{}".format(secret_key, request).encode('utf-8')
        signed_request = hashlib.md5(request_to_sign).hexdigest()
        self.request =  "https://api.webshrinker.com/{}&hash={}".format(request, signed_request)
    def displayCategory(self):
        response = requests.get(self.request)
        status_code = response.status_code
        data = response.json()
        category = json.loads(json.dumps(data))
        if status_code == 200:
            # Do something with the JSON response
            output = category['data'][0]['categories']
            for i in output:
                print i['label']
        elif status_code == 202:
            # The website is being visited and the categories will be updated shortly
            print(json.dumps(data, indent=4, sort_keys=True))
        elif status_code == 400:
            # Bad or malformed HTTP request
            print "Bad or malformed HTTP request"
            print json.dumps(data, indent=4, sort_keys=True)
        elif status_code == 401:
            # Unauthorized
            print "Unauthorized - check your access and secret key permissions"
            print json.dumps(data, indent=4, sort_keys=True)
        elif status_code == 402:
            # Request limit reached
            print "Account request limit reached"
            print json.dumps(data, indent=4, sort_keys=True)
        else:
            # General error occurred
            print "A general error occurred, try the request again"


access_key = "U7XWnaLKdHlSgx4CeLwt"
secret_key = "gEhnqk7F3iCvhvwyHATJ"
url = "pornhub.com"

api_url = categorizer_api(access_key, secret_key,url)
categorizer_api.displayCategory(api_url)


