Understaind `count` better. Documentation states:

    `count:` Count the number of unique values of a certain field, for all the records that matched the
     search parameter. By default, the API returns the 1000 most frequent values.

OpenVigil does allow entering your own search string and gives a default count example. See:
<https://openvigil.pharmacology.uni-kiel.de/openvigilfda.php>. The example is:

<search=patient.drug.openfda.generic_name.exact:(%22DROSPIRENONE+AND+ETHINYL+ESTRADIOL%22)+AND+patient.reaction.reactionmeddrapt.exact:(%22PAIN%22)+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
>

Counting records where certain terms occur

This query looks in the drug/event endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

    Search for all records

    Count the number of records matching the terms in patient.reaction.reactionmeddrapt.exact. The .exact suffix here tells the API to count whole phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately)

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`

Why does this query

https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact

work, but this one gives an error

https://api.fda.gov/device/event.json?count=device.openfda.device_name

I believe it is because the openfda fields are openfda, i.e.annotated, fields?

`https://api.fda.gov/device/event.json?searcount=device.manufacturer_name`

`https://api.fda.gov/device/event.json?count=device.manufacturer_name.exact`

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

I think `:` means contains while `=` means "matches exactly"?

Both of these searches

<https://api.fda.gov/device/event.json?search=device.openfda.device_name:Excimer>

<https://api.fda.gov/device/event.json?search=device.openfda.device_name.exact:"Excimer+Laser+System"">

return the same totals of 13267.

Note: `mdr_report_key`, which is unique, is returned in every `device/event` query.

including it in the search of both queries, writing PHP code to execute the 
queries and save the searched-for field and the unique field to a file. Then sorting the files based on the 
`mdr_report_key` and doing the set difference.
