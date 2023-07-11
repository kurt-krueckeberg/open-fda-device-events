# Prospective Code

## Example 

Search for device adverse events for Excimer Lasik code `LZS` or AC-powered keratome code `HNO`:

`https://api.fda.gov/device/event.json?search=device.device_report_product_Code=%22HNO%22+device.device_report_product_Code=%22LZS%22`

Date range:

`https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1`

- Add a date range
- Add soure of report
- Add text of report
- Add `generic_device` search
- etc
