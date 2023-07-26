# Examples

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

````
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
````

All `drug/event` endpoint [examples](https://open.fda.gov/apis/drug/event/example-api-queries/):

1. Search for all records with receivedate between Jan 01, 2004 and Dec 31, 2008. limit to 1 record.

````
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
````

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
