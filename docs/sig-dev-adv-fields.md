# Most Important Device Adverse Event Fields

As explained on the previous page, fields denoted `.exact` can be searched for an exact phrase.

```{csv-table} Significant Device Adverse Event Fields
:header: >
:    "Field", ".exact?", "Description","Significant Value" 
:widths: 19 3 60 18
:delim: "|"

`adverse_event_flag`|Y|"Whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient:
- Y means yes it did
- N means no it did not."|`Y`
`device.device_report_product_code`|Y|Three-letter FDA Product Classification|See list of codes in table below.
`source_type`|Y|"The manufacturer-reported source of the adverse event report. This is an `.exact` field. It has been indexed both as its exact string content and also tokenized. Value is one of:

- Other = Other
- Foreign = Foreign
- Study = Study
- Literature = Literature
- Consumer = Consumer
- Health Professional = Health Professional
- User facility = User facility
- Company representation = Company representation
- Distributor = Distributor
- Unknown = Unknown"|`source_type:consumer`
`device.openfda.device_name`|Y|"This is the proprietary name, or trade name, of the cleared device.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."|
`device.generic_name`|Y|The generic or common name of the suspect medical device or a generally descriptive name (e.g. urological catheter, heart pacemaker, patient restraint, etc.).This is an `.exact` field.|`device.generic_name:LASIK` or `device.generaic_name:"refractive surgery`
`mdr_text.text`|Y|Narrative text or problem description. This is an `.exact field`.| 
`mdr_text.txt`|Y|Narrative text or problem description|
`date_report`|N|Date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.|
`report_source_code`|Y|Source of the adverse event report--Manufact., Voluntary, User Fac., Distributor|`Voluntary report`
`type_of_report`|Y|"A string that describes the type of report. This is an .exact field. Value is one of the following:

- Initial submission = Initial report of an event.
- Followup = Additional or corrected information.
- Extra copy received = Documentation forthcoming.
- Other information submitted = Documentation forthcoming."|
`event_location`|Y|"Where the event occurred.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Other = Other
- Hospital = Hospital
- Home = Home
- Nursing home = Nursing home
- Outpatient treatment facility = Outpatient treatment facility
- Outpatient diagnostic facility = Outpatient diagnostic facility
- Ambulatory surgical facility = Ambulatory surgical facility
- Catheterization suite = Catheterization suite
- Critical care unit = Critical care unit
- Dialysis unit = Dialysis unit
- Emergency room = Emergency room
- Examination room = Examination room
- Laboratory/pathology department = Laboratory/pathology department
- Maternity ward - nursery = Maternity ward - nursery
- Operating room = Operating room
- Outpatient clinic/surgery = Outpatient clinic/surgery
- Patients room or ward = Patients room or ward
- Radiology department = Radiology department
- Ambulatory health care facility = Ambulatory health care facility
- Ambulatory surgical center = Ambulatory surgical center
- Blood bank = Blood bank
- Bloodmobile = Bloodmobile
- Catheterization lab - free standing = Catheterization lab - free standing
- Chemotherapy center = Chemotherapy center
- Clinic - walk in, other = Clinic - walk in, other
- Dialysis center = Dialysis center
- Drug clinic = Drug clinic
- Imaging center - mobile = Imaging center - mobile
- Imaging center - stationary = Imaging center - stationary
- Laboratory = Laboratory
- Mobile health unit = Mobile health unit
- Mri centers = Mri centers
- Psychiatric center - walk in, other = Psychiatric center - walk in, other
- Tuberculosis clinic = Tuberculosis clinic
- Urgent care center = Urgent care center
- Long-term care facility = Long-term care facility
- Hospice = Hospice
- Psychiatric facility = Psychiatric facility
- Rehabilitation center = Rehabilitation center
- Retirement home = Retirement home
- Patients home = Patients home
- In transit to user/medical facility = In transit to user/medical facility
- Public venue = Public venue
- Outdoors = Outdoors
- Park = Park
- Playground = Playground
- Public building = Public building
- School = School
- Street = Street
- Unknown = Unknown
- Not applicable = Not applicable
- No information = No information
- Invalid data = Invalid data"|
`mdr_report_key`|Y|a string that acts like a primary and foreign key for joining four file together|nothing
`patient.patient_problems`|array of strings|"Describes actual adverse effects on the patient that may be related to the device problem observed during the reported event.
This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
`mdr_text.text_type_code`|string|"String that describes the type of narrative contained within the text field.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Description of Event or Problem = The problem (quality, performance, or safety concern) in sufficient detail so that the circumstances surrounding the defect or malfunction of the medical product can be understood. For patient adverse events, may include a description of the event in detail using the reporter’s own words, including a description of what happened and a summary of all relevant clinical information (medical status prior to the event; signs and/or symptoms; differential diagnosis for the event in question; clinical course; treatment; outcome, etc.). If available and if relevant, may include synopses of any office visit notes or the hospital discharge summary. This section may also contain information about surgical procedures and laboratory tests.
- Manufacturer Evaluation Summary = If available, the results of any evaluation of a malfunctioning device and, if known, any relevant maintenance/service information should be included in this section.
- Additional Manufacturer Narrative = Documentation forthcoming."
```

:::{table} Significant 3-letter codes found in `device.device_report_product_code`

| Device Product Codes | Device name |
:--- | :-----------------
**HQF** | Laser, Ophthalmic [^1] 
**LZS** | Excimer Laser System 
**OTL** | Femtosecond Laser System For Refractive Correction 
**HMY** | Keratome, Battery-Powered 
**HNO** | Keratome, AC-Powered 
**MYD** | Keratome, Water Jet 
**NKY** | Blade, Keratome, Reprocessed 
:::

[^1]: This Laser Opthalmic device might not be a refractive surgery device. TODO: Find out if it is.

