<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'Anda Harus Login'
    }).then((result)=>{
    document.location.href = "<?= base_url('profile/login') ?>";
    });
</script>