# Examples

TODO: Add the examples in todo.md here.

## Collect These Further Examples

Collect these examples. Note how `.exact` and `count` are used.

- [https://open.fda.gov/apis/device/enforcement/example-api-queries/](https://open.fda.gov/apis/device/enforcement/example-api-queries/)
- [https://open.fda.gov/apis/device/recall/example-api-queries/](https://open.fda.gov/apis/device/recall/example-api-queries/)
- [https://open.fda.gov/apis/food/event/example-api-queries/](https://open.fda.gov/apis/food/event/example-api-queries/)

## Drug Adverse Event Examples

Count number of unique matching records

| `count` syntax                      | Explanation                                                                                                                      |
|:------------------------------------|:----------------------------------------------------------------------------------------------------------------|
| `search=field1:term&count=field2`   | Search for matching records and, then, within that set of records, count the number of times that the unique values of a `field2` appear.|

This query looks in the **drug/event** endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records
that matched is summed, providing a useful summary.

Search for all records

We `count` the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The `.exact` suffix here tells the API to count whole
phrases (e.g. injection site reaction) instead of individual words (e.g. injection, site, and reaction separately):

```
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
```

All `drug/event` endpoint [examples](https://open.fda.gov/apis/drug/event/example-api-queries/):

1. Search for all records with receivedate between Jan 01, 2004 and Dec 31, 2008. limit to 1 record.

```
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

<a href='https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1'>Execute call</a>

2. Search for records where the field `patient.reaction.reactionmeddrapt` (patient reaction) contains "fatigue" and `occurcountry` (country where the event happened) was "ca" (the country code for Canada)

```
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1
```

<a href='https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1'>Execute call</a>

3. Search for records where the field `patient.reaction.reactionmeddrapt` (patient reaction) contains "fatigue" or `occurcountry` (country where the event happened) was "ca" (the country code for Canada)

```
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1
```

<a href='https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1'>Execute call</a>

4. https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10

This query looks in the `drug/event` endpoint for ten records and sorts them in descending order by received date `receivedate`.

```
https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10
```

<a href='https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10'>Execute call</a  >


5. This query looks in the drug/event endpoint for all records. It then returns a count of the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

```
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
```

<a href='https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact'>Execute it</a>

Search for all records with product_code equals NOB.

```
https://api.fda.gov/device/classification.json?search=product_code:NOB&limit=1
```

<a href='https://api.fda.gov/device/classification.json?search=product_code:NOB&limit=1'>Execute call</a>

This query is similar to the prior one, but returns a count of the FEI numbers.

```
https://api.fda.gov/device/classification.json?count=openfda.fei_number
```

<a href='https://api.fda.gov/device/classification.json?count=openfda.fei_number'>Execute call</a>

6. This complex search is ambiguous.

```
https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
```

How does ElasticSearch interpret the search expression: `patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")`?

Is there an explanation on openFDA for such a search?

I believe it does "DROSPIRENONE and 'ETHINYL ESTRADIOL'" and not "DROSPIRENONE and ETHINYL or ESTRADIOL". In the latter case, you also need to know how
precdence of AND and OR and whether the precedence is equaluated left-to-right or right-to-left. 

In order to find out, test queries need to be created; however, if ETHINYL only occurs before ESTRADIOL, such queries could not be constructed.

<a href='https://api.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0'>Execute the call</a>

**Analysis:**

`count=receivedate` counts the *unique* "report first received" dates where:

-  the generic name of the drugs taken were **DROSPIRENONE** and **ETHINYL** or **ESTRADIOL**: \
  `patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")`

- the reaction to the above drug combination was (included?) pain: \
  `patient.reaction.reactionmeddrapt.exact:("PAIN")`

 - the range of dates (when the report was first received) is from June 29, 1989 to August 11, 2015 \
   `receivedate:([1989-06-29+TO+2015-08-11])`  

The number of matching records for `patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")` is **16364554**, but
the results show the count of of the date when the report was first received accompanied by the date. Most count values equal 1 but not all.

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


## [Device 510(k) API queries](https://open.fda.gov/apis/device/510k/example-api-queries/)

1. Search for all records with `advisory_committee` equal to cv.

```
https://api.fda.gov/device/510k.json?search=advisory_committee:cv&limit=1
```

<a href='https://api.fda.gov/device/510k.json?search=advisory_committee:cv&limit=1'>Execute call</a>

Search for all records with openfda.regulation_number equals 868.5895 and return just 1.

```
https://api.fda.gov/device/510k.json?search=openfda.regulation_number:868.5895&limit=1
```

<a href='https://api.fda.gov/device/510k.json?search=openfda.regulation_number:868.5895&limit=1'>Execute call</a>

2. Search in the 501K enepoint and count the country code(s):

```
https://api.fda.gov/device/510k.json?count=country_code
```

<a href='https://api.fda.gov/device/510k.json?count=country_code'>Execute call</a>

## [Device Classification Endpoint Examples](https://open.fda.gov/apis/device/classification/example-api-queries/)

Search for all records with regulation_number equal to 872.6855

```
https://api.fda.gov/device/classification.json?search=regulation_number:872.6855&limit=1
```

<a href='https://api.fda.gov/device/classification.json?search=regulation_number:872.6855&limit=1'>Execute call</a>
