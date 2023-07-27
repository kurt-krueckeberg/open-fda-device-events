# Advanced Syntax

You can group search criterai with `()` and do boolean `OR` and `AND` searches.
## Examples of Grouping and Boolean Searches

Grouping several terms inside `( )` can simplify searches. For example, a long search expression like

<https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF"+device.device_report_product_Code="LZS">

can be rewritten with `()` and `OR`:

<https://api.fda.gov/device/event.json?search=device.device_report_product_Code=("HQF"+OR+"LZS")>

:::{important}
Apparently a boolean-or search of phrases **requires** `()` and `OR` like this \
`https://api.fda.gov/drug/enforcement.json?search=classification:("Class+I"+OR+"Class+II")` \
with the embedded spaced denoted by `+`. \
See <https://opendata.stackexchange.com/questions/3443/openfda-api-can-i-perform-search-by-same-field-with-various-values/3444#3444>
:::

You can also perform AND searches (to find all matching search terms). As an example, say, you want to find where `patient.drug.medicinalproduct`
contains `cetirizine` and where `serious` is `2`, you can do

<https://api.fda.gov/drug/event.json?search=patient.drug.medicinalproduct:cetirizine+AND+serious:2>

You can add `OR` search criteria to search for one of several `medicinalproduct`:

<https://api.fda.gov/drug/event.json?search=patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine)+AND+serious:2>

The example above could also have been written (with a further set of `()`) as

<https://api.fda.gov/drug/event.json?search=(patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine))+AND+serious:2>

## Further Examples

Search for the adverse events where `device.device_report_product_code=LZS`, Excimer Laser Systems, and where the reported text contains `dry`

<https://api.fda.gov/device/event.json?search=(device.device_report_product_code=LZS)+AND+(mdr_text.text:dry)>

you get 1596 total results. If you use the `.exact` suffix and change `:` to `=`:

<https://api.fda.gov/device/event.json?search=(device.device_report_product_code=LZS)+AND+(mdr_text.text.exact=dry)>

you get 1822 total results. **todo:** where do the results differ and why?

## Dates and ranges

The openFDA API supports searching by range in date, numeric, or string fields.

- Specify an inclusive range by using square brackets `[min+TO+max]`. These include the values in the range. For example, `[1+TO+5]` will match 1 through 5.

- Dates are simple to search by via range. For instance, `[2004-01-01+TO+2005-01-01]` will search for records between **Jan 1, 2004** and **Jan 1, 2005**.

**TODO:** Add example

## Missing (or not missing) values

You can search for empty fields or for fields that are not empty:

* `_missing_`: search modifier that matches when a field has no value (is empty).

* `_exists_`: search modifier that matches when a field has a value (is not empty).

**TODO:** Add example

## Timeseries

**TODO:** Add example

## Paging

**TODO:** Add example

