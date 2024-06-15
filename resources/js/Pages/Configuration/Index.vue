<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


</script>
<template>
    <Head title="Agenda" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Configuração da Agenda</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="my-4">
                            <h3 class="text-base font-semibold leading-6 text-gray-900">
                                Área de Configuração
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Configure as informações do seu calendário.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-2 border rounded-lg">
                            <div class="p-4">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First
                                        name</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last
                                        name</label>
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                        class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email-address"
                                        class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                    <input type="text" name="email-address" id="email-address" autocomplete="email"
                                        class="mt-2 block w-full rounded-md border-0 px-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country"
                                        class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                    <select id="country" name="country" autocomplete="country-name"
                                        class="mt-2 block w-full rounded-md border-0 bg-white py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option>United States</option>
                                        <option>Canada</option>
                                        <option>Mexico</option>
                                    </select>
                                </div>
                            </div>
                            <div class="p-4">
                                <fieldset>
                                    <legend class="text-sm font-semibold leading-6 text-gray-900">By Email</legend>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex h-6 items-center">
                                                <input id="comments" name="comments" type="checkbox"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                            </div>
                                            <div class="ml-3 text-sm leading-6">
                                                <label for="comments" class="font-medium text-gray-900">Comments</label>
                                                <p class="text-gray-500">Get notified when someones posts a comment on a
                                                    posting.</p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="candidates" name="candidates" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                                </div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label for="candidates"
                                                        class="font-medium text-gray-900">Candidates</label>
                                                    <p class="text-gray-500">Get notified when a candidate applies for a
                                                        job.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex items-start">
                                                <div class="flex h-6 items-center">
                                                    <input id="offers" name="offers" type="checkbox"
                                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                                                </div>
                                                <div class="ml-3 text-sm leading-6">
                                                    <label for="offers" class="font-medium text-gray-900">Offers</label>
                                                    <p class="text-gray-500">Get notified when a candidate accepts or
                                                        rejects an offer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="button"
                                class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</AuthenticatedLayout></template>
