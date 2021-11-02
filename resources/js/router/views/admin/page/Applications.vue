<template>
    <div class="applications">
        <table>
            <thead>
            <tr>
                <td>
                    <button @click="sort('created_at')">
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
                <td>
                    <button @click="sort('name')">
                        <span>Имя</span>
                        <span>
                            <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path class="fa-secondary" fill="currentColor"
                                      d="M41.05 288.05h238c21.4 0 32.1 25.9 17 41l-119 119a23.9 23.9 0 01-33.8.1l-.1-.1-119.1-119c-15.05-15.05-4.4-41 17-41z"
                                      opacity=".4"/><path class="fa-primary" fill="currentColor"
                                                          d="M24.05 183.05l119.1-119A23.9 23.9 0 01177 64a.94.94 0 01.1.1l119 119c15.1 15.1 4.4 41-17 41h-238c-21.45-.05-32.1-25.95-17.05-41.05z"/>
                            </svg>
                        </span>
                    </button>
                </td>
                <td>
                    <button @click="sort('phone')">
                        <span>Телефон</span>
                        <span>
                            <svg class="fill-current w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path class="fa-secondary" fill="currentColor"
                                      d="M41.05 288.05h238c21.4 0 32.1 25.9 17 41l-119 119a23.9 23.9 0 01-33.8.1l-.1-.1-119.1-119c-15.05-15.05-4.4-41 17-41z"
                                      opacity=".4"/><path class="fa-primary" fill="currentColor"
                                                          d="M24.05 183.05l119.1-119A23.9 23.9 0 01177 64a.94.94 0 01.1.1l119 119c15.1 15.1 4.4 41-17 41h-238c-21.45-.05-32.1-25.95-17.05-41.05z"/>
                            </svg>
                        </span>
                    </button>
                </td>
                <td>
                    <button @click="sort('email')">
                        <span>Email</span>
                        <span>
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
                <td></td>
            </tr>
            <tr>
                <td class="input-filter">
                    <input @input="filterColumn()" type="date" v-model="filters.created_at" class="input">
                </td>
                <td class="input-filter">
                    <input @input="filterColumn()" type="text" v-model="filters.name" class="input">
                </td>
                <td class="input-filter">
                    <input @input="filterColumn()" type="text" v-model="filters.phone" class="input">
                </td>
                <td class="input-filter">
                    <input @input="filterColumn()" type="text" v-model="filters.email" class="input">
                </td>
                <td></td>
                <td>
                    <transition name="fade-slide">
                        <div>
                            <button @click="showFilters = !showFilters">
                                <span class="block">Выбрать категоррию</span>
                                <span class="ml-3 block flex align-middle">
                                    <span class="w-4 lg:w-6">
                                        <svg
                                            :class="['fill-current text-gi-gray-dark transform-arrow', showFilters ? 'active' : '']"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 442.8 253.2">
                                        <path
                                            d="M439.3 23.3L419.5 3.5c-4.7-4.7-12.3-4.7-17 0L221.4 184.2 40.3 3.5c-4.7-4.7-12.3-4.7-17 0L3.5 23.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0L439.3 40.3c4.7-4.7 4.7-12.3 0-17z"/>
                                        </svg>
                                    </span>
                            </span>
                            </button>
                            <transition name="fade-slide">
                                <div v-if="showFilters">
                                    <checkbox v-for="category in categories"
                                              v-model="selectedCategories[category.id]"
                                              :key="category.id" :options="category.name">
                                    </checkbox>
                                </div>
                            </transition>
                        </div>
                    </transition>
                </td>
            </tr>
            </thead>
            <tbody v-if="applications.length > 0">
            <Application v-for="application in applications" :application="application" :key="application.id"/>
            </tbody>
            <tbody v-else>
            <tr>
                <td class="w-12/12 py-2 text-gi-gray-medium font-light text-xl align-top">
                    <div class="application-not-found">Заявок не найдено</div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Application from "./Application"
import {mapActions, mapGetters} from "vuex"
import Checkbox from "../../../../components/helpers/Checkbox"

export default {
    name: 'Applications',
    components: {Checkbox, Application},
    data: () => ({
        selectedCategories: {},
        showFilters: false,
        filters: {
            created_at: '',
            name: '',
            phone: '',
            email: ''
        },
    }),
    watch: {
        'selectedCategories': {
            handler(newVal) {
                this.updateSelectedCategories(newVal).then(() => {
                    console.log(this.selectedCategories)
                    this.getApplications()
                })
            },
            deep: true
        }
    },
    computed: mapGetters({
        applications: 'applications/applications',
        categories: 'applications/categories'
    }),
    methods: {
        ...mapActions({
            getApplications: 'applications/getApplications',
            getCategories: 'applications/getCategories',
            updateSelectedCategories: 'applications/updateSelectedCategories',
            updateSort: 'applications/updateSort',
            updateFilters: 'applications/updateFilters'
        }),
        sort(type) {
            this.updateSort(type).then(() => {
                this.getApplications()
            })
        },
        filterColumn() {
            this.updateFilters({
                filtersCreatedAt: this.filters.created_at,
                filtersName: this.filters.name,
                filtersPhone: this.filters.phone,
                filtersEmail: this.filters.email
            }).then(() => {
                this.getApplications()
            })
        },
        fillSelectedCategories() {
            const values = {}

            this.categories.forEach(status => {
                values[status.id] = false
            })

            this.selectedCategories = values
        },
    },
    created() {
        if (this.categories.length === 0) {
            this.getCategories().then(() => {
                this.fillSelectedCategories()
            })
        } else {
            this.fillSelectedCategories()
        }
    }
}
</script>

<style scoped>

</style>