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
  <PublicLayout title="Privacy Policy">
    <Head title="Privacy Policy" />
    <section class="mx-auto w-full max-w-4xl px-4 py-16">
      <Reveal mode="up">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
          <span class="text-[#FFD700]">Privacy</span> Policy
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
                At Teviot Tyres, we are committed to protecting your privacy and personal data. This Privacy Policy 
                explains how we collect, use, store, and protect your information when you use our website or services.
              </p>
              <p>
                We are the data controller for the personal information we collect. This policy complies with the 
                UK General Data Protection Regulation (UK GDPR) and the Data Protection Act 2018.
              </p>
            </div>
          </div>

          <!-- Information We Collect -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">2. Information We Collect</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">2.1 Information You Provide</h3>
              <p>When you use our services, we may collect:</p>
              <ul>
                <li><strong>Contact Information:</strong> Name, phone number, email address, postal address</li>
                <li><strong>Vehicle Information:</strong> Registration number, make, model, service history</li>
                <li><strong>Payment Information:</strong> Payment card details (processed securely by our payment provider)</li>
                <li><strong>Account Information:</strong> Username, password, preferences (if you create an account)</li>
                <li><strong>Communication Records:</strong> Records of phone calls, emails, and messages with us</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">2.2 Information Collected Automatically</h3>
              <p>When you visit our website, we automatically collect:</p>
              <ul>
                <li><strong>Technical Data:</strong> IP address, browser type, device information, operating system</li>
                <li><strong>Usage Data:</strong> Pages visited, time spent on pages, links clicked, referring website</li>
                <li><strong>Cookies:</strong> Small files stored on your device (see our Cookie Policy below)</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">2.3 DVLA Vehicle Data</h3>
              <p>
                When you use our vehicle registration lookup service, we access data from the DVLA Vehicle Enquiry 
                Service. This data is provided by the DVLA and includes vehicle make, model, colour, fuel type, 
                tax status, and MOT information.
              </p>
            </div>
          </div>

          <!-- How We Use Your Information -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">3. How We Use Your Information</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>We use your personal information for the following purposes:</p>
              
              <h3 class="text-base font-semibold text-white mt-4">3.1 Service Provision</h3>
              <ul>
                <li>To provide tyres, MOT testing, servicing, and other automotive services</li>
                <li>To schedule and manage appointments</li>
                <li>To identify your vehicle and recommend appropriate services</li>
                <li>To process payments and manage Payment Assist arrangements</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">3.2 Communication</h3>
              <ul>
                <li>To contact you about your bookings and services</li>
                <li>To send appointment reminders and service notifications</li>
                <li>To respond to your inquiries and provide customer support</li>
                <li>To send important updates about our services (with your consent)</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">3.3 Business Operations</h3>
              <ul>
                <li>To maintain accurate business records</li>
                <li>To comply with legal and regulatory requirements</li>
                <li>To improve our services and website functionality</li>
                <li>To prevent fraud and ensure security</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">3.4 Marketing (With Consent)</h3>
              <ul>
                <li>To send promotional offers and service reminders</li>
                <li>To inform you about new services or special offers</li>
              </ul>
              <p class="text-sm italic">
                You can opt out of marketing communications at any time by contacting us or using the unsubscribe 
                link in our emails.
              </p>
            </div>
          </div>

          <!-- Legal Basis -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">4. Legal Basis for Processing</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>We process your personal data based on the following legal grounds:</p>
              <ul>
                <li><strong>Contract Performance:</strong> To fulfill our contractual obligations when providing services</li>
                <li><strong>Legitimate Interests:</strong> To operate our business, improve services, and prevent fraud</li>
                <li><strong>Legal Obligation:</strong> To comply with laws such as tax, accounting, and MOT regulations</li>
                <li><strong>Consent:</strong> For marketing communications and non-essential cookies (where required)</li>
              </ul>
            </div>
          </div>

          <!-- Data Sharing -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">5. Sharing Your Information</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>We may share your information with:</p>

              <h3 class="text-base font-semibold text-white mt-4">5.1 Service Providers</h3>
              <ul>
                <li><strong>Payment Processors:</strong> To process card payments securely</li>
                <li><strong>DVLA:</strong> To access vehicle information via the Vehicle Enquiry Service</li>
                <li><strong>IT Service Providers:</strong> For website hosting and technical support</li>
                <li><strong>Parts Suppliers:</strong> To order parts for your vehicle</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">5.2 Legal Requirements</h3>
              <p>
                We may disclose your information if required by law, court order, or to protect our legal rights, 
                prevent fraud, or ensure safety.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">5.3 Business Transfers</h3>
              <p>
                If we sell or transfer our business, your information may be transferred to the new owner, subject 
                to the same privacy protections.
              </p>

              <p class="mt-4">
                <strong>We do not sell your personal data to third parties for marketing purposes.</strong>
              </p>
            </div>
          </div>

          <!-- Data Security -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">6. Data Security</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>We implement appropriate technical and organizational measures to protect your data:</p>
              <ul>
                <li>Secure HTTPS encryption for our website</li>
                <li>Secure payment processing through PCI-DSS compliant providers</li>
                <li>Access controls and authentication for our systems</li>
                <li>Regular security updates and monitoring</li>
                <li>Staff training on data protection</li>
              </ul>
              <p>
                While we take reasonable steps to protect your data, no method of transmission over the internet 
                is completely secure. We cannot guarantee absolute security.
              </p>
            </div>
          </div>

          <!-- Data Retention -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">7. Data Retention</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>We retain your personal data for as long as necessary:</p>
              <ul>
                <li><strong>Service Records:</strong> 7 years (for warranty, legal, and tax purposes)</li>
                <li><strong>MOT Records:</strong> As required by DVSA regulations</li>
                <li><strong>Payment Records:</strong> 7 years (for accounting and tax purposes)</li>
                <li><strong>Marketing Consent:</strong> Until you withdraw consent or we no longer need it</li>
                <li><strong>Website Analytics:</strong> 26 months (Google Analytics default)</li>
              </ul>
              <p>
                After the retention period, we will securely delete or anonymize your data unless we are legally 
                required to keep it longer.
              </p>
            </div>
          </div>

          <!-- Your Rights -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">8. Your Rights</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>Under UK GDPR, you have the following rights:</p>
              <ul>
                <li><strong>Right to Access:</strong> Request a copy of your personal data</li>
                <li><strong>Right to Rectification:</strong> Correct inaccurate or incomplete data</li>
                <li><strong>Right to Erasure:</strong> Request deletion of your data (in certain circumstances)</li>
                <li><strong>Right to Restrict Processing:</strong> Limit how we use your data</li>
                <li><strong>Right to Data Portability:</strong> Receive your data in a portable format</li>
                <li><strong>Right to Object:</strong> Object to processing based on legitimate interests or for marketing</li>
                <li><strong>Right to Withdraw Consent:</strong> Withdraw consent for marketing or cookies at any time</li>
              </ul>
              <p>
                To exercise any of these rights, please contact us at <strong>{{ phone }}</strong>. We will respond 
                within one month.
              </p>
              <p>
                You also have the right to lodge a complaint with the Information Commissioner's Office (ICO) if 
                you believe we have mishandled your data. Visit <a href="https://ico.org.uk" class="text-[#FFD700] hover:underline" target="_blank">ico.org.uk</a> for more information.
              </p>
            </div>
          </div>

          <!-- Cookies -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">9. Cookies</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <h3 class="text-base font-semibold text-white">9.1 What Are Cookies?</h3>
              <p>
                Cookies are small text files stored on your device when you visit our website. They help us provide 
                a better user experience and understand how our website is used.
              </p>

              <h3 class="text-base font-semibold text-white mt-4">9.2 Types of Cookies We Use</h3>
              <ul>
                <li><strong>Essential Cookies:</strong> Required for the website to function (e.g., session management, security)</li>
                <li><strong>Functional Cookies:</strong> Remember your preferences and settings</li>
                <li><strong>Analytics Cookies:</strong> Help us understand website usage (e.g., Google Analytics)</li>
                <li><strong>Marketing Cookies:</strong> Used for targeted advertising (only with your consent)</li>
              </ul>

              <h3 class="text-base font-semibold text-white mt-4">9.3 Managing Cookies</h3>
              <p>
                You can control cookies through your browser settings. Note that disabling essential cookies may 
                affect website functionality. Most browsers allow you to:
              </p>
              <ul>
                <li>View and delete cookies</li>
                <li>Block third-party cookies</li>
                <li>Block cookies from specific websites</li>
                <li>Delete all cookies when you close your browser</li>
              </ul>
            </div>
          </div>

          <!-- Third-Party Services -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">10. Third-Party Services</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>Our website may contain links to third-party websites or use third-party services:</p>
              <ul>
                <li><strong>DVLA Vehicle Enquiry Service:</strong> Subject to DVLA's terms and privacy policy</li>
                <li><strong>Payment Processors:</strong> Subject to their own privacy policies</li>
                <li><strong>Google Analytics:</strong> For website analytics (anonymized data)</li>
              </ul>
              <p>
                We are not responsible for the privacy practices of third-party websites. Please review their 
                privacy policies before providing any information.
              </p>
            </div>
          </div>

          <!-- Children's Privacy -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">11. Children's Privacy</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>
                Our services are not intended for children under 16. We do not knowingly collect personal data 
                from children. If you believe we have collected data from a child, please contact us immediately.
              </p>
            </div>
          </div>

          <!-- Changes to Policy -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">12. Changes to This Policy</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>
                We may update this Privacy Policy from time to time to reflect changes in our practices or legal 
                requirements. The latest version will always be available on our website with the "Last updated" date.
              </p>
              <p>
                Significant changes will be communicated via email (if we have your email address) or by a notice 
                on our website.
              </p>
            </div>
          </div>

          <!-- Contact Us -->
          <div class="rounded-xl border border-neutral-800 bg-neutral-950 p-6">
            <h2 class="text-xl font-semibold text-[#FFD700]">13. Contact Us</h2>
            <div class="prose prose-invert prose-sm mt-4 max-w-none text-neutral-300">
              <p>If you have any questions about this Privacy Policy or how we handle your data, please contact us:</p>
              <ul>
                <li><strong>Phone:</strong> {{ phone }}</li>
                <li><strong>Location:</strong> Hawick, Scottish Borders</li>
              </ul>
              <p>
                For data protection inquiries or to exercise your rights, please call us and ask to speak with our 
                data protection contact.
              </p>
            </div>
          </div>
        </div>
      </Reveal>
    </section>
  </PublicLayout>
</template>
