# Code Ideas for the device/event Endpoint

Javascript + ReactJS seems a more straight forward solution for implementing the openFDA API calls to query
adverse device event data for those device I am interested in, as it client-side, browser-based solution.

But I'm not sure is graphing libraries like D3.js are server side?

## Prospective Queries for LASIK-related Deviced

1. Search for `device.device_report_product_Code="LZS"` (for device of Excimer Laser) where `mdr_text` contains `dry`:

``
https://api.fda.gov/device/event.json?search=(device.device_report_product_Code="LZS")+AND+(mdr_text.text:dry)
``

<a href='https://api.fda.gov/device/event.json?search=(device.device_report_product_Code="LZS")+AND+(mdr_text.text:dry)'>Execute call</a>

:::{note} This also works:
`https://api.fda.gov/device/event.json?search=device.device_report_product_Code="LZS"+AND+mdr_text.text:dry`
:::

2. Search for device adverse events for Excimer Lasik code `LZS` or AC-powered keratome code `HNO`:

``
https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HNO"+device.device_report_product_Code="LZS"
``

<a href='https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HNO"+device.device_report_product_Code="LZS"'>Execute call</a>

3. Here we search for all the product codes (using boolean OR operator `+`): `HQF`, `LZS`, `OTL`, `HMY`, `HNO`, `MYD`, `NKY`.

``
https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF"+device.device_report_product_Code="LZS"+device.device_report_product_Code="OTL"+device.device_report_product_Code="HMY"+device.device_report_product_Code="HNO"+device.device_report_product_Code="MYD"+device.device_report_product_Code="NKY"
``

<a href='https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF"+device.device_report_product_Code="LZS"+device.device_report_product_Code="OTL"+device.device_report_product_Code="HMY"+device.device_report_product_Code="HNO"+device.device_report_product_Code="MYD"+device.device_report_product_Code="NKY"'>Execute call</a>

4. Count `mdr_report_key` 's for "LZS" (Excimer Laser System) reports:

``
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
``

<a href=hittps://api.fda.gov/device/event.json?search=device.device_report_product_Code="LZS"&count:device.mdr_report_key'>Execute call</a>

:::{note} `mdr_report_key` is unique, anyway, so the use of `count` is only a usage example (but of no practical use).
## General Query Options

1. Searching for a specified date range:

``
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
``

<a href='https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1'>Execute call</a>

2. Search for adverse events within a date range. A date range is specified using brackets `[ ]`; for example, to search for all records with date\_received between
   Jan 01, 2013 and Dec 31, 2014, and to limit the results to one retuned value:

`https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1`

See searchable fields for more about `date_received`. Brackets `[ ]` are used to specify a range for date, number, or string fields.

``
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
``

<a href='https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1'>Execute call</a>
