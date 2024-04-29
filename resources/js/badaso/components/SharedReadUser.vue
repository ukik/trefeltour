<template>
  <div
    style="
      max-height: 80vh;
      overflow-y: scroll;
      padding: 15px 15px 0px 15px;
      background: #e5feff;
    "
  >
    <vs-col vs-lg="12">
      <vs-card>
        <vs-row>
          <vs-col
            v-for="(dataRow, rowIndex) in dataType.dataRows"
            :key="rowIndex"
            :vs-lg="dataRow.details.size ? dataRow.details.size : '12'"
          >
            <!-- {{ dataRow.field }} -- {{ record[
                            $caseConvert.stringSnakeToCamel(dataRow.field)
                            ] }} -->
            <template v-if="dataRow.read">
              <table class="badaso-table">
                <tr>
                  <td class="badaso-table__label">
                    {{ dataRow.displayName }}
                  </td>
                  <td class="badaso-table__value">
                    <!-- <img
                            v-if="dataRow.type == 'upload_image'"
                            :src="
                            record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                            ]
                            "
                            width="100%"
                            alt=""
                        /> -->
                    <vs-row v-if="dataRow.type == 'upload_image'">
                      <common-light-box
                        :images="[record[$caseConvert.stringSnakeToCamel(dataRow.field)]]"
                        ref="lightbox"
                      />

                      <vs-col vs-lg="4" vs-sm="12">
                        <div class="badaso-upload-image-multiple__preview">
                          <img
                            @click="
                              onLightBox();
                              $refs.lightbox[0].showMultiple();
                            "
                            class="badaso-upload-image-multiple__preview-image"
                            :src="record[$caseConvert.stringSnakeToCamel(dataRow.field)]"
                            width="100%"
                            alt=""
                          />
                        </div>
                      </vs-col>
                    </vs-row>

                    <div
                      v-else-if="dataRow.type == 'upload_image_multiple'"
                      class="crud-generated__item--upload-image-multiple"
                    >
                      <common-light-box
                        :images="
                          $parseJsonChecker(
                            record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                          )
                        "
                        ref="lightbox"
                      />
                      <!-- <img
                            v-for="(image, indexImage) in stringToArray(
                                record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                            )"
                            :key="indexImage"
                            :src="image"
                            width="100%"
                            alt=""
                            class="crud-generated__item--image"
                            /> -->
                      <!-- <img
                                v-for="(image, indexImage) in JSON.parse(
                                record[
                                    $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                                )"
                                :key="indexImage"
                                :src="image"
                                width="100%"
                                alt=""
                                class="crud-generated__item--image"
                            /> -->

                      <vs-row>
                        <vs-col
                          vs-lg="4"
                          vs-sm="12"
                          v-for="(val, index) in $parseJsonChecker(
                            record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                          )"
                          :key="index"
                        >
                          <div class="badaso-upload-image-multiple__preview">
                            <img
                              @click="
                                onLightBox();
                                $refs.lightbox[0].index = index;
                                $refs.lightbox[0].showMultiple();
                              "
                              :src="val"
                              class="badaso-upload-image-multiple__preview-image"
                            />
                          </div>
                        </vs-col>
                      </vs-row>
                    </div>
                    <span
                      v-else-if="dataRow.type == 'editor'"
                      v-html="record[$caseConvert.stringSnakeToCamel(dataRow.field)]"
                    ></span>
                    <a
                      v-else-if="dataRow.type == 'url'"
                      :href="record[$caseConvert.stringSnakeToCamel(dataRow.field)]"
                      target="_blank"
                      >{{ record[$caseConvert.stringSnakeToCamel(dataRow.field)] }}</a
                    >
                    <a
                      v-else-if="dataRow.type == 'upload_file'"
                      :href="`${record[$caseConvert.stringSnakeToCamel(dataRow.field)]}`"
                      target="_blank"
                      >{{
                        getDownloadUrl(
                          record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                        )
                      }}</a
                    >
                    <div
                      v-else-if="dataRow.type == 'upload_file_multiple'"
                      class="crud-generated__item--upload-file-multiple"
                    >
                      <ol>
                        <li
                          v-for="(file, indexFile) in arrayToString(
                            record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                          )"
                          :key="indexFile"
                        >
                          <a :href="`${file}`" target="_blank">{{ file }}</a>
                        </li>
                      </ol>
                    </div>
                    <p v-else-if="dataRow.type == 'radio' || dataRow.type == 'select'">
                      {{
                        bindSelection(
                          dataRow.details.items,
                          record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                        )
                      }}
                    </p>
                    <div
                      v-else-if="
                        dataRow.type == 'select_multiple' || dataRow.type == 'checkbox'
                      "
                      class="crud-generated__item--select-multiple"
                    >
                      <p
                        v-for="(selected, indexSelected) in stringToArray(
                          record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                        )"
                        :key="indexSelected"
                      >
                        {{ bindSelection(dataRow.details.items, selected) }}
                      </p>
                    </div>
                    <div v-else-if="dataRow.type == 'color_picker'">
                      <div
                        class="crud-generated__item--color-picker"
                        :style="`background-color: ${
                          record[$caseConvert.stringSnakeToCamel(dataRow.field)]
                        }`"
                      ></div>
                      {{ record[$caseConvert.stringSnakeToCamel(dataRow.field)] }}
                    </div>
                    <span v-else-if="dataRow.type == 'relation'">
                      {{ displayRelationData(record, dataRow) }}
                    </span>
                    <div v-else>
                      <!-- {{ record }} -->
                      <ol
                        class="ml-3"
                        style="width: 100px"
                        v-if="dataRow.field == 'date_checkin'"
                      >
                        <li
                          v-for="item in JSON.parse(record?.dateCheckin)?.map(
                            (e) => e.id
                          )"
                        >
                          <span>{{ item }}</span>
                        </li>
                      </ol>
                      <span v-else-if="dataRow.field == 'starting_date'">
                        {{ $formatTime(record?.startingDate) }}
                      </span>
                      <span v-else-if="dataRow.field == 'get_final_amount'">
                        {{ $rupiah(record?.getFinalAmount) }}
                      </span>
                      <span v-else-if="dataRow.field == 'year_exp'">
                        {{ $formatDate(record?.yearExp) }}
                      </span>
                      <span
                        v-else-if="dataRow.field == 'customer_id' && record?.customer"
                      >
                        {{ record?.customer?.username }}
                      </span>

                      <span v-if="dataRow.field == 'get_price'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>
                      <span v-else-if="dataRow.field == 'get_discount'">
                        {{ record[$caseConvert.stringSnakeToCamel(dataRow.field)] }}%
                      </span>
                      <span v-else-if="dataRow.field == 'get_cashback'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>
                      <span v-else-if="dataRow.field == 'get_total_amount'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>
                      <span v-else-if="dataRow.field == 'get_final_amount'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>

                      <span v-else-if="dataRow.field == 'get_final_amount'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>

                      <chip-available
                        v-else-if="dataRow.field == 'is_available'"
                        :is_available="record.isAvailable"
                      ></chip-available>
                      <chip-payment-selected
                        v-else-if="dataRow.field == 'is_selected'"
                        :is_selected="record.isSelected"
                      ></chip-payment-selected>
                      <chip-payment-status
                        v-else-if="dataRow.field == 'status'"
                        :status="record.status"
                      ></chip-payment-status>
                      <chip-payment-valid
                        v-else-if="dataRow.field == 'is_valid'"
                        :is_valid="record.isValid"
                      ></chip-payment-valid>
                      <span v-else-if="dataRow.field == 'total_amount'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>

                      <span v-else-if="dataRow.field == 'general_price'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>
                      <span v-else-if="dataRow.field == 'discount_price'">
                        {{ record[$caseConvert.stringSnakeToCamel(dataRow.field)] }}%
                      </span>
                      <span v-else-if="dataRow.field == 'cashback_price'">
                        {{
                          $rupiah(record[$caseConvert.stringSnakeToCamel(dataRow.field)])
                        }}
                      </span>
                      <span
                        v-else-if="dataRow.field == 'customer_id' && record?.customer"
                      >
                        {{ record?.customer?.username }}
                      </span>

                      <span v-else>
                        {{ record[$caseConvert.stringSnakeToCamel(dataRow.field)] }}
                      </span>
                    </div>
                  </td>
                </tr>
              </table>
            </template>
          </vs-col>
        </vs-row>
      </vs-card>
    </vs-col>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  name: "CrudGeneratedRead",
  components: {},
  props: {
    slug: {
      default: "",
    },
    response: {
      default: null,
    },
  },
  data: () => ({
    dataType: {},
    record: {},
    isMaintenance: false,
    isAuth: {},
  }),
  async mounted() {
    this.$openLoader();
    this.isAuth = await this.$authUtil.getAuth(this.$api);
    console.log("SharedReadUser", this.isAuth);

    this.getDetailEntity();
  },
  computed: {
    maintenanceImg() {
      const config = this.$store.getters["badaso/getConfig"];
      return config.maintenanceImage;
    },
  },
  methods: {
    onLightBox() {
      console.log("onLightBox", this.$refs.lightbox);
    },
    getDownloadUrl(item) {
      if (item == null || item == undefined) return;

      return item.split("storage").pop();
    },
    async getDetailEntity() {
      this.$openLoader();

      try {
        // const response = await this.$api.badasoEntity.read({
        //   slug: this.slug,
        //   id: this.$route.params.id,
        // });

        const {
          data: { dataType },
        } = await this.$api.badasoTable.getDataType({
          slug: this.slug,
        });

        this.$closeLoader();
        this.dataType = dataType;
        this.record = this.response.data;

        const dataRows = this.dataType.dataRows.map((data) => {
          try {
            data.add = data.add == 1;
            data.edit = data.edit == 1;
            data.read = data.read == 1;
            data.details = JSON.parse(data.details);
            if (data.type == "upload_file_multiple") {
              const val = this.record[this.$caseConvert.stringSnakeToCamel(data.field)];

              if (val) {
                data.value = val.toString();
              }
            }
          } catch (error) {}
          return data;
        });

        this.dataType.dataRows = JSON.parse(JSON.stringify(dataRows));
      } catch (error) {
        if (error.status == 503) {
          this.isMaintenance = true;
        }
        this.$closeLoader();
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    },
    bindSelection(items, value) {
      const selected = _.find(items, ["value", value]);
      if (selected) {
        return selected.label;
      } else {
        return value;
      }
    },
    stringToArray(str) {
      if (str) {
        return str.split(",");
      } else {
        return [];
      }
    },
    arrayToString(files) {
      if (files) {
        const mixArray = files;
        const str = mixArray.replace(/\[|\]|"/g, "").split(",");
        return str;
      } else {
        return [];
      }
    },
    displayRelationData(record, dataRow) {
      console.log("displayRelationData", dataRow);
      try {
        const table = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTable
        );
        this.$caseConvert.stringSnakeToCamel(dataRow.relation.destinationTableColumn);
        const displayColumn = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTableDisplayColumn
        );

        if (dataRow.relation.relationType == "has_one") {
          const list = record[table];
          return list[displayColumn];
        } else if (dataRow.relation.relationType == "has_many") {
          const list = record[table];
          const flatList = list.map((ls) => {
            return ls[displayColumn];
          });
          return flatList.join(", ");
        } else if (dataRow.relation.relationType == "belongs_to") {
          const lists = record[table];
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field);
          for (let list of lists) {
            if (list?.id == record[field]) {
              return list[displayColumn];
            }
          }
        } else if (dataRow.relation.relationType == "belongs_to_many") {
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field);
          const lists = record[field];
          let flatList = [];
          Object.keys(lists).forEach(function (ls, key) {
            flatList.push(lists[ls][displayColumn]);
          });

          return flatList.join(",").replace(",", ", ");
        } else {
          return record[table] ? record[table][displayColumn] : null;
        }
      } catch (error) {
        console.log("error displayRelationData", error);
      }
    },
  },
};
</script>
