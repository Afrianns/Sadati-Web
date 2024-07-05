document.addEventListener("alpine:init", () => {
    Alpine.data("payment", () => ({
        snapPayment(snap_key, id) {
            window.snap.pay(snap_key, {
                onSuccess: function (result) {
                    // let booking_id = { book_id: id };
                    // await fetch("/payment/success", {
                    //     method: "POST",
                    //     body: JSON.stringify({ ...result, ...booking_id }),
                    //     headers: {
                    //         "Content-type": "application/json; charset=UTF-8",
                    //         "X-CSRF-Token":
                    //             document.querySelector("input[name=_token]")
                    //                 .value,
                    //     },
                    // })
                    //     .then((res) => {
                    //         return res.json();
                    //     })
                    //     .then((result) => {
                    //         console.log(result.data, result);
                    //     })
                    //     .catch((err) => {
                    //         console(err);
                    //     });

                    let callback = {
                        status_code: result["status_code"],
                        status_message: result["status_message"],
                        transaction_id: result["transaction_id"],
                        order_id: result["order_id"],
                        gross_amount: result["gross_amount"],
                        payment_type: result["payment_type"],
                        transaction_time: result["transaction_time"],
                        transaction_status: result["transaction_status"],
                        fraud_status: result["fraud_status"],
                        book_id: id,
                    };

                    let strRes = JSON.stringify(result);
                    console.log(strRes);
                    window.location.href = `/payment/success/${id}/${JSON.stringify(
                        callback
                    )}`;
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

    Alpine.data("listPayment", () => ({
        isPay: 1,

        filterPayment() {
            this.isPay = this.isPay == 1 ? 2 : 1;
        },
        check(param) {
            if (this.isPay == 1) {
                return param;
            } else {
                return !param;
            }
        },
    }));
    Alpine.data("createPackage", () => ({
        fields: [{ value: "" }],

        addField() {
            console.log(this.fields);
            this.fields.push({ value: "" });
        },
        removeField(index) {
            this.fields.splice(index, 1);
        },
    }));
});

// result value
// {
//     "status_code": "200",
//     "status_message": "Success, transaction is found",
//     "transaction_id": "ac2232d6-ec2a-4726-9e15-987b4b0a9478",
//     "order_id": "1392566723",
//     "gross_amount": "1000.00",
//     "payment_type": "qris",
//     "transaction_time": "2024-07-03 16:49:28",
//     "transaction_status": "settlement",
//     "fraud_status": "accept",
//     "finish_redirect_url": "http://main.test/?order_id=1392566723&status_code=200&transaction_status=settlement",
//     "book_id": "23"
// }
