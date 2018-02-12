<script>

    $(document).ready(function () {
        $('.event').on("dragstart", function (event) {
            var dt = event.originalEvent.dataTransfer;
            dt.setData('Text', $(this).attr('id'));
        });
        $('table td').on("dragenter dragover drop", function (event) {
            event.preventDefault();
            if (event.type === 'drop') {
                var data = event.originalEvent.dataTransfer.getData('Text', $(this).attr('id'));

                de = $('#' + data).detach();
                if (event.originalEvent.target.tagName === "SPAN") {
                    de.insertBefore($(event.originalEvent.target));
                }
                else {
                    de.appendTo($(this));
                }
            }
        });
    })
</script>

<style>

    table {
        background: #f7f6f6;
        width: 100%;
    }

    table th, table td {
        width: 20%;
        height:100px;
        text-align: center;
    }

    table {
        border:1px solid #d6d6d6;
        border-collapse: collapse;
    }

    table td, table th {
        border-left: 1px solid #d6d6d6;
        border-right: 1px solid #d6d6d6;
    }

    table td:first-child {
        border-left: none;
    }

    table td:last-child {
        border-right: none;
    }

    table span {
        display:block;
        background-color: #ebebeb;
        color: fff;
        height: 100px;
        width: 100%;
        border-top: 1px solid #d6d6d6;
        border-bottom: 1px solid #d6d6d6;
    }

    /*success modal*/

    #addTransactionSuccessBody {
        color: white;
        background-color: #5cb85c;
    }

    select.input-sm {
        color: white;
        line-height: 1.5;
        padding: 5px 15px;
        font-weight: bold;
        text-align: center;
    }

    .form-control:focus {
        box-shadow: none;
    }

    option {
        padding: 20px;
        font-size: 12px;
    }

    option:hover {
        background-color: transparent;
    }

    select option,
    select {
        background-color: white;
        /*color: white;*/
    }

    select option[value="STATUS_UNKNOWN"],
    select.STATUS_UNKNOWN {
        background-color: lightgrey;
    }

    select option[value="STATUS_WON"],
    select.STATUS_WON {
        background-color: #5cb85c;

    }

    select option[value="STATUS_LOST"],
    select.STATUS_LOST {
        background-color: red;

    }

    .modal-header {
        background-color: #e5e5e5;
    }

    hr {
        border: 1px solid #8c8b8b;
        margin-top: 15px;
    }

    .vertical-alignment-helper {
        display: table;
        height: 100%;
        width: 100%;
    }

    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
    }

    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width: inherit;
        height: inherit;
        /* To center horizontally */
        margin: 0 auto;
    }

    .modal-header {
        background-color: #eee;
    }

    .modal-footer {
        background-color: #F0F0F0;
    }

    .modal-title {
        padding-left: 48px;
    }

    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    #organisationNameId {
        background: url(assets/img/icon-business.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #email {
        background: url(assets/img/icon-email.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #telephone {
        background: url(assets/img/icon-telephone.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #contactPersonNameId {
        background: url(assets/img/icon-contactperson.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    .row {
        margin-top: 30px;
    }


    .column-left {

    }

    .column-right {
        float: right;

    }

    .hidden {
        display: none;
    }

    #displayTunnel, #displayTable {
        margin-left: 20px;
    }


</style>

<div class="row">

    <div class="column-left">
        <button type="button" class="btn btn-success" data-focus="false" data-toggle="modal" data-keyboard="true"
                data-target="#myModal">Lisa tehing
        </button>

        <a href="salesfunnel"><img src="assets/img/icon-tunnel.png" id="displayTunnel" /></a>
        <a href="projects"><img src="assets/img/icon-table.png" id="displayTable" /></a>

    </div>
</div>

<div class="row">
    <table>
        <tr>
            <th>PÄRING</th>
            <th>TÖÖS</th>
            <th>KOOLITUS</th>
            <th>ÜLE ANTUD</th>
            <th>ABI</th>
        </tr>

        <?php foreach ($transactions as $transaction): ?>

            <tr class="containment-wrapper">
                <td>
            <span class="event" id="<?= $transaction['ID'] ?>" draggable="true"><?= $transaction['NAME'] ?>
            </span>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        <?php endforeach; ?>

    </table>

</div>


<script>


</script>


