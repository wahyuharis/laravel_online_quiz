<script>
    // $(document).ready(function(){
    //     alert('hello');
    // });

 

    $(document).ready(function() {
        // ko.applyBindings(new Form_daftar_peserta_model(), document.getElementById("form_daftar_peserta_container"));
        $('.dtttimepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            "timePicker24Hour": true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
            // minYear: 1901,
            // maxYear: parseInt(moment().format('YYYY'), 10)
        }, function(start, end, label) {
            // var years = moment().diff(start, 'years');
            // alert("You are " + years + " years old!");
        });

        $('#form_1').submit(function(e) {
            e.preventDefault();
            // var formdata = new FormData(this);
            JsLoadingOverlay.show();

            $.ajax({
                url: '<?= url('admin/daftar_kuis/submit') ?>', // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(data) // A function to be called if request succeeds
                {
                    if (data.success) {
                        window.location = '<?= url('admin/daftar_kuis/') ?>';
                        console.log(data);
                    } else {
                        alert(data.message);
                        // error_data_hanlder(data.error);
                    }
                    console.log(data);
                    JsLoadingOverlay.hide();
                },
                error: function(err, txt) {
                    JsLoadingOverlay.hide();
                    console.log(err);
                    // console.log('================');
                    // console.log(txt);
                }
            });

        });

    })
</script>