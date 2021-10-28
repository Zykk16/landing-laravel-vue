<template>
    <div class="applications">
        <table class="w-full font-nova mt-4">
            <thead class="text-xl">
            <tr>
                <td class="w-2/12">
                    <button class="flex items-center focus:outline-none" @click="sort('created_at')">
                        <span class="text-gi-gray-dark font-light">Дата</span>
                        <span class="text-gi-gray-dark">
                            <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path class="fa-secondary" fill="currentColor"
                                      d="M41.05 288.05h238c21.4 0 32.1 25.9 17 41l-119 119a23.9 23.9 0 01-33.8.1l-.1-.1-119.1-119c-15.05-15.05-4.4-41 17-41z"
                                      opacity=".4"/><path class="fa-primary" fill="currentColor"
                                                          d="M24.05 183.05l119.1-119A23.9 23.9 0 01177 64a.94.94 0 01.1.1l119 119c15.1 15.1 4.4 41-17 41h-238c-21.45-.05-32.1-25.95-17.05-41.05z"/>
                            </svg>
                        </span>
                    </button>
                </td>
                <td class="w-8/12">
                    <button class="flex items-center focus:outline-none" @click="sort('name')">
                        <span class="text-gi-gray-dark font-light">Вакансия</span>
                        <span class="text-gi-gray-dark">
                            <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path class="fa-secondary" fill="currentColor"
                                      d="M41.05 288.05h238c21.4 0 32.1 25.9 17 41l-119 119a23.9 23.9 0 01-33.8.1l-.1-.1-119.1-119c-15.05-15.05-4.4-41 17-41z"
                                      opacity=".4"/><path class="fa-primary" fill="currentColor"
                                                          d="M24.05 183.05l119.1-119A23.9 23.9 0 01177 64a.94.94 0 01.1.1l119 119c15.1 15.1 4.4 41-17 41h-238c-21.45-.05-32.1-25.95-17.05-41.05z"/>
                            </svg>
                        </span>
                    </button>
                </td>
            </tr>
            <tr>
                <td class="w-2/12 p-2 pl-0">
                    <input @input="filterColumn()" type="date"
                           v-model="filters.created_at"
                           class="input input-filter border rounded-lg text-xl font-light placeholder-gi-gray-medium border-gi-gray-lightest outline-none p-1">
                </td>
                <td class="w-8/12 p-2 pl-0">
                    <input @input="filterColumn()" type="text" v-model="filters.name"
                           class="input input-filter border rounded-lg text-xl font-light placeholder-gi-gray-medium border-gi-gray-lightest outline-none p-1">
                </td>
            </tr>
            </thead>
            <tbody v-if="applications.length > 0">
            <Application v-for="application in applications" :application="application"
                         :key="application.id"
                         @deleted-position="onDeletePosition"/>
            </tbody>
            <tbody v-else>
            <tr>
                <td class="w-2/12 p-2 pl-0"></td>
                <td class="w-12/12 py-2 text-gi-gray-medium font-light text-xl align-top">
                    <div class="mt-6 text-center text-2xl font-light text-gi-red-normal">Заявок не найдено</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Application from "./Application";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Applications",
    components: {Application},
    data() {
        return {
            filters: {
                created_at: '',
                name: ''
            },
        }
    },

    computed: {
        ...mapGetters({
            applications: 'applications/applications'
        })
    },

    methods: {
        ...mapActions({
            getApplications: 'applications/getApplications',
            updateSort: 'applications/updateSort',
            updateFilters: 'applications/updateFilters'
        }),
        sort(type) {
            this.updateSort(type).then(() => {
                this.getApplications();
            });
        },
        filterColumn() {
            this.updateFilters({
                filtersCreatedAt: this.filters.created_at,
                filtersName: this.filters.name
            }).then(() => {
                this.getApplications()
            })
        },

        mounted() {
            setTimeout(() => {
                console.log(123)
                this.getApplications()
            }, 3000)
        }
    }
}
</script>

<style scoped>

</style>