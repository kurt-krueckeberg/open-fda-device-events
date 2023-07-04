openFDA API Overview

## Authorization

Authorization limits:

- Without API authorization key: 240 requests allowed per minute, per IP address; 1,000 requests per day, per IP address.

- With API authorization key: 240 requests per minute; 120,000 requests per day.

## Authentication Method

Authentication using the API key is done two ways:

- passing it in the HTTP header using **basic auth** scheme: `Authorization: Basic eW91ckFQSUtleUhlcmU6`

- passing your API key with each request using the `api_key` query string parameter: `https://api.fda.gov/drug/event.json?api_key=yourAPIKeyHere&search=...`

## Queries

### JSON Results
 
There are two sections:

1. `results` &mdash; An arrray of matches (for non-counting querires).

2. `meta` &mdash; metadata:


   | Meta Field           | Details                                                                                                                                                                                                         |
   |:---------------------|:----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
   | `meta.disclaimer`    | Important details notes about openFDA data and limitations of the dataset.                                                                                                                                      |
   | `meta.license`       | Link to a web page with license terms that govern data within openFDA.                                                                                                                                          |
   | `meta.last_updated`  | The last date when this openFDA endpoint was updated. Note that this does not correspond to the most recent record for the endpoint or dataset. Rather, it is the last time the openFDA API was itself updated. |
   | `meta.results.skip`  | **Offset (page) of results,** defined by the *skip* query parameter.                                                                                                                                            |
   | `meta.results.limit` | **Number of records** in this return, defined by the *limit* query parameter. If there is no limit parameter, the API returns one result.                                                                       |
   | `meta.results.total` | **Total number of records** matching the search criteria. |
                                                                                                                                           
### Query Parameters

The API supports five query parameters:

| Parameter type | How it is used                                                                                                                      |        
|:---------|:---------------------------------------------------------------------------------------------------------------------------------|
|`search`| What to search for, in which fields. If you don’t specify a field to search, the API will search in every field.|
|`sort`| Sort the results of the search by the specified field in ascending or descending order by using the `:asc` or `:desc` modifier.|
|`count`| Count the number of unique values of a certain field, for all the records that matched the search parameter. By default, the API returns the 1000 most frequent values.|
|`limit`| Return up to this number of records that match the search parameter. Currently, the largest allowed value for the limit parameter is 1000.|
|`skip`| Skip this number of records that match the search parameter, then return the matching records that follow. Use in combination with limit to paginate results. Currently, the largest allowed value for the skip parameter is 25000. See Paging if you require paging through larger result sets.|

### Search Syntax

Searches have a special syntax: `search=field:term`. This query, for example, looks in the **drug/event** endpoint for a record where one of the reported patient reactions was fatigue. Search for records where the
field `patient.reaction.reactionmeddrapt` (patient reaction) contains **fatigue**:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

Search terms can be combined with **AND** to match both search terms or with **+** to match either of two terms.

#### Examples

##### Matching all search terms

This query looks in the  **drug/event** endpoint for a record where **both** fatigue was a reported patient reaction **and** the country in which the event happened was Canada:

```html
 https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1
```

##### Matching any search terms

