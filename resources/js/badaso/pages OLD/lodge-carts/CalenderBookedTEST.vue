<template>
    <div>
        {{ combinedAttrs }}
        <hr>
        {{ getSort }}
        <br>
        <!-- :min-date='new Date()' -->
    <DatePicker  :value="days" :attributes='combinedAttrs' :is-range="false" @dayclick="onDayClick"
        :columns="$screens({ default: 1, lg: 2 })"
        :disabled-dates='disabledDates'
        >
        <!-- <div
            slot="day-popover"
            slot-scope="{ day, dayTitle, attributes }">
            <div class="text-xs text-gray-300 font-semibold text-center">
            {{ dayTitle }}
            </div>
            <ul>
            <li
                v-for="{key, customData} in attributes"
                :key="key">
                {{ customData.description }}
            </li>
            </ul>
        </div> -->
    </DatePicker>
</div>
</template>

<script>
import { Calendar, DatePicker } from 'v-calendar'

let today = new Date()
// Or just use in separate component
export default {
    components: {
        Calendar,
        DatePicker
    },
    data() {
        return {
            attrs: [
                {
                    key: 'today',
                    highlight: 'red',
                    dates: today.setDate(today.getDate() - 5),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 1',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
                {
                    key: 'today',
                    highlight: 'red',
                    dates: new Date(2024, 3, 8),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 2',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
                {
                    key: 'today',
                    highlight: 'red',
                    dates: new Date(),
                    dot: true,
                    // popover: {
                    //     label: 'todo.description 3',
                    //     // visibility: 'focus'
                    // },
                    // customData: {
                    //     description: 'xxxxxxxxxxxx'
                    // }
                },
            ],
            // range: {
            //     start: new Date(),
            //     end: new Date().setDate(today.getDate() + 5)
            // },
            days: [],

            combinedAttrs: [],
            disabledDates: [
                {
                    start: null,
                    end: today.setDate(today.getDate() - 5)
                },
                {
                    start: null,
                    end: new Date()
                },
                {
                    start: null,
                    end: new Date(2024, 3, 8),
                },
            ]
        };
    },
    mounted() {
        this.combinedAttrs = [
            ...this.attrs
        ]

        this.combinedAttrs.sort(function(a,b){
            // Turn your strings into dates, and then subtract them
            // to get a value that is either negative, positive, or zero.
            return new Date(b.dates) - new Date(a.dates);
        });
    },
    computed: {
        getSort() {
            let temp = []
            this.combinedAttrs.forEach(el => {
                temp.push(el.dates)
            })
            return temp
        }
        // dates() {
        //     return this.days.map(day => day.date);
        // },
        // attributes() {
        //     return this.dates.map(date => ({
        //         highlight: true,
        //         dates: date,
        //     }));
        // },
    },
    methods: {
        onDayClick(day) {
            console.log('onDayClick', day)

            let disabled = false
            this.disabledDates.forEach(el => {
                // console.log('onDayClick DISABLED 1', new Date(el.end).toISOString().split('T')[0], day.id)
                if(new Date(el.end).toISOString().split('T')[0] == day.id) {
                    disabled = true
                    console.log('onDayClick DISABLED 2', new Date(el.end).toISOString().split('T')[0], day.id)
                }
            })
            if(disabled) return

            const idx = this.days.findIndex(d => d.id === day.id);

            if (idx >= 0) {
                this.days.splice(idx, 1);
            } else {
                this.days.push({
                    id: day.id,
                    date: day.date,
                    dates: day.id, // dipakai attributes
                    highlight: true, // dipakai attributes
                });
            }

            this.combinedAttrs = [
                ...this.days,
                ...this.attrs
            ]

            this.combinedAttrs.sort(function(a,b){
                // Turn your strings into dates, and then subtract them
                // to get a value that is either negative, positive, or zero.
                return new Date(b.dates) - new Date(a.dates);
            });
        },
    },
}
</script>
