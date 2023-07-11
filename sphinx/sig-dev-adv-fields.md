# Most Important Device Adverse Event Fields

As explained on the previous page, fields denoted `.exact` can be searched for an exact phrase.

```{csv-table} Significant Device Adverse Event Fields!
:header: >
:    "Field", "Is .exact?", "Description","Significant Value" 
:widths: 19 3 60 18
:delim: "|"

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
```

:::{table} Significant 3-letter codes found in `device.device_report_product_code`

| Device Product Codes | Device name |
:--- | :-----------------
**OCL** | Surgical Device, For Cutting, Coagulation, And/Or Ablation Of Tissue, Including Cardiac Tissue 
**HQF** | Laser, Ophthalmic 
**LZS** | Excimer Laser System 
**OTL** | Femtosecond Laser System For Refractive Correction 
**HMY** | Keratome, Battery-Powered 
**HNO** | Keratome, Ac-Powered 
**MYD** | Keratome, Water Jet 
**NKY** | Blade, Keratome, Reprocessed 
:::

