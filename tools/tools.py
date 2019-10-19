import requests
import requests.packages.urllib3.util.ssl_
requests.packages.urllib3.util.ssl_.DEFAULT_CIPHERS = 'ALL'
import sys
import certifi

url = 'https://www.uniprot.org/uploadlists/'

From = sys.argv[1]
To = sys.argv[2]
query = sys.argv[3]

params = {
    'from': From,
    'to': To,
    'format': 'tab',
    'query': query
}
count = 0
while count < 10:
	try:
	    rp = requests.get(url, params=params, verify=certifi.where())
	except:
	    pass
	else:
	    if rp.status_code != 200:
	        print('not 200')
	        exit()
	    rp.encoding = rp.apparent_encoding
	    print(rp.text)
	    break
if count == 10:
	print('timeout')