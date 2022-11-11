These classes are the main Guzzle-related generalized REST API base classes and interfaces used to call the sentence corpus APIs and the dictionary APIs.

The interfaces:


- ClassmapperInterface.php
- DictionaryInterface.php
- HtmlBuilder.php
- NounFetchInterface.php
- ResultfileInterface.php
- SentenceFetchInterface.php
- TranslateInterface.php


The base classes:

- ClassID.php
- RestClient.php 

Implementation classes: 
using those classes and interfaces above:

- LeipzigSentenceFetcher.php
- CollinsNouncFetcher.php
- CollinsDictionary.php


Main top-level code:

main.php


Note: Javascript comes with a built-in general library for matching REST API calls.
