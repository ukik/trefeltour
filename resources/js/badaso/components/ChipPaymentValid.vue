<template>
    <div>
        <vs-chip v-if="is_valid === 'true'" color="success">
            <vs-icon class="mr-2" icon="done" size="14px" color="white"></vs-icon>
            Sukses
        </vs-chip>
        <vs-chip v-else-if="is_valid === 'false'" color="danger">
            <vs-icon class="mr-2" icon="close" size="14px" color="white"></vs-icon>
            Pending
        </vs-chip>
    </div>
</template>

<script>
export default {
    props: {
        is_valid: {
            default: '',
        }
    }
}
</script>
