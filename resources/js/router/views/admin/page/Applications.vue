<template>
    <div class="applications">
        <v-card>
            <v-card-title>
                Applications
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>
            <v-data-table
                v-model="selected"
                :headers="headers"
                :items="filteredApplications"
                :search.sync="search"
                :custom-sort="customSort"
                item-key="name"
                class="elevation-1"
                :expanded.sync="expanded"
                show-expand
                :item-class="rowClass"
            >
                <template v-slot:header="{ header }">
                    <tr class="grey lighten-3">
                        <th v-for="header in headers" :key="header.text">
                            <div v-if="filters.hasOwnProperty(header.value)">
                                <v-autocomplete
                                    multiple
                                    chips
                                    clearable
                                    :items="columnValueList(header.value)"
                                    v-model="filters[header.value]"
                                    return-object
                                >
                                    <template v-slot:selection="{ item, index }">
                                        <v-chip v-if="index < 5">
                                            <span>
                                                {{ item }}
                                            </span>
                                        </v-chip>
                                        <span v-if="index === 5" class="grey--text caption">
                                            (+{{ filters[header.value].length - 5 }} others)
                                        </span>
                                    </template>
                                </v-autocomplete>
                            </div>
                        </th>
                    </tr>
                </template>
                <template v-slot:item.category="{ item }">
                    {{ item.category.name }}
                </template>
                <template v-slot:expanded-item="{ headers, item }">
                    <td :colspan="headers.length">
                        Message: {{ item.message }}
                    </td>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex"
import Checkbox from "../../../../components/helpers/Checkbox"

export default {
    name: 'Applications',
    components: {Checkbox},
    data: () => ({
        search: '',
        expanded: [],
        selected: [],
        filters: {
            category: [],
        },
        headers: [
            {text: 'Name', align: 'start', value: 'name'},
            {text: 'Phone', value: 'phone'},
            {text: 'Email', value: 'email'},
            {
                text: 'Message', value: 'data-table-expand',
                sortable: false, align: 'center', width: '100px'
            },
            {
                text: 'Category', value: 'category', width: '400px',
                sortable: false,
            },
            {text: 'Date', value: 'created_at'},
        ],
    }),

    computed: {
        ...mapGetters({
            applications: 'applications/applications',
            categories: 'applications/categories',
        }),

        filteredApplications() {
            return this.applications.filter(d => {
                return Object.keys(this.filters).every(f => {
                    return this.filters[f].length < 1 || this.filters[f].includes(d[f].name)
                })
            })
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'applications/getApplications',
            getCategories: 'applications/getCategories',
        }),

        customSort(items, index, isDesc) {
            items.sort((a, b) => {
                if (index === "date") {
                    if (!isDesc) {
                        return dateHelp.compare(a.date, b.date);
                    } else {
                        return dateHelp.compare(b.date, a.date);
                    }
                } else {
                    if (!isDesc) {
                        return a[index] < b[index] ? -1 : 1;
                    } else {
                        return b[index] < a[index] ? -1 : 1;
                    }
                }
            });
            return items;
        },

        columnValueList(val) {
            return this.applications.map(d => {
                const container = {}
                container[val] = d.category.name

                return container.category
            })
        },

        rowClass() {
            return 'centered-item'
        },
    },
    mounted() {
        this.getCategories()
        this.getApplications()
    }
}
</script>

<style lang="scss" scoped>

</style>