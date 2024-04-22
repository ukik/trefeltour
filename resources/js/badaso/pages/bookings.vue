<template>
    <div>
        <vs-row>
            <custom-badaso-widget :col="col" :widgets="dashboardData"> </custom-badaso-widget>
        </vs-row>
        <!-- <vs-row class="col-12">
            <price-list />
        </vs-row> -->
    </div>
</template>

<script>
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Home",
  components: {},
  data: () => ({
    dashboardData: [
        {
            "label": "Booking Travel",
            "icon": "drive_eta",
            // "value": 13,
            "prefixValue": "",
            "delimiter": "."
        },
        {
            "label": "Booking Kuliner",
            "icon": "restaurant",
            // "value": 14,
            "prefixValue": "",
            "delimiter": "."
        },
        {
            "label": "Booking Hotel",
            "icon": "apartment",
            // "value": 549,
            "prefixValue": "",
            "delimiter": "."
        },

        {
            "label": "Booking Rental",
            "icon": "car_rental",
            // "value": 13,
            "prefixValue": "",
            "delimiter": "."
        },
        {
            "label": "Booking Wisata",
            "icon": "map",
            // "value": 14,
            "prefixValue": "",
            "delimiter": "."
        },
        {
            "label": "Booking Talent",
            "icon": "face",
            // "value": 549,
            "prefixValue": "",
            "delimiter": "."
        },
        {
            "label": "Booking Suvenir",
            "icon": "local_mall",
            // "value": 14,
            "prefixValue": "",
            "delimiter": "."
        }

    ],
    col: 12,
  }),
  async mounted() {
    // this.getDashboardData();
    // this.saveTokenFcmMessage();

    if (this.dashboardData.length >= 4) {
        this.col = 3;
    } else if (this.dashboardData.length == 3) {
        this.col = 4;
    } else {
        this.col = 6;
    }
  },
  methods: {
    getDashboardData() {
      this.$openLoader();
      this.$api.badasoDashboard
        .index()
        .then((response) => {
          this.$closeLoader();
          this.dashboardData = response.data;
          this.dashboardData.map((data) => {
            data.value =
              data.prefixValue +
              data.value
                .toString()
                .replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, data.delimiter);
            return data;
          });

          if (this.dashboardData.length >= 4) {
            this.col = 3;
          } else if (this.dashboardData.length == 3) {
            this.col = 4;
          } else {
            this.col = 6;
          }
        })
        .catch((error) => {
          if (error.status == 401) {
            this.$closeLoader();
            this.$vs.notify({
              title: this.$t("alert.error"),
              text: error.message,
              color: "danger",
            });
          } else {
            this.$closeLoader();
            this.$vs.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          }
        });
    },
    saveTokenFcmMessage() {
      if (this.$statusActiveFeatureFirebase) {
        this.$messagingToken.then((tokenMessage) => {
          try {
            this.$api.badasoFcm.saveTokenMessage(tokenMessage);
          } catch (error) {
            console.error("Errors set token firebase cloud message :", error);
          }
        });
      }
    },
  },
};
</script>
