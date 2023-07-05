# Advanced Syntax

## Grouping

To group several terms together, use parentheses `( )`. For example,

`patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine)`

To join terms as in a boolean AND, use the term +AND+: For example,

`(patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine))+AND+serious:2`

requires that any of the drug names match and that the field `serious` also match.

:::{error}
Are two groups of parentheses needed in the example above? What is `serious`? Is it a top-level term?
:::
