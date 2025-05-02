# BotLog

**BotLog** is a lightweight PHP application designed to help manage and monitor dynamic IP addresses of home servers that are exposed to the internet.

## The Problem

Many internet providers automatically change users' IP addresses on a daily basis. While it's easy to check your own current IP, it becomes difficult to keep track of other participants' changing IPs in a distributed server setup.

## The Solution

BotLog offers a simple API that each server can call periodically (e.g. via a CRON job), authenticating itself with a name and password. Upon each call, BotLog updates the IP address associated with the calling bot, using the actual source IP of the request.

Authenticated users can log in through the web interface and view the most recent IP addresses of all registered servers that have reported in.

## Technologies

- **Language:** PHP  
- **Framework:** Yii2  
- **Database:** MySQL  
- **API:** Simple REST interface with name/password authentication  
- **Automation:** CRON jobs running on each participating server  

## License

This project is licensed under the MIT License.

---

**BotLog** - a simple and effective way to track the current IP addresses of dynamic home servers.
