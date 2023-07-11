# Prospective Code

## Example 

Search for device adverse events for Excimer Lasik code `LZS` or AC-powered keratome code `HNO`:

`https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HNO"+device.device_report_product_Code="LZS"`

Here we search for all the product codes: `HQF`, `LZS`, `OTL`, `HMY`, `HNO`, `MYD`, `NKY`.

`https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF"+device.device_report_product_Code="LZS"+device.device_report_product_Code="OTL"+device.device_report_product_Code="HMY"+device.device_report_product_Code="HNO"+device.device_report_product_Code="MYD"+device.device_report_product_Code="NKY"`

Date range:


`https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1`

- Add a date range
- Add soure of report
- Add text of report
- Add `generic_device` search
- etc
