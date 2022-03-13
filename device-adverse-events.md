<div class="container">

# Adverse Event Reports API

## About the "Manufacturer and User Facility Device Experience" Database

The Manufacturer and User Facility Device Experience (MAUDE) database contains medical device adverse event reports submitted by mandatory reporters—manufacturers,
importers and device user facilities—and voluntary reporters such as health care professionals, patients, and consumers. Currently, this data covers publically releasable records submitted
to the FDA from about 1992 to the present. The data is updated weekly.

The device adverse event reports [search page](https://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfmaude/search.cfm) offers **standard search options** worth remembering.

### How adverse events are collected

### Identifying Adverse Events

Adverse events are collected through a series of safety reports. Each is identified by a 8-digit string

  **6176304-1**.

where the first 7 digits (before the hyphen) identify the individual report, and the last digit (after the hyphen) indicates the order of the report. For eample, if three reports are submitted (for the same event),
they would be saved as

- **6176304-1**
- **6176304-2**
- **6176304-3**

### Using [Medwatch]((https://www.accessdata.fda.gov/scripts/medwatch/index.cfm) to Report Adverse Events

On the [MedWatch Online Voluntary Reporting Form](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm) website patients and health professionals can submit "adverse device event" reports. Heatlh professionals can submit
[FDA Form 3500](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm?action=professional.reporting1) online and consumers 
[FDA Form 3500B](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm?action=consumer.reporting1)".

### How Adverse Event Reports are Organized

Device adverse event reports vary significantly, depending on who initially reported the event, what kind of event was reported, and whether there were follow-up reports. Some reports
come directly from user facilities (like hospitals) or device importers (distributors), while others come directly from manufacturers. Some involve adverse reactions in patients, while
others are reports of defects that did not result in such adverse reactions.

OpenFDA device adverse event results loosely reflect fields found in forms used by manufacturers and members of the public to report these events. Since reports may come
from manufacturers, user facilities, distributors, and voluntary sources (such as patients and physicians) who are subject to different reporting requirements, the collected data in
the adverse event system may not always capture every field and should not be interpreted as incomplete.

## Device Adverse Event API

### Endpoint URL

<span style="font-size: 1.4em;font-weight: 500;background:#add8e6">https://api.fda.gov/device/event.json<span style="background:#ffe4b5">?</span><span style="background: #ffa07a">search=</span><span style="background: #90ee90">device.generic_name:x-ray</span><span style="background:#ffe4b5">&</span><span style="background:#ffb6c1">limit=5</span><span>

### Example Adverse Device Event Queries

#### One adverse event report

TODO: Incorprate somewhere in this documentation the "device searchable fields" info contained in ~/o/searchable-fields-device-api.yaml, which I have annotated.

Search for adverse events within a date range. A date range is specified using brackets [ ].

- Search for all records with `date_received` between Jan 01, 2013 and Dec 31, 2014.

- limit to 1 record.

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

See searchable fields for more about date_received. Brackets [ ] are used to specify a range for date, number, or string fields.

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

Resume [here](https://open.fda.gov/apis/device/event/example-api-queries/)

</div>
