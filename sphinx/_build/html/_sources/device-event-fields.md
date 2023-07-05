# All Device-Event search fields

Although most are not usually relevant, there are a total of 114 device event fields that can be searched.

:::{table} All Fields that Can be Searched
:widths: auto
:align: left

| field\_name | datatype | definition |
| ----------- | -------- | ---------- |
| `adverse_event_flag` | string | whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient. |
| `date_facility_aware` | string | date the user facility’s medical personnel or the importer (distributor) became aware that the device has or may have caused or contributed to the reported event. |
| `date_manufacturer_received` | string | date when the applicant, manufacturer, corporate affiliate, etc. receives information that an adverse event or medical device malfunction has occurred. this would apply to a report received anywhere in the world. for follow-up reports, the date that the follow-up information was received. |
| `date_of_event` | string | actual or best estimate of the date of first onset of the adverse event. this field was added in 2006. |
| `date_received` | string | date the report was received by the fda. |
| `date_report` | string | date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event. |
| `date_report_to_fda` | string | date the user facility/importer (distributor) sent the report to the fda, if applicable. |
| `date_report_to_manufacturer` | string | date the user facility/importer (distributor) sent the report to the manufacturer, if applicable. |
| `device.brand_name` | string | the trade or proprietary name of the suspect medical device as used in product labeling or in the catalog (e.g. flo-easy catheter, reliable heart pacemaker, etc.). if the suspect device is a reprocessed single-use device, this field will contain `na`. |
| `device.catalog_number` | string | the exact number as it appears in the manufacturer’s catalog, device labeling, or accompanying packaging. |
| `device.date_received` | string | documentation forthcoming. tk |
| `device.date_removed_flag` | string | whether an implanted device was removed from the patient, and if so, what kind of date was provided. |
| `device.date_returned_to_manufacturer` | string | date the device was returned to the manufacturer, if applicable. |
| `device.device_age_text` | string | age of the device or a best estimate, often including the unit of time used. contents vary widely, but common patterns include: ## mo or ## yr (meaning number of months or years, respectively. |
| `device.device_availability` | string | whether the device is available for evaluation by the manufacturer, or whether the device was returned to the manufacturer. |
| `device.device_evaluated_by_manufacturer` | string | whether the suspect device was evaluated by the manufacturer. |
| `device.device_event_key` | string | documentation forthcoming. |
| `device.device_operator` | string | the person using the medical device at the time of the adverse event. this may be a health professional, a lay person, or may not be applicable. |
| `device.device_report_product_code[^1]` | string | three-letter fda product classification code. medical devices are classified under <a href='http://www.fda.gov/medicaldevices/deviceregulationandguidance/overview/classifyyourdevice/default.htm'>21 cfr parts 862-892</a>. |
| `device.device_sequence_number` | string | number identifying this particular device. for example, the first device object will have the value 1. this is an enumeration corresponding to the number of patients involved in an adverse event. |
| `device.expiration_date_of_device` | string | if available; this date is often be found on the device itself or printed on the accompanying packaging. |
| `device.generic_name` | string | the generic or common name of the suspect medical device or a generally descriptive name (e.g. urological catheter, heart pacemaker, patient restraint, etc.). |
| `device.implant_flag` | string | whether a device was implanted or not. may be either marked n or left empty if this was not applicable. |
| `device.lot_number` | string | if available, the lot number found on the label or packaging material. |
| `device.manufacturer_d_address_1` | string | device manufacturer address line 1. |
| `device.manufacturer_d_address_2` | string | device manufacturer address line 2. |
| `device.manufacturer_d_city` | string | device manufacturer city. |
| `device.manufacturer_d_country` | string | device manufacturer country. |
| `device.manufacturer_d_name` | string | device manufacturer name. |
| `device.manufacturer_d_postal_code` | string | device manufacturer postal code. |
| `device.manufacturer_d_state` | string | device manufacturer state code. |
| `device.manufacturer_d_zip_code` | string | device manufacturer zip code. |
| `device.manufacturer_d_zip_code_ext` | string | device manufacturer zip code extension. |
| `device.model_number` | string | the exact model number found on the device label or accompanying packaging. |
| `device.openfda` | object |   |
| `device.other_id_number` | string | any other identifier that might be used to identify the device. expect wide variability in the use of this field. it is commonly empty, or marked `na`, `n/a`, `*`, or `unk`, if unknown or not applicable. |
| `device_date_of_manufacturer` | string | date of manufacture of the suspect medical device. |
| `distributor_address_1` | string | user facility or importer (distributor) address line 1. |
| `distributor_address_2` | string | user facility or importer (distributor) address line 2. |
| `distributor_city` | string | user facility or importer (distributor) city. |
| `distributor_name` | string | user facility or importer (distributor) name. |
| `distributor_state` | string | user facility or importer (distributor) two-digit state code. |
| `distributor_zip_code` | string | user facility or importer (distributor) 5-digit zip code. |
| `distributor_zip_code_ext` | string | user facility or importer (distributor) 4-digit zip code extension (zip+4 code). |
| `event_key` | string | documentation forthcoming. |
| `event_location` | string | where the event occurred. |
| `event_type` | string | outcomes associated with the adverse event. |
| `expiration_date_of_device` | string | if available; this date is often be found on the device itself or printed on the accompanying packaging. |
| `health_professional` | string | whether the initial reporter was a health professional (e.g. physician, pharmacist, nurse, etc.) or not. |
| `initial_report_to_fda` | string | whether the initial reporter also notified or submitted a copy of this report to fda. |
| `manufacturer_address_1` | string | suspect medical device manufacturer address line 1. |
| `manufacturer_address_2` | string | suspect medical device manufacturer address line 2. |
| `manufacturer_city` | string | suspect medical device manufacturer city. |
| `manufacturer_contact_address_1` | string | suspect medical device manufacturer contact address line 1. |
| `manufacturer_contact_address_2` | string | suspect medical device manufacturer contact address line 2. |
| `manufacturer_contact_area_code` | string | manufacturer contact person phone number area code. |
| `manufacturer_contact_city` | string | manufacturer contact person city. |
| `manufacturer_contact_country` | string | manufacturer contact person two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records. |
| `manufacturer_contact_exchange` | string | manufacturer contact person phone number exchange. |
| `manufacturer_contact_extension` | string | manufacturer contact person phone number extension. |
| `manufacturer_contact_f_name` | string | manufacturer contact person first name. |
| `manufacturer_contact_l_name` | string | manufacturer contact person last name. |
| `manufacturer_contact_pcity` | string | manufacturer contact person phone number city code. |
| `manufacturer_contact_pcountry` | string | manufacturer contact person phone number country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records. |
| `manufacturer_contact_phone_number` | string | manufacturer contact person phone number. |
| `manufacturer_contact_plocal` | string | manufacturer contact person local phone number. |
| `manufacturer_contact_postal_code` | string | manufacturer contact person postal code. |
| `manufacturer_contact_state` | string | manufacturer contact person two-letter state code. |
| `manufacturer_contact_t_name` | string | manufacturer contact person title (mr., mrs., ms., dr., etc.) |
| `manufacturer_contact_zip_code` | string | manufacturer contact person 5-digit zip code. |
| `manufacturer_contact_zip_ext` | string | manufacturer contact person 4-digit zip code extension (zip+4 code). |
| `manufacturer_country` | string | suspect medical device manufacturer two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records. |
| `manufacturer_g1_address_1` | string | device manufacturer address line 1. |
| `manufacturer_g1_address_2` | string | device manufacturer address line 2. |
| `manufacturer_g1_city` | string | device manufacturer address city. |
| `manufacturer_g1_country` | string | device manufacturer two-letter country code. note: for medical device adverse event reports, comparing country codes with city names in the same record demonstrates widespread use of conflicting codes. caution should be exercised when interpreting country code data in device records. |
| `manufacturer_g1_name` | string | device manufacturer name. |
| `manufacturer_g1_postal_code` | string | device manufacturer address postal code. |
| `manufacturer_g1_state` | string | device manufacturer address state. |
| `manufacturer_g1_zip_code` | string | device manufacturer address zip code. |
| `manufacturer_g1_zip_code_ext` | string | device manufacturer address zip code extension. |
| `manufacturer_link_flag` | string | indicates whether a user facility/importer-submitted (distributor-submitted) report has had subsequent manufacturer-submitted reports. if so, the distributor information (address, etc.) will also be present and this field will contain `y`. |
| `manufacturer_name` | string | suspect medical device manufacturer name. |
| `manufacturer_postal_code` | string | suspect medical device manufacturer postal code. may contain the zip code for addresses in the united states. |
| `manufacturer_state` | string | suspect medical device manufacturer two-letter state code. |
| `manufacturer_zip_code` | string | suspect medical device manufacturer 5-digit zip code. |
| `manufacturer_zip_code_ext` | string | suspect medical device manufacturer 4-digit zip code extension (zip+4 code). |
| `mdr_report_key` | string | a unique identifier for a report. |
| `mdr_text.date_report` | string | date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event. |
| `mdr_text.mdr_text_key` | string | documentation forthcoming. |
| `mdr_text.patient_sequence_number` | string | number identifying this particular patient. for example, the first patient object will have the value 1. this is an enumeration corresponding to the number of patients involved in an adverse event. |
| `mdr_text.text` | string | narrative text or problem description. |
| `mdr_text.text_type_code` | string | string that describes the type of narrative contained within the text field. |
| `number_devices_in_event` | string | number of devices noted in the adverse event report. almost always `1`. may be empty if `report_source_code` contains `voluntary report`. |
| `number_patients_in_event` | string | number of patients noted in the adverse event report. almost always `1`. may be empty if `report_source_code` contains `voluntary report`. |
| `patient.date_received` | string | date the report about this patient was received. |
| `patient.patient_problems` | array of strings | describes actual adverse effects on the patient that may be related to the device problem observed during the reported event. |
| `patient.patient_sequence_number` | string | documentation forthcoming. |
| `patient.sequence_number_outcome` | array of strings | outcome associated with the adverse event for this patient. expect wide variability in this field; each string in the list of strings may contain multiple outcomes, separated by commas, and with numbers, which may or may not be related to the `patient_sequence_number`. |
| `patient.sequence_number_treatment` | array of strings | treatment the patient received. |
| `previous_use_code` | string | whether the use of the suspect medical device was the initial use, reuse, or unknown. |
| `product_problem_flag` | string | indicates whether or not a report was about the quality, performance or safety of a device. |
| `product_problems` | array of strings | the product problems that were reported to the fda if there was a concern about the quality, authenticity, performance, or safety of any medication or device. |
| `remedial_action` | array of strings | follow-up actions taken by the device manufacturer at the time of the report submission, if applicable. |
| `removal_correction_number` | string | if a corrective action was reported to fda under <a href='http://www.law.cornell.edu/uscode/text/21/360i'>21 usc 360i(f)</a>, the correction or removal reporting number (according to the format directed by <a href='http://www.accessdata.fda.gov/scripts/cdrh/cfdocs/cfcfr/cfrsearch.cfm?cfrpart=807'>21 cfr 807</a>). if a firm has not submitted a correction or removal report to the fda, but the fda has assigned a recall number to the corrective action, the recall number may be used. |
| `report_date` | string | date of the report, or the date that the report was forwarded to the manufacturer and/or the fda. |
| `report_number` | string | identifying number for the adverse event report. the format varies, according to the source of the report. the field is empty when a user facility submits a report. *for manufacturer reports*. manufacturer report number. the report number consists of three components: the manufacturer’s fda registration number for the manufacturing site of the reported device, the 4-digit calendar year, and a consecutive 5-digit number for each report filed during the year by the manufacturer (e.g. 1234567-2013-00001, 1234567-2013-00002). *for user facility/importer (distributor) reports*. distributor report number. documentation forthcoming. *for consumer reports*. this field is empty. |
| `report_source_code` | string | source of the adverse event report |
| `report_to_fda` | string | whether the report was sent to the fda by a user facility or importer (distributor). user facilities are required to send reports of device-related deaths. importers are required to send reports of device-related deaths and serious injuries. |
| `report_to_manufacturer` | string | whether the report was sent to the manufacturer by a user facility or importer (distributor). user facilities are required to send reports of device-related deaths and serious injuries to manufacturers. importers are required to send reports to manufacturers of device-related deaths, device-related serious injuries, and device-related malfunctions that could cause or contribute to a death or serious injury. |
| `reporter_occupation_code` | string | initial reporter occupation. |
| `reprocessed_and_reused_flag` | string | indicates whether the suspect device was a single-use device that was reprocessed and reused on a patient. |
| `single_use_flag` | string | whether the device was labeled for single use or not. |
| `source_type` | array of strings | the manufacturer-reported source of the adverse event report. |
| `type_of_report` | array of strings | the type of report. |
:::

