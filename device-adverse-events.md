<section>

# Adverse Event Reports API

## Medical Device Reporting 

Consumers who have a so-called *adverse device event* can, then, submit a report, called a [Medwatch Voluntary Report](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm?action=consumer.reporting1), to the FDA. Along with those by manufacturers and medical profesionals, these reports
 are stored in the [MAUDE - Manufacturer and User Facility Device Experience](https://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfmaude/search.cfm) database. The database tables are regularly exported in large zip files that can be [downloaded](https://www.fda.gov/medical-devices/mandatory-reporting-requirements-manufacturers-importers-and-device-user-facilities/about-manufacturer-and-user-facility-device-experience-maude).
 
The device adverse event reports [search page](https://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfmaude/search.cfm) offers **standard search options** worth remembering. iBut the FDA's openFDA API offers a better, more convenient alternative.
 
## openFDA

For an overview of **openFDA** see [Open FDA API](https://github.com/kurt-krueckeberg/fda-device-events/edit/main/open-fda-api.md).        

### How adverse events are collected

### Identifying Adverse Events

Adverse events are collected through a series of safety reports. Each is identified by a 8-digit string

  **6176304-1**.

where the first 7 digits (before the hyphen) identify the individual report, and the last digit (after the hyphen) indicates the order of the report. For eample, if three reports are submitted (for the same event),
they would be saved as

- **6176304-1**
- **6176304-2**
- **6176304-3**

### Using [Medwatch](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm) to Report Adverse Events

On the [MedWatch Online Voluntary Reporting Form](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm) website patients and health professionals can submit "adverse device event" reports. Heatlh professionals can submit
[FDA Form 3500](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm?action=professional.reporting1) online and consumers 
[FDA Form 3500B](https://www.accessdata.fda.gov/scripts/medwatch/index.cfm?action=consumer.reporting1)".

### How Adverse Event Reports are Organized

Device adverse event reports vary significantly, depending on who initially reported the event, what kind of event was reported, and whether there were follow-up reports. Some reports
come directly from user facilities (like hospitals) or device importers (distributors), while others come directly from manufacturers. Some involve adverse reactions in patients, while
others are reports of defects that did not result in such adverse reactions.

OpenFDA device adverse event results **loosely reflect fields found in forms used by manufacturers and members of the public to report these events**. Since reports
may come from manufacturers, user facilities, distributors, and voluntary sources (such as patients and physicians) who are subject to different reporting
requirements, the collected data in the adverse event system may not always capture every field and should not be interpreted as incomplete.

## Device Adverse Event API

### Endpoint URL

<span style="font-size: 1.4em;font-weight: 500;background:#add8e6">https://api.fda.gov/device/event.json<span style="background:#ffe4b5">?</span><span style="background: #ffa07a">search=</span><span style="background: #90ee90">device.generic_name:x-ray</span><span style="background:#ffe4b5">&</span><span style="background:#ffb6c1">limit=5</span><span>

### Example Adverse Device Event Queries

#### One adverse event report

TODO: Incorprate somewhere in this documentation the "device searchable fields" info contained in searchable-fields-device-api.yaml, which I have annotated.

Search for adverse events within a date range. A date range is specified using brackets [ ].

- Search for all records with `date_received` between Jan 01, 2013 and Dec 31, 2014.

- limit to 1 record.

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

See searchable fields for more about date\_received. Brackets [ ] are used to specify a range for date, number, or string fields.

```html
https://api.fda.gov/device/event.json?search=date_received:[20130101+TO+20141231]&limit=1
```

Resume [here](https://open.fda.gov/apis/device/event/example-api-queries/)

</section>
