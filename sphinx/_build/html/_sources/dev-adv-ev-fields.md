# Device Adverse Events Searchable Fields

**TODO:**

`device.openfda.device_name` is the proprietary name, or trade name, of the cleared device.

<https://api.fda.gov/device/event.json?search=device.openfda.device_name:Excimer>
<https://api.fda.gov/device/event.json?search=device.openfda.device_name.exact:"Excimer+Laser+System"">

return the same total results since the exact device name is "Excimer Laser System".

- `count=device.openfda.device_name` \
  counts the tokenized values of this field. Instances of 'Excimer' and 'Laser' and 'System' are counted separately. **todo:**  <-- check this.

- `count=device.openfda.device_name.exact` \
  counts the total unique strings comprising exact values of this field  (whatever that means?). FOO BAR, BAR FOO, FOO, and BAR would all be counted separately, along with other combinations that contain these terms.

:::{tip}

- To exactly match a search phrase, append `.exact` to the field name: \
  `search=device.openfda.device_name.exact:"refractive surgery`

- To count the exact values of a field: \
  `count=device.openfda.device_name.exact`
:::

List of Device Adverse searchable fields. See the openFDA [Device Adverse Event Searchable fields](https://open.fda.gov/apis/device/event/searchable-fields/)

The fields categorized as "OpenFDA fields", which begin `device.openfda`, are harmonized fields.  When you query an endpoint, you can search by:

- Fields native to records served by that endpoint.

- Harmonized openFDA fields, if they exist.

**openFDA** does not rewrite original records. These additional fields are annotations, in special openfda dictionary of values. 

```{csv-table} Device Adverse Event Searchable Fields
:header: >
:    "Section", "Field Name", "Type", "Description"
:widths: 15, 15, 15, 55
:delim: "|"

Event|`adverse_event_flag`|string|"Whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = Yes
- N = No"
Event|`product_problems`|array of strings|The product problems that were reported to the FDA if there was a concern about the quality, authenticity, performance, or safety of any medication or device.
Event|`product_problem_flag`|string|"Indicates whether or not a report was about the quality, performance or safety of a device.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = The report is about the quality, performance, or safety of a device—for example, defects or malfunctions. This flag is set when a device malfunction could lead to a death or serious injury if the malfunction were to recur.
- N = The report is not about a defect or malfunction."
Event|`date_of_event`|string|Actual or best estimate of the date of first onset of the adverse event. This field was added in 2006.
Event|`date_report`|string|Date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.
Event|`date_received`|string|Date the report was received by the FDA.
Event|`device_date_of_manufacturer`|string|Date of manufacture of the suspect medical device.
Event|`event_type`|string|"Outcomes associated with the adverse event.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Death = Death, either caused by or associated with the adverse event.
- Injury (IN) = Documentation forthcoming.
- Injury (IL) = Documentation forthcoming.
- Injury (IJ) = Documentation forthcoming.
- Malfunction = Product malfunction.
- Other = Other serious/important medical event.
- No answer provided = No information was provided."
Event|`number_devices_in_event`|string|"Number of devices noted in the adverse event report. Almost always 1. May be empty if report_source_code contains Voluntary report.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Event|`number_patients_in_event`|string|"Number of patients noted in the adverse event report. Almost always 1. May be empty if report_source_code contains Voluntary report.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Event|`previous_use_code`|string|"Whether the use of the suspect medical device was the initial use, reuse, or unknown.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- I = Initial use.
- R = Reuse.
- U = Unknown.
* = Invalid data or this information was not provided."
Event|`remedial_action`|array of strings|"Follow-up actions taken by the device manufacturer at the time of the report submission, if applicable.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Recall = Recall
- Repair = Repair
- Replace = Replace
- Relabeling = Relabeling
- Other = Other
- Notification = Notification
- Inspection = Inspection
- Patient Monitoring = Patient Monitoring
- Modification/Adjustment = Modification/Adjustment
- Invalid Data = Invalid Data"
Event|`removal_correction_number`|string|"If a corrective action was reported to FDA under 21 USC 360i(f), the correction or removal reporting number (according to the format directed by 21 CFR 807). If a firm has not submitted a correction or removal report to the FDA, but the FDA has assigned a recall number to the corrective action, the recall number may be used.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.
"
Event|`report_number`|string|"Identifying number for the adverse event report. The format varies, according to the source of the report. The field is empty when a user facility submits a report. For manufacturer reports. Manufacturer Report Number. The report number consists of three components: The manufacturer’s FDA registration number for the manufacturing site of the reported device, the 4-digit calendar year, and a consecutive 5-digit number for each report filed during the year by the manufacturer (e.g. 1234567-2013-00001, 1234567-2013-00002). For user facility/importer (distributor) reports. Distributor Report Number. Documentation forthcoming. For consumer reports. This field is empty.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Event|`single_use_flag`|string|"Whether the device was labeled for single use or not.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Yes = The device was labeled for single use.
- No = The device was not labeled for single use, or this is irrelevant to the device being reported (e.g. an X-ray machine)."
Source|`report_source_code`|string|"Source of the adverse event report

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Manufacturer report = Manufacturer report
- Voluntary report = Voluntary report
- User facility report = User facility report
- Distributor report = Distributor report"
Source|`health_professional`|string|"Whether the initial reporter was a health professional (e.g. physician, pharmacist, nurse, etc.) or not.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = The initial reporter is a health professional.
- N = The initial reporter is not a health professional."
Source|`reporter_occupation_code`|string|"Initial reporter occupation.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Physician = Physician
- Nurse = Nurse
- Health professional = Health professional
- Lay user/patient = Lay user/patient
- Other health care professional = Other health care professional
- Audiologist = Audiologist
- Dental hygienist = Dental hygienist
- Dietician = Dietician
- Emergency medical technician = Emergency medical technician
- Medical technologist = Medical technologist
- Nuclear medicine technologist = Nuclear medicine technologist
- Occupational therapist = Occupational therapist
- Paramedic = Paramedic
- Pharmacist = Pharmacist
- Phlebotomist = Phlebotomist
- Physical therapist = Physical therapist
- Physician assistant = Physician assistant
- Radiologic technologist = Radiologic technologist
- Respiratory therapist = Respiratory therapist
- Speech therapist = Speech therapist
- Dentist = Dentist
- Other caregivers = Other caregivers
- Dental assistant = Dental assistant
- Home health aide = Home health aide
- Medical assistant = Medical assistant
- Nursing assistant = Nursing assistant
- Patient = Patient
- Patient family member or friend = Patient family member or friend
- Personal care assistant = Personal care assistant
- Service and testing personnel = Service and testing personnel
- Biomedical engineer = Biomedical engineer
- Hospital service technician = Hospital service technician
- Medical equipment company technician/representative = Medical equipment company technician/representative
- Physicist = Physicist
- Service personnel = Service personnel
- Device unattended = Device unattended
- Risk manager = Risk manager
- Attorney = Attorney
- Other = Other
- Unknown = Unknown
- Not applicable = Not applicable
- No information = No information
- Invalid data = Invalid data"
Source|`initial_report_to_fda`|string|"Whether the initial reporter also notified or submitted a copy of this report to FDA.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Yes = FDA was also notified by the initial reporter.
- No = FDA was not notified by the initial reporter.
- Unknown = Unknown whether FDA was also notified by the initial reporter.
- No answer provided or empty = This information was not provided."
Source|`reprocessed_and_reused_flag`|string|"Indicates whether the suspect device was a single-use device that was reprocessed and reused on a patient.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = Was a single-use device that was reprocessed and reused.
- N = Was not a single-use device that was reprocessed and reused.
- UNK = The original equipment manufacturer was unable to determine if their single-use device was reprocessed and reused."
Device|`device.device_sequence_number`|string|"Number identifying this particular device. For example, the first device object will have the value 1. This is an enumeration corresponding to the number of patients involved in an adverse event.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Device|`device.device_event_key`|string|Documentation forthcoming.
Device|`device.date_received`|string|Documentation forthcoming
Identification|`device.brand_name`|string|"The trade or proprietary name of the suspect medical device as used in product labeling or in the catalog (e.g. Flo-Easy Catheter, Reliable Heart Pacemaker, etc.). If the suspect device is a reprocessed single-use device, this field will contain NA.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device.generic_name`|string|"The generic or common name of the suspect medical device or a generally descriptive name (e.g. urological catheter, heart pacemaker, patient restraint, etc.).

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device.udi_di`|string|A unique numeric or alphanumeric code specific to a device version or model.
Identification|`device.udi_public`|string|"Includes both the UDI-DI and the parts of the Production identifier (PI) that would not identify an individual patient. The Production Identifier is  a conditional, variable portion of a UDI that identifies one or more of the following when included on the label of a device and may include:

1. lot or batch number within which a device was manufactured,
2. serial number of a specific device, 
3. expiration date of a specific device, 
4. date a specific device was manufactured, and 
5. distinct identification code required by §1271.290(c) for a human cell, tissue, or cellular and tissue-based product (HCT/P) regulated as a device."
Identification|`device.device_report_product_code`|string|"Three-letter FDA Product Classification Code. Medical devices are classified under 21 CFR Parts 862-892.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Fore more information, see Product Classification Database (http://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfPCD/classification.cfm)"
Identification|`device.model_number`|string|"The exact model number found on the device label or accompanying packaging.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device_catalog_number`|string|"The exact number as it appears in the manufacturer’s catalog, device labeling, or accompanying packaging.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device.lot_number`|string|"If available, the lot number found on the label or packaging material.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device.other_id_number`|string|"Any other identifier that might be used to identify the device. Expect wide variability in the use of this field. It is commonly empty, or marked NA, N/A, *, or UNK, if unknown or not applicable.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Identification|`device.expiration_date_of_device`|string|If available; this date is often be found on the device itself or printed on the accompanying packaging.
Identification|`device.device_age_text`|string|Age of the device or a best estimate, often including the unit of time used. Contents vary widely, but common patterns include: ## Mo or ## Yr (meaning number of months or years, respectively.
Identification|`device.device_availability`|string|"Whether the device is available for evaluation by the manufacturer, or whether the device was returned to the manufacturer.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Yes = Yes
- No = No
- Device was returned to manufacturer = Device was returned to manufacturer
- No answer provided = No answer provided
- I = Documentation forthcoming."
Identification|`device.date_returned_to_manufacturer`|string|Date the device was returned to the manufacturer, if applicable.
Identification|`device.device_evaluated_by_manufacturer`|string|"Whether the suspect device was evaluated by the manufacturer.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Yes = An evaluation was made of the suspect or related medical device.
- No = An evaluation of a returned suspect or related medical device was not conducted.
- Device not returned to manufacturer = An evaluation could not be made because the device was not returned to, or made available to, the manufacturer.
- No answer provided or empty = No answer was provided or this information was unavailable."
Use of Device|`device.device_operator`|string|"The person using the medical device at the time of the adverse event. This may be a health professional, a lay person, or may not be applicable.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Physician = Physician
- Nurse = Nurse
- Health professional = Health professional
- Lay user/patient = Lay user/patient
- Other health care professional = Other health care professional
- Audiologist = Audiologist
- Dental hygienist = Dental hygienist
- Dietician = Dietician
- Emergency medical technician = Emergency medical technician
- Medical technologist = Medical technologist
- Nuclear medicine technologist = Nuclear medicine technologist
- Occupational therapist = Occupational therapist
- Paramedic = Paramedic
- Pharmacist = Pharmacist
- Phlebotomist = Phlebotomist
- Physical therapist = Physical therapist
- Physician assistant = Physician assistant
- Radiologic technologist = Radiologic technologist
- Respiratory therapist = Respiratory therapist
- Speech therapist = Speech therapist
- Dentist = Dentist
- Other caregivers = Other caregivers
- Dental assistant = Dental assistant
- Home health aide = Home health aide
- Medical assistant = Medical assistant
- Nursing assistant = Nursing assistant
- Patient = Patient
- Patient family member or friend = Patient family member or friend
- Personal care assistant = Personal care assistant
- Service and testing personnel = Service and testing personnel
- Biomedical engineer = Biomedical engineer
- Hospital service technician = Hospital service technician
- Medical equipment company technician/representative = Medical equipment company technician/representative
- Physicist = Physicist
- Service personnel = Service personnel
- Device unattended = Device unattended
- Risk manager = Risk manager
- Attorney = Attorney
- Other = Other
- Unknown = Unknown
- Not applicable = Not applicable
- No information = No information
- Invalid data = Invalid data"
Use of Device|`device.implant_flag`|string|"Whether a device was implanted or not. May be either marked N or left empty if this was not applicable.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Use of Device|`device.date_removed_flag`|string|"Whether an implanted device was removed from the patient, and if so, what kind of date was provided.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Month and year provided only day defaults to 01 = Only a year and month were provided. Day was set to 01.
- Year provided only = Only a year was provided. Month was set to 01 (January) and day set to 01.
- No information at this time = Documentation forthcoming.
- Not available = Documentation forthcoming.
- Unknown = Documentation forthcoming.
- * = Documentation forthcoming.
- B = Documentation forthcoming.
- V = Documentation forthcoming."
Manufacturer|`device.manufacturer_d_name`|string|"Device manufacturer name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_address_1`|string|"Device manufacturer address line 1.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_address_2`|string|"Device manufacturer address line 2.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_city`|string|"Device manufacturer city.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_state`|string|"Device manufacturer state code

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_zip_code`|string|"Device manufacturer zip code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_zip_code_ext`|string|"Device manufacturer zip code extension.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_postal_code`|string|"Device manufacturer postal code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Manufacturer|`device.manufacturer_d_country`|string|"Device manufacturer country.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Patient|`patient.date_received`|string|Date the report about this patient was received.
Patient|`patient.patient_sequence_number`|string|"Documentation forthcoming.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Patient|`patient.patient_problems`|array of strings|"Describes actual adverse effects on the patient that may be related to the device problem observed during the reported event.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Patient|`patient.sequence_number_outcome`|array of strings|"Outcome associated with the adverse event for this patient. Expect wide variability in this field; each string in the list of strings may contain multiple outcomes, separated by commas, and with numbers, which may or may not be related to the patient_sequence_number.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Life Threatening = Life Threatening
- Hospitalization = Hospitalization
- Disability = Disability
- Congenital Anomaly = Congenital Anomaly
- Required Intervention = Required Intervention
- Other = Other
- Invalid Data = Invalid Data
- Unknown = Unknown
- No Information = No Information
- Not Applicable = Not Applicable
- Death = Death"
Patient|`patient.sequence_number_treatment`|array of strings|"Treatment the patient received.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Report text|`mdr_text.date_report`|string|Date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event.
Report text|`mdr_text.mdr_text_key`|string|"Documentation forthcoming.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Report text|`mdr_text.patient_sequence_number`|string|"Number identifying this particular patient. For example, the first patient object will have the value 1. This is an enumeration corresponding to the number of patients involved in an adverse event.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Report text|`mdr_text.text`|string|"Narrative text or problem description.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Report text|`mdr_text.text_type_code`|string|"String that describes the type of narrative contained within the text field.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Description of Event or Problem = The problem (quality, performance, or safety concern) in sufficient detail so that the circumstances surrounding the defect or malfunction of the medical product can be understood. For patient adverse events, may include a description of the event in detail using the reporter’s own words, including a description of what happened and a summary of all relevant clinical information (medical status prior to the event; signs and/or symptoms; differential diagnosis for the event in question; clinical course; treatment; outcome, etc.). If available and if relevant, may include synopses of any office visit notes or the hospital discharge summary. This section may also contain information about surgical procedures and laboratory tests.
- Manufacturer Evaluation Summary = If available, the results of any evaluation of a malfunctioning device and, if known, any relevant maintenance/service information should be included in this section.
- Additional Manufacturer Narrative = Documentation forthcoming."
By user facility/importer|`type_of_report`|string|"The type of report.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Initial submission = Initial report of an event.
- Followup = Additional or corrected information.
- Extra copy received = Documentation forthcoming.
- Other information submitted = Documentation forthcoming."
By user facility/importer|`date_facility_aware`|string|Date the user facility’s medical personnel or the importer (distributor) became aware that the device has or may have caused or contributed to the reported event.
By user facility/importer|`report_date`|string|Date of the report, or the date that the report was forwarded to the manufacturer and/or the FDA.
By user facility/importer|`report_to_fda`|string|"Whether the report was sent to the FDA by a user facility or importer (distributor). User facilities are required to send reports of device-related deaths. Importers are required to send reports of device-related deaths and serious injuries.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = The report was sent to the FDA by a user facility or importer.
- N = The report was not sent to the FDA by a user facility or importer."
By user facility/importer|`date_report_to_fda`|string|Date the user facility/importer (distributor) sent the report to the FDA, if applicable.
By user facility/importer|`report_to_manufacturer`|string|"Whether the report was sent to the manufacturer by a user facility or importer (distributor). User facilities are required to send reports of device-related deaths and serious injuries to manufacturers. Importers are required to send reports to manufacturers of device-related deaths, device-related serious injuries, and device-related malfunctions that could cause or contribute to a death or serious injury.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = The report was sent to the manufacturer by a user facility or importer.
- N = The report was not sent to the manufacturer by a user facility or importer."
By user facility/importer|`date_report_to_manufacturer`|string|Date the user facility/importer (distributor) sent the report to the manufacturer, if applicable.
By user facility/importer|`event_location`|string|"Where the event occurred.

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
- Invalid data = Invalid data"
Name and address|`distributor_name`|string|"User facility or importer (distributor) name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_address_1`|string|"User facility or importer (distributor) address line 1.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_address_2`|string|"User facility or importer (distributor) address line 2.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_city`|string|"User facility or importer (distributor) city.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_state`|string|"User facility or importer (distributor) two-digit state code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_zip_code`|string|"User facility or importer (distributor) 5-digit zip code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Name and address|`distributor_zip_code_ext`|string|"User facility or importer (distributor) 4-digit zip code extension (zip+4 code).

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_name`|string|"Suspect medical device manufacturer name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_address_1`|string|"Suspect medical device manufacturer address line 1.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_address_2`|string|"Suspect medical device manufacturer address line 2.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_city`|string|"Suspect medical device manufacturer city.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_postal_code`|string|"Suspect medical device manufacturer postal code. May contain the zip code for addresses in the United States.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_state`|string|"Suspect medical device manufacturer two-letter state code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_zip_code`|string|"Suspect medical device manufacturer 5-digit zip code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_zip_code_ext`|string|"Suspect medical device manufacturer 4-digit zip code extension (zip+4 code).

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_country`|string|"Suspect medical device manufacturer two-letter country code. Note: For medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. Caution should be exercised when interpreting country code data in device records.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_address_1`|string|"Suspect medical device manufacturer contact address line 1.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_address_2`|string|"Suspect medical device manufacturer contact address line 2.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_area_code`|string|"Manufacturer contact person phone number area code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_city`|string|"Manufacturer contact person city.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_country`|string|"Manufacturer contact person two-letter country code. Note: For medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. Caution should be exercised when interpreting country code data in device records.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_exchange`|string|"Manufacturer contact person phone number exchange.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_extension`|string|"Manufacturer contact person phone number extension.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_t_name`|string|"Manufacturer contact person title (Mr., Mrs., Ms., Dr., etc.)

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_f_name`|string|"Manufacturer contact person first name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_l_name`|string|"Manufacturer contact person last name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_pcity`|string|"Manufacturer contact person phone number city code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_pcountry`|string|"Manufacturer contact person phone number country code. Note: For medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. Caution should be exercised when interpreting country code data in device records.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_phone_number`|string|"Manufacturer contact person phone number.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_plocal`|string|"Manufacturer contact person local phone number.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_postal_code`|string|"Manufacturer contact person postal code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_state`|string|"Manufacturer contact person two-letter state code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_zip_code`|string|"Manufacturer contact person 5-digit zip code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_contact_zip_ext`|string|"Manufacturer contact person 4-digit zip code extension (zip+4 code).

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_name`|string|"Device manufacturer name.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_city`|string|"Device manufacturer address city.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.
"
Suspect device manufacturer|`manufacturer_gl_country`|string|"Device manufacturer two-letter country code. Note: For medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. Caution should be exercised when interpreting country code data in device records.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_postal_code`|string|"Device manufacturer address postal code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_state`|string|"Device manufacturer address state.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_address_1`|string|Device manufacturer address line 1.
Suspect device manufacturer|`manufacturer_gl_address_2`|string|Device manufacturer address line 2.
Suspect device manufacturer|`manufacturer_gl_zip_code`|string|"Device manufacturer address zip code.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Suspect device manufacturer|`manufacturer_gl_zip_code_ext`|string|"Device manufacturer address zip code extension.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
By any manufacturer|`date_manufacturer_received`|string|Date when the applicant, manufacturer, corporate affiliate, etc. receives information that an adverse event or medical device malfunction has occurred. This would apply to a report received anywhere in the world. For follow-up reports, the date that the follow-up information was received.
By any manufacturer|`source_type`|string|"The manufacturer-reported source of the adverse event report.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Other = Other
- Foreign = Foreign
- Study = Study
- Literature = Literature
- Consumer = Consumer
- Health Professional = Health Professional
- User facility = User facility
- Company representation = Company representation
- Distributor = Distributor
- Unknown = Unknown
- Invalid data = Invalid data"
Keys and flags|`event_key`|string|"Documentation forthcoming.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Keys and flags|`mdr_report_key`|string|"A unique identifier for a report. This key is part of the download files and is used to join the four files together.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
Keys and flags|`manufacturer_link_flag`|string|"Indicates whether a user facility/importer-submitted (distributor-submitted) report has had subsequent manufacturer-submitted reports. If so, the distributor information (address, etc.) will also be present and this field will contain Y.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized.

Value is one of the following:

- Y = There are subsequent manufacturer-submitted reports.
- N = There are no subsequent manufacturer-submitted reports."
OpenFDA fields|`device.openfda.device_class`|string|"A risk based classification system for all medical devices ((Federal Food, Drug, and Cosmetic Act, section 513)

Value is one of the following:

- 1 = Class I (low to moderate risk): general controls
- 2 = Class II (moderate to high risk): general controls and special controls
- 3 = Class III (high risk): general controls and Premarket Approval (PMA)
- U = Unclassified
- N = Not classified
- F = HDE"
OpenFDA fields|`device.openfda.device_name`|string|"This is the proprietary name, or trade name, of the cleared device.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
OpenFDA fields|`device.openfda.fei_number`|array of strings|Facility identifier assigned to facility by the FDA Office of Regulatory Affairs.
OpenFDA fields|`device.openfda.medical_specialty_description`|string|"Regulation Medical Specialty is assigned based on the regulation (e.g. 21 CFR Part 888 is Orthopedic Devices) which is why Class 3 devices lack the “Regulation Medical Specialty” field.

This is an `.exact` field. It has been indexed both as its exact string content, and also tokenized."
OpenFDA fields|`device.openfda.registration_number`|array of strings|
OpenFDA fields|`device.openfda.regulation_number`|array of strings|The classification regulation in the Code of Federal Regulations (CFR) under which the device is identified, described, and formally classified (Code of Federal regulations Title 21, 862.00 through 892.00). The classification regulation covers various aspects of design, clinical evaluation, manufacturing, packaging, labeling, and postmarket surveillance of the specific medical device.
```

