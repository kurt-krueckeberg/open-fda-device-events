# Todo

## Read

## stackexchange replies

To learn more about the openFDA API read the replies at: [https://opendata.stackexchange.com/questions/tagged/openfda](https://opendata.stackexchange.com/questions/tagged/openfda)

My question [Why does device.device_report_product_code require = rather than :?](https://opendata.stackexchange.com/questions/21134/why-does-device-device-report-product-code-require-rather-than/21164#21164) 
did get answered:

 > This is a very strange bug - the API should be erroring with the use of an equal sign there. We'll open a bug report and investigate.
In the meantime, the ':' version does return results and should be what is used.
Regards,
Violet Wren
openFDA Tech Lead

## ElasticSearch Query DSL (Domain Specific Language) 

Elasticsearch [query string query](https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html).

## Test Queries 

`device.generic_name` results when `device.product_code=LZS`: 

```{list-table} Example 1
:header-rows: 1 
:name: example-1
:align: left
:width: 70%
:widths: 2 3

*  - Field
   - Value
*  - `device.brand_name`
   - "LADARVISION 4000"
*  - `device.generic_name`
   - "OPTHALMIC EXCIMER LASER SYSTEM"
*  - `device.openfda.device_name`
   - "Excimer Laser System"
*  - `device.openfda.device_class`
   - "3"
```

```{list-table} Example 2
:header-rows: 1
:name: example-2
:width: 70%
:align: left
:widths: 2 3

* - Field
  - Value
* - `device.brand_name`
  - "LASIK MD VISION"
* - `device.generic_name`
  - "EXCIMER LASER SYSTEM"
* - `device.openfda.device_name`
  - "EXCIMER LASER SYSTEM"
* - `device.openfda.device_class`
  - "3"
```

```{list-table} Example 3
:name: example-3
:name: example-3
:width: 70%
:widths: 2 3
:align: left

* - Field
  - Value
* - `device.brand_name` 
  - "WAVEFRONT
* - `device.generic_name` 
  - "EXCIMER
* - `device.openfda.device_name` 
  - "EXCIMER LASER SYSTEM"
* - `device.openfda.device_class` 
  - 3
```

```{list-table} Example 4
:header-rows: 1
:name: example-4
:width: 70%
:widths: 2 3
:align: left

* - Field
  - Value
* - `device.brand_name`
  - "VISX STAR S4 IR EXCIMER LASER"
* - `device.generic_name`
  - "EXCIMER LASER"
* - `device.openfda.device_name`
  - "Excimer Laser System"
* - `device.openfda.device_class`
  - 3
```

```
https://api.fda.gov/device/event.json?search=device.device_report_product_code=LZS
```

<a href='https://api.fda.gov/device/event.json?search=device.device_report_product_code=LZS'>Execute query</a>

```
https://api.fda.gov/device/event.json?search=device.device_report_product_code.exact=LZS
```

<a href='https://api.fda.gov/device/event.json?search=device.device_report_product_code.exact=LZS'>Execute query</a>

`meta.results.total` is **13303** for both queries!

### Understanding `count`

The `count` query parameter:

> Counts the number of unique values of a certain field, for all the records that matched the search parameter. By default, the API returns the
1000 most frequent values.

:::{important}
You can interactively get `count` results for several different `device` event fields at [Device adverse event reports over time](https://api.fda.gov/apis/device/event/explore-the-api-with-an-interactive-chart/).
:::

Take this **search example** with `count=receivedate`:

```
https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
```

### `count` and `.exact`

According to the [query syntax](https://open.fda.gov/apis/query-syntax/), a **count** query with and `.exact` field as in this example

```
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
```

<a href='https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact'>Execute call</a>

counts "the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The `.exact` suffix here tells the API to **count whole phrases**
(e.g. "injection site reaction") instead of individual words (e.g. "injection", "site", and "reaction" separately)

<a href='https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0'>Execute the call</a>

In general, a field with an addition `.exact` suffix version has been indexed as entire phrases. For example, the `device.brand_name` contains the trade or proprietary name of a medical
device. If, say, the `device.brand_name` is "VISX STAR S4 IR EXCIMER LASER", but you want to search for any brand name containing "VISX", you must search using
 
```
search=device.brand_name:"VISX"
```

This will return over 100 adverse event report results, such as: "VISX STAR4", "VISX STAR S4 IR EXCIMER LASER" and so on. On the other hand, if you search the `.exact` version, you will find only 37 
adverse event reports, each with `device.brand_name` = "VISIX" (and no other strings).

```
search=device.brand_name.exact:"VISX"
```

Thus, this query

```
https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
```

is **not** a boolean search of two different generic drug: "DROSPIRENONE" and "ETHINYL ESTRADIOL". Instead `patient.drug.openfda.generic_name.exact` is searched for the precise string "DROSPIRENONE AND ETHINYL ESTRADIOL". **AND** is not a boolean
operator. It is part of the string being searched for. In fact, searching for two different generic names would not make sense since there is only one. 

When `count=receivedate` is added

```
https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
```

then only the count results are returned. We can break the query down:

`count=receivedate` counts the *unique* "report first received" dates where:

-  the generic name of the drug is **DROSPIRENONE and ETHINYL ESTRADIOL**: \
  `patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")`

- the reaction to the above drug combination was (included?) pain: \
  `patient.reaction.reactionmeddrapt.exact:("PAIN")`

 - the range of dates (when the report was first received) is from June 29, 1989 to August 11, 2015 \
   `receivedate:([1989-06-29+TO+2015-08-11])`  

:::{note}
With `.exact` searches, AND probably doesn't mean anything if you are searching exact and entire strings. Boolean OR is probably more relevant.
:::

The number of matching records for `patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")` is **16364554**, but
the results show the count of of the date when the report was first received accompanied by the date. Most count values equal 1 but not all:

```json
{
  "meta": {
    "disclaimer": "Do not rely on openFDA to make decisions regarding medical care. While we make every effort to ensure that data is accurate, you should assume all results are unvalidated. We may limit or otherwise restrict your access to the API in line with our Terms of Service.",
    "terms": "https://open.fda.gov/terms/",
    "license": "https://open.fda.gov/license/",
    "last_updated": "2023-04-27"
  },
  "results": [
    {
      "time": "20040223",
      "count": 1
    },
    {
      "time": "20040928",
      "count": 1
    },
    {
      "time": "20050418",
      "count": 1
    },
    {
      "time": "20050614",
      "count": 1
    },
    {
      "time": "I snipped many results...",
      "count": "...in order to show a count result other than 1. There are man more results after the value below, too."
    },
    {
      "time": "20100630",
      "count": 3
    },
}
```

If `count=..` is omitted the results (ony the first result is shown below) are:

```json
{
    "meta": {
      "disclaimer": "Do not rely on openFDA to make decisions regarding medical care. While we make every effort to ensure that data is accurate, you should assume all results are unvalidated. We may limit or otherwise restrict your access to the API in line with our Terms of Service.",
      "terms": "https://open.fda.gov/terms/",
      "license": "https://open.fda.gov/license/",
      "last_updated": "2023-04-27",
      "results": {
        "skip": 0,
        "limit": 1,
        "total": 12898
      }
    },
    "results": [
      {
        "safetyreportversion": "3",
        "safetyreportid": "10003860",
        "primarysourcecountry": "US",
        "occurcountry": "US",
        "transmissiondateformat": "102",
        "transmissiondate": "20150720",
        "reporttype": "1",
        "serious": "1",
        "seriousnesshospitalization": "1",
        "receivedateformat": "102",
        "receivedate": "20140312",
        "receiptdateformat": "102",
        "receiptdate": "20150331",
        "fulfillexpeditecriteria": "1",
        "companynumb": "US-BAYER-2014-035493",
        "duplicate": "1",
        "reportduplicate": {
          "duplicatesource": "BAYER",
          "duplicatenumb": "US-BAYER-2014-035493"
        },
        "primarysource": {
          "reportercountry": "US",
          "qualification": "5"
        },
        "sender": {
          "sendertype": "2",
          "senderorganization": "FDA-Public Use"
        },
        "receiver": {
          "receivertype": "6",
          "receiverorganization": "FDA"
        },
        "patient": {
          "patientonsetage": "25",
          "patientonsetageunit": "801",
          "patientagegroup": "5",
          "patientweight": "49.89",
          "patientsex": "2",
          "reaction": [
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Injury"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "General physical health deterioration"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Cerebrovascular arteriovenous malformation",
              "reactionoutcome": "1"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Gastrooesophageal reflux disease"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Peripheral artery thrombosis"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Pain"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Anxiety"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Abdominal pain"
            },
            {
              "reactionmeddraversionpt": "18.0",
              "reactionmeddrapt": "Emotional distress"
            }
          ],
          "drug": [
            {
              "drugcharacterization": "2",
              "medicinalproduct": "AMITRIPTYLINE",
              "drugstructuredosagenumb": "25",
              "drugstructuredosageunit": "003",
              "drugdosagetext": "25 MG, ONCE AT NIGHT",
              "drugindication": "NECK PAIN",
              "activesubstance": {
                "activesubstancename": "AMITRIPTYLINE"
              }
            },
            {
              "drugcharacterization": "1",
              "medicinalproduct": "YAZ",
              "drugauthorizationnumb": "021676",
              "drugdosagetext": "UNK",
              "drugdosageform": "FILM-COATED TABLET",
              "drugstartdateformat": "610",
              "drugstartdate": "200804",
              "drugenddateformat": "610",
              "drugenddate": "200807",
              "actiondrug": "1",
              "activesubstance": {
                "activesubstancename": "DROSPIRENONE\\ETHINYL ESTRADIOL"
              },
              "openfda": {
                "application_number": [
                  "NDA021676"
                ],
                "brand_name": [
                  "YAZ"
                ],
                "generic_name": [
                  "DROSPIRENONE AND ETHINYL ESTRADIOL"
                ],
                "manufacturer_name": [
                  "Bayer HealthCare Pharmaceuticals Inc."
                ],
                "product_ndc": [
                  "50419-405"
                ],
                "product_type": [
                  "HUMAN PRESCRIPTION DRUG"
                ],
                "rxcui": [
                  "630734",
                  "748797",
                  "748798",
                  "748856"
                ],
                "spl_id": [
                  "bd3baa73-1d24-49e2-9120-fa7c82f3af90"
                ],
                "spl_set_id": [
                  "065f33e4-b587-4e66-b896-ca9ab7b7c876"
                ],
                "package_ndc": [
                  "50419-405-03"
                ]
              }
            },
            {
              "drugcharacterization": "2",
              "medicinalproduct": "REOPRO",
              "activesubstance": {
                "activesubstancename": "ABCIXIMAB"
              }
            },
            {
              "drugcharacterization": "2",
              "medicinalproduct": "ACIPHEX",
              "drugstructuredosagenumb": "20",
              "drugstructuredosageunit": "003",
              "drugseparatedosagenumb": "2",
              "drugintervaldosageunitnumb": "1",
              "drugintervaldosagedefinition": "804",
              "drugdosagetext": "20 MG, BID",
              "drugindication": "GASTROOESOPHAGEAL REFLUX DISEASE",
              "activesubstance": {
                "activesubstancename": "RABEPRAZOLE SODIUM"
              },
              "openfda": {
                "application_number": [
                  "NDA020973"
                ],
                "brand_name": [
                  "ACIPHEX"
                ],
                "generic_name": [
                  "RABEPRAZOLE SODIUM"
                ],
                "manufacturer_name": [
                  "Eisai Inc.",
                  "Woodward Pharma Services LLC"
                ],
                "product_ndc": [
                  "62856-243",
                  "69784-243"
                ],
                "product_type": [
                  "HUMAN PRESCRIPTION DRUG"
                ],
                "route": [
                  "ORAL"
                ],
                "substance_name": [
                  "RABEPRAZOLE SODIUM"
                ],
                "rxcui": [
                  "854868",
                  "854870"
                ],
                "spl_id": [
                  "e00fa711-01d4-48ba-9c3a-594fb6abff02",
                  "be3a78bc-4f9c-473f-bb62-bd1d6920b5ec"
                ],
                "spl_set_id": [
                  "5d103551-978f-472a-9c62-51e6e4dea068",
                  "42282e11-3179-420e-b979-e53dd5bd4b12"
                ],
                "package_ndc": [
                  "62856-243-30",
                  "62856-243-90",
                  "62856-243-41",
                  "69784-243-30"
                ],
                "unii": [
                  "3L36P16U4R"
                ]
              }
            },
            {
              "drugcharacterization": "2",
              "medicinalproduct": "TOPAMAX",
              "drugstructuredosagenumb": "400",
              "drugstructuredosageunit": "003",
              "drugdosagetext": "400 MG,ONCE IN THE MORNING",
              "drugindication": "SEIZURE",
              "activesubstance": {
                "activesubstancename": "TOPIRAMATE"
              },
              "openfda": {
                "application_number": [
                  "NDA020505",
                  "NDA020844"
                ],
                "brand_name": [
                  "TOPAMAX"
                ],
                "generic_name": [
                  "TOPIRAMATE"
                ],
                "manufacturer_name": [
                  "Janssen Pharmaceuticals, Inc."
                ],
                "product_ndc": [
                  "50458-639",
                  "50458-640",
                  "50458-641",
                  "50458-642",
                  "50458-647",
                  "50458-645"
                ],
                "product_type": [
                  "HUMAN PRESCRIPTION DRUG"
                ],
                "route": [
                  "ORAL"
                ],
                "substance_name": [
                  "TOPIRAMATE"
                ],
                "rxcui": [
                  "151226",
                  "151227",
                  "151228",
                  "151229",
                  "152855",
                  "199888",
                  "199889",
                  "199890",
                  "205315",
                  "205316",
                  "845478",
                  "845479"
                ],
                "spl_id": [
                  "fb80f4b4-14e7-484c-e053-6294a90af892"
                ],
                "spl_set_id": [
                  "21628112-0c47-11df-95b3-498d55d89593"
                ],
                "package_ndc": [
                  "50458-639-65",
                  "50458-640-65",
                  "50458-641-65",
                  "50458-642-65",
                  "50458-647-65",
                  "50458-645-65"
                ],
                "nui": [
                  "N0000008486",
                  "N0000185506",
                  "N0000182140"
                ],
                "pharm_class_pe": [
                  "Decreased Central Nervous System Disorganized Electrical Activity [PE]"
                ],
                "pharm_class_moa": [
                  "Cytochrome P450 3A4 Inducers [MoA]",
                  "Cytochrome P450 2C19 Inhibitors [MoA]"
                ],
                "unii": [
                  "0H73WJJ391"
                ]
              }
            },
            {
              "drugcharacterization": "1",
              "medicinalproduct": "YASMIN",
              "drugdosagetext": "UNK",
              "drugdosageform": "FILM-COATED TABLET",
              "drugstartdateformat": "602",
              "drugstartdate": "2005",
              "drugenddateformat": "602",
              "drugenddate": "2005",
              "activesubstance": {
                "activesubstancename": "DROSPIRENONE\\ETHINYL ESTRADIOL"
              },
              "openfda": {
                "application_number": [
                  "NDA021098"
                ],
                "brand_name": [
                  "YASMIN"
                ],
                "generic_name": [
                  "DROSPIRENONE AND ETHINYL ESTRADIOL"
                ],
                "manufacturer_name": [
                  "Bayer HealthCare Pharmaceuticals Inc."
                ],
                "product_ndc": [
                  "50419-402"
                ],
                "product_type": [
                  "HUMAN PRESCRIPTION DRUG"
                ],
                "rxcui": [
                  "284207",
                  "748797",
                  "748800",
                  "748857"
                ],
                "spl_id": [
                  "0940c8a8-b5cd-4ba6-9fc8-ca4f55ae3973"
                ],
                "spl_set_id": [
                  "d7ea6a60-5a56-4f81-b206-9b27b7e58875"
                ],
                "package_ndc": [
                  "50419-402-03"
                ]
              }
            }
          ],
          "summary": {
            "narrativeincludeclinical": "CASE EVENT DATE: 200807"
          }
        }
      }
    ]
  }
}
```

**Comments:** The `.exact` generic names of the drugs were used rather than their brand name

:::{Important}
Is the boolean logic in the above query: **DROSPIRENONE** AND (**ETHINYL** or **ESTRADIOL**)? This **MUST** be understood.
:::

**Example 2:** This query looks in the `drug/event.json` endpoint for the count of the top patient reactions. For each reaction, the number of records that matched is summed, providing
a useful summary.

> Search for all records
Count the number of records matching the terms in patient.reaction.reactionmeddrapt.exact. The .exact suffix here tells the API to count whole phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately)

[https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact](https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact)

### `.exact` questions

These comments are from an openFDA team member...

Some fields also have a second, `.exact` version which can also be searched. A field specified without the `.exact` suffix can be search for
partial, "is contained in" searches. It has been tokenized to allow flexible partial searches, so a query like 

`https://api.fda.gov/drug/ndc.json?search=brand_name:Advil&limit=1000`

will return all drugs that contain "Advil" within their brand name, such as "CHILDRENS ADVIL", "ADVIL MIGRAINE", and so on.

`brand_name` also has a `.exact`-suffix version. It too can be search for "Advil":

`https://api.fda.gov/drug/ndc.json?search=brand_name.exact:Advil&limit=1000`

You will now see fewer results. Each result will have (exactly--right?) "Advil" as its `brand_name` (nothing more and nothing less--right?). Exact match must
match exactly. **todo:** double check.

Here is another example taken from openfda.stackexchagne.com. It is a search looks for reports that may have been labeled with the incorrect product code:

```
https://api.fda.gov/device/event.json?search=date_received:[20130401+TO+20180430]+AND+device.manufacturer_d_name:(Jude+Medtronic)+AND+(device.device_report_product_code:DRC+device.brand_name:("needle"+AND+("transseptal"+"brockenbrough"+"brk")))&limit=100&skip=0">https://api.fda.gov/device/event.json?search=date_received:[20130401+TO+20180430]+AND+device.manufacturer_d_name:(Jude+Medtronic)+AND+(device.device_report_product_code:DRC+device.brand_name:("needle"+AND+("transseptal"+"brockenbrough"+"brk")))&limit=100&skip=0
```

<a href='https://api.fda.gov/device/event.json?search=date_received:[20130401+TO+20180430]+AND+device.manufacturer_d_name:(Jude+Medtronic)+AND+(device.device_report_product_code:DRC+device.brand_name:("needle"+AND+("transseptal"+"brockenbrough"+"brk")))&limit=100&skip=0'>Execute query above</a>

:::{note}
`brand_name` field is exact, and requires the search terms to be in parentheses. 
:::

**todo:**

- Run the queries above and understand what is being said and its accuracy and what exactly `.exact` does. 
- Create `.exact`-suffix versions of the queries in ~/o/s/query-parameters.md and likewise note the differences.

The two basic uses of search are:

`search=field:value+AND+field:value` for records that match both values and `search=field:value+field:value` for records that match either of the values.

Using what I have learned by doing the above research, why does this query

[https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact](https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact)

work, but this one gives an error?

[https://api.fda.gov/device/event.json?count=device.openfda.device_name](https://api.fda.gov/device/event.json?count=device.openfda.device_name)

Is it because the openfda fields are annotated fields? Compare these two queries:

[https://api.fda.gov/device/event.json?searcount=device.manufacturer_name](https://api.fda.gov/device/event.json?searcount=device.manufacturer_name)

[https://api.fda.gov/device/event.json?count=device.manufacturer_name.exact](https://api.fda.gov/device/event.json?count=device.manufacturer_name.exact)

## Issues

Example 1 

[https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:nausea](https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:nausea) 

returns a total of 628612 meta.results.total.

but using `=` instead of `:` 
 
[https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt=nausea](https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt=nausea)

returns 687192 results.total. Why more?

Example 2

[https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF"](https://api.fda.gov/device/event.json?search=device.device_report_product_Code="HQF")

returns results but 

[https://api.fda.gov/device/event.json?search=device.device_report_product_Code:"HQF"](https://api.fda.gov/device/event.json?search=device.device_report_product_Code:"HQF")

returns nothing.

I think `:` means contains while `=` means "matches exactly"?

Both of these searches

[https://api.fda.gov/device/event.json?search=device.openfda.device_name:Excimer](https://api.fda.gov/device/event.json?search=device.openfda.device_name:Excimer)

[https://api.fda.gov/device/event.json?search=device.openfda.device_name.exact:"Excimer+Laser+System""](https://api.fda.gov/device/event.json?search=device.openfda.device_name.exact:"Excimer+Laser+System"")

return the same totals of 13267.

Note: `mdr_report_key`, which is unique, is returned in every `device/event` query.

including it in the search of both queries, writing PHP code to execute the 
queries and save the searched-for field and the unique field to a file. Then sorting the files based on the 
`mdr_report_key` and doing the set difference.
