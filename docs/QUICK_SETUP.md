# Quick Setup Guide

## 1. Add API Keys to .env

Open your `.env` file and ensure these lines exist with your actual keys:

```env
DVLA_OPEN_DATA_TEST_API_KEY=your_test_key_here
DVLA_OPEN_DATA_LIVE_API_KEY=your_live_key_here
```

## 2. Clear Config Cache

```bash
sail artisan config:clear
```

## 3. Verify Configuration

```bash
sail artisan dvla:check
```

You should see:
```
✓ Current environment (local) has required test API key configured
```

## 4. Test the Integration

```bash
sail artisan dvla:test
```

## Troubleshooting

If you see "API key not configured":
1. Check `.env` file has the keys
2. Make sure there are no spaces around the `=` sign
3. Run `sail artisan config:clear`
4. Run `sail artisan dvla:check` again
