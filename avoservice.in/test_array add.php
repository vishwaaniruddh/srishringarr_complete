<table>
  <thead>
    <tr>
      <th>Action</th>
      <th>Description</th>
      <th>Qty</th>
      <th>Unit Price</th>
      <th>Amount</th>
       <th>Tax</th>
    </tr>
  </thead>
  <tbody class="items_table">
    <tr class="item-row">
      <td><button id="delete" href="javascript:;" onclick="deleteRow(this)" title="Remove row">Delete</button></td>
      <td><input class="form-control row-desc" id="desc" rows="1"></td>
      <td><input class="form-control tx-right row-qty" type="text" id="qty" onkeyup="calc()" value="0"></td>
      <td><input class="form-control tx-right row-unitprice" type="text" id="unitprice" value="0"></td>
      <td><input class="form-control tx-right row-amount" type="text" id="amount" disabled></td>
      <td>
        <input class="form-control tx-right row-tax" type="text" id="amounttax"></td>
    </tr>
   
  </tbody>
  <tr id="hiderow">
    <td colspan="7" class="tx-center tx-15"><b><a id="addrow" href="javascript:;" title="Add a row"><i class="fe fe-plus-circle"></i>Add an Item</a></b></td>
  </tr>
</table>
<br><br>
<button id="btnAddItem">Create Array</button>

        $(document).ready(function() {
          AddItem();
          $('#addrow').click(function() {
            addItem();
          });
          $('.delete-row').click(function() {
            deleteRow(btn);
          });
        });

        function deleteRow(btn) {
          var row = btn.parentNode.parentNode;
          var next = row.parentNode.rows[row.rowIndex + 0];
          row.parentNode.removeChild(next);
          row.parentNode.removeChild(row);
        }

        function addItem() {

          var itemRow =
            `<tr class="item-row">
            <td><button class="delete-row" href="javascript:; "onclick = "deleteRow(this)">Delete</button></td>
            <td><textarea class="form-control row-desc" id="desc" rows="1"></textarea></td> 
            <td><input class="form-control tx-right row-qty" type="text" id="qty" onkeyup="calc()" value="0"></td>
            <td><input class="form-control tx-right row-unitprice" type="text" id="unitprice" value="0"></td>
            <td><input class="form-control tx-right row-amount" type="text" id="amount" disabled></td>
          <td><input class="form-control tx-right row-tax" type="text" id="amounttax"></td>
            </tr>` ;

          $(".items_table").append(itemRow);

        }

        function AddItem() {
          $("#btnAddItem").click(function(e) {
            //arrayItem
            var arrayItem = [];
            var sArrayItem = "";
/*
            var item = {
              ItemDesc: $("desc").val(),
              ItemUnitPrice: $("unitprice").val(),
              ItemQty: $("qty").val(),
              TaxAmount: $("amounttax").val(),
              ItemTotalAmount: $("amount").val()
            }

            arrayItem.push(item)*/
            // at here, I only able to get the row 1 data, the following added row item didnt get it.
            //byright here should give me array of item, but now I only able get the first row.
        //code to build row data 

        $.each($(".items_table .item-row"),function(index,value){

        let desc = $(this).find(".row-desc").val()
        let qty = $(this).find(".row-qty").val()
        let unitprice = $(this).find(".row-unitprice").val()
        let amount = $(this).find(".row-amount").val()
        let tax = $(this).find(".row-tax").val()
        let item = {
          ItemDesc: desc,
          ItemUnitPrice:unitprice,
          ItemQty: qty,
          TaxAmount: tax,
          ItemTotalAmount: amount,
        }
        arrayItem.push(item)
        });
            console.log(arrayItem)
            sArrayItem = JSON.stringify(arrayItem);

            $.ajax({
              type: "POST",
              url: "AddItem",
              data: JSON.stringify({
                sArrayItem
              }),
              contentType: "application/json; charset=utf-8",
              dataType: "json",
              success: function(result) {

                if (result.d.indexOf(".aspx") != -1)
                  window.location.href = result.d;
                else
                  showPopup(result);
              },
              failure: function(response) {
                alert(response.d);
              }
            });
          });
        };
