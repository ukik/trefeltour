<template>
  <div class="top-navbar__notification">
    <a
      v-on:click="openOrCloseSideBarNotification()"
      href="#"
      :style="{ color: topbarFontColor }"
    >
      <vs-icon icon="notifications"></vs-icon>
      <!-- <sup>{{ countUnreadMessage }}</sup> -->
      <sup>{{ total }}</sup>
    </a>

    <!-- list notification -->
    <vs-sidebar
      position-right
      parent="body"
      default-index="1"
      color="primary"
      class="sidebarx"
      spacer
      v-model="sideBarNotification"
    >
      <div index="1" icon="notifications" slot="header">
        <vs-sidebar-item
          index="0"
          class="top-navbar__notification-item"
          icon="notifications"
        >
          <strong>{{ $t("notification.notification") }}</strong>
        </vs-sidebar-item>
      </div>

      <div v-if="total > 0" class="d-flex justify-content-center">
        <vs-button
          class="mx-1"
          @click="getMessages(prevPage)"
          v-if="messages.length > 0"
          :disabled="currentPage <= 1"
          color="primary"
          size="small"
          type="filled"
          icon="arrow_back"
        ></vs-button>
        <vs-button
          class="mx-1"
          @click="getMessages(nextPage)"
          v-if="messages.length > 0"
          :disabled="currentPage >= lastPage"
          color="primary"
          size="small"
          type="filled"
          icon="arrow_forward"
        ></vs-button>
      </div>

      <vs-divider class="mt-2"></vs-divider>

      <vs-sidebar-item
        icon="question_answer"
        v-for="(message, index) in messages"
        :index="index"
        :key="index"
        :style="message.style"
      >
        <div
          v-on:click="
            openSideBarDetailMessage(message?.data, index);
            id_notification = message?.id;
          "
          class="notification-item"
        >
          <h6>{{ message?.data?.title }}</h6>

          <!-- <span
            v-html="
              message.content.length > 20
                ? message.content.substring(0, 20) + '...'
                : message.content
            "
          >
          </span> -->
          <!-- <template v-for="(item, key) in message.content">
            <span>{{ key }}: {{ item }}</span>
          </template> -->
          <span
            v-html="
              `${message?.data?.name} (${
                message?.data?.email
              }) baru saja ${addLabelCategory(message?.data?.table)}`
            "
          ></span>

          <vs-row style="align-items: center">
            <vs-chip>
              <!-- <vs-avatar icon="schedule" /> -->
              {{ $formatDate(message?.data?.content?.createdAt) }}
            </vs-chip>
          </vs-row>
        </div>
      </vs-sidebar-item>

      <vs-divider></vs-divider>

      <div v-if="total > 0" class="d-flex justify-content-center">
        <vs-button
          class="mx-1"
          @click="getMessages(prevPage)"
          v-if="messages.length > 0"
          :disabled="currentPage <= 1"
          color="primary"
          size="small"
          type="filled"
          icon="arrow_back"
        ></vs-button>
        <vs-button
          class="mx-1"
          @click="getMessages(nextPage)"
          v-if="messages.length > 0"
          :disabled="currentPage >= lastPage"
          color="primary"
          size="small"
          type="filled"
          icon="arrow_forward"
        ></vs-button>
      </div>
    </vs-sidebar>

    <!-- detail message notification -->
    <vs-sidebar
      position-right
      parent="body"
      default-index="1"
      color="primary"
      class="sidebarx"
      spacer
      v-model="sideBarDetailMessage"
    >
      <div class="header-sidebar" index="1" icon="notifications" slot="header">
        <vs-sidebar-item
          index="1"
          v-on:click="closeSideBarDetailMessage()"
          icon="chevron_left"
        >
          <h4>{{ $t("notification.detailMessage") }}</h4>
        </vs-sidebar-item>
      </div>
      <vs-row>
        <div class="m-3" style="margin-left: 14px; margin-right: 14px">
          <!-- <h6>{{ detailMessage?.title }}</h6> -->
          <!-- <h6>{{ detailMessage?.label }}</h6> -->

          <vs-card class="cardx">
            <div slot="header">
              <h4>{{ detailMessage?.title }}</h4>
            </div>
            <div>
              <span v-html="detailMessage?.label"></span>

              <vs-divider></vs-divider>

              <h6>Sender</h6>
              <div>
                <vs-row class="row-div">
                  <vs-icon class="m-1" icon="person" :color="topbarFontColor"></vs-icon>
                  <span>{{ detailSenderMessage?.name }}</span>
                </vs-row>
              </div>

              <div>
                <vs-row class="row-div">
                  <vs-icon class="m-1" icon="email" :color="topbarFontColor"></vs-icon>
                  <span>{{ detailSenderMessage?.email }}</span>
                </vs-row>
              </div>

              <div>
                <vs-row class="row-div">
                  <vs-icon class="m-1" icon="schedule" :color="topbarFontColor"></vs-icon>
                  <span>{{ $formatDate(detailMessage?.content?.createdAt) }}</span>
                </vs-row>
              </div>
            </div>
            <div slot="footer">
              <vs-row vs-justify="flex-end">
                <vs-button
                  @click="markAsRead(id_notification)"
                  type="gradient"
                  color="success"
                  icon="done"
                  >Tandai Dibaca</vs-button
                >
                <vs-button
                  @click="
                    $router.push({
                      name: 'CrudGeneratedRead',
                      params: {
                        id: detailMessage?.content?.id,
                        slug: detailMessage?.table,
                      },
                    })
                  "
                  type="gradient"
                  color="danger"
                  icon="visibility"
                ></vs-button>
                <!-- <vs-button color="primary" icon="turned_in_not"></vs-button>
                <vs-button
                  color="rgb(230,230,230)"
                  color-text="rgb(50,50,50)"
                  icon="settings"
                ></vs-button> -->
              </vs-row>
            </div>
          </vs-card>

          <!-- <span v-html="detailMessage?.content"></span> -->
          <!-- <template v-for="(item, key) in detailMessage.content">
            <div>{{ key }}: {{ item }}</div>
          </template> -->

          <!-- <vs-divider></vs-divider>

          <div>
            <vs-row class="row-div">
              <vs-icon class="m-1" icon="person" :color="topbarFontColor"></vs-icon>
              <span>{{ detailSenderMessage?.name }}</span>
            </vs-row>
          </div>

          <div>
            <vs-row class="row-div">
              <vs-icon class="m-1" icon="email" :color="topbarFontColor"></vs-icon>
              <span>{{ detailSenderMessage?.email }}</span>
            </vs-row>
          </div>

          <div>
            <vs-row class="row-div">
              <vs-icon class="m-1" icon="schedule" :color="topbarFontColor"></vs-icon>
              <span>{{ detailMessage?.createdAt }}</span>
            </vs-row>
          </div> -->
        </div>
      </vs-row>
    </vs-sidebar>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import * as _ from "lodash";
