import re
import json
import urllib2
url = "http://api.ubibot.io/channels/2723?account_key=860a553576d7dea6d511bf67b565f1b8"
response = urllib2.urlopen(url)
data = response.read()
values = json.loads(data)
extract = json.dumps(values['channel']['last_values'],indent=4, sort_keys=True)
json_extract = json.loads(json.loads(extract))
new_json_extract = {};
for v1 in json_extract:
  new_json_extract[v1] = str(json_extract[v1]["value"]);
new_json_extract = json.dumps(new_json_extract,sort_keys=True);
print(new_json_extract);
