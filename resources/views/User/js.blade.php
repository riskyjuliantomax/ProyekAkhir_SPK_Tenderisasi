<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var delete_id = $(this).closest('tr').find('.id_user').val();
            Swal.fire({
                title: 'Yakin Hapus?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapuskan !'
            }).then((result) => {
                if (result.isConfirmed) {
                    var data = {
                        "_token": $('input[name=token]').val(),
                        "id": delete_id,
                    };
                    $.ajax({
                        type: "delete",
                        url: "/User/delete/" + delete_id,
                        data: data,
                        success: function(response) {
                            Swal.fire(
                                'Berhasil Hapus!',
                                'User telah berhasil dihapus.',
                                'success'
                            )
                            setInterval(() => {
                                location.reload();
                            }, 1000);
                        }
                    });

                }
            })
        });

    });
</script>
