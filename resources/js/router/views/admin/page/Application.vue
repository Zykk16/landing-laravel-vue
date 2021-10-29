<template>
    <tr>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.created_at }}</div>
            </div>
        </td>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.name }}</div>
            </div>
        </td>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.phone }}</div>
            </div>
        </td>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.email }}</div>
            </div>
        </td>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.message }}</div>
            </div>
        </td>
        <td class="table-column">
            <div class="table-column-item">
                <div class="title">{{ application.category }}</div>
            </div>
        </td>
    </tr>
</template>

<script>
export default {
    name: "Application",
    props: {
        application: {type: Object, required: true}
    },
}
</script>

<style scoped>

</style>