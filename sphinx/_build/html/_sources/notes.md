# Notes

Read some of the openFDA replies at <https://opendata.stackexchange.com/questions/tagged/openfda>

## Device Event Fields Open Questions

Q: What are/is the value(s) `device.generice_name` if the `deive.product_code` is "LZS"?

A: Here are actual examples:

| Field | Value |
| :---  | ----- |
`device.generic_name` | "OPTHALMIC EXCIMER LASER SYSTEM"
`device.brand_name` | "LADARVISION 4000"
`device.device_report_product_code` | "LZS"
`device.openfda.device_name` | "Excimer Laser System"
`device.openfda.device_class` | "3"

| Field | Value |
| :---  | ----- |
`device.generic_name` | "EXCIMER LASER"
`device.brand_name` | "SUMMIT APEX PLUS"
`device.device_report_product_code` | LZS
`device.openfda.device_name` | "Excimer Laser System"
`device.openfda.device_class` | 3

| Field | Value |
| :---  | ----- |
`device.generic_name` | "EXCIMER LASER SYSTEM"
`device.brand_name` | "WAVEFRONT LASER"
`device.device_report_product_code` | LZS
`device.openfda.device_name` | "Excimer Laser System"
`device.openfda.device_class` | 3

## How Api Actually Works Open Questions

Understaind `count` better. Documentation states:

    `count:` Count the number of unique values of a certain field, for all the records that matched the
     search parameter. By default, the API returns the 1000 most frequent values.

OpenVigil does allow entering your own search string and gives a default count example. See:
<https://openvigil.pharmacology.uni-kiel.de/openvigilfda.php>. The example is:

`search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0`

Counting records where certain terms occur

This query looks in the drug/event endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

    Search for all records

    Count the number of records matching the terms in patient.reaction.reactionmeddrapt.exact. The .exact suffix here tells the API to count whole phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately)

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`

## `.exact` questions

Some fields also have a second, `.exact` version which can also be searched. A field specified without the `.exact` suffix can be search for
partial, "is contained in" searches. It has been tokenized to allow flexible partial searches, so a query like 

<https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000>

will return all drugs that contain "Advil" within their brand name, such as "CHILDRENS ADVIL", "ADVIL MIGRAINE", and so on.

`brand_name` also has a `.exact`-suffix version. It too can be search for "Advil":

<https://api.fda.gov/drug/ndc.json?search=brand_name.exact:Advil&limit=1000>

You will now see fewer results. Each result will have (exactly--right?) "Advil" as its `brand_name` (nothing more and nothing less--right?). Exact match must
match exactly. **todo:** double check.

Here is another example taken from openfda.stackexchagne.com. It is a search looks for reports that may have been labeled with the incorrect product code:

<https://api.fda.gov/device/event.json?search=date_received:[20130401+TO+20180430]+AND+device.manufacturer_d_name:(Jude+Medtronic)+AND+(device.device_report_product_code:DRC+device.brand_name:("needle"+AND+("transseptal"+"brockenbrough"+"brk")))&limit=100&skip=0>

:::{note}
`brand_name` field is exact, and requires the search terms to be in parentheses. 
:::

**todo:**

- Run the queries above and understand what is being said and its accuracy and what exactly `.exact` does. 
- Create `.exact`-suffix versions of the queries in ~/o/s/query-parameters.md and likewise note the differences.

The two basic uses of search are:

search=field:value+AND+field:value for records that match both values.
search=field:value+field:value for records that match either of the values.

Using what I have learned by doing the above research, explain why does this query

<https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact>

work, but this one gives an error

<https://api.fda.gov/device/event.json?count=device.openfda.device_name>

I believe it is because the openfda fields are openfda, i.e.annotated, fields?

<https://api.fda.gov/device/event.json?searcount=device.manufacturer_name>

<https://api.fda.gov/device/event.json?count=device.manufacturer_name.exact>

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
