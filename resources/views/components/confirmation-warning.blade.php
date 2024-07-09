@props(['title', 'text' => "Apa kamu yakin ingin melanjutkannya -nya?"])
<form {{ $attributes }} x-on:submit.prevent="confirmation($el, '{{ $title }}','{{ $text }}')">
    {{ $slot }}
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmation(value, title, text){
        Swal.fire({
            title: title,
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal!",
            confirmButtonText: title
        }).then((result) =>{
            if(title == "Tutup Booking" && result.isConfirmed){
                Swal.fire({
                    input: "text",
                    inputLabel: "Masukan catatan untuk pelanggan (Optional)",
                    confirmButtonText: 'Kirim',
                }).then((result_two) => {
                    if (result_two.isConfirmed){
                        value.admin_note.value = result_two.value;
                        value.submit();
                    }
                })
            }

            if (result.isConfirmed && title != "Tutup Booking"){
                value.submit();
            }
        })
    }
</script>