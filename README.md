# Test Task
Please prepare a simple app for exporting data from XML file to Redis( https://redis.io/ ).

## From attached config.xml export data to Redis keys:
- key "subdomains" will contain JSON with all subdomains (e.g. ["http://secureline.tools.avast.com", "http://gf.tools.avast.com"])
- keys "cookie:%NAME%:%HOST%" will contain values of cookie elements (e.g. key "cookie:dlp-avast:amazon" will contain string "mmm_amz_dlp_777_ppc_m")
- use docker-compose ( https://docs.docker.com/compose/ ) (container with java or php (or other language) and container with Redis)
- provide unit tests for your app

## Run it with the command:
export.sh -v /path/to/xml
if "-v" argument is present then it will print all keys saved to Redis
