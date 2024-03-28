<template>
    <div>
        <div slot="button" class="full-width text-center p-2">
            <vs-button @click="is_calender_pilih = true" color="primary" :type="is_calender_pilih ? 'filled' : 'border'">Pilih Tanggal Check-In</vs-button>
            <vs-button @click="is_calender_pilih = false" color="success" :type="!is_calender_pilih ? 'filled' : 'border'">Lihat Sudah Booked</vs-button>
        </div>

        <div v-show="is_calender_pilih">
            <slot name="calender1" />
        </div>
        <div v-show="!is_calender_pilih">
            <slot name="calender2" />
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            is_calender_pilih: true
        }
    }
}
</script>
