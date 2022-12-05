$(document).ready(function() {
    // ຕັ້ງຄ່າປຸ່ມ ຂໍ້ມູນເພິ່ມເຕິມ
        $('.view_data').attr({
            "data-bs-toggle" : "modal",
            "data-bs-target" : "#staticBackdrop"
        })

        // ສົ່ງຄ່າໄປເພືອຄົ້ນຫາ
        $('.view_data').click(function() {
            var uid = $(this).attr("id");
                $.ajax({
                    url: 'select.php',
                    method: 'post',
                    dataType: 'json',
                    data: {id : uid},
                    success: function(data){
                        $('#id').text(data.id)
                        $('#fname').text(data.fname)
                        $('#lname').text(data.lname)
                        $("#email").text(data.email)
                        $('#Web').text(data.web)
                    }
                })
        })

        //  checkboxAll
        $('#checkAll').on('click', function() {
            if (this.checked) {
                $('.getIdto_delete').each(function(){
                    this.checked = true
                        $('#checked').text($('.getIdto_delete').length)
                        $('#checked').show()
                    var AllIdCheck = $(this).attr("id");
                        $('#delete_checkbox').click(function() {
                    var conFirmDeleteAll = confirm('ທ່ານຕ້ອງການຈະລຶມຂໍ້ມູນທັ້ງໝົດຫຼຶບໍ່')
                            if (conFirmDeleteAll){
                                $.ajax({
                            url: 'delete.php',
                            method: 'post',
                            data: {delete : AllIdCheck},
                            success: function(){
                                location.reload()
                            }
                        })
                            }
            })
                })
            } else {
                $('.getIdto_delete').each(function(){
                    this.checked = false
                    $('#checked').hide()
                })
            }
        
        })
        $('.getIdto_delete').on('click', function() {
            var numberChecked = $('.getIdto_delete:checked').length
             if (numberChecked >= 1) {
                $('#checked').text(numberChecked)
                $('#checked').show()
             } else {
                $('#checked').hide()
             }


             if ($('.getIdto_delete').length == $('.getIdto_delete:checked').length) {
                $('#checkAll').prop('checked', true)
             } else {
                $('#checkAll').prop('checked', false)
             }
        })

        // ປຸ່ມລົບ checkbox
        $('.getIdto_delete').change(function() {
            if (this.checked) {
                var id_check = $(this).attr('id');
                
            } 
            
            $('#delete_checkbox').click(function() {
                       var statusComfirm = confirm("ທ່ານຕ້ອງການລົບຂໍ້ມູນນີ້ຫຼຶ ບໍ່")
                       if (statusComfirm) {
                        $.ajax({
                        url: 'delete.php',
                        method: 'post',
                        data: {delete : id_check},
                        success: function(){
                            location.reload()
                        }
                       })
                       }
            })
        })

        // ສົ່ງຄ່າໄປ ເມືອ ມີການ Mouseenter and Mousehover to mouseleave
        $('.view_data').mouseenter(function() {
                $('.collapse').addClass('show');
                var uid = $(this).attr("id");
                    $.ajax({
                        url: 'select.php',
                        method: 'post',
                        dataType: 'json',
                        data: {id : uid},
                        success: function(data){
                            $('#view_id').val(data.id)
                            $('#view-fname').val(data.fname)
                            $('#view_lname').val(data.lname)
                            $("#view_email").val(data.email)
                            $('#view_web').val(data.web)
                        }
                    })
            
        })

        // ລົບ class
        $('.view_data').mouseleave(function() {
            $('.collapse').removeClass('show');
        })
            // ສົ່ງຄ່າເພືອລົບ
        $('.delete_data').click(function() {
            var delete_id = $(this).attr("id")
            var status = confirm("ຕ້ອງການລົບຂໍ້ມູນນີ້ຫຼຶບໍ")
                if (status) {
                    $.ajax({
                    url: 'delete.php',
                    method: 'post',
                    data: {delete : delete_id},
                    success: function() {
                        location.reload()
                    }
                })
                }
        })

        // ນຳຂໍ້ມູນທັ້ງໝົດທີ່ຢູ່ໃນແບບຟ້ອມເພືອ ບັນທືກ
        $("#insert-form").on('submit',function (e) {
            e.preventDefault()
        
            $.ajax({
                url: 'insert.php',
                method: "post",
                data: $('#insert-form').serialize(),//ຄືການສົ່ງຂໍ້ມູນໄປໝົດທັງທີ່ຢູ່ໃນແບບຟ້ອມແລະແປງເປັນ strnig
                beforeSend: function(){ //ຄືການກຳລັງຈະສົ່ງຂໍ້ມູນໄປຈະໃຫ້ມັນເຮັດຫຍັງ
                    $('#btn-insert').html("ກຳລັງບັນທຶກ..")
                },
                success: function(data){ //ເມືອສຳເລັດແລ້ວຈະໃຫ້ມັນເຮັດຫຍັງ
                    $('#insert-form')[0].reset()
                    $('#exampleModal').modal('hide')
                    $('.show').html(data)
                    location.reload()
                }
            })
        })
    });