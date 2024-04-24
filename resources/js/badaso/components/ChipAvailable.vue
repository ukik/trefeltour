<template>
    <div>
        <vs-chip v-if="is_available === 'true'" color="success">
            <vs-icon class="mr-2" icon="done" size="14px" color="white"></vs-icon>
            Tersedia
        </vs-chip>
        <vs-chip v-else-if="is_available === 'false'" color="danger">
            <vs-icon class="mr-2" icon="close" size="14px" color="white"></vs-icon>
            Tidak
        </vs-chip>
        <span v-else>{{ is_available }}</span>
    </div>
</template>

<script>
export default {
    props: {
        is_available: {
            default: '',
        }
    }
}
</script>
