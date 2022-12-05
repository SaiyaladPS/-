<?php
    include_once 'Connet.php';

    $select = $conn->prepare("SELECT * FROM users");
    $select->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta hppre-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@300;400;600;700;900&family=Noto+Serif+Lao:wght@200&family=Oswald:wght@200;300&display=swap');

    * {
        font-family: 'Noto Sans Lao', sans-serif;
    }
    </style>
</head>

<body>
    <div class="container pt-3 text-info">
        <h3 class=" bg-success text-info p-2 text-center">ການນຳໃຊ້ Bootstrap: Modal, PHP: PDO MySQL Ajax</h3>
        <button class="btn btn-outline-success" data-bs-toggle="modal"
            data-bs-target="#exampleModal" id="add">ເພິ່ມຂໍ້ມູນ</button>
        <button class="btn btn-outline-danger d-none" id="delete_checkbox">ລົບ<span id="checked"
                class="badge bg-danger rounded-pill"></span></button>
        <table class="table table-dark table-hover mt-3 text-center ">
            <thead>
                <tr>
                    <th>ຊື່</th>
                    <th>ເບີ່ງຂໍ້ມູນເພີ່ມເຕີ່ມ</th>
                    <th>ແກ້ໄຂ</th>
                    <th>ລົບ</th>
                    <th><label for="checkAll">ເລືອກທັງໝົດ</label><input type="checkbox" id="checkAll"
                            class=" form-check-input"></th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $select->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><label for="<?php echo $row['id']?>"><?php echo $row['fname'] ?></label></td>
                    <td><button class="btn btn-outline-primary view_data"
                            id="<?php echo $row['id'] ?>">ຂໍ້ມູນເພິ່ມເຕິມ</button></td>
                    <td><button class="btn btn-outline-warning ebit_data" id="<?php echo $row['id']?>">ແກ້ໄຂ</button>
                    </td>
                    <td><button class=" btn btn-outline-danger delete_data" id="<?php echo $row['id'] ?>">ລົບ</button>
                    </td>
                    <td><input type="checkbox" name="checkbox" class=" form-check-input getIdto_delete"
                            id="<?php echo $row['id']?>"></td>
                </tr>
                <?php } ?>
                <?php require 'showMousehover.php' ?>
            </tbody>
            <?php require 'Modal.php' ?>

            <?php require 'insertModal.php'?>
        </table>
        <div class="show"></div>
    </div>
    <script>
    // ເຂົ້າເຖິງ
    let view_setUp = document.querySelectorAll(".view_data");
    let delete_data = document.querySelectorAll(".delete_data")
    let check_delete = document.querySelectorAll('.getIdto_delete');
    let check_All = document.querySelector('#checkAll')
    let shownumber = document.querySelector('#checked')
    let delete_All = document.querySelector('#delete_checkbox');
    let form = document.querySelector('#insert-form');
    let btnUpdate = document.querySelectorAll('.ebit_data')
    let btnconUp = document.querySelector('#btn-insert');
    let btnAdd = document.querySelector('#add');

    // ປຸ່ມເພິ່ມຂໍ້ມູນ
    btnAdd.addEventListener('click', function() {
        function setval(eve) {
        document.querySelector(eve).setAttribute('value', '')
        return setval
    }
        if (btnconUp.type == 'button') {
            btnconUp.type = 'submit'
            setval('#form_id')
            setval('#form_fname')
            setval('#form_lname')
            setval('#form_email')
            setval('#form_Web')
        }
        document.querySelector('#exampleModalLabel').innerHTML = 'ການບັນທືກຂໍ້ມູນ'
        document.querySelector('#btn-insert').innerHTML = 'ບັນທືກ'

    })
 

    // ປຸ່ມແກ້ໄຂ
                    function val(ele, value) {
                        document.querySelector(ele).setAttribute('value', value)
                    }
    btnUpdate.forEach(element => {
            document.querySelector('#exampleModalLabel').innerHTML = 'ການແກ້ໄຂຂໍ້ມູນ'
            document.querySelector('#btn-insert').innerHTML = 'ແກ້ໄຂ'
                element.setAttribute('data-bs-toggle', 'modal')
                element.setAttribute('data-bs-target', '#exampleModal')
                element.addEventListener('click', function() {
                        var id = element.getAttribute('id');
                        const hppre = new XMLHttpRequest()
                        const urld = 'select.php'
                        const data = 'uid='+ id
                        hppre.open('POST', urld, true)
                        hppre.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        hppre.onreadystatechange = function() { //Call a function when the state changes.
                            if (hppre.readyState == 4 && hppre.status == 200) {
                               var data = hppre.responseText;
                               var dataJson = JSON.parse(data)
                               val('#form_id', dataJson.id)
                               val('#form_fname', dataJson.fname)
                               val('#form_lname', dataJson.lname)
                               val('#form_email', dataJson.email)
                               val('#form_Web', dataJson.web)
                            }
                            btnconUp.type = 'button';
                        }
                        hppre.send(data)
                        })
                });

    // ສົ່ງຂໍ້ມູນໄປແກ້ໄຂ #btn-insertbn
               
    btnconUp.addEventListener('click', function() {
            var id = document.querySelector('#form_id').value
            var fname = document.querySelector('#form_fname').value
            var lname = document.querySelector('#form_lname').value
            var email = document.querySelector('#form_email').value
            var Web = document.querySelector('#form_Web').value

            const hppre = new XMLHttpRequest()
                        const urld = 'update.php'
                        const data = `id=${id}&fname=${fname}&lname=${lname}&email=${email}&Web=${Web}`
                        hppre.open('POST', urld, true)
                        hppre.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        hppre.onreadystatechange = function() { //Call a function when the state changes.
                            if(hppre.readyState == 4 && hppre.status == 200) {
                                btnconUp.type = 'submit'
                                location.reload()
                            }
                        }
                        hppre.send(data)
           
    })


            // ບັນທືກຂໍ້ມູນຈາກແບບຟອມ
            form.addEventListener('submit', (e) => {
                e.preventDefault()
                // ກຳນຳຄ່າໃນແບບຟອນ ແລະ ມາເປັນໃຫ້ເປັນ json ແລະ ສົ່ງໄປ
                const url = "insert.php";
                fetch(url, {
                    method: "POST",
                    body: new FormData(form),
                    // -- or --
                    // body : JSON.stringify({
                    //     form_fname : document.querySelector('#form_fname'),
                    //     form_lname : document.querySelector('#form_lname'),
                    //     form_email : document.querySelector('#form_email'),
                    //     form_Web : document.querySelector('#form_web')
                    // })
                }).then(
                    location.reload()
                )
                // }).then(
                //     response => response.text() // .json(), etc.
                //     // same as function(response) {return response.text();}
                // ).then(
                //     html => console.log(html)
                // );
            })



            // ປຸ່ມເລືອກທັງໝົດ
            check_All.addEventListener('click', function() {
                if (check_All.checked) {
                    for (var i = 0; i < delete_data.length; i++) {
                        check_delete[i].checked = true
                        shownumber.innerText = check_delete.length
                    }
                    delete_All.classList.remove('d-none')
                } else {
                    for (var i = 0; i < delete_data.length; i++) {
                        check_delete[i].checked = false
                        shownumber.innerText = ''
                    }
                    delete_All.classList.add('d-none')
                }
            })
            // ປຸ່ມຕິກລົບເທືອລະອັນ
            check_delete.forEach((input_box) => {
                input_box.addEventListener('click', () => {
                    // var len = [].slice.call(check_delete)
                    // .filter(function(e) { return e.checked; }).length;

                    var len = [].slice.call(check_delete).filter((e) => {
                        return e.checked
                    })
                    if (len.length == check_delete.length) {
                        check_All.checked = true
                    } else {
                        check_All.checked = false
                    }

                    if (len.length > 0) {
                        shownumber.innerHTML = len.length
                        delete_All.classList.remove('d-none')
                    } else {
                        shownumber.innerHTML = ''
                        delete_All.classList.add('d-none')
                    }
                })
            })


            // ປຸ່ມລົບທັ້ງໝົດຂອງຕົວທີ່ມີການຕິກເລືອກ 
            delete_All.addEventListener('click', function() {
                $Confirm = confirm('ທ່ານຍຶນຍັນຈະລົບຂໍ້ມູນທີ່ມີການເລືອກທັງໝົດນີ້ ຫຼື ບໍ')
                if ($Confirm) {
                    check_delete.forEach((id) => {
                    if (id.checked) {
                        const xmlh = new XMLHttpRequest()
                        var uid = id.getAttribute('id');
                        xmlh.open("GET", 'delete.php?delete=' + uid)
                        xmlh.onreadystatechange = function() {
                            if (xmlh.readyState === 4 && xmlh.status === 200) {
                                location.reload()
                            }

                        }
                        xmlh.send()

                    }
                })
                }
            })

            for (var i = 0; i < view_setUp.length; i++) {
                // ເຊັດຄ່າ
                view_setUp[i].setAttribute("data-bs-toggle", "modal")
                view_setUp[i].setAttribute("data-bs-target", "#staticBackdrop")

                // ໃສ່ eve
                view_setUp[i].addEventListener('click', function() {

                    const xhttp = new XMLHttpRequest()
                    // ຮັບຄ່າຈາກ
                    var uid = this.getAttribute("id");
                    // ສົ່ງໄປຂໍຂໍ້ມູນ
                    xhttp.open("GET", "select.php?id=" + uid)
                    xhttp.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            // ແປ່ງເປັນ Json
                            let dataJson = JSON.parse(this.responseText)
                            // ນຳໄປໃສ່
                            inner("#id", dataJson.id)
                            inner("#fname", dataJson.fname)
                            inner("#lname", dataJson.lname)
                            inner("#email", dataJson.email)
                            inner("#Web", dataJson.web)
                        }
                    }
                    xhttp.send()
                })
                delete_data[i].addEventListener('click', function() {

                    const xhttp = new XMLHttpRequest()
                    var uid = this.getAttribute("id");
                    var status = confirm("ທ້າງຕ້ອງການລົບ ຫຼຶ ບໍ່");
                    if (status) {
                        xhttp.open("GET", "delete.php?delete=" + uid)
                        xhttp.send()
                        setTimeout(() => {
                            location.reload()
                        }, 1000)
                    }
                })
            }


            function inner(name, data) {
                document.querySelector(name).innerHTML = data
            }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>