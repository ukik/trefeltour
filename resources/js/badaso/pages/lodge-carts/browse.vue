<template>
  <div>
    <!-- <CalenderBooked /> -->
    <stack-modal class="d-flex justify-content-center"
                :show="show"
                title=""
                @close="getEntity(); show=false; selectedMulti = []; selected = []; selectedData = null;"
                :modal-class="{ [modalClass]: true }"
                :saveButton="{ visible: false }"
                :cancelButton="{ title: 'Close', btnClass: { 'btn btn-primary': true } }"
            >
            <slot name="modal-header">
                <div class="modal-header px-0">
                    <h3 class="modal-title">
                        Booking
                    </h3>
                    <vs-button @click="show=false">
                        <i class="vs-icon notranslate icon-scale material-icons null">close</i>
                    </vs-button>
                </div>
            </slot>
            <div v-if="tipe == 'single'" class="py-4">
                <div class="row">
                    <span class="col">Customer</span>
                    <span class="col-auto">{{ selectedData?.badasoUser?.name }} ({{ selectedData?.badasoUser?.username }})</span>
                </div>
                <div class="row">
                      <span class="col">UUID </span>
                      <span class="col-auto">{{ selectedData?.lodgePrice?.uuid }}</span>
                  </div>
                  <div class="row">
                      <span class="col">Nama Harga </span>
                      <span class="col-auto">{{ selectedData?.lodgePrice?.name }}</span>
                  </div>
                  <div class="row">
                      <span class="col">Tempat </span>
                      <span class="col-auto">{{ selectedData?.lodgeProfile?.name }}</span>
                  </div>
                  <div class="row">
                      <span class="col">Kamar</span>
                      <span class="col-auto">{{ selectedData?.lodgeRoom?.name }}</span>
                  </div>
                  <div class="row">
                      <span class="col">Stok</span>
                      <span class="col-auto">{{ selectedData?.lodgeRoom?.quota }} kamar</span>
                  </div>
                  <div class="row">
                      <span class="col">Durasi</span>
                      <span class="col-auto">{{ selectedData?.quantity }} hari</span>
                  </div>
                  <div class="row">
                      <span class="col">Harga per malam</span>
                      <span class="col-auto">{{ $rupiah(getTotalAmount(selectedData?.lodgePrice)) }}</span>
                  </div>
                  <div class="row">
                      <span class="col">Total Harga</span>
                      <span class="col-auto">
                          {{ $rupiah(Math.round(getTotalAmount(selectedData?.lodgePrice) * selectedData?.quantity)) }}
                      </span>
                  </div>
                  <div class="row">
                        <div class="col">
                            <span class="full-width text-center">Tanggal Check-In</span>
                            <CalenderBooked @onBubbleEvent="records = $event"
                                :selectedData="selectedData"
                                :id="selectedData?.id"
                                :limit="limit"
                                :page="page"
                                :filter="filter"
                                :orderField="orderField"
                                :orderDirection="orderDirection"
                                :isShowDataRecycle="isShowDataRecycle"
                                :perPage="perPage"
                                :currentPage="currentPage"
                                :date_checkin="selectedData?.dateCheckin" class="mt-2" />
                        </div>
                    </div>
            </div>
            <div v-if="tipe == 'multi'" class="py-4" :class="[ selectedMulti.length >= 2 ? 'pr-2' : '' ]" style="
                    min-height: 250px;
                    max-height: 470px;
                    overflow-y: overlay;
                    overflow-x: hidden;
                ">
                <!-- <div class="row">
                    <span class="col">Customer</span>
                    <span class="col-auto">{{ selectedMulti.map((item) => item?.badasoUser?.name)[0] }} ({{ selectedMulti.map((item) => item?.badasoUser?.username)[0] }})</span>
                </div> -->
                <template v-for="(item, index) in selectedMulti" >
                    <div>
                        <hr>
                        <div class="row">
                            <span class="col">Customer</span>
                            <span class="col-auto">{{ item?.badasoUser?.name }} ({{ item?.badasoUser?.username }})</span>
                        </div>
                        <div class="row">
                            <span class="col">UUID </span>
                            <span class="col-auto">{{ item?.lodgePrice?.uuid }}</span>
                        </div>
                        <div class="row">
                            <span class="col">Nama Harga </span>
                            <span class="col-auto">{{ item?.lodgePrice?.name }}</span>
                        </div>
                        <div class="row">
                            <span class="col">Tempat </span>
                            <span class="col-auto">{{ item?.lodgeProfile?.name }}</span>
                        </div>
                        <div class="row">
                            <span class="col">Kamar</span>
                            <span class="col-auto">{{ item?.lodgeRoom?.name }}</span>
                        </div>
                        <div class="row">
                            <span class="col">Stok</span>
                            <span class="col-auto">{{ item?.lodgeRoom?.quota }} kamar</span>
                        </div>
                        <div class="row">
                            <span class="col">Durasi</span>
                            <span class="col-auto">{{ item?.quantity }} hari</span>
                        </div>
                        <div class="row">
                            <span class="col">Harga</span>
                            <span class="col-auto">{{ $rupiah(getTotalAmount(item?.lodgePrice)) }}</span>
                        </div>
                        <div class="row">
                            <span class="col">Total Harga</span>
                            <span class="col-auto">
                                {{ $rupiah(Math.round(getTotalAmount(item?.lodgePrice) * item?.quantity)) }}
                            </span>
                        </div>
                        <div class="row">
                            <div class="col">
                            <span class="full-width text-center">Tanggal Check-In</span>
                            <CalenderBooked @onBubbleEvent="records = $event"
                                :selectedData="item"
                                :id="item?.id"
                                :limit="limit"
                                :page="page"
                                :filter="filter"
                                :orderField="orderField"
                                :orderDirection="orderDirection"
                                :isShowDataRecycle="isShowDataRecycle"
                                :perPage="perPage"
                                :currentPage="currentPage"
                                :date_checkin="item?.dateCheckin" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <hr class="m-0">

            <div slot="modal-footer">
                <div v-if="tipe=='multi'" class="px-3">
                    <div class="row">
                        <span class="col">Total Tagihan</span>
                        <span class="col-auto">{{ $rupiah(totalTagihan) }}</span>
                    </div>
                    <hr>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <input  type="textarea" placeholder="Tambah catatan..." class="col mx-0 mb-3 vs-inputx vs-input--input normal" v-model="description">
                </div>
                <div class="modal-header pt-0 d-flex justify-content-center">
                    <vs-button @click="onInvoice">
                        <i class="vs-icon notranslate icon-scale material-icons null">shopping_basket</i>
                        <span class="pl-1">Buat Invoice</span>
                    </vs-button>
                </div>
            </div>
    </stack-modal>

    <shared-browser-modal ref="SharedBrowserModal" />
    <template v-if="!showMaintenancePage">
      <badaso-breadcrumb-hover full>
        <template slot="action">
          <!-- <download-excel
            :data="records"
            :fields="fieldsForExcel"
            :worksheet="dataType.displayNameSingular"
            :name="dataType.displayNameSingular + '.xls'"
            class="crud-generated__excel-button"
          >
            <badaso-dropdown-item
              icon="file_upload"
              v-if="$helper.isAllowedToModifyGeneratedCRUD('browse', dataType)"
            >
              {{ $t("action.exportToExcel") }}
            </badaso-dropdown-item>
          </download-excel>
          <badaso-dropdown-item
            icon="file_upload"
            v-if="$helper.isAllowedToModifyGeneratedCRUD('browse', dataType)"
            @click="generatePdf"
          >
            {{ $t("action.exportToPdf") }}
          </badaso-dropdown-item>
          <badaso-dropdown-item
            icon="add"
            :to="{ name: 'CrudGeneratedAdd' }"
            v-if="
              isCanAdd &&
              $helper.isAllowedToModifyGeneratedCRUD('add', dataType)
            "
          >
            {{ $t("action.add") }}
          </badaso-dropdown-item> -->
          <badaso-dropdown-item
            icon="list"
            :to="{ name: 'CrudGeneratedSort' }"
            v-if="
              isCanSort &&
              $helper.isAllowedToModifyGeneratedCRUD('edit', dataType)
            "
          >
            {{ $t("action.sort") }}
          </badaso-dropdown-item>
          <badaso-dropdown-item
            icon="delete_sweep"
            v-if="
              selected.length > 0 &&
              $helper.isAllowedToModifyGeneratedCRUD('delete', dataType)
            "
            @click.stop
            @click="confirmDeleteMultiple"
          >
            {{ $t("action.bulkDelete") }}
          </badaso-dropdown-item>
          <badaso-dropdown-item
            icon="restore"
            v-if="selected.length > 0 && isShowDataRecycle"
            @click.stop
            @click="confirmRestoreMultiple"
          >
            {{ $t("action.bulkRestore") }}
          </badaso-dropdown-item>
          <badaso-dropdown-item
            icon="settings"
            v-if="
              $helper.isAllowedToModifyGeneratedCRUD('maintenance', dataType)
            "
            @click.stop
            @click="openMaintenanceDialog"
          >
            {{ $t("crudGenerated.maintenanceDialog.title") }}
          </badaso-dropdown-item>
          <badaso-dropdown-item
            v-if="dataType.isSoftDelete"
            icon="restore_from_trash"
            @click.stop
            :to="{ name: 'CrudGeneratedBrowseBin' }"
          >
            {{ $t("action.showTrash") }}
          </badaso-dropdown-item>
        </template>
      </badaso-breadcrumb-hover>

      <vs-row v-if="$helper.isAllowedToModifyGeneratedCRUD('browse', dataType)">
        <vs-col vs-lg="12">
          <vs-alert
            :active="Object.keys(errors).length > 0"
            color="danger"
            icon="new_releases"
            class="crud-generated__errors"
          >
            <span v-for="key in Object.keys(errors)" :key="key">
              <span v-for="err in errors[key]" :key="err">
                {{ err }}
              </span>
            </span>
          </vs-alert>
        </vs-col>
        <vs-col vs-lg="12">
          <vs-card>
            <div slot="header">
                <div  class="row px-3">
                    <h3 class="col align-self-center">{{ dataType.displayNameSingular }}</h3>

                    <vs-button v-if="selected.length > 0" type="relief" @click="onBookingTerpilih">
                        <vs-icon icon="shopping_cart" style="font-size: 18px;" class=""></vs-icon>
                        Booking Terpilih
                    </vs-button>
                </div>
            </div>
            <div>
                <!-- <div v-if="this.$store.getters['badaso/getUser']?.isAdmin" class="alert alert-warning my-3" role="alert">
                    Pilih untuk booking (1 Invoice untuk 1 Customer)
                </div> -->

              <badaso-table-cart ref="badaso_table_1"
                v-if="dataType.serverSide !== 1" :lastPage="lastPage" :currentPage="currentPage" :perPage="perPage"
                @onChangePage="onChangePage"
                @onChangeMaxItems="onChangeMaxItems"
                @search="onSearch"
                v-model="selected"
                pagination
                :max-items="descriptionItems[0]"
                search
                :data="records"
                stripe
                description
                :description-items="descriptionItems"
                :description-title="$t('crudGenerated.footer.descriptionTitle')"
                :description-connector="
                  $t('crudGenerated.footer.descriptionConnector')
                "
                :description-body="$t('crudGenerated.footer.descriptionBody')"
                multiple
              >
                <template slot="thead">
                    <vs-th></vs-th>
                    <vs-th></vs-th>
                  <vs-th
                    v-for="(dataRow, index) in dataType.dataRows" v-if="
                        // dataRow?.field != 'quantity' &&
                        dataRow?.field != 'ui_date_range' &&
                        dataRow?.field != 'date_checkout'
                        "
                    :key="index"
                    :sort-key="$caseConvert.stringSnakeToCamel(dataRow.field)"
                  >
                    <template v-if="dataRow.browse == 1">
                      {{ dataRow.displayName }}
                    </template>
                  </vs-th>
                  <vs-th> {{ $t("crudGenerated.header.action") }} </vs-th>
                </template>

                <template slot-scope="{ data }">
                  <vs-tr
                    :data="record"
                    :key="index"
                    v-for="(record, index) in data"
                    :state="
                      idsOfflineDeleteRecord.includes(record.id.toString())
                        ? 'danger'
                        : 'default'
                    "
                  >
                    <template
                      v-if="
                        !idsOfflineDeleteRecord.includes(
                          record.id.toString()
                        ) || !isOnline
                      "
                    >
                        <vs-td>
                            <vs-button @click="$refs.SharedBrowserModal.onCall({
                              show: true,
                              type: 'detail',
                              selectedData: record,
                              title: 'Detail Order',
                              slug: $route.params?.slug })">
                                <vs-icon icon="visibility" style="font-size: 18px;" class=""></vs-icon>
                            </vs-button>
                        </vs-td>
                        <vs-td>
                          <vs-button @click=" tipe='single'; selectedData = record; onPopupBooking();">
                              <vs-icon icon="shopping_cart" style="font-size: 18px;" class=""></vs-icon>
                          </vs-button>
                        </vs-td>
                      <vs-td
                        v-for="(dataRow, indexColumn) in dataType.dataRows"
                        v-if="
                        // dataRow?.field != 'quantity' &&
                        dataRow?.field != 'ui_date_range' &&
                        dataRow?.field != 'date_checkout'
                        "
                        :key="indexColumn"
                        :data="
                          data[index][
                            $caseConvert.stringSnakeToCamel(dataRow.field)
                          ]
                        "
                        :style="dataRow.field == 'ui_date_range' ? 'min-width: 500px;' : ''"
                      >
                        <template v-if="dataRow.browse == 1">
                          <img
                            v-if="dataRow.type == 'upload_image'"
                            :src="`${
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            }`"
                            width="20%"
                            alt=""
                          />
                          <div
                            v-else-if="dataRow.type == 'upload_image_multiple'"
                            class="crud-generated__item--upload-image-multiple"
                          >
                            <img
                              v-for="(image, indexImage) in stringToArray(
                                record[
                                  $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                              )"
                              :key="indexImage"
                              :src="`${image}`"
                              width="20%"
                              alt=""
                              class="crud-generated__item--image"
                            />
                          </div>
                          <span
                            v-else-if="dataRow.type == 'editor'"
                            v-html="
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            "
                          ></span>
                          <a
                            v-else-if="dataRow.type == 'url'"
                            :href="
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            "
                            target="_blank"
                            >{{
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            }}</a
                          >
                          <a
                            v-else-if="dataRow.type == 'upload_file'"
                            :href="`${
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            }`"
                            target="_blank"
                            >{{
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            }}</a
                          >
                          <div
                            v-else-if="dataRow.type == 'upload_file_multiple'"
                            class="crud-generated__item--upload-file-multiple"
                          >
                            <p
                              v-for="(file, indexFile) in arrayToString(
                                record[
                                  $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                              )"
                              :key="indexFile"
                            >
                              <a :href="`${file}`" target="_blank">{{
                                file
                              }}</a>
                            </p>
                          </div>
                          <p
                            v-else-if="
                              dataRow.type == 'radio' ||
                              dataRow.type == 'select'
                            "
                          >
                            {{
                              bindSelection(
                                dataRow.details.items,
                                record[
                                  $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                              )
                            }}
                          </p>
                          <!-- <div
                            v-else-if="
                              dataRow.type == 'select_multiple' ||
                              dataRow.type == 'checkbox'
                            "
                            class="crud-generated__item--select-multiple"
                          >
                            <p
                              v-for="(selected, indexSelected) in stringToArray(
                                record[
                                  $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                              )"
                              :key="indexSelected"
                            >
                              {{
                                bindSelection(dataRow.details.items, selected)
                              }}
                            </p>
                          </div> -->
                          <div v-else-if="dataRow.type == 'color_picker'">
                            <div
                              class="crud-generated__item--color-picker"
                              :style="`background-color: ${
                                record[
                                  $caseConvert.stringSnakeToCamel(dataRow.field)
                                ]
                              }`"
                            ></div>
                            {{
                              record[
                                $caseConvert.stringSnakeToCamel(dataRow.field)
                              ]
                            }}
                          </div>
                          <span v-else-if="dataRow.type == 'relation'">{{
                            displayRelationData(record, dataRow)
                          }}</span>
                            <div :class="[ dataRow.field == 'ui_date_range' ? 'row' : '']" v-else>
                                <!-- <vs-button v-if="dataRow.field == 'booking'" type="relief" @click=" tipe='single'; selectedData = record; onPopupBooking();">Booking Ini</vs-button> -->
                                <span v-if="dataRow.field == 'name'">
                                    {{ record.lodgePrice?.name }}
                                </span>
                                <span v-else-if="dataRow.field == 'get_price'">
                                    {{ $rupiah(record.lodgePrice?.generalPrice) }}
                                </span>
                                <span v-else-if="dataRow.field == 'get_discount'">
                                    {{ record.lodgePrice?.discountPrice }}%
                                </span>
                                <span v-else-if="dataRow.field == 'get_cashback'">
                                    {{ $rupiah(record.lodgePrice?.cashbackPrice) }}
                                </span>
                                <span v-else-if="dataRow.field == 'get_total_amount'">
                                    {{ $rupiah(getTotalAmount(record?.lodgePrice)) }}
                                </span>
                                <span v-else-if="dataRow.field == 'get_final_amount'">
                                    {{ $rupiah(Math.round(getTotalAmount(record?.lodgePrice) * record.quantity)) }}
                                </span>
                                <span v-else-if="dataRow.field == 'quantity'">
                                    {{ record.quantity }} hari
                                </span>
                                <ol class="ml-2" style="width:100px;" v-else-if="dataRow.field == 'date_checkin'">
                                   <li v-for="item in JSON.parse(record.dateCheckin)?.map(e => e.id)">
                                        <span>{{ item }}</span>
                                    </li>
                                </ol>

                                <div class="ml-2 full-width" v-else-if="dataRow.field == 'ui_date_range'">
                                    <CounterDate :record="record" :selectedId="record.id" @onBubbleEvent="onUpdateQuantity" />
                                    <!-- <Counter :selectedId="record.id" @onBubbleEvent="onUpdateQuantity" :set_quantity="record.quantity" :stock="record?.lodgePrice?.stock" /> -->
                                </div>
                                <span v-else>
                                {{
                                    record[
                                    $caseConvert.stringSnakeToCamel(dataRow.field)
                                    ]
                                }}
                                </span>
                            </div>
                        </template>
                      </vs-td>
                      <vs-td class="crud-generated__button">
                        <badaso-dropdown vs-trigger-click>
                          <vs-button
                            size="large"
                            type="flat"
                            icon="more_vert"
                          ></vs-button>
                          <vs-dropdown-menu>



                            <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: data[index].id,
                                  slug: $route.params.slug,
                                },
                              }"
                              v-if="
                                isCanRead &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'read',
                                  dataType.name
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail
                            </badaso-dropdown-item>
                            <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedEdit',
                                params: {
                                  id: data[index].id,
                                  slug: $route.params.slug,
                                },
                              }"
                              v-if="
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="edit"
                            >
                              Edit
                            </badaso-dropdown-item>
                            <badaso-dropdown-item
                              icon="delete"
                              @click="confirmDelete(data[index].id)"
                              v-if="
                                !idsOfflineDeleteRecord.includes(
                                  record.id.toString()
                                ) &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'delete',
                                  dataType
                                )
                              "
                            >
                              Delete
                            </badaso-dropdown-item>
                            <badaso-dropdown-item
                              @click="confirmDeleteDataPending(data[index].id)"
                              icon="delete_outline"
                              v-if="
                                idsOfflineDeleteRecord.includes(
                                  record.id.toString()
                                ) && !isShowDataRecycle
                              "
                            >
                              {{
                                $t(
                                  "offlineFeature.crudGenerator.deleteDataPending"
                                )
                              }}
                            </badaso-dropdown-item>

                            <hr class="m-0 my-1">


                            <!-- ADDITIONAL -->

                            <!-- <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: data[index].talentBooking?.id,
                                  slug: 'talent-bookings',
                                },
                              }"
                              v-if="
                                data[index].talentBooking?.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Booking
                            </badaso-dropdown-item>

                            <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: data[index].talentBooking?.talentPayment?.id,
                                  slug: 'talent-payments',
                                },
                              }"
                              v-if="
                                data[index].talentBooking?.talentPayment?.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Pembayaran
                            </badaso-dropdown-item>

                            <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: data[index].talentBooking?.talentPayment?.talentPaymentsValidation?.id,
                                  slug: 'talent-payments-validations',
                                },
                              }"
                              v-if="
                                data[index].talentBooking?.talentPayment?.talentPaymentsValidation?.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Pembayaran Validasi
                            </badaso-dropdown-item> -->

                            <!-- <badaso-dropdown-item
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: data[index].talentSkill?.id,
                                  slug: 'talent-skills',
                                },
                              }"
                              v-if="
                                data[index].talentService?.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Layanan
                            </badaso-dropdown-item> -->

                            <badaso-dropdown-item v-for="(item1, index1) in data[index]?.talentSkills" :key="1+index1"
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: item1.id,
                                  slug: 'talent-skills',
                                },
                              }"
                              v-if="
                                item1.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Wahana: {{ item1.name }}
                            </badaso-dropdown-item>

                            <badaso-dropdown-item v-for="(item2, index2) in data[index].talentPrices" :key="2+index2"
                              :to="{
                                name: 'CrudGeneratedRead',
                                params: {
                                  id: item2.id,
                                  slug: 'talent-prices',
                                },
                              }"
                              v-if="
                                item2.id &&
                                isCanEdit &&
                                $helper.isAllowedToModifyGeneratedCRUD(
                                  'edit',
                                  dataType
                                ) &&
                                !isShowDataRecycle
                              "
                              icon="visibility"
                            >
                              Detail Harga: {{ item2.uuid }}
                            </badaso-dropdown-item>

                            <!-- --------------------- -->


                          </vs-dropdown-menu>
                        </badaso-dropdown>
                      </vs-td>
                    </template>
                  </vs-tr>
                </template>
              </badaso-table-cart>
            </div>
          </vs-card>
        </vs-col>
        <vs-prompt
          @accept="saveMaintenanceState"
          :active.sync="maintenanceDialog"
        >
          <vs-row>
            <badaso-switch
              :label="$t('crudGenerated.maintenanceDialog.switch')"
              :placeholder="$t('crudGenerated.maintenanceDialog.switch')"
              v-model="isMaintenance"
              size="12"
              :alert="errors['is_maintenance']"
            ></badaso-switch>
          </vs-row>
        </vs-prompt>
      </vs-row>
      <vs-row v-else>
        <vs-col vs-lg="12">
          <vs-card>
            <vs-row>
              <vs-col vs-lg="12">
                <h3>
                  {{
                    $t("crudGenerated.warning.notAllowedToBrowse", {
                      tableName: dataType.displayNameSingular,
                    })
                  }}
                </h3>
              </vs-col>
            </vs-row>
          </vs-card>
        </vs-col>
      </vs-row>
    </template>
    <template v-if="showMaintenancePage">
      <badaso-breadcrumb-row full> </badaso-breadcrumb-row>

      <vs-row v-if="$helper.isAllowedToModifyGeneratedCRUD('browse', dataType)">
        <vs-col vs-lg="12">
          <div class="badaso-maintenance__container">
            <img :src="`${maintenanceImg}`" alt="Maintenance Icon" />
            <h1 class="badaso-maintenance__text">
              We are under <br />maintenance
            </h1>
          </div>
        </vs-col>
      </vs-row>
    </template>
  </div>
</template>

<script>
import Counter from "./Counter.vue"
import CounterDate from "./counter-date.vue"
import CalenderBooked from "./CalenderBooked.vue"
import CalenderBookedPicker from "./CalenderBookedPicker.vue"

import StackModal from '@innologica/vue-stackable-modal'
import axios from "axios"

import * as _ from "lodash";
import downloadExcel from "vue-json-excel";
import jsPDF from "jspdf";
import "jspdf-autotable";
import moment from "moment";
export default {
  components: { downloadExcel, Counter, StackModal, CounterDate, CalenderBooked, CalenderBookedPicker },
  name: "CrudGeneratedBrowse",
  data: () => ({
    errors: {},
    data: {},
    descriptionItems: [5, 10, 25, 50, 75, 100],
    selected: [],
    records: [],
    dataType: [],
    willDeleteId: null,
    isCanAdd: false,
    isCanEdit: false,
    isCanRead: false,
    isCanSort: false,
    totalItem: 0,
    filter: "",
    page: 1,
    limit: 10,
    orderField: "",
    orderDirection: "",
    rowPerPage: null,
    fieldsForExcel: {},
    fieldsForPdf: [],
    idsOfflineDeleteRecord: [],
    maintenanceDialog: false,
    isMaintenance: false,
    showMaintenancePage: false,
    isShowDataRecycle: false,
    search: "",

    modalClass: 'none col align-self-center',
    selectedData: null,
    show: false,
    tipe: 'single', // 'single' || 'multi'
    selectedMulti: [],
    totalTagihan: 0,
    description: '',

    lastPage: 0,
    currentPage: 1,
    perPage: 5
  }),
  watch: {
    $route: {
        immediate: true,
        handler (to, from) {
          this.getEntity();
        }
    },
    selected(val) {
        this.selectedMulti = val
        console.log('totalTagihan', val)

        let total = 0
        val.forEach(element => {
            total += Number(this.getTotalAmount(element?.lodgePrice) * element.quantity)
        });
        this.totalTagihan = total
    }
    // page: function(to, from) {
    //   this.handleChangePage(to);
    // },
    // limit: function(to, from) {
    //   this.handleChangeLimit(to);
    // },
  },
  mounted() {
    if (this.$route.query.search || this.$route.query.page) {
      this.filter = this.$route.query.search;
      this.page = this.$route.query.page;
      this.show = this.$route.query.show;
    }
    // this.getEntity();
    this.loadIdsOfflineDelete();

    // Swal.fire("SweetAlert2 is working!");
  },
  methods: {
    onSearch(val) {
        this.search = val
        this.selected = []
        this.selectedMulti = []
        this.getEntity();
    },
    async onPopupBooking() {

        var bodyFormData = new FormData();

        if(this.tipe == 'multi') {
            const ids = this.selectedMulti.map((map) => map.id)
            bodyFormData.append('payload', JSON.stringify(ids));
        } else if (this.tipe == 'single') {
            bodyFormData.append('payload', JSON.stringify([this.selectedData?.id]));
        }

        this.$openLoader();
        await axios.post('/api/typehead/lodge/get_prices_booking', bodyFormData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then((response) => {
            console.log('onPopupBooking', response)
            if(this.tipe == 'multi') {
                this.selectedMulti = response.data?.data
            } else if (this.tipe == 'single') {
                this.selectedData = response.data?.data[0]
            }
        })
        .catch((error) => {
        })

        this.show = true

        this.$closeLoader();

    },
    async onInvoice() {

        // const ids = this.selectedMulti.map(item => {
        //     id: item.id
        // })
        // this.records.forEach((element, index) => {
        //     ids.forEach(it => {
        //         if(it.id == element.id) this.records.splice(index, 1)
        //     });
        // });
        // console.log('onInvoice', this.records, ids)
        // return

        var bodyFormData = new FormData();

        if(this.tipe == 'multi') {
            // this.selectedMulti.forEach(el => {
            //     bodyFormData.append('payload[]', JSON.parse(el));
            // })
            bodyFormData.append('payload', JSON.stringify(this.selectedMulti));
        } else if (this.tipe == 'single') {
            bodyFormData.append('payload', JSON.stringify([this.selectedData]));
        }
        bodyFormData.append('description', this.description);


        this.$openLoader();
        await axios.post('/trevolia-api/v1/entities/lodge-carts/add', bodyFormData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then((response) => {

            this.show = false
            this.selectedMulti = []
            this.totalTagihan = 0
            this.selectedData = null
            this.selected = []
            this.description = ''

            this.getEntity();

            this.$vs.notify({
                title: this.$t("alert.success"),
                text: "Berhasil booking",
                color: "success",
            });
        })
        .catch((error) => {
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: "Gagal booking",
            color: "danger",
          });
        })
        this.$closeLoader();
    },
    onBookingTerpilih() {
        this.tipe = 'multi'

        this.onPopupBooking()
        return

        // const ids = this.selected.map((item) => item.id);

        const isAdmin = this.$store.getters['badaso/getUser']?.isAdmin
        // console.log('el.customerId', ids, this.selected.length, isAdmin)

        if(isAdmin) {

            let duplicate = null;

            let block = false

            this.selectedMulti.forEach(el => {
                if(!duplicate) duplicate = el.customerId
                if(duplicate == el.customerId) duplicate = el.customerId
                if(duplicate !== el.customerId) {

                    this.$vs.notify({
                        title: this.$t("alert.danger"),
                        text: "1 Invoice untuk 1 Customer",
                        color: "danger",
                    });

                    block = true
                    // this.$vs.dialog({
                    //     type: "confirm",
                    //     color: "danger",
                    //     title: this.$t("action.delete.title"),
                    //     text: this.$t("action.delete.text"),
                    //     accept: this.deleteRecords,
                    //     acceptText: this.$t("action.delete.accept"),
                    //     cancelText: this.$t("action.delete.cancel"),
                    //     cancel: () => {},
                    // });
                }
            })

            if(block) return
        }

        this.tipe = 'multi'

        this.onPopupBooking()
    },
    onUpdateQuantity: _.debounce(async function(value) {
        // alert(value)

        // if(value.quantity >= this.stock) this.quantity = this.stock
        // if(value.quantity <= 1) this.quantity = 1

        // if(!this.selectedCustomer) {
        //     this.$vs.notify({
        //         title: this.$t("alert.danger"),
        //         text: "Customer wajib diisi",
        //         color: "danger",
        //     });
        //     return
        // }

        var bodyFormData = new FormData();
        bodyFormData.append('id', value.id);
        bodyFormData.append('quantity', value.quantity);
        bodyFormData.append('dateCheckIn', value.dateCheckIn);
        bodyFormData.append('dateCheckOut', value.dateCheckOut);

        bodyFormData.append('slug', this.$route.params.slug);
        bodyFormData.append('limit', this.limit);
        bodyFormData.append('page', this.page);
        bodyFormData.append('filterValue', this.filter);
        bodyFormData.append('orderField', this.$caseConvert.snake(this.orderField));
        bodyFormData.append('orderDirection', this.$caseConvert.snake(this.orderDirection));
        bodyFormData.append('showSoftDelete', this.isShowDataRecycle);
        bodyFormData.append('perPage', this.perPage);
        bodyFormData.append('page', this.currentPage);


        this.$openLoader();
        await axios.post('/api/typehead/lodge/update_to_cart', bodyFormData, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then((response) => {
            console.log('onUpdateQuantity', response.data?.data?.data)
            if(response.data?.data?.data) this.records = response.data?.data?.data;
          this.$vs.notify({
            title: this.$t("alert.success"),
            text: "Berhasil update keranjang",
            color: "success",
          });
        })
        .catch((error) => {
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        })
        this.$closeLoader();
    }, 500),
    getTotalAmount(value) {
        console.log('getTotalAmount', value)
        const total =  (Number(value?.generalPrice) - ((Number(value?.generalPrice) * Number(value?.discountPrice)/100)) - Number(value?.cashbackPrice))
        return total;
    },
    onChangePage(val) {
        this.currentPage = val;
        this.getEntity();
    },
    onChangeMaxItems(val) {
        this.currentPage = 1; // reset ke page 1
        this.perPage = val;
        this.getEntity();
    },
    getDownloadUrl(item) {
      if (item == null || item == undefined) return;

      return item.split("storage").pop();
    },
    confirmDeleteDataPending(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: () => this.deleteRecordDataPending(id),
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteRecord,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmDeleteMultiple(id) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteRecords,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    getEntity: _.debounce(async function () {
    // async getEntity() {
      this.$openLoader();
      try {
        const {
            data: {
                data, total, lastPage, currentPage, perPage
            }
        } = await this.$api.badasoEntity.browse({
          slug: this.$route.params.slug,
          limit: this.limit,
          page: this.page,
          filterValue: this.filter,
          orderField: this.$caseConvert.snake(this.orderField),
          orderDirection: this.$caseConvert.snake(this.orderDirection),
          showSoftDelete: this.isShowDataRecycle,

          search: this.search,
          perPage: this.perPage,
          page: this.currentPage
        });

        this.lastPage = lastPage
        this.currentPage = currentPage
        this.perPage = perPage
        let response = {
            data: {
                data,
                total,
            }
        }
        // response['data'] = responseX.data
        // response['data']['data'] = data
        // response['data']['total'] = total
        // console.log('getEntity', response)
        // return
        // console.log(this.$refs.badaso_table_1.loadData())

        const {
          data: { dataType },
        } = await this.$api.badasoTable.getDataType({
          slug: this.$route.params.slug,
        });
        this.$closeLoader();
        this.data = response.data;
        this.records = response.data.data;
        this.records.map((record) => {
          if (record.createdAt || record.updatedAt) {
            record.createdAt = moment(record.createdAt).format(
              "YYYY-MM-DD hh:mm:ss"
            );
            record.updatedAt = moment(record.updatedAt).format(
              "YYYY-MM-DD hh:mm:ss"
            );
          }
          return record;
        });

        console.log('getEntity this.records', this.records)


        this.totalItem =
          response.data.total > 0
            ? Math.ceil(response.data.total / this.limit)
            : 1;

        this.dataType = dataType;
        this.isMaintenance = this.dataType.isMaintenance == 1;
        const dataRows = this.dataType.dataRows.map((data) => {
          try {
            data.details = JSON.parse(data.details);
          } catch (error) {}
          return data;
        });
        this.dataType.dataRows = JSON.parse(JSON.stringify(dataRows));
        const addFields = dataRows.filter((row) => row.add == 1);
        const editFields = dataRows.filter((row) => row.edit == 1);
        const readFields = dataRows.filter((row) => row.read == 1);
        this.isCanAdd = addFields.length > 0;
        this.isCanEdit = editFields.length > 0;
        this.isCanRead = readFields.length > 0;
        if (this.dataType.orderColumn && this.dataType.orderDisplayColumn) {
          this.isCanSort = true;
        }
        this.prepareExcelExporter();
      } catch (error) {
        if (error.status == 503) {
          this.showMaintenancePage = true;
        }
        this.$closeLoader();
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    }, 500),
    deleteRecordDataPending(id) {
      try {
        const keyStore = window.location.pathname;
        this.$readObjectStore(keyStore).then((store) => {
          if (store.result) {
            const data = store.result.data;
            const newData = [];

            for (const indexData in data) {
              const itemData = data[indexData].requestData.data;
              for (const indexItem in itemData) {
                const fieldData = itemData[indexItem];
                if (fieldData.field == "ids") {
                  let valueIds = fieldData.value.split(",");
                  valueIds = valueIds.filter((valueId, index) => valueId != id);
                  if (valueIds.length != 0) {
                    data[indexData].requestData.data[indexItem].value =
                      valueIds.join(",");

                    newData[newData.length] = data[indexData];
                  }
                } else {
                  const valueId = fieldData.value;
                  if (valueId.toString() != id.toString()) {
                    newData[newData.length] = data[indexData];
                  }
                }
              }
            }
            this.$setObjectStore(keyStore, { data: newData });

            this.idsOfflineDeleteRecord = this.idsOfflineDeleteRecord.filter(
              (itemId, index) => itemId != id
            );
          }
        });
      } catch (error) {
        console.error(error);
      }
    },
    deleteRecord() {
      this.$openLoader();
      this.$api.badasoEntity
        .delete({
          slug: this.$route.params.slug,
          data: [
            {
              field: "id",
              value: this.willDeleteId,
            },
          ],
        })
        .then((response) => {
          this.$closeLoader();
          this.getEntity();
        })
        .catch((error) => {
          this.loadIdsOfflineDelete();

          this.errors = error.errors;
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    deleteRecords() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoEntity
        .deleteMultiple({
          slug: this.$route.params.slug,
          data: [
            {
              field: "ids",
              value: ids.join(","),
            },
          ],
        })
        .then((response) => {
          this.$closeLoader();
          this.getEntity();
        })
        .catch((error) => {
          this.selected = [];
          this.loadIdsOfflineDelete();

          this.errors = error.errors;
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
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
    handleSearch(e) {
      this.filter = e.target.value;
      this.page = 1;
      this.$router
        .replace({
          query: {
            search: this.filter,
            page: this.page,
            show: this.limit,
          },
        })
        .catch((err) => {
          console.log(err);
        });
      this.getEntity();
    },
    handleChangePage(page) {
      this.page = page;
      this.$router
        .replace({
          query: {
            search: this.filter,
            page: this.page,
            show: this.limit,
          },
        })
        .catch((err) => {
          console.log(err);
        });
      this.getEntity();
    },
    handleChangeLimit(limit) {
      this.page = 1;
      this.limit = limit;
      this.$router
        .replace({
          query: {
            search: this.filter,
            page: this.page,
            show: this.limit,
          },
        })
        .catch((err) => {
          console.log(err);
        });
      this.getEntity();
    },
    handleSort(field, direction) {
      this.orderField = field;
      this.orderDirection = direction;
      this.getEntity();
    },
    handleSelect(data) {
      this.selected = data;
    },
    displayRelationData(record, dataRow) {
      if (dataRow.relation) {
        const relationType = dataRow.relation.relationType;
        const table = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTable
        );
        this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTableColumn
        );
        const displayColumn = this.$caseConvert.stringSnakeToCamel(
          dataRow.relation.destinationTableDisplayColumn
        );
        if (relationType == "has_one") {
          const list = record[table];
          return list[displayColumn] ? list[displayColumn] : null;
        } else if (relationType == "has_many") {
          const list = record[table];
          const flatList = list.map((ls) => {
            return ls[displayColumn];
          });
          return flatList.join(", ");
        } else if(relationType == "belongs_to"){
          const lists = record[table];
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field)
          for(let list of lists){
            if (list.id == record[field]){
              return list[displayColumn];
            }
          }
        }  else if (relationType == "belongs_to_many") {
          let field = this.$caseConvert.stringSnakeToCamel(dataRow.field)
          const lists = record[field]
          let flatList = []
          Object.keys(lists).forEach(function (ls, key) {
            flatList.push(lists[ls][displayColumn]);
          });
          return flatList.join(",").replace(",", ", ");
        }
      } else {
        return null;
      }
    },
    prepareExcelExporter() {
      for (const iterator of this.dataType.dataRows) {
        this.fieldsForExcel[iterator.displayName] =
          this.$caseConvert.stringSnakeToCamel(iterator.field);
      }

      for (const iterator of this.dataType.dataRows) {
        const string = this.$caseConvert.stringSnakeToCamel(iterator.field);
        if (iterator.browse == 1) {
          this.fieldsForPdf.push(
            string.charAt(0).toUpperCase() + string.slice(1)
          );
        }
      }
    },
    openMaintenanceDialog() {
      this.maintenanceDialog = true;
    },
    saveMaintenanceState() {
      this.$api.badasoEntity
        .maintenance({
          slug: this.$route.params.slug,
          is_maintenance: this.isMaintenance,
        })
        .then((response) => {
          this.maintenanceDialog = false;
        })
        .catch((error) => {
          this.errors = error.errors;
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    generatePdf() {
      let data = this.records;

      const result = data.map(Object.values);

      // eslint-disable-next-line new-cap
      const doc = new jsPDF("l");

      // Dynamic table title
      doc.setFont("helvetica", "bold");
      doc.setFontSize(28);
      doc.text(this.dataType.displayNameSingular, 149, 20, "center");

      // Data table
      doc.autoTable({
        head: [this.fieldsForPdf],
        body: result,
        startY: 30,
        // Default for all columns
        styles: { valign: "middle" },
        headStyles: { fillColor: [6, 187, 211] },
        // Override the default above for the text column
        columnStyles: { text: { cellWidth: "wrap" } },
      });

      // Output Table title and data table in new tab
      const output = doc.output("blob");
      data = window.URL.createObjectURL(output);
      window.open(data, "_blank");

      setTimeout(function () {
        // For Firefox it is necessary to delay revoking the ObjectURL
        window.URL.revokeObjectURL(data);
      }, 100);
    },
    loadIdsOfflineDelete() {
      try {
        const keyStore = window.location.pathname;
        this.$readObjectStore(keyStore).then((store) => {
          let dataResult = store.result;
          if (dataResult) {
            dataResult = dataResult.data;
            const newDataResult = [];
            for (const index in dataResult) {
              const { requestMethod, requestData } = dataResult[index];
              if (requestMethod == "delete" && requestData.slug != undefined) {
                newDataResult[newDataResult.length] = dataResult[index];
              }
            }

            let ids = [];
            for (const index in newDataResult) {
              const dataRequest = newDataResult[index].requestData.data;
              for (const indexDataRequest in dataRequest) {
                if (
                  dataRequest[indexDataRequest].field == "id" ||
                  dataRequest[indexDataRequest].field == "ids"
                ) {
                  const valueIds = dataRequest[indexDataRequest].value
                    .toString()
                    .split(",");
                  ids.push(...valueIds);
                }
              }
            }
            ids = ids.filter((itemIds, indexIds, self) => {
              return self.indexOf(itemIds) == indexIds;
            });

            this.idsOfflineDeleteRecord = ids;
          }
        });
      } catch (error) {
        console.error(error);
      }
    },
    async onSwitchChangeDataShow() {
      await this.getEntity();
    },
  },
  computed: {
    isOnline: {
      get() {
        const isOnline = this.$store.getters["badaso/getGlobalState"].isOnline;
        return isOnline;
      },
    },
    maintenanceImg() {
      const config = this.$store.getters["badaso/getConfig"];
      return config.maintenanceImage;
    },
  },
};
</script>./counter-date.vue
