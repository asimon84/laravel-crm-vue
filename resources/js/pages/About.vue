<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { about } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import Accordion from '../components/Accordion.vue';
import AccordionPanel from '../components/AccordionPanel.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'About',
        href: about().url,
    },
];
</script>

<template>
    <Head title="About" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">

              <Accordion>
                <AccordionPanel title="Section 1">
                  <p>Content for section 1.</p>
                </AccordionPanel>
                <AccordionPanel title="Section 2">
                  <p>Content for section 2.</p>
                  <ul>
                    <li>Item A</li>
                    <li>Item B</li>
                  </ul>
                </AccordionPanel>
                <AccordionPanel title="Section 3">
                  <p>Content for section 3.</p>
                </AccordionPanel>
              </Accordion>

        </div>
    </AppLayout>
</template>