[^1]:The complete list of three-letter product classification codes can be [downloaded](https://www.accessdata.fda.gov/premarket/ftparea/foiclass.zip). See the file's
[description](https://www.fda.gov/medical-devices/classify-your-medical-device/download-product-code-classification-files#description).

:::{note}
The complete list of three-letter product classification codes can be [downloaded](https://www.accessdata.fda.gov/premarket/ftparea/foiclass.zip). See the file's [description](https://www.fda.gov/medical-devices/classify-your-medical-device/download-product-code-classification-files#description).
See also the [yml file](searchable-fields-device-api.yaml) I downloaded (although I can' t remember from where) that describes the fields in a bit more detail.
:::

## List of the Relevant Field

:::{table} Fields Relevant to Adverse Event Reports for Refractive Surgery
:widths: auto
:align: left

| field\_name | datatype | definition |
| ----------- | -------- | ---------- |
| `adverse_event_flag` | string | whether the report is about an incident where the use of the device is suspected to have resulted in an adverse outcome in a patient. TODO: Isn't this always true or yes in the case of an adverse device event? |
| `device.device_report_product_code` | string | three-letter fda product classification code. medical devices are classified under <a href='http://www.fda.gov/medicaldevices/deviceregulationandguidance/overview/classifyyourdevice/default.htm'>21 cfr parts 862-892</a>. |
| `device.generic_name` | string | the generic or common name of the suspect medical device or a generally descriptive name. TODO: Is LASIK a generic device or part of a generic device?). |
| `event_type` | string | outcomes associated with the adverse event. TODO: Is theres a pre-defined set of event types? |
| `mdr_text.date_report` | string | date the initial reporter (whoever initially provided information to the user facility, manufacturer, or importer) provided the information about the event. |
| `mdr_text.text` | string | narrative text or problem description. |
| `mdr_text.text_type_code` | string | string that describes the type of narrative contained within the text field. |
| `patient.date_received` | string | date the report about this patient was received. |
| `patient.sequence_number_outcome` | array of strings | outcome associated with the adverse event for this patient. expect wide variability in this field; each string in the list of strings may contain multiple outcomes, separated by commas, and with numbers, which may or may not be related to the `patient_sequence_number`. |
| `report_date` | string | date of the report, or the date that the report was forwarded to the manufacturer and/or the fda. |
| `report_source_code` | string | source of the adverse event report |
| `type_of_report` | array of strings | the type of report. |
:::

These are the relevant refractive surgery-related device codes:

|Code|Device name                                                                                    |
|:---|:----------------------------------------------------------------------------------------------|
|**OCL**|Surgical Device, For Cutting, Coagulation, And/Or Ablation Of Tissue, Including Cardiac Tissue|
|**HQF**|Laser, Ophthalmic|
|**LZS**|Excimer Laser System|
|**OTL**|Femtosecond Laser System For Refractive Correction|
|**HMY**|Keratome, Battery-Powered|
|**HNO**|Keratome, Ac-Powered|
|**MYD**|Keratome, Water Jet|
|**NKY**|Blade, Keratome, Reprocessed|

:::{note}
The femtosecond laser is a laser used to create the flap instead of a keratome.
:::
