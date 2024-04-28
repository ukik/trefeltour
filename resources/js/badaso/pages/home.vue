<style>
#home_tab li.vs-tabs--li {
  background: white;
}
</style>
<template>
  <div>
    <badaso-widget :col="col1" :widgets="dashboardData1"> </badaso-widget>

    <vs-row class="mb-2">
      <vs-col>
        <vs-dropdown>
          <vs-button class="btn-drop" type="filled" icon="expand_more"
            >Tahun: {{ currentYear }}</vs-button
          >
          <vs-dropdown-menu>
            <template v-for="item in listYear">
              <vs-dropdown-item @click="currentYear = item; getDashboardDataContext()">{{ item }}</vs-dropdown-item>
            </template>
          </vs-dropdown-menu>
        </vs-dropdown>

        <vs-dropdown>
          <vs-button class="btn-drop" type="filled" icon="expand_more"
            >Bulan: {{ currentMonthLabel }}</vs-button
          >
          <vs-dropdown-menu>
            <vs-dropdown-item @click="currentMonth = '01'; getDashboardDataContext()"> Januari </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '02'; getDashboardDataContext()"> Februari </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '03'; getDashboardDataContext()"> Maret </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '04'; getDashboardDataContext()"> April </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '05'; getDashboardDataContext()"> Mei </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '06'; getDashboardDataContext()"> Juni </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '07'; getDashboardDataContext()"> Juli </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '08'; getDashboardDataContext()"> Agustus </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '09'; getDashboardDataContext()"> September </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '10'; getDashboardDataContext()"> Oktober </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '11'; getDashboardDataContext()"> November </vs-dropdown-item>
            <vs-dropdown-item @click="currentMonth = '12'; getDashboardDataContext()"> Desember </vs-dropdown-item>
          </vs-dropdown-menu>
        </vs-dropdown>
      </vs-col>
    </vs-row>

    <vs-row id="home_tab">
      <vs-col>
        <vs-tabs alignment="fixed">
          <vs-tab
            label="Travel"
            icon="drive_eta"
            @click="getDashboardDataContext('count_travel')"
          ></vs-tab>
          <vs-tab
            label="Kuliner"
            icon="restaurant"
            @click="getDashboardDataContext('count_culinary')"
          ></vs-tab>
          <vs-tab
            label="Hotel"
            icon="apartment"
            @click="getDashboardDataContext('count_lodge')"
          ></vs-tab>
          <vs-tab
            label="Rental"
            icon="car_rental"
            @click="getDashboardDataContext('count_transport')"
          ></vs-tab>
          <vs-tab
            label="Wisata"
            icon="map"
            @click="getDashboardDataContext('count_tourism')"
          ></vs-tab>
          <vs-tab
            label="Talent"
            icon="face"
            @click="getDashboardDataContext('count_talent')"
          ></vs-tab>
          <vs-tab
            label="Suvenir"
            icon="local_mall"
            @click="getDashboardDataContext('count_souvenir')"
          ></vs-tab>
        </vs-tabs>
      </vs-col>
      <vs-col v-if="false">
        <div class="row">
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="home">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="drive_eta">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="restaurant">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="apartment">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="car_rental">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="map">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="face">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
          <div class="col-auto pr-0">
            <vs-button color="primary" type="filled" icon="local_mall">Home</vs-button>
            <!-- <div class="p-3 border bg-light">Custom column padding</div> -->
          </div>
        </div>
      </vs-col>
    </vs-row>

    <custom-badaso-widget :col="col2" :widgets="dashboardData2"> </custom-badaso-widget>
  </div>
</template>

<script>
import * as _ from "lodash";
import axios from "axios";
export default {
  // eslint-disable-next-line vue/multi-word-component-names
  name: "Home",
  components: {},
  data: () => ({
    listYear: [],
    currentYear: new Date().getFullYear(),
    currentMonth: new Date().getMonth(),
    currentMonthLabel: "",
    dashboardData1: [],
    currentTab: "count_travel",

    col1: 12,

    dashboardData2: [],
    col2: 12,

    colorx: "#8B0000",
  }),
  watch: {
    currentMonth(val) {
      console.log("currentMonth", Number(val));
      this.adjustMonth(val);
    },
  },
  async mounted() {
    await this.getYear();
    await this.adjustMonth(this.currentMonth);
    await this.getDashboardData();
    await this.getDashboardDataContext("count_travel");
    await this.saveTokenFcmMessage();
  },
  methods: {
    adjustMonth(val) {
      switch (Number(val)) {
        case 1:
          this.currentMonthLabel = "Januari";
          break;
        case 2:
          this.currentMonthLabel = "Februari";
          break;
        case 3:
          this.currentMonthLabel = "Maret";
          break;
        case 4:
          this.currentMonthLabel = "April";
          break;
        case 5:
          this.currentMonthLabel = "Mei";
          break;
        case 6:
          this.currentMonthLabel = "Juni";
          break;
        case 7:
          this.currentMonthLabel = "Juli";
          break;
        case 8:
          this.currentMonthLabel = "Agustus";
          break;
        case 9:
          this.currentMonthLabel = "September";
          break;
        case 10:
          this.currentMonthLabel = "Oktober";
          break;
        case 11:
          this.currentMonthLabel = "November";
          break;
        case 12:
          this.currentMonthLabel = "Desember";
          break;
      }
    },
    getDashboardData() {
      this.$openLoader();
      this.$api.badasoDashboard
        .index()
        .then((response) => {
          this.$closeLoader();
          this.dashboardData1 = response.data;
          this.dashboardData1.map((data) => {
            data.value =
              data.prefixValue +
              data.value
                .toString()
                .replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, data.delimiter);
            return data;
          });

          if (this.dashboardData1.length >= 4) {
            this.col1 = 3;
          } else if (this.dashboardData1.length == 3) {
            this.col1 = 4;
          } else {
            this.col1 = 6;
          }
        })
        .catch((error) => {
          if (error.status == 401) {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.error"),
              text: error.message,
              color: "danger",
            });
          } else {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          }
        });
    },

    getDashboardDataContext: _.debounce(function (slug = null) {
      if (slug) this.currentTab = slug;

      this.dashboardData2 = [];
      this.col2 = [];

      const _slug = this.currentTab

      axios({
        url: `/trevolia-api/v1/dashboard/` + _slug,
        method: "get",
        params: {
          year: this.currentYear,
          month: this.currentMonth,
        },
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
        .then((response) => {
          this.dashboardData2 = response.data?.data;
          this.dashboardData2.map((data) => {
            data.value =
              data.prefixValue +
              data.value
                .toString()
                .replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, data.delimiter);
            return data;
          });

          if (this.dashboardData2.length >= 4) {
            this.col2 = 3;
          } else if (this.dashboardData2.length == 3) {
            this.col2 = 4;
          } else {
            this.col2 = 6;
          }
        })
        .catch((error) => {
          if (error.status == 401) {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.error"),
              text: error.message,
              color: "danger",
            });
          } else {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          }
        });
    }, 750),

    getYear: _.debounce(function () {
      axios({
        url: `/trevolia-api/v1/dashboard/year`,
        method: "get",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
        .then((response) => {
          console.log("getYear", response);
          this.listYear = response.data?.data;
        })
        .catch((error) => {
          if (error.status == 401) {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.error"),
              text: error.message,
              color: "danger",
            });
          } else {
            this.$closeLoader();
            this.$vs?.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          }
        });
    }, 250),

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
