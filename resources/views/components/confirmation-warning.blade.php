@props(['title' => "Hapus Booking", 'text' => "Apa kamu yakin ingin menghapus -nya?"])
<form {{ $attributes }} method="post" x-on:submit.prevent='confirmation($el)'>
    {{ $slot }}
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmation(value){
        Swal.fire({
            title: '<?= $title ?>',
            text: '<?= $text ?>',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal!",
            confirmButtonText: '<?= $title ?>!'
        }).then((result) =>{
            if (result.isConfirmed){
                value.submit();
            }
        })
    }
</script>