# Further Examples

## Adverse Device Events

One adverse event report

TODO: Incorprate somewhere in this documentation the "device searchable fields" info contained in searchable-fields-device-api.yaml, which I have annotated.

Search for adverse events within a date range. A date range is specified using brackets `[ ]`; for example, to search for all records with date\_received between
Jan 01, 2013 and Dec 31, 2014, and to limit the results to one retuned value:

`https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1`

See searchable fields for more about date\_received. Brackets [ ] are used to specify a range for date, number, or string fields.

`https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1`

Resume [here](https://open.fda.gov/apis/device/event/example-api-queries/)

## Match Options Example

### Match a single search term
 
This example API call queries the `drug/event` endpoint for records where one of the reported patient reactions was **fatigue**. `patient.reaction.reactionmeddrapt` (patient reaction) is searched for **fatigue**:

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"&limit=1`

### Match several terms (AND)

Search the  `drug/event` endpoint for **fatigue** as a reported patient reaction and **Canada** as the country in which the reported event occurred. **AND** is used
to join two search terms. The country code for Canada is **ca**.

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+AND+occurcountry:"ca"&limit=1`

### Matching any search terms (OR)

Search the `drug/event` endpoint where either **fatigue** was a reported patient reaction *or* the country in which the event happened was **Canada**.

`https://api.fda.gov/drug/event.json?search=patient.reaction.reactionmeddrapt:"fatigue"+occurcountry:"ca"&limit=1`

### Sort Results

Search the `drug/event` endpoint for: 

- ten records

- sorted in descending order by `receivedate`

`https://api.fda.gov/drug/event.json?sort=receivedate:desc&limit=10`

### Counting records where certain terms occur

Search the `drug/event` endpoint for all records and count the top patient reactions. For each reaction, the number of records that matched is summed, providing a useful summary.

- search all records

- Count the number of records matching the terms in `patient.reaction.reactionmeddrapt.exact`. The **`.exact`** suffix here tells the API to
  count whole phrases ("**injection site reaction**") instead of individual words (**injection**, **site**, and **reaction** separately)

`https://api.fda.gov/drug/event.json?count=patient.reaction.reactionmeddrapt.exact`
