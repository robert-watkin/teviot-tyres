# Teviot Tyres - Project Planning Document

## Project Overview
A modern, dark-themed automotive service website for Teviot Tyres, featuring user profiles, vehicle registration lookup, and comprehensive service information.

**Domain:** teviottyres.com  
**Budget:** £600 (30-40 hours @ £15/hour)  
**Monthly Costs:** £11.25 (Server £10 + Domain £1.25)

---

## Pages & Features

### 1. Landing Page ✅
**Status:** Completed
- [x] Hero section with CTA
- [x] Services overview (modular components)
- [x] Problem/Solution sections
- [x] Testimonials section
- [x] Payment Assist information
- [x] Registration lookup section
- [x] Footer with service links
- [x] Dark theme implementation
- [x] Responsive design

**Components:**
- `HeroSection.vue`
- `ServicesSection.vue`
- `ProblemSection.vue`
- `SolutionSection.vue`
- `TestimonialsSection.vue`
- `PaymentAssistSection.vue`
- `RegLookupSection.vue`
- `FooterSection.vue`

### 2. Services Page ✅
**Status:** Completed
- [x] Individual service sections with anchor links
- [x] "Back to top" buttons on each section
- [x] Phone CTA on each service
- [x] Footer links to each service section
- [x] Background images for visual appeal
- [x] Consistent styling with landing page

**Services Included:**
1. Tyres
2. MOT Preparation
3. Diagnostics
4. Servicing
5. Batteries
6. Emergency Callout
7. Payment Assist
8. Brakes
9. Exhausts
10. Clutches
11. Timing Belts
12. Springs & Suspension
13. Wheel Bearings
14. Remapping & Keys

### 3. Authentication Pages
**Status:** Pending

#### Login Page
- [ ] Email/phone login
- [ ] Password field
- [ ] "Remember me" option
- [ ] Forgot password link
- [ ] Register redirect

#### Register Page
- [ ] Name field
- [ ] Email field
- [ ] Phone field
- [ ] Password field
- [ ] Password confirmation
- [ ] Terms & Conditions acceptance
- [ ] Login redirect

### 4. User Profile Page
**Status:** Pending
- [ ] View/edit user details (CRUD)
- [ ] Name
- [ ] Email
- [ ] Phone
- [ ] Password change
- [ ] View saved vehicles
- [ ] Delete account option

### 5. Vehicle Management
**Status:** Pending
- [ ] View saved vehicles
- [ ] Add new vehicle (via reg lookup)
- [ ] Edit vehicle details
  - [ ] Tyre size specification
  - [ ] Custom notes
- [ ] Delete vehicle
- [ ] Vehicle history/service records

### 6. Registration Lookup Page
**Status:** Partially Complete (component exists)
- [x] Registration input field
- [x] Lookup button
- [ ] API integration for vehicle data
- [ ] Display vehicle information
- [ ] Save to account option (requires auth)
- [ ] Guest lookup (no save option)

**TODO:** Determine API provider for vehicle data

### 7. Admin Dashboard
**Status:** Pending

#### Analytics
- [ ] Integration with datafa.st
- [ ] Page views
- [ ] User registrations
- [ ] Popular services
- [ ] Conversion tracking

#### User Management
- [ ] View all users
- [ ] User details
- [ ] View user's vehicles
- [ ] Send emails to users
- [ ] User activity logs

#### Email System
- [ ] Compose email
- [ ] Select recipients (individual/bulk)
- [ ] Email templates
- [ ] Email history

### 8. Contact Page
**Status:** Pending
- [ ] Contact form
- [ ] Name field
- [ ] Email field
- [ ] Phone field
- [ ] Message field
- [ ] Business information display
- [ ] Map/location
- [ ] Opening hours
- [ ] Social media links

### 9. Legal Pages
**Status:** Pending
- [ ] Terms & Conditions
- [ ] Privacy Policy
- [ ] Cookie Policy
- [ ] GDPR compliance information