This query looks in the **drug/event** endpoint for a record where **either** fatigue was a reported patient reaction **or** the country in which the event happened was Canada:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1
```

#### Sort ten results in descending order 

This query looks in the **drug/event** endpoint for ten records and sorts them in descending order by received date.

```html
https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10
```

#### Count number of unique records???

**TODO:** Better explain and illustrate `count`.

 `search=field1:term&count=field2`     Search for matching records. Then within that set                                                        
                                       of records, count the number of times that the unique values of a `field2` appear. Instead of looking at
                                       individual records, you can use the count parameter to count how often certain terms (like drug names or
                                       patient reactions) appear in the matching set of records.
 ------------------------------------- ------------------------------------------------------------------------------------------------------------

### All Device-Event search fields

Although most are not usually relevant, there are a total of 114 device event fields that can be searched.

|field\_name|datatype|definition|
|----------|--------|----------|
|adverse\_event\_flag|string|whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient.|
|date\_facility\_aware|string|date the user facility’s medical personnel or the importer (distributor) became aware that the device has or may have caused or contributed to the reported event.|
|date\_manufacturer\_received|string|date when the applicant, manufacturer, corporate affiliate, etc. receives information that an adverse event or medical device malfunction has occurred. this would apply to a report received anywhere in the world. for follow-up reports, the date that the follow-up information was received.|
|date\_of\_event|string|actual or best estimate of the date of first onset of the adverse event. this field was added in 2006.|
|date\_received|string|date the report was received by the fda.|
|date\_report|string|date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.|
|date\_report\_to\_fda|string|date the user facility/importer (distributor) sent the report to the fda, if applicable.|
|date\_report\_to\_manufacturer|string|date the user facility/importer (distributor) sent the report to the manufacturer, if applicable.|
|device.brand\_name|string|the trade or proprietary name of the suspect medical device as used in product labeling or in the catalog (e.g. flo-easy catheter, reliable heart pacemaker, etc.). if the suspect device is a reprocessed single-use device, this field will contain `na`.|
|device.catalog\_number|string|the exact number as it appears in the manufacturer’s catalog, device labeling, or accompanying packaging.|
|device.date\_received|string|documentation forthcoming. tk|
|device.date\_removed\_flag|string|whether an implanted device was removed from the patient, and if so, what kind of date was provided.|
|device.date\_returned\_to\_manufacturer|string|date the device was returned to the manufacturer, if applicable.|
|device.device\_age\_text|string|age of the device or a best estimate, often including the unit of time used. contents vary widely, but common patterns include: ## mo or ## yr (meaning number of months or years, respectively.|
|device.device\_availability|string|whether the device is available for evaluation by the manufacturer, or whether the device was returned to the manufacturer.|
|device.device\_evaluated\_by\_manufacturer|string|whether the suspect device was evaluated by the manufacturer.|
|device.device\_event\_key|string|documentation forthcoming.|
|device.device\_operator|string|the person using the medical device at the time of the adverse event. this may be a health professional, a lay person, or may not be applicable.|
|device.device\_report\_product\_code|string|three-letter fda product classification code. medical devices are classified under <a href='http://www.fda.gov/medicaldevices/deviceregulationandguidance/overview/classifyyourdevice/default.htm'>21 cfr parts 862-892</a>.|
|device.device\_sequence\_number|string|number identifying this particular device. for example, the first device object will have the value 1. this is an enumeration corresponding to the number of patients involved in an adverse event.|
|device.expiration\_date\_of\_device|string|if available; this date is often be found on the device itself or printed on the accompanying packaging.|
|device.generic\_name|string|the generic or common name of the suspect medical device or a generally descriptive name (e.g. urological catheter, heart pacemaker, patient restraint, etc.).|
|device.implant\_flag|string|whether a device was implanted or not. may be either marked n or left empty if this was not applicable.|
|device.lot\_number|string|if available, the lot number found on the label or packaging material.|
|device.manufacturer\_d\_address\_1|string|device manufacturer address line 1.|
|device.manufacturer\_d\_address\_2|string|device manufacturer address line 2.|
|device.manufacturer\_d\_city|string|device manufacturer city.|
|device.manufacturer\_d\_country|string|device manufacturer country.|
|device.manufacturer\_d\_name|string|device manufacturer name.|
|device.manufacturer\_d\_postal\_code|string|device manufacturer postal code.|
|device.manufacturer\_d\_state|string|device manufacturer state code.|
|device.manufacturer\_d\_zip\_code|string|device manufacturer zip code.|
|device.manufacturer\_d\_zip\_code\_ext|string|device manufacturer zip code extension.|
|device.model\_number|string|the exact model number found on the device label or accompanying packaging.|
|device.openfda|object| |
|device.other\_id\_number|string|any other identifier that might be used to identify the device. expect wide variability in the use of this field. it is commonly empty, or marked `na`, `n/a`, `*`, or `unk`, if unknown or not applicable.|
|device\_date\_of\_manufacturer|string|date of manufacture of the suspect medical device.|
|distributor\_address\_1|string|user facility or importer (distributor) address line 1.|
|distributor\_address\_2|string|user facility or importer (distributor) address line 2.|
|distributor\_city|string|user facility or importer (distributor) city.|
|distributor\_name|string|user facility or importer (distributor) name.|
|distributor\_state|string|user facility or importer (distributor) two-digit state code.|
|distributor\_zip\_code|string|user facility or importer (distributor) 5-digit zip code.|
|distributor\_zip\_code\_ext|string|user facility or importer (distributor) 4-digit zip code extension (zip+4 code).|
|event\_key|string|documentation forthcoming.|
|event\_location|string|where the event occurred.|
|event\_type|string|outcomes associated with the adverse event.|
|expiration\_date\_of\_device|string|if available; this date is often be found on the device itself or printed on the accompanying packaging.|
|health\_professional|string|whether the initial reporter was a health professional (e.g. physician, pharmacist, nurse, etc.) or not.|
|initial\_report\_to\_fda|string|whether the initial reporter also notified or submitted a copy of this report to fda.|
|manufacturer\_address\_1|string|suspect medical device manufacturer address line 1.|
|manufacturer\_address\_2|string|suspect medical device manufacturer address line 2.|
|manufacturer\_city|string|suspect medical device manufacturer city.|
|manufacturer\_contact\_address\_1|string|suspect medical device manufacturer contact address line 1.|
|manufacturer\_contact\_address\_2|string|suspect medical device manufacturer contact address line 2.|
|manufacturer\_contact\_area\_code|string|manufacturer contact person phone number area code.|
|manufacturer\_contact\_city|string|manufacturer contact person city.|
|manufacturer\_contact\_country|string|manufacturer contact person two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records.|
|manufacturer\_contact\_exchange|string|manufacturer contact person phone number exchange.|
|manufacturer\_contact\_extension|string|manufacturer contact person phone number extension.|
|manufacturer\_contact\_f\_name|string|manufacturer contact person first name.|
|manufacturer\_contact\_l\_name|string|manufacturer contact person last name.|
|manufacturer\_contact\_pcity|string|manufacturer contact person phone number city code.|
|manufacturer\_contact\_pcountry|string|manufacturer contact person phone number country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records.|
|manufacturer\_contact\_phone\_number|string|manufacturer contact person phone number.|
|manufacturer\_contact\_plocal|string|manufacturer contact person local phone number.|
|manufacturer\_contact\_postal\_code|string|manufacturer contact person postal code.|
|manufacturer\_contact\_state|string|manufacturer contact person two-letter state code.|
|manufacturer\_contact\_t\_name|string|manufacturer contact person title (mr., mrs., ms., dr., etc.)|
|manufacturer\_contact\_zip\_code|string|manufacturer contact person 5-digit zip code.|
|manufacturer\_contact\_zip\_ext|string|manufacturer contact person 4-digit zip code extension (zip+4 code).|
|manufacturer\_country|string|suspect medical device manufacturer two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records.|
|manufacturer\_g1\_address\_1|string|device manufacturer address line 1.|
|manufacturer\_g1\_address\_2|string|device manufacturer address line 2.|
|manufacturer\_g1\_city|string|device manufacturer address city.|
|manufacturer\_g1\_country|string|device manufacturer two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records.|
|manufacturer\_g1\_name|string|device manufacturer name.|
|manufacturer\_g1\_postal\_code|string|device manufacturer address postal code.|
|manufacturer\_g1\_state|string|device manufacturer address state.|
|manufacturer\_g1\_zip\_code|string|device manufacturer address zip code.|
|manufacturer\_g1\_zip\_code\_ext|string|device manufacturer address zip code extension.|
|manufacturer\_link\_flag|string|indicates whether a user facility/importer-submitted (distributor-submitted) report has had subsequent manufacturer-submitted reports. if so, the distributor information (address, etc.) will also be present and this field will contain `y`.|
|manufacturer\_name|string|suspect medical device manufacturer name.|
|manufacturer\_postal\_code|string|suspect medical device manufacturer postal code. may contain the zip code for addresses in the united states.|
|manufacturer\_state|string|suspect medical device manufacturer two-letter state code.|
|manufacturer\_zip\_code|string|suspect medical device manufacturer 5-digit zip code.|
|manufacturer\_zip\_code\_ext|string|suspect medical device manufacturer 4-digit zip code extension (zip+4 code).|
|mdr\_report\_key|string|a unique identifier for a report.|
|mdr\_text.date\_report|string|date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.|
|mdr\_text.mdr\_text\_key|string|documentation forthcoming.|
|mdr\_text.patient\_sequence\_number|string|number identifying this particular patient. for example, the first patient object will have the value 1. this is an enumeration corresponding to the number of patients involved in an adverse event.|
|mdr\_text.text|string|narrative text or problem description.|
|mdr\_text.text\_type\_code|string|string that describes the type of narrative contained within the text field.|
|number\_devices\_in\_event|string|number of devices noted in the adverse event report. almost always `1`. may be empty if `report\_source\_code` contains `voluntary report`.|
|number\_patients\_in\_event|string|number of patients noted in the adverse event report. almost always `1`. may be empty if `report\_source\_code` contains `voluntary report`.|
|patient.date\_received|string|date the report about this patient was received.|
|patient.patient\_problems|array of strings|describes actual adverse effects on the patient that may be related to the device problem observed during the reported event.|
|patient.patient\_sequence\_number|string|documentation forthcoming.|
|patient.sequence\_number\_outcome|array of strings|outcome associated with the adverse event for this patient. expect wide variability in this field; each string in the list of strings may contain multiple outcomes, separated by commas, and with numbers, which may or may not be related to the `patient\_sequence\_number`.|
|patient.sequence\_number\_treatment|array of strings|treatment the patient received.|
|previous\_use\_code|string|whether the use of the suspect medical device was the initial use, reuse, or unknown.|
|product\_problem\_flag|string|indicates whether or not a report was about the quality, performance or safety of a device.|
|product\_problems|array of strings|the product problems that were reported to the fda if there was a concern about the quality, authenticity, performance, or safety of any medication or device.|
|remedial\_action|array of strings|follow-up actions taken by the device manufacturer at the time of the report submission, if applicable.|
|removal\_correction\_number|string|if a corrective action was reported to fda under <a href='http://www.law.cornell.edu/uscode/text/21/360i'>21 usc 360i(f)</a>, the correction or removal reporting number (according to the format directed by <a href='http://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfcfr/cfrsearch.cfm?cfrpart=807'>21 cfr 807</a>). if a firm has not submitted a correction or removal report to the fda, but the fda has assigned a recall number to the corrective action, the recall number may be used.|
|report\_date|string|date of the report, or the date that the report was forwarded to the manufacturer and/or the fda.|
|report\_number|string|identifying number for the adverse event report. the format varies, according to the source of the report. the field is empty when a user facility submits a report. *for manufacturer reports*. manufacturer report number. the report number consists of three components: the manufacturer’s fda registration number for the manufacturing site of the reported device, the 4-digit calendar year, and a consecutive 5-digit number for each report filed during the year by the manufacturer (e.g. 1234567-2013-00001, 1234567-2013-00002). *for user facility/importer (distributor) reports*. distributor report number. documentation forthcoming. *for consumer reports*. this field is empty.|
|report\_source\_code|string|source of the adverse event report|
|report\_to\_fda|string|whether the report was sent to the fda by a user facility or importer (distributor). user facilities are required to send reports of device-related deaths. importers are required to send reports of device-related deaths and serious injuries.|
|report\_to\_manufacturer|string|whether the report was sent to the manufacturer by a user facility or importer (distributor). user facilities are required to send reports of device-related deaths and serious injuries to manufacturers. importers are required to send reports to manufacturers of device-related deaths, device-related serious injuries, and device-related malfunctions that could cause or contribute to a death or serious injury.|
|reporter\_occupation\_code|string|initial reporter occupation.|
|reprocessed\_and\_reused\_flag|string|indicates whether the suspect device was a single-use device that was reprocessed and reused on a patient.|
|single\_use\_flag|string|whether the device was labeled for single use or not.|
|source\_type|array of strings|the manufacturer-reported source of the adverse event report.|
|type\_of\_report|array of strings|the type of report.|

## My Prospective Subset of relevant fields

|field\_name|datatype|definition|
|----------|--------|----------|
|adverse\_event\_flag|string|whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient. TODO: Isn't this always true or yes in the case of an adverse device event?|
|device.device\_report\_product\_code|string|three-letter fda product classification code. medical devices are classified under <a href='http://www.fda.gov/medicaldevices/deviceregulationandguidance/overview/classifyyourdevice/default.htm'>21 cfr parts 862-892</a>.|
|device.generic\_name|string|the generic or common name of the suspect medical device or a generally descriptive name. TODO: Is LASIK a generic device or part of a generic device?).|
|event\_type|string|outcomes associated with the adverse event. TODO: Is theres a pre-defined set of event types?|
|mdr\_text.date\_report|string|date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.|
|mdr\_text.text|string|narrative text or problem description.|
|mdr\_text.text\_type\_code|string|string that describes the type of narrative contained within the text field.|
|patient.date\_received|string|date the report about this patient was received.|
|patient.sequence\_number\_outcome|array of strings|outcome associated with the adverse event for this patient. expect wide variability in this field; each string in the list of strings may contain multiple outcomes, separated by commas, and with numbers, which may or may not be related to the `patient\_sequence\_number`.|
|report\_date|string|date of the report, or the date that the report was forwarded to the manufacturer and/or the fda.|
|report\_source\_code|string|source of the adverse event report|
|type\_of\_report|array of strings|the type of report.|

### FDA Medical Device Product Codes

The FDA uses a three-letter, upper-case code to uniquely identify medical devices. A complete list of all the FDA device codes is in [foiclass.zip]() file and described [here](https://www.fda.gov/medical-devices/classify-your-medical-device/download-product-code-classification-files#description).

See these [LAISK-related Device Codes from Classification Database](lasik-device-codes.md).

### Examples

### Adverse Device Event

One adverse event report

TODO: Incorprate somewhere in this documentation the "device searchable fields" info contained in searchable-fields-device-api.yaml, which I have annotated.

Search for adverse events within a date range. A date range is specified using brackets `[ ]`; for example, to search for all records with date_received between
Jan 01, 2013 and Dec 31, 2014, and to limit the results to one retuned value:

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

See searchable fields for more about date_received. Brackets [ ] are used to specify a range for date, number, or string fields.

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

Resume [here](https://open.fda.gov/apis/device/event/example-api-queries/)

### Search Match Options

#### Match a single search term
 
This example API call queries the `drug/event` endpoint for records where one of the reported patient reactions was **fatigue**. `patient.reaction.reactionmeddrapt` (patient reaction) is searched for **fatigue**:

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1
```

