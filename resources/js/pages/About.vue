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
                <AccordionPanel title="What is this?">
                    <p>This is a sample CRM application built with a Vue.js frontend.</p>
                </AccordionPanel>
                <AccordionPanel title="What is a CRM?">
                    <p>A CRM is Customer Relationship Management software. It helps a business manage customers, contact information, and order histories.</p>
                </AccordionPanel>
                <AccordionPanel title="What is the purpose?">
                    <p>This application demonstrates Vue.js front end capabilities and componentization of reusable elements.</p>
                </AccordionPanel>
            </Accordion>

        </div>
    </AppLayout>
</template>
