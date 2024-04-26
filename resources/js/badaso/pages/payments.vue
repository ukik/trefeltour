<template>
  <vs-row>
    <vs-col type="flex" vs-justify="center" vs-align="center" vs-w="12">
      <vs-card>
        <div slot="header">
            <h3>Dashboard</h3>
        </div>
        <div>
          <vs-tabs>
            <vs-tab label="Home">
              <chart-pie />
            </vs-tab>
            <vs-tab label="Documents">
              <div></div>
            </vs-tab>
            <vs-tab label="Contributors">
              <div></div>
            </vs-tab>
            <vs-tab label="Ecosystem">
              <div></div>
            </vs-tab>
          </vs-tabs>
        </div>
        <div slot="footer">
          <vs-row vs-justify="flex-end">
            <vs-button type="gradient" color="danger" icon="favorite"></vs-button>
            <vs-button color="primary" icon="turned_in_not"></vs-button>
            <vs-button
              color="rgb(230,230,230)"
              color-text="rgb(50,50,50)"
              icon="settings"
            ></vs-button>
          </vs-row>
        </div>
      </vs-card>
    </vs-col>
  </vs-row>
</template>
