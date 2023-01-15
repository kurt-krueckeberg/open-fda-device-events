# Open FDA API

## Introduction

To make public FDA information about drugs, devices and foods, the **FDA** created [openFDA](https://open.fda.gov/apis), a [RESTful API](https://aws.amazon.com/what-is/restful-api/) that uses the open source search platform [Elasticsearch](https://www.elastic.co/enterprise-search) to allow flexible text searches. Two examples of how you can use the openFDA API are:
 
- [AdverseVerterinaryEvents.com](https://adversevetevents.com/) is an example of a site that uses the **openFDA** API.
- [Device adverse event reports over time](https://open.fda.gov/apis/device/event/explore-the-api-with-an-interactive-chart/)

The [Device adverse event reports over time](https://open.fda.gov/apis/device/event/explore-the-api-with-an-interactive-chart/) drop-down box lists the numerous fields that can be searched.

## How Adverse Event Reports are Organized

Device adverse event reports vary significantly, depending on who initially reported the event, what kind of event was reported, and whether there were follow-up reports. Some reports
come directly from user facilities (like hospitals) or device importers (distributors), while others come directly from manufacturers. Some involve adverse reactions in patients, while
others are reports of defects that did not result in such adverse reactions.

OpenFDA device adverse event results **loosely reflect fields found in forms used by manufacturers and members of the public to report these events**. Since reports
may come from manufacturers, user facilities, distributors, and voluntary sources (such as patients and physicians) who are subject to different reporting
requirements, the collected data in the adverse event system may not always capture every field and should not be interpreted as complete.
 
## openFDA API Overview

See [API Introduction](docs/api.md).

## Creating a Vue.js Application

See [Vue applicaton](docs/vue.md).