export default {
  data() {
    return {
      nextPage: null,
      prevPage: null,
      lastPage: null,
      currentPage: 1,
      total: 0,
      id_notification: null,

      sideBarNotification: false,
      sideBarDetailMessage: false,
      messages: [],
      detailMessage: {},
      detailSenderMessage: {},
    };
  },
  props: {
    topbarFontColor: {
      type: String,
      default: "#06bbd3",
    },
  },
  methods: {
    addLabel(message) {
      this.detailMessage["label"] = `${message?.name} (${
        message?.email
      }) baru saja ${this.addLabelCategory(message?.table)} (${this.id_notification})`;

      //   switch (message?.table) {
      //     case "culinary-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Kuliner</b> (${message?.content?.id})`;
      //       break;
      //     case "travel-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Travel</b> (${message?.content?.id})`;
      //       break;
      //     case "transport-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Rental</b> (${message?.content?.id})`;
      //       break;
      //     case "souvenir-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Suvenir</b> (${message?.content?.id})`;
      //       break;
      //     case "talent-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Talent</b> (${message?.content?.id})`;
      //       break;
      //     case "lodge-bookings":
      //       this.detailMessage[
      //         "label"
      //       ] = `${message?.name} (${message?.email}) baru saja <b>Booking Hotel</b> (${message?.content?.id})`;
      //       break;
      //   }
    },
    addLabelCategory(category) {
      switch (category) {
        case "culinary-bookings":
          return `<b>Booking Kuliner</b>`;
        case "travel-bookings":
          return `<b>Booking Travel</b>`;
        case "tourism-bookings":
          return `<b>Booking Wisata</b>`;
        case "transport-bookings":
          return `<b>Booking Rental</b>`;
        case "lodge-bookings":
          return `<b>Booking Hotel</b>`;
        case "talent-bookings":
          return `<b>Booking Talent</b>`;
        case "souvenir-bookings":
          return `<b>Booking Suvenir</b>`;

        case "culinary-payments-validations":
          return `<b>Validasi Pembayaran Kuliner</b>`;
        case "travel-payments-validations":
          return `<b>Validasi Pembayaran Travel</b>`;
        case "tourism-payments-validations":
          return `<b>Validasi Pembayaran Wisata</b>`;
        case "transport-payments-validations":
          return `<b>Validasi Pembayaran Rental</b>`;
        case "lodge-payments-validations":
          return `<b>Validasi Pembayaran Hotel</b>`;
        case "talent-payments-validations":
          return `<b>Validasi Pembayaran Talent</b>`;
        case "souvenir-payments-validations":
          return `<b>Validasi Pembayaran Suvenir</b>`;


        case "culinary-payments":
          return `<b>Pembayaran Kuliner</b>`;
        case "travel-payments":
          return `<b>Pembayaran Travel</b>`;
        case "tourism-payments":
          return `<b>Pembayaran Wisata</b>`;
        case "transport-payments":
          return `<b>Pembayaran Rental</b>`;
        case "lodge-payments":
          return `<b>Pembayaran Hotel</b>`;
        case "talent-payments":
          return `<b>Pembayaran Talent</b>`;
        case "souvenir-payments":
          return `<b>Pembayaran Suvenir</b>`;

      }
    },
    openSideBarDetailMessage(message, index) {
      this.sideBarDetailMessage = true;
      this.sideBarNotification = false;
      this.detailMessage = message;
      this.detailSenderMessage = message.sender;
      if (!message.isRead) {
        this.messages[index].isRead = 1;
        this.messages[index].style = { backgroundColor: "#ffffff" };
        // this.readMessage(message.id);
        // this.loadUnreadMessage();
      }
      this.addLabel(message);
    },
    closeSideBarDetailMessage() {
      this.sideBarDetailMessage = false;
      this.sideBarNotification = true;
    },
    loadUnreadMessage() {
      this.$store.commit("badaso/SET_GLOBAL_STATE", {
        key: "countUnreadMessage",
        value: this.messages.filter((message) => message.isRead != 1).length,
      });
    },
    getMessages: _.debounce(async function (page) {
      this.$openLoader();
      await axios({
        url: "/api/notification/unread",
        method: "get",
        params: {
          // 'perPage':1,
          page: page,
        },
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
        .then((response) => {
          const temp = response?.data?.data;
          this.nextPage = temp.nextPage;
          this.prevPage = temp.prevPage;
          this.lastPage = temp.lastPage;
          this.currentPage = temp.currentPage;
          this.total = temp.total;

          // const _messages = [
          //     ...this.messages,
          //     ...temp?.data
          // ]

          this.messages = temp?.data;

          console.log("getMessages", response);
        })
        .catch((error) => {
          this.$vs?.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
      this.$closeLoader();
      return;
      this.$api.badasoFcm
        .getMessages()
        .then(({ data }) => {
          this.messages = data.messages.map((item, index) => {
            item.style = {
              backgroundColor: !item.isRead ? "#f0f5f9" : "#ffffff",
            };

            if (item.createdAt) {
              item.createdAt = moment(item.createdAt).utc().format("YYYY-MM-DD HH:mm:ss");
            }
            return item;
          });

          this.loadUnreadMessage();
        })
        .catch((error) => {
          this.$vs?.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    }, 750),

    markAsRead: _.debounce(async function (id) {
      this.$openLoader();
      await axios({
        url: "/api/notification/markasread/" + id,
        method: "get",
        params: {
          page: this.currentPage,
        },
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      })
        .then((response) => {
          const temp = response?.data?.data;
          this.nextPage = temp.nextPage;
          this.prevPage = temp.prevPage;
          this.lastPage = temp.lastPage;
          this.currentPage = temp.currentPage;
          this.total = temp.total;

          this.messages = temp?.data;

          console.log("getMessages", response);
        })
        .catch((error) => {
          this.$vs?.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
      this.$closeLoader();
    }, 750),
    readMessage(id) {
      this.$api.badasoFcm.readMessage(id).catch((error) => {
        this.$vs?.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      });
    },
    openOrCloseSideBarNotification() {
      this.sideBarNotification = !this.sideBarNotification;
      this.getMessages(this.currentPage);
    },
  },
  computed: {
    countUnreadMessage() {
      const countUnreadMessage = this.$store.getters["badaso/getGlobalState"]
        .countUnreadMessage;
      return countUnreadMessage;
    },
  },
  created() {
    this.getMessages(this.currentPage);
  },
};
</script>
