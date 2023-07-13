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

`:` must have a specific meaning other than equals. To try to figure this out would probably require
includinig a unique field like `mdr_report_key` in the search of both queries. Writing PHP code to execute the 
queries and save the searched-for field and the unique field to a file. Then sorting the files based on the 
`mdr_report_key` and doing the set difference.
