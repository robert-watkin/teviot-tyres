# Vehicle Enquiry Service (VES) API Guide

The VES API OpenAPI 3.0 technical specification can be found [here](https://developer-portal.driver-vehicle-licensing.api.gov.uk/apis/vehicle-enquiry-service/vehicle-enquiry-service-description.html)

It is also available in JSON format.

## Introduction

The DVLA Vehicle Enquiry Service API is a RESTful service that provides vehicle details of a specified vehicle. It uses the vehicle registration number as input to search and provide details of the vehicle. The response data is provided in JSON format.

## Register For VES API

If you would like to register to use this API, please [apply here](https://developer-portal.driver-vehicle-licensing.api.gov.uk/).

## Request

To consume the API, make an HTTP POST request to the following URL:

```
https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles
```

### Authentication

Each request you must include a mandatory key value pair in the header:
- **Key**: `x-api-key`
- **Value**: Your issued API key

No other authentication is required for this API.

### Body

Include the Vehicle Registration Number (VRN) in the request body:

```json
{ 
  "registrationNumber": "TE57VRN" 
}
```

**Important**: Do not include any spaces or non-alphanumeric characters in the VRN.

### Example

Using cURL:

```bash
curl -L -X POST 'https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles' \
-H 'x-api-key: YOUR_API_KEY' \
-H 'Content-Type: application/json' \
-d '{"registrationNumber": "TE57VRN"}'
```

> **Security Note**: OWASP security guidelines dictate that sensitive information should not be included in URLs. The VRN is deemed sensitive information by the ICO, so is passed in the body as a POST request.

## Response

A successful request returns JSON:

```json
{
  "artEndDate": "2025-02-28",
  "co2Emissions": 135,
  "colour": "BLUE",
  "engineCapacity": 2494,
  "fuelType": "PETROL",
  "make": "ROVER",
  "markedForExport": false,
  "monthOfFirstRegistration": "2004-12",
  "motStatus": "No details held by DVLA",
  "registrationNumber": "ABC1234",
  "revenueWeight": 1640,
  "taxDueDate": "2007-01-01",
  "taxStatus": "Untaxed",
  "typeApproval": "N1",
  "wheelplan": "NON STANDARD",
  "yearOfManufacture": 2004,
  "euroStatus": "EURO 6 AD",
  "realDrivingEmissions": "1",
  "dateOfLastV5CIssued": "2016-12-25"
}
```

## Error Responses

| Status | Meaning | Description |
|--------|---------|-------------|
| 400 | Bad Request | Bad Request |
| 404 | Not Found | Vehicle Not Found |
| 500 | Internal Server Error | Internal Server Error |
| 503 | Service Unavailable | Service Unavailable |

## Test Environment

Access to a test environment is available for integration testing.

### Test URL

```
https://uat.driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles
```

### Test VRNs

- `ER19BAD` - Returns 400 Bad Request
- See full list of test VRNs in the official documentation

### Test Response Example

```json
{
  "errors": [
    {
      "status": "400",
      "code": "400",
      "title": "Bad Request",
      "detail": "Invalid format for field - vehicle registration number"
    }
  ]
}
```

## Usage Plans and Throttling Limits

- Only **one API key** per customer/company
- Rate limits apply (requests per second)
- HTTP 429 returned when limits exceeded

## Support

Technical queries: dvlaapiaccess@dvla.gov.uk
Subject line: "VES API technical query"
