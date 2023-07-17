# Documentation Issue

The API documentation (to my knowledge) doesn't document the required use of `=` for a field like `device.device_report_product_code`.  To successfully
search the **device/event** endpoint for `device.device_report_product_code`, you must search using `=` instead of `:` like this:

<https://api.fda.gov/device/event.json?search=device.device_report_product_code="HQF">

Furthermore, if you use `:` instead of `=`, you don't get an error. You get "No results found!", which is what this query returns:

<https://api.fda.gov/device/event.json?search=device.device_report_product_code:"HQF">

Yet **HQF** is a valid 3-letter device code. Why must use `=` when `:` should work (if it means "contains") and why are no matches returned?

