export default function (vs) {
    vs.notify({
        title: this.$t("alert.warning"),
        text: "Formulir edit sudah expired",
        color: "warning",
        icon:'query_builder',
    });
}
