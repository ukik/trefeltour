<template>
    <div>
        <vs-chip v-if="is_reserved === 'true'" color="success">
            <vs-icon class="mr-2" icon="done" size="14px" color="white"></vs-icon>
            Bekerja
        </vs-chip>
        <vs-chip v-else-if="is_reserved === 'false'" color="danger">
            <vs-icon class="mr-2" icon="close" size="14px" color="white"></vs-icon>
            Tidak
        </vs-chip>
        <span v-else>{{ is_reserved }}</span>
    </div>
</template>

<script>
export default {
    props: {
        is_reserved: {
            default: '',
        }
    }
}
</script>
