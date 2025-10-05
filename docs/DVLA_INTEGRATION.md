# DVLA Vehicle Lookup Integration

This document explains how to use and test the DVLA Vehicle Enquiry Service (VES) integration.

## Setup

### 1. Environment Variables

Add your API keys to `.env`:

```env
DVLA_OPEN_DATA_TEST_API_KEY=your_test_key_here
DVLA_OPEN_DATA_LIVE_API_KEY=your_live_key_here
```

### 2. Environment Detection

The system automatically uses:
- **Test API** in `local` and `testing` environments
- **Live API** in `production` environment

## Testing

### Command Line Testing

Test the integration using the artisan command:

```bash
# Test with default test registration
sail artisan dvla:test

# Test with specific registration
sail artisan dvla:test ABC123
```

### Unit Tests

Run the test suite:

```bash
sail artisan test --filter DvlaVehicleLookup
```

### Test Registration Numbers (UAT Environment)

When using the test API, you can use these predefined registrations:

- `AA19AAA` - Valid vehicle (success)
- `ER19BAD` - Returns 400 Bad Request
- See [official docs](https://developer-portal.driver-vehicle-licensing.api.gov.uk/) for full list

## Usage

### In Controllers

```php
use App\Services\DvlaVehicleService;

public function lookup(Request $request, DvlaVehicleService $dvlaService)
{
    $result = $dvlaService->lookupVehicle($request->registration);
    
    if ($result['success']) {
        $vehicle = $dvlaService->formatVehicleData($result['data']);
        // Use $vehicle data
    } else {
        // Handle error: $result['error']
    }
}
```

### Response Format

#### Success Response

```php
[
    'success' => true,
    'data' => [
        'registrationNumber' => 'ABC123',
        'make' => 'FORD',
        'colour' => 'BLUE',
        'fuelType' => 'PETROL',
        'yearOfManufacture' => 2015,
        // ... more fields
    ]
]
```

#### Error Response

```php
[
    'success' => false,
    'error' => 'Vehicle not found',
    'status_code' => 404,
    'details' => [...] // Optional error details
]
```

### Formatted Data

The `formatVehicleData()` method returns user-friendly data:

```php
[
    'registration' => 'ABC123',
    'make' => 'Ford',
    'colour' => 'Blue',
    'fuel_type' => 'Petrol',
    'year_of_manufacture' => 2015,
    'engine_capacity' => 1600,
    'co2_emissions' => 120,
    'tax_status' => 'Taxed',
    'tax_due_date' => '2025-01-01',
    'mot_status' => 'Valid',
    'month_of_first_registration' => '2015-03',
    'marked_for_export' => false,
    'euro_status' => 'EURO 6',
]
```

## Error Handling

The service handles these error codes:

| Code | Meaning | User Message |
|------|---------|--------------|
| 400 | Bad Request | Invalid registration number format |
| 404 | Not Found | Vehicle not found |
| 429 | Too Many Requests | Too many requests. Please try again later |
| 500 | Server Error | DVLA service error. Please try again later |
| 503 | Service Unavailable | DVLA service temporarily unavailable |

## Frontend Integration

The reg lookup page is at `/reg-lookup` and uses the `VehicleLookupController`.

### Form Validation

The form validates:
- Required field
- 2-8 characters
- Only letters and numbers (spaces allowed)
- Automatically cleaned (uppercase, spaces removed)

### Example Form (Vue/Inertia)

```vue
<form @submit.prevent="submit">
  <input 
    v-model="form.registration" 
    type="text" 
    placeholder="e.g. AB12 CDE"
    maxlength="8"
  />
  <button type="submit">Search</button>
</form>

<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  registration: ''
});

const submit = () => {
  form.post(route('reg.lookup.search'));
};
</script>
```

## Rate Limiting

- Only **one API key** per company
- Rate limits apply (requests per second)
- Returns HTTP 429 when exceeded
- Implement client-side debouncing/throttling

## Security

- API keys stored in `.env` (never commit)
- Registration numbers sanitized before sending
- Sensitive data not logged in production
- HTTPS only (enforced by DVLA)

## Monitoring

Errors are logged to Laravel logs:

```bash
# View logs
sail artisan log:tail

# Or check storage/logs/laravel.log
```

## Troubleshooting

### "Vehicle not found" for valid registration

- Check you're using correct environment (test vs live)
- Verify API key is correct
- Test registration may not exist in test environment

### "Invalid API key"

- Check `.env` has correct key for environment
- Run `sail artisan config:clear`
- Verify no extra spaces in API key

### Rate limiting errors

- Implement request throttling
- Add delays between requests
- Consider caching results

## Going Live

Before switching to production:

1. ✅ Test thoroughly with test API
2. ✅ Verify live API key is correct
3. ✅ Set `APP_ENV=production` in `.env`
4. ✅ Clear config cache: `sail artisan config:clear`
5. ✅ Monitor error logs closely
6. ✅ Implement rate limiting on frontend

## Support

For DVLA API issues:
- Email: dvlaapiaccess@dvla.gov.uk
- Subject: "VES API technical query"
- Include: API key (last 4 digits only), error details, timestamp
