# DVLA Integration Testing Checklist

## Quick Start

### 1. Verify Environment Setup

```bash
# Check your .env file has both keys
grep DVLA .env
```

Should show:
```
DVLA_OPEN_DATA_TEST_API_KEY=your_test_key
DVLA_OPEN_DATA_LIVE_API_KEY=your_live_key
```

### 2. Clear Config Cache

```bash
sail artisan config:clear
```

### 3. Run Quick Test

```bash
sail artisan dvla:test
```

Expected output: Vehicle details for test registration `AA19AAA`

## Testing Checklist

### ✅ Command Line Tests

- [ ] Test with default registration: `sail artisan dvla:test`
- [ ] Test with custom registration: `sail artisan dvla:test ABC123`
- [ ] Test with invalid format: `sail artisan dvla:test INVALID!!!`
- [ ] Test with non-existent vehicle: `sail artisan dvla:test NOTFOUND`

### ✅ Unit Tests

- [ ] Run all tests: `sail artisan test --filter DvlaVehicleLookup`
- [ ] All tests should pass

### ✅ Browser Tests

1. Navigate to `/reg-lookup`
2. Test valid registration (e.g., `AA19AAA` in test environment)
3. Test invalid format (e.g., `ABC@123`)
4. Test empty submission
5. Test with spaces (e.g., `AB12 CDE`)
6. Test with lowercase (e.g., `abc123`)

### ✅ Error Handling

Test these scenarios:
- [ ] Empty registration
- [ ] Too short (< 2 chars)
- [ ] Too long (> 8 chars)
- [ ] Invalid characters
- [ ] Vehicle not found (404)
- [ ] Invalid format (400)

### ✅ API Response Validation

Check that responses include:
- [ ] Registration number
- [ ] Make
- [ ] Colour
- [ ] Fuel type
- [ ] Year of manufacture
- [ ] Tax status
- [ ] MOT status

## Test Registration Numbers (UAT)

Use these in test environment:

| Registration | Expected Result |
|--------------|-----------------|
| `AA19AAA` | Valid vehicle (success) |
| `ER19BAD` | 400 Bad Request |
| See DVLA docs for more |

## Common Issues & Solutions

### Issue: "Invalid API key"
**Solution**: 
1. Check `.env` has correct key
2. Run `sail artisan config:clear`
3. Restart Laravel: `sail down && sail up -d`

### Issue: "Vehicle not found" for test registration
**Solution**:
1. Verify you're in local environment: `php artisan env`
2. Check test API key is set
3. Try different test registration from DVLA docs

### Issue: Tests failing
**Solution**:
1. Clear cache: `sail artisan cache:clear`
2. Clear config: `sail artisan config:clear`
3. Re-run: `sail artisan test --filter DvlaVehicleLookup`

## Next Steps After Testing

Once all tests pass:

1. **Update Frontend** - Enhance `/reg-lookup` page with vehicle display
2. **Add Caching** - Cache successful lookups to reduce API calls
3. **Add Analytics** - Track lookup success/failure rates
4. **Rate Limiting** - Implement frontend throttling
5. **User Feedback** - Add loading states and better error messages

## Production Checklist

Before going live:

- [ ] Test API works correctly
- [ ] Live API key is set in production `.env`
- [ ] Error logging is working
- [ ] Rate limiting is implemented
- [ ] User-friendly error messages
- [ ] Loading states on frontend
- [ ] Analytics tracking setup
- [ ] DVLA terms of use reviewed
