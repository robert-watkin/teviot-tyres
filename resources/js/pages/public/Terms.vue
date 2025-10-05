<script setup lang="ts">
import PublicLayout from '@/layouts/public/PublicLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Reveal from '@/components/Reveal.vue';

const page = usePage();
const site = computed(() => (page.props as any).site || {});
const phone = computed(() => site.value.phone || '01450 374875');
const lastUpdated = 'January 2025';
</script>

<template>
  <PublicLayout title="Terms & Conditions">
    <Head title="Terms & Conditions" />
    <section class="mx-auto w-full max-w-4xl px-4 py-16">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
          <span class="text-[#FFD700]">Terms</span> & Conditions
        </h1>
        <p class="mt-2 text-sm text-neutral-400">Last updated: {{ lastUpdated }}</p>
      </Reveal>

      <Reveal mode="up" :delay="60">
        <div class="mt-8 space-y-6">
          <!-- Introduction -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">1. Introduction</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>
                Welcome to Teviot Tyres. These Terms and Conditions govern your use of our website and services. 
                By accessing our website or using our services, you agree to be bound by these terms.
              </p>
              <p>
                Teviot Tyres is a trading name operated from Hawick, Scottish Borders. We provide tyre fitting, 
                MOT testing, vehicle servicing, diagnostics, and related automotive services.
              </p>
            </div>
          </div>

          <!-- Services -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">2. Services</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">2.1 Service Provision</h3>
              <p>We provide the following services:</p>
              <ul>
                <li>Tyre supply and fitting (all makes and budgets)</li>
                <li>Class 4 MOT testing (DVSA approved)</li>
                <li>MOT preparation and pre-checks</li>
                <li>Vehicle servicing and maintenance</li>
                <li>Diagnostic services</li>
                <li>Battery testing and replacement</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">2.2 Booking and Appointments</h3>
              <p>
                Services are provided by appointment. Bookings can be made by calling <strong>{{ phone }}</strong>. 
                We will confirm your appointment time and provide an estimated cost where possible.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">2.3 Service Standards</h3>
              <p>
                All work is carried out by qualified technicians to industry standards. We use quality parts 
                and materials appropriate to your vehicle and budget requirements.
              </p>
            </div>
          </div>

          <!-- Pricing and Payment -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">3. Pricing and Payment</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">3.1 Quotes and Estimates</h3>
              <p>
                Prices displayed on our website are indicative only. Final prices will be confirmed when you 
                contact us or visit our premises. We reserve the right to adjust prices based on vehicle 
                specifications and requirements.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">3.2 Payment Terms</h3>
              <p>
                Payment is due upon completion of work unless alternative arrangements have been agreed in advance. 
                We accept cash, card payments, and offer Payment Assist options (subject to status).
              </p>

              <h3 class="text-base font-semibold text-white mt-4">3.3 Payment Assist</h3>
              <p>
                Payment Assist allows you to spread the cost of repairs over multiple payments. Terms and eligibility 
                will be discussed when you book. This service is provided subject to our assessment and your agreement 
                to the payment schedule.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">3.4 Additional Work</h3>
              <p>
                If additional work is required beyond the original quote, we will contact you for approval before 
                proceeding. You will not be charged for work you have not authorized.
              </p>
            </div>
          </div>

          <!-- Warranties and Guarantees -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">4. Warranties and Guarantees</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">4.1 Workmanship Guarantee</h3>
              <p>
                We guarantee our workmanship for 12 months from the date of service. If you experience any issues 
                related to our work, contact us immediately and we will rectify the problem at no additional cost.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">4.2 Parts Warranty</h3>
              <p>
                Parts supplied by us are covered by the manufacturer's warranty. Warranty periods vary by product 
                and will be confirmed at the time of purchase. We will assist with warranty claims where applicable.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">4.3 Exclusions</h3>
              <p>
                Warranties do not cover damage caused by misuse, accident, neglect, or normal wear and tear. 
                Warranties are void if unauthorized repairs or modifications are made.
              </p>
            </div>
          </div>

          <!-- MOT Testing -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">5. MOT Testing</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">5.1 DVSA Standards</h3>
              <p>
                All MOT tests are conducted in accordance with DVSA (Driver and Vehicle Standards Agency) guidelines. 
                We are an approved MOT testing station for Class 4 vehicles.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">5.2 Test Results</h3>
              <p>
                MOT test results are determined by DVSA standards and are impartial. We will advise you of any 
                failures or advisories and can provide quotes for remedial work.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">5.3 Retests</h3>
              <p>
                If your vehicle fails its MOT, you may be eligible for a free partial retest if repairs are 
                completed within 10 working days and the vehicle is returned to us for retesting.
              </p>
            </div>
          </div>

          <!-- Vehicle Registration Lookup -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">6. Vehicle Registration Lookup Service</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">6.1 DVLA Data</h3>
              <p>
                Our vehicle registration lookup service uses data provided by the DVLA Vehicle Enquiry Service. 
                The information is provided for reference purposes only.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">6.2 Accuracy</h3>
              <p>
                While we strive to provide accurate information, we cannot guarantee the completeness or accuracy 
                of DVLA data. You should verify critical information independently.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">6.3 Data Usage</h3>
              <p>
                By using our registration lookup service, you agree that the data will be used solely for obtaining 
                information about your vehicle for service purposes. Misuse of this service is prohibited.
              </p>
            </div>
          </div>

          <!-- Liability -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">7. Liability</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">7.1 Our Liability</h3>
              <p>
                We maintain appropriate insurance and will be liable for any damage or loss directly caused by 
                our negligence or breach of contract, up to the value of the service provided.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">7.2 Customer Responsibility</h3>
              <p>
                You are responsible for ensuring your vehicle is roadworthy and legal to drive. We are not liable 
                for any consequences arising from your use of the vehicle after service.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">7.3 Limitation</h3>
              <p>
                Nothing in these terms excludes or limits our liability for death or personal injury caused by 
                negligence, fraud, or any other liability that cannot be excluded by law.
              </p>
            </div>
          </div>

          <!-- Cancellations -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">8. Cancellations and Changes</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">8.1 Customer Cancellations</h3>
              <p>
                You may cancel or reschedule your appointment by calling us. We request at least 24 hours' notice 
                where possible. Late cancellations may incur a charge if parts have been ordered specifically for your vehicle.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">8.2 Our Right to Cancel</h3>
              <p>
                We reserve the right to cancel or reschedule appointments in exceptional circumstances. We will 
                provide as much notice as possible and offer alternative arrangements.
              </p>
            </div>
          </div>

          <!-- Website Use -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">9. Website Use</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">9.1 Acceptable Use</h3>
              <p>
                You may use our website for lawful purposes only. You must not use our website in any way that 
                causes damage to the website or impairs its availability or accessibility.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">9.2 Intellectual Property</h3>
              <p>
                All content on this website, including text, graphics, logos, and software, is our property or 
                licensed to us and is protected by copyright and other intellectual property laws.
              </p>
            </div>
          </div>

          <!-- General -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">10. General Terms</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">10.1 Changes to Terms</h3>
              <p>
                We may update these terms from time to time. The latest version will always be available on our 
                website. Continued use of our services constitutes acceptance of any changes.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">10.2 Governing Law</h3>
              <p>
                These terms are governed by the laws of Scotland. Any disputes will be subject to the exclusive 
                jurisdiction of the Scottish courts.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">10.3 Contact Us</h3>
              <p>
                If you have any questions about these terms, please contact us at <strong>{{ phone }}</strong>.
              </p>
            </div>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