#### Match several terms (AND)

Search the  `drug/event` endpoint for **fatigue** as a reported patient reaction and **Canada** as the country in which the reported event occurred. **AND** is used
to join two search terms. The country code for Canada is **ca**.

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1
```

#### Matching any search terms (OR)

Search the `drug/event` endpoint where either **fatigue** was a reported patient reaction *or* the country in which the event happened was **Canada**.

```html
https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1
```

#### Sort Results

Search the `drug/event` endpoint for: 

- ten records

- sorted in descending order by `receivedate`

```html
https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10
```

#### Counting records where certain terms occur

Search the `drug/event` endpoint for all records and count the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

- search all records

- Count the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The **`.exact`** suffix here tells the API to
  count whole phrases ("**injection site reaction**") instead of individual words (**injection**, **site**, and **reaction** separately)

```html
https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact
```

## API Syntax Rules

Unless otherwise specified, the API will return only one matching record for a search. You can specify the number of records to be returned by using the `limit` parameter. The maximum limit
allowed is 1000 for any single API call. If no limit is set, the API will return one matching record.

RESUME [HERE](https://open.fda.gov/apis/advanced-syntax/)

## Creating a Website that is a Vue.js Application

See:

- [How To Make API calls in Vue.JS Applications](https://medium.com/bb-tutorials-and-thoughts/how-to-make-api-calls-in-vue-js-applications-43e017d4dc86)

- [Consuming a REST API with Vue JS - Build a single-page application](https://www.youtube.com/watch?v=uFrL_xa77tE)
