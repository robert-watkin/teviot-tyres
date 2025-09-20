<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import PublicLayout from '@/layouts/public/PublicLayout.vue'
import HeroSection from '../../components/landing/HeroSection.vue'
import TestimonialsSection from '../../components/landing/TestimonialsSection.vue'
import ProblemSection from '../../components/landing/ProblemSection.vue'
import SolutionSection from '../../components/landing/SolutionSection.vue'
import ServicesSection from '../../components/landing/ServicesSection.vue'
import RegLookupSection from '../../components/landing/RegLookupSection.vue'
import PaymentAssistSection from '../../components/landing/PaymentAssistSection.vue'
import CTASection from '../../components/landing/CTASection.vue'
</script>

<template>
  <PublicLayout title="Teviot Tyres">
    <Head title="Teviot Tyres" />

    <!-- Hero Section -->
    <HeroSection />

    <!-- Testimonials Section -->
    <TestimonialsSection />

    <!-- Problem Section -->
    <ProblemSection />

    <!-- Solution Section -->
    <SolutionSection />

    <!-- Services Section -->
    <ServicesSection />

    <!-- Reg Lookup Section -->
    <RegLookupSection />

    <!-- Payment Assist Section -->
    <PaymentAssistSection />

    <!-- CTA Section -->
    <CTASection />
  </PublicLayout>
</template>
