# Open FDA API

## Introduction

The [openFDA](https://open.fda.gov/apis) [RESTful API](https://aws.amazon.com/what-is/restful-api/) supports [Elasticsearch](https://www.elastic.co/enterprise-search) queries of public FDA information about drugs, devices and foods. An example use of the API is:

- [Device adverse event reports over time](https://open.fda.gov/apis/device/event/explore-the-api-with-an-interactive-chart/)

The [Device adverse event reports over time](https://open.fda.gov/apis/device/event/explore-the-api-with-an-interactive-chart/) drop-down box lists the numerous fields that can be searched.

## How Adverse Event Reports are Organized

Device adverse event reports vary significantly, depending on who initially reported the event, what kind of event was reported, and whether there were follow-up reports. Some reports
come directly from user facilities (like hospitals) or device importers (distributors), while others come directly from manufacturers. Some involve adverse reactions in patients, while
others are reports of defects that did not result in such adverse reactions.

OpenFDA device adverse event results **loosely reflect fields found in forms used by manufacturers and members of the public to report these events**. Since reports
may come from manufacturers, user facilities, distributors, and voluntary sources (such as patients and physicians) who are subject to different reporting
requirements, the collected data in the adverse event system may not always capture every field and should not be interpreted as complete.

## How Adverse Event Reports are Soted and Identified

Adverse events are collected through a series of safety reports. Each is identified by a 8-digit string

  **6176304-1**.

where the first 7 digits (before the hyphen) identify the individual report, and the last digit (after the hyphen) indicates the order of the report. For eample, if three reports are submitted (for the same event),
they would be saved as

- **6176304-1**
- **6176304-2**
- **6176304-3**
 
## openFDA API Overview

See the [open FDA API Introduction](docs/api.md).

## Creating a Vue.js Application

See [Vue applicaton](docs/vue.md).
