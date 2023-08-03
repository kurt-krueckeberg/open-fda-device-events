# Queries Overview

## JSON Results Object

Query results are returned as a JSON object with two properties:

- `meta` certain data about the request.
- the `results` array

`meta` contains a `total` results count, and `offset` and `limit` values (useful for pagination):

   | Meta Field           | Details                                                                                                                                                                                                         |
   |:---------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
   | `meta.disclaimer`    | Important details notes about openFDA data and limitations of the dataset.                                                                                                                                      |
   | `meta.license`       | Link to a web page with license terms that govern data within openFDA.                                                                                                                                          |
   | `meta.last_updated`  | The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated. |
   | `meta.results.skip`  | The skip is the **offset** of the results.
   | `meta.results.limit` | **Number of records returned**, as defined by the *limit* query parameter. If the `limit` parameter was omitted, the API returns one result. |
   | `meta.results.total` | **Total number of records** matching the search criteria. |

2.`results` &mdash; the arrray of matches (for non-counting querires).

:::{important} 
Unless otherwise specified, the API will return only **one** matching record for a search. You can specify the number of records to be returned by using
the `limit` parameter. The maximum limit allowed is 1000 for any single API call. If no limit is set, the API will return one matching record.
:::

The query `https://api.fda.gov/drug/event.json?limit=1` searches the `drug/event` endpoint for a single record (`limit=1`).

The `results` properties in the single record returned contains all kinds of information about the adverse event report,
including the drugs that the patient was taking, the reactions that the patient experienced, and a good deal of other context:

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
      "total": 16364554
    }
  },
  "results": [
    {
      "safetyreportid": "5801206-7",
      "transmissiondateformat": "102",
      "transmissiondate": "20090109",
      "serious": "1",
      "seriousnessdeath": "1",
      "receivedateformat": "102",
      "receivedate": "20080707",
      "receiptdateformat": "102",
      "receiptdate": "20080625",
      "fulfillexpeditecriteria": "1",
      "companynumb": "JACAN16471",
      "primarysource": {
        "reportercountry": "CANADA",
        "qualification": "3"
      },
      "sender": {
        "senderorganization": "FDA-Public Use"
      },
      "receiver": null,
      "patient": {
        "patientonsetage": "26",
        "patientonsetageunit": "801",
        "patientsex": "1",
        "patientdeath": {
          "patientdeathdateformat": null,
          "patientdeathdate": null
        },
        "reaction": [
          {
            "reactionmeddrapt": "DRUG ADMINISTRATION ERROR"
          },
          {
            "reactionmeddrapt": "OVERDOSE"
          }
        ],
        "drug": [
          {
            "drugcharacterization": "1",
            "medicinalproduct": "DURAGESIC-100",
            "drugauthorizationnumb": "019813",
            "drugadministrationroute": "041",
            "drugindication": "DRUG ABUSE"
          }
        ]
      }
    }
  ]
}
```
