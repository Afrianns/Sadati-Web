document.addEventListener("alpine:init", () => {
    Alpine.data("payment", () => ({
        snapPayment(snap_key, id) {
            window.snap.pay(snap_key, {
                onSuccess: function (result) {
                    console.log(result);
                    window.location.href = `/payment/success/${id}`;
                },
                onPending: function (result) {
                    console.log(result);
                },
                onError: function (result) {
                    console.log(result);
                    window.location.href = `/payment/failed`;
                },
            });
        },
    }));

    Alpine.data("packages", (initailData) => ({
        open: false,
        edit: false,

        fields: initailData,
        addField() {
            this.fields.push("");
        },
        removeField(index) {
            this.fields.splice(index, 1);
        },

        clearField(originalData) {
            this.fields = originalData;
        },
    }));
});
