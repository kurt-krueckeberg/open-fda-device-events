# Todo

Javascript + ReactJS seems a more straight forward solution for implementing the openFDA API calls to query
adverse device event data for those device I am interested in, as it client-side, browser-based solution.

But I'm not sure is graphing libraries like D3.js are server side?

## Read stackexchange replies

To learn more about the openFDA API read these stackexchange.com replies: [https://opendata.stackexchange.com/questions/tagged/openfda](https://opendata.stackexchange.com/questions/tagged/openfda)

## Questions about AND and OR 

In this queryy

``` 
https://open.fda.gov/drug/event.json?search=patient.drug.openfda.generic_name.exact:("DROSPIRENONE+AND+ETHINYL+ESTRADIOL")+AND+patient.reaction.reactionmeddrapt.exact:("PAIN")+AND+receivedate:([1989-06-29+TO+2015-08-11])&count=receivedate&skip=0
```

is the boolean logic: **DROSPIRENONE** AND (**ETHINYL** or **ESTRADIOL**)?
