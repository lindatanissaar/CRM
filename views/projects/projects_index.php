<div class="row">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Lisa tehing</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Lisa uus tehing</h4>

                </div>
                <div class="modal-body">
                    <div class="modal-body row">
                        <div class="col-md-6">
                            <p>heipa-heipa-paheipaheipaheipaheipaheipa</p>
                        </div>
                        <div class="col-md-6">
                            <p>heipa-heiipaheiheipaheipa</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Sisesta</button>
                </div>
            </div>

        </div>
    </div>

</div>


    <div class="table-responsive">

        <table class="table table-striped table-bordered">

            <thead>

            <tr>
                <th>Nimetus</th>
                <th>Väärtus</th>
                <th>Ettevõte</th>
                <th>Kontaktisik</th>
                <th>E-mail</th>
                <th>Telefon</th>
                <th>Tähtaeg</th>
                <th>Staatus</th>
                <th>Märkused</th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td contenteditable><?= $transaction['NAME'] ?></td>
                    <td contenteditable><?= $transaction['PRICE'] ?></td>
                    <td contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                    <td contenteditable><?= $transaction['CONTACT_PERSON_NAME'] ?></td>
                    <td contenteditable><?= $transaction['EMAIL'] ?></td>
                    <td contenteditable><?= $transaction['PHONE'] ?></td>
                    <td contenteditable><?= $transaction['DEADLINE_DATE'] ?></td>
                    <td contenteditable><?= $transaction['STATUS'] ?></td>
                    <td contenteditable><?= $transaction['NOTE'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

    $("#addTransaction").click(function(){

    })


    })


    var email = $("#email").val();
    var password = $("#password").val();
    var name = $("#name").val();
    var surname = $("#surname").val();
    var address = $("#address").val();
    var postcode = $("#postcode").val();
    var telephone = $("#telephone").val();

    // make $.post query
    $.post("register/addUser", {
        email: email,
        password: password,
        name: name,
        surname: surname,
        address: address,
        postcode: postcode,
        telephone: telephone
    }).done(function (data) {
        // if response from users/addingAdmins is successful, write "Uus kasutaja on lisatud", otherwise alert error
        if (data == "success") {
            document.getElementById("message").innerHTML = "NEW USER WAS MADE. NOW YOU CAN " + '<a href ="login">LOG IN</a>';

        } else {
            document.getElementById("message").innerHTML = '<?= __("THERE WAS AN ERROR") ?>'
        }
    });

</script>
