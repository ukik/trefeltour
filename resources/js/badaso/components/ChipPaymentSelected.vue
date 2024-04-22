<template>
    <div>
        <vs-chip v-if="is_selected" color="success">
            <vs-icon class="mr-2" icon="done" size="14px" color="white"></vs-icon>
            Valid
        </vs-chip>
        <vs-chip v-else-if="!is_selected" color="danger">
            <vs-icon class="mr-2" icon="close" size="14px" color="white"></vs-icon>
            Belum Valid
        </vs-chip>
    </div>
</template>

<script>
export default {
    props: {
        is_selected: {
            default: '',
        }
    }
}
</script>
