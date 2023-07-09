# Open FDA Authorization

While you do not need a key to use the Open FDA API, a key authorizes more requests per day as shown below:

- Without API authorization key:
  - 240 requests allowed per minute, per IP address
  - 1,000 requests per day, per IP address.

- With API authorization key:
  - 240 requests per minute
  - 120,000 requests per day.

## Authentication Method

Authentication using the API key can be done in two ways:

- passing it in the HTTP header using **basic auth** scheme: `Authorization: Basic eW91ckFQSUtleUhlcmU6`

- passing your API key with each request using the `api_key` query string parameter: `https://api.fda.gov/drug/event.json?api_key=yourAPIKeyHere&search=...`
