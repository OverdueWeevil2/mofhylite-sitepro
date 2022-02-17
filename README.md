# mofhylite-sitepro
[Site.Pro](https://site.pro) for [MOFHY-Lite](https://github.com/NXTS-Developers/MOFHY-Lite)
## Requirements
[Site.Pro Reseller Account](https://site.pro/Reselling-Prices/)

[MOFHY-Lite](https://github.com/NXTS-Developers/MOFHY-Lite)
## Installation
1. Sign up for [Site.Pro Reseller Account](https://site.pro/Reselling-Prices/)
2. Add brand
3. Install ``mofhylite-sitepro-main.zip`` [(link)](https://github.com/OverdueWeevil2/mofhylite-sitepro/archive/refs/heads/main.zip) and extract
4. Edit [site.php](site.php#L23-L27) and change below lines to [Site.Pro API Credentials](https://site.pro/My-Licenses/)
```php
$apiUser = "SITE-PRO-API-USERNAME-HERE"; // Site.Pro API Username
$apiPass = "SITE-PRO-API-PASSWORD-HERE"; // Site.Pro API Password
$tldapi = "http://your-builder-domain-here.com"; // if you are using on-premises type your builder domain else type https://site.pro
$apiLicense = ""; // License ID
$apiBrand = ""; // Brand ID
```
5. Upload files to **MOFHY-Lite** directory
## Brand/License ID
![](https://user-images.githubusercontent.com/67264530/154498698-efde4511-daf6-44c9-b162-5e9ae174bd84.png)
