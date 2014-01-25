import unirest
import json 

def main(): 
	year = 1999
	month = 1
	day = 1

	while(year<=2012):
		while(month<12): 
			date = "{0:04d}".format(year)+"-"+"{0:02d}".format(month)+"-"+"{0:02d}".format(day) 
			response = unirest.get("https://joss-open-exchange-rates.p.mashape.com/historical/"+date+".json",
						headers={
						"X-Mashape-Authorization": "" # Your mashape auth key here
					}
				)
			decoded = json.loads(response.raw_body) 
			print date+": \t\033[0;31m"+str(decoded["rates"]["CNY"])+"\033[0m \n \t\t\033[0;32m"+str(decoded["rates"]["MXN"])+"\033[0m "

			month += 2 
		month = 1
		year += 1

main() 
