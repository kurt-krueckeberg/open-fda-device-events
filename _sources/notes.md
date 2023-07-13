## Issues

Example 1 

<https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:nausea> 

returns a total of 628612 meta.results.total.

but using `=` instead of `:` 
 
<https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt=nausea>

returns 687192 results.total. Why more?

Example 2

<https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF">

returns results but 

<https://api.fda.gov/device/event.json?search=device.device_report_product_Code:"HQF">

returns nothing.

`:` must have a specific meaning other than equals.
