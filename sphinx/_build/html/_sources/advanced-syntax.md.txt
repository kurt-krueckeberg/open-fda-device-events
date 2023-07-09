# Advanced Syntax

**TODO:** Include API examples of eachs item mentioned below.

## Grouping

To group several terms together, use parentheses `( )`. For example,

`patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine)`

To join terms as in a boolean AND, use the term +AND+: For example,

`(patient.drug.medicinalproduct:(cetirizine+OR+loratadine+OR+diphenhydramine))+AND+serious:2`

requires that any of the drug names match and that the field `serious` also match.

:::{note}
**TODO:**
- Are two groups of parentheses needed in the example above? What is `serious`? Is it a top-level term?
- Add example
:::

## Dates and ranges

The openFDA API supports searching by range in date, numeric, or string fields.

- Specify an inclusive range by using square brackets `[min+TO+max]`. These include the values in the range. For example, `[1+TO+5]` will match 1 through 5.

- Dates are simple to search by via range. For instance, `[2004-01-01+TO+2005-01-01]` will search for records between **Jan 1, 2004** and **Jan 1, 2005**.

:::{note}
- Add example
:::

## Missing (or not missing) values

You can search for empty fields or for fields that are not empty:

* `_missing_`: search modifier that matches when a field has no value (is empty).

* `_exists_`: search modifier that matches when a field has a value (is not empty).

:::{note}
**TODO:**
- Add example
:::

## Timeseries

:::{note}
**TODO:**
- Add example
:::

## Paging

:::{note}
**TODO:**
- Add example
:::

