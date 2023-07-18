# Notes

Other OpenFda PHP Code to Investigate

 [laravel-openfda](https://github.com/MeisamMulla/laravel-openfda) has a fundametnalclass that encapsulates the functionality of query API call 
and its five openFDA query parameters. So this encapsulates succintly what the openFDA API does. Its Endpoints class or interface can probably be 
re-worked using an Enum, maybe an interface backed Enum?

```php
$query->search($srch)->limit($l)->?skip($s)->?count();
```

## Code Notes

### Todoes

To answer the questions below it might help to search [Open Data](https://opendata.stackexchange.com/) for answers, like searching ".exact" or 
".exact" and "find", "contains", or ... "Elasticsearch" and "JSON" and "data", and so on.

1. Define exactly which devie/event fields I need to understand better before I can define an interface for OpenFda.
2. Determine which fields require `=` and which require `:`.
3. Determine what usefulness, if any, there is for the fields of interest that have `.exact` versions.

Maybe a generic pasers, maybe in PHP, will be useful in the implementation? Or a parse I can generate, maybe some sort of CLI parameters parser?

- [TNTSearch](https://github.com/teamtnt/tntsearch) is a full-text search (FTS) engine written entirely in PHP. It could help highlight? OR maybe
I could download all the JSON openFDA LASIK data, sort it in a DB and then search it?
