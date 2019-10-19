import urllib.parse
import urllib.request
import sys

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

data = urllib.parse.urlencode(params)
data = data.encode('utf-8')
req = urllib.request.Request(url, data)
with urllib.request.urlopen(req) as f:
   response = f.read()
print(response.decode('utf-8'))