---

## Technical Requirements

### User Authentication & Profiles
- [ ] Laravel Breeze setup (recommended for Laravel 12+)
  - [ ] Blade or Inertia Vue stack
- [ ] User registration
- [ ] User login/logout
- [ ] Password reset
- [ ] Email verification
- [ ] Profile CRUD operations
- [ ] Session management

### Vehicle Management System
- [ ] Vehicle model & migration
- [ ] User-vehicle relationship (one-to-many)
- [ ] Vehicle CRUD operations
- [ ] API integration for reg lookup
- [ ] Tyre size field
- [ ] Custom notes field

### Admin System
- [ ] Admin middleware
- [ ] Admin dashboard
- [ ] User management interface
- [ ] Email sending system
- [ ] Analytics integration (datafa.st)

### API Integration
**TODO:** Determine vehicle data API provider
- [ ] Research API options (DVLA, third-party)
- [ ] API key setup
- [ ] Rate limiting
- [ ] Error handling
- [ ] Caching strategy

### Analytics
- [ ] Install datafa.st
- [ ] Track page views
- [ ] Track user registrations
- [ ] Track CTA clicks (phone calls)
- [ ] Track reg lookups
- [ ] Custom events

---

## Functional Requirements

### Call-to-Action (CTA)
- [x] "Phone to book" buttons throughout site
- [x] Phone number: 01450 374875
- [x] Prominent placement on all service pages
- [ ] Click tracking for analytics

### Registration Lookup Flow
1. User enters vehicle registration
2. System fetches vehicle data from API
3. Display vehicle information
4. **If logged in:** Option to save to profile
5. **If not logged in:** Prompt to create account to save

### Payment Assist
- [x] Information section on landing page
- [x] Detailed section on services page
- [x] 0% interest over 4 months
- [x] Soft credit search information
- [x] 3-step process illustration

### Social Media Integration
- [ ] Fetch business info from Facebook
- [ ] Contact details
- [ ] Services list
- [ ] Reviews/testimonials
- [ ] Opening hours

---

## Design Requirements

### Branding
**TODO:** Awaiting branding assets from Gav
- [ ] Logo files
- [ ] Color palette
- [ ] Typography guidelines
- [ ] Brand assets

