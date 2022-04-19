# mofhylite-sitepro
[Site.Pro](https://site.pro) for [MOFHY-Lite](https://github.com/NXTS-Developers/MOFHY-Lite)
## Requirements
[Site.Pro Reseller Account](https://site.pro/Reselling-Prices/)

[MOFHY-Lite](https://github.com/NXTS-Developers/MOFHY-Lite)
## Installation
1. Sign up for [Site.Pro Reseller Account](https://site.pro/Reselling-Prices/)
2. Add brand
3. Install ``mofhylite-sitepro-main.zip`` [(download link)](https://github.com/OverdueWeevil2/mofhylite-sitepro/archive/refs/heads/main.zip) and extract
4. Edit [site.php](site.php#L23-L25) and change below lines to [Site.Pro API Credentials](https://site.pro/My-Licenses/)
```php
$apiUser = "SITE-PRO-API-USERNAME-HERE"; // Site.Pro API Username
$apiPass = "SITE-PRO-API-PASSWORD-HERE"; // Site.Pro API Password
$tldapi = "http://your-builder-domain-here.com"; // if you are using on-premises type your builder domain else type https://site.pro
```
5. Upload files to **MOFHY-Lite** directory
6. Leave a star if you like
