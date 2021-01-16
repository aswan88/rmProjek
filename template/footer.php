<!-- footer -->
<footer class="bg-success mt-5 p-3 text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">

            </div>
            <div class="col-md-6 col-sm-12">
                <h4>Developer</h4>
                <p>Ax_Dev</p><br>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio mollitia consequatur excepturi saepe fuga magnam qui. Qui et, eveniet tenetur dolor praesentium doloremque? Assumenda distinctio quo officia laudantium iste enim.</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <p> @CopyRight2020</p>
    </div>
</footer>
<!-- enf footer -->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assets/jQuery/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/fontawesome-free/js/all.min.js"></script>
<script>
    // ini menyiapkan dokumen agar siap grak :)
    $(document).ready(function() {
        // yang bawah ini bekerja jika tombol lihat data (class="view_data") di klik
        $('.viewData').click(function() {
            // membuat variabel id, nilainya dari attribut id pada button
            // id="'.$row['id'].'" -> data id dari database ya sob, jadi dinamis nanti id nya
            var id = $(this).attr("id");
            // memulai ajax
            $.ajax({
                url: 'v_DataBayar.php', // set url -> ini file yang menyimpan query tampil detail data siswa
                method: 'post', // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
                data: {
                    id: id
                }, // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
                success: function(data) { // kode dibawah ini jalan kalau sukses
                    $('#data_item').html(data); // mengisi konten dari -> <div class="modal-body" id="data_siswa">
                    $('#BayarModal').modal("show"); // menampilkan dialog modal nya
                }
            });
        });
    });
</script>
</body>

</html>