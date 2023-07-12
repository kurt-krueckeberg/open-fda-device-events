# Most Important Device Adverse Event Fields

This list is uner development.

```{csv-table} Significant Device Adverse Event Fields!
:header: >
: "Field", "Description", "Significant Value(s)" 
:align: left
:widths: auto

`source_type`, The manufacturer-reported source of the adverse event report. This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized., "Value is one of:

- Other = Other
- Foreign = Foreign
- Study = Study
- Literature = Literature
- Consumer = Consumer
- Health Professional = Health Professional
- User facility = User facility
- Company representation = Company representation
- Distributor = Distributor
- Unknown = Unknown", `source_type:consumer`
`mdr_report_key`, a string that acts like a primary and foreign key for joining four file together,
`date_report`, Date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event., date value, date value
`device.generic_name`, The generic or common name of the suspect medical device or a generally descriptive name (e.g. urological catheter, heart pacemaker, patient restraint, etc.).This is an `.exact` field.,`device.generic_name:LASIK`? `device.generaic_name:"refractive surgery"?
`mdr_text.text`,Narrative text or problem description. This is an `.exact field`., 
`type_of_report`, A string that describes the type of report. This is an .exact field. Value is one of the following:

- Initial submission = Initial report of an event.
- Followup = Additional or corrected information.
- Extra copy received = Documentation forthcoming.
- Other information submitted = Documentation forthcoming.",
`event_location`, to be added later,,
`mdr_text.txt`,,
:::