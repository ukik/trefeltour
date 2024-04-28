<template>
    <div>
        <vs-chip v-if="status === 'true'" color="success">
            <vs-icon class="mr-2" icon="done" size="14px" color="white"></vs-icon>
            Sukses
        </vs-chip>
        <vs-chip v-else-if="status === 'false'" color="danger">
            <vs-icon class="mr-2" icon="close" size="14px" color="white"></vs-icon>
            Pending
        </vs-chip>
    </div>
</template>

<script>
export default {
    props: {
        status: {
            default: '',
        }
    }
}
</script>