### Theme
- [x] Dark theme implementation
- [x] Gold accent color (#FFD700)
- [x] Neutral grays for backgrounds
- [x] High contrast for readability

### Responsive Design
- [x] Mobile-first approach
- [x] Tablet breakpoints
- [x] Desktop optimization
- [x] Touch-friendly interactions

---

## Database Schema

### Users Table
```sql
- id
- name
- email (unique)
- phone
- email_verified_at
- password
- remember_token
- is_admin (boolean)
- timestamps
```

### Vehicles Table
```sql
- id
- user_id (foreign key)
- registration (string)
- make (string)
- model (string)
- year (integer)
- color (string)
- fuel_type (string)
- tyre_size (string, nullable)
- notes (text, nullable)
- timestamps
```

### Service_Requests Table (Future)
```sql
- id
- user_id (foreign key, nullable)
- vehicle_id (foreign key, nullable)
- service_type (string)
- message (text)
- status (enum: pending, contacted, completed)
- timestamps
```

---

## API Endpoints

### Public Routes
- `GET /` - Landing page
- `GET /services` - Services page
- `GET /contact` - Contact page
- `GET /terms` - Terms & Conditions
- `GET /privacy` - Privacy Policy
- `POST /reg-lookup` - Vehicle registration lookup

### Authenticated Routes
- `GET /profile` - User profile
- `PUT /profile` - Update profile
- `DELETE /profile` - Delete account
- `GET /vehicles` - List user vehicles
- `POST /vehicles` - Add vehicle
- `PUT /vehicles/{id}` - Update vehicle
- `DELETE /vehicles/{id}` - Delete vehicle

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/users` - List all users
- `GET /admin/users/{id}` - View user details
- `POST /admin/email` - Send email to users
- `GET /admin/analytics` - View analytics

---

## Development Phases

### Phase 1: Foundation ✅ (Completed)
- [x] Landing page design & implementation
- [x] Services page design & implementation
- [x] Component architecture
- [x] Responsive design
- [x] Dark theme

### Phase 2: Authentication ✅ (Completed - Pre-installed)
- [x] User registration system (Laravel Breeze)
- [x] Login system
- [x] Password reset
- [x] Email verification
- [x] Two-factor authentication
- [ ] Profile management (In Progress)

### Phase 3: Vehicle Management
- [ ] Vehicle model & migrations
- [ ] Registration lookup API integration
- [ ] Save vehicles to profile
- [ ] Vehicle CRUD operations

### Phase 4: Admin System
- [ ] Admin middleware & guards
- [ ] User management interface
- [ ] Email system
- [ ] Analytics integration

### Phase 5: Additional Pages
- [ ] Contact page
- [ ] Legal pages (T&Cs, Privacy)
- [ ] About page (optional)

### Phase 6: Testing & Deployment
- [ ] User acceptance testing
- [ ] Performance optimization
- [ ] SEO optimization
- [ ] Server setup (Forge)
- [ ] Domain configuration
- [ ] SSL certificate
- [ ] Production deployment

---

## Outstanding Decisions

### High Priority
1. **Vehicle Data API Provider**
   - Options: DVLA API, third-party services
   - Considerations: Cost, rate limits, data accuracy
   - Decision needed before Phase 3

2. **Branding Assets**
   - Awaiting from Gav
   - Needed for final polish

### Medium Priority
3. **Email Service Provider**
   - Options: Mailgun, SendGrid, Amazon SES
   - For transactional emails and admin emails

4. **Analytics Platform**
   - datafa.st integration details
   - Alternative: Google Analytics

### Low Priority
5. **Additional Features**
   - Service booking system (future enhancement)
   - Online payment integration
   - Service history tracking

---

## Competitor Analysis

### Westmoor MOT Center
**Observations:**
- Clear service listings
- Easy-to-find contact information
- Online booking system
- Customer reviews prominent
- Mobile-friendly design

**Improvements for Teviot Tyres:**
- More modern, dark theme design
- Better user experience with saved vehicles
- Payment assist information upfront
- Faster registration lookup

---

## Success Metrics

### User Engagement
- Number of registrations
- Number of saved vehicles
- Registration lookups performed
- Phone CTA clicks

### Business Goals
- Increase phone inquiries
- Build customer database
- Improve brand awareness
- Streamline customer service

### Technical Performance
- Page load time < 2 seconds
- Mobile performance score > 90
- Uptime > 99.9%
- Zero critical security issues

---

## Next Steps

1. **Immediate (This Week)**
   - [ ] Set up authentication system
   - [ ] Create user profile pages
   - [ ] Research vehicle data API options

2. **Short Term (Next 2 Weeks)**
   - [ ] Implement vehicle management
   - [ ] Integrate registration lookup API
   - [ ] Create contact page
   - [ ] Write legal pages

3. **Medium Term (Next Month)**
   - [ ] Build admin dashboard
   - [ ] Implement email system
   - [ ] Set up analytics
   - [ ] User testing

4. **Before Launch**
   - [ ] Final branding integration
   - [ ] Performance optimization
   - [ ] Security audit
   - [ ] Server setup
   - [ ] Domain configuration

---

## Notes

- Current focus: Landing page and services page are complete and polished
- Next priority: User authentication and vehicle management
- Payment assist is a key differentiator - prominently featured
- Dark theme with gold accents creates premium feel
- Mobile-first approach ensures accessibility
- All CTAs lead to phone calls - no online booking yet

---

**Last Updated:** 2025-10-02  
**Project Status:** Phase 1 Complete, Phase 2 In Progress  
**Completion:** ~40% (UI/UX complete, backend pending